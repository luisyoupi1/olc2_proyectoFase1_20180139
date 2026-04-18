<?php

ini_set('display_errors', '0');
ini_set('display_startup_errors', '0');
ini_set('html_errors', '0');
error_reporting(E_ALL);

header('Content-Type: application/json; charset=utf-8');

ob_start();

set_error_handler(function ($severity, $message, $file, $line) {
    throw new ErrorException($message, 0, $severity, $file, $line);
});

set_exception_handler(function ($e) {
    while (ob_get_level() > 0) {
        ob_end_clean();
    }

    header('Content-Type: application/json; charset=utf-8');

    echo json_encode([
        'output' => '',
        'symbols' => [],
        'errors' => [
            [
                'type' => 'Fatal',
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'column' => 0
            ]
        ]
    ], JSON_UNESCAPED_UNICODE);
    exit;
});

register_shutdown_function(function () {
    $error = error_get_last();

    if ($error !== null) {
        while (ob_get_level() > 0) {
            ob_end_clean();
        }

        header('Content-Type: application/json; charset=utf-8');

        echo json_encode([
            'output' => '',
            'symbols' => [],
            'errors' => [
                [
                    'type' => 'Fatal',
                    'message' => $error['message'],
                    'line' => $error['line'],
                    'column' => 0
                ]
            ]
        ], JSON_UNESCAPED_UNICODE);
        exit;
    }
});

use Antlr\Antlr4\Runtime\InputStream;
use Antlr\Antlr4\Runtime\CommonTokenStream;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../generated/grammar/GolampiLexer.php';
require_once __DIR__ . '/../generated/grammar/GolampiParser.php';
require_once __DIR__ . '/../src/Interpreter/GolampiInterpreter.php';
require_once __DIR__ . '/../src/Interpreter/SyntaxErrorListener.php';

$rawInput = file_get_contents('php://input');
$data = json_decode($rawInput, true);

if (!is_array($data)) {
    while (ob_get_level() > 0) {
        ob_end_clean();
    }

    echo json_encode([
        'output' => '',
        'symbols' => [],
        'errors' => [
            [
                'type' => 'Interno',
                'message' => 'No se pudo decodificar el JSON recibido.',
                'line' => 0,
                'column' => 0
            ]
        ]
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

$code = $data['code'] ?? '';

if (trim($code) === '') {
    while (ob_get_level() > 0) {
        ob_end_clean();
    }

    echo json_encode([
        'output' => 'No se recibió código.',
        'symbols' => [],
        'errors' => []
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

$input = InputStream::fromString($code);

$lexer = new GolampiLexer($input);
$lexerErrorListener = new SyntaxErrorListener();
$lexer->removeErrorListeners();
$lexer->addErrorListener($lexerErrorListener);

$tokens = new CommonTokenStream($lexer);

$parser = new GolampiParser($tokens);
$parserErrorListener = new SyntaxErrorListener();
$parser->removeErrorListeners();
$parser->addErrorListener($parserErrorListener);

$tree = $parser->program();

$errors = [];

foreach ($lexerErrorListener->getErrors() as $error) {
    $errors[] = $error;
}

foreach ($parserErrorListener->getErrors() as $error) {
    $errors[] = $error;
}

if (count($errors) > 0) {
    while (ob_get_level() > 0) {
        ob_end_clean();
    }

    echo json_encode([
        'output' => '',
        'symbols' => [],
        'errors' => $errors
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

$interpreter = new GolampiInterpreter();
$interpreter->visit($tree);

$symbols = [];
foreach ($interpreter->getSymbolTable() as $symbol) {
    $symbols[] = [
        'id' => $symbol->id,
        'type' => $symbol->type,
        'value' => is_bool($symbol->value)
            ? ($symbol->value ? 'true' : 'false')
            : (is_array($symbol->value)
                ? json_encode($symbol->value, JSON_UNESCAPED_UNICODE)
                : $symbol->value),
        'scope' => $symbol->scope,
        'line' => $symbol->line,
        'column' => $symbol->column,
        'isConst' => $symbol->isConst
    ];
}

foreach ($interpreter->getErrors() as $error) {
    $errors[] = [
        'type' => $error->type,
        'message' => $error->message,
        'line' => $error->line,
        'column' => $error->column
    ];
}

while (ob_get_level() > 0) {
    ob_end_clean();
}

echo json_encode([
    'output' => $interpreter->getOutput(),
    'symbols' => $symbols,
    'errors' => $errors
], JSON_UNESCAPED_UNICODE);
exit;