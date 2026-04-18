# Manual Técnico
## Golampi Interpreter

**Curso:** Organización de Lenguajes y Compiladores 2  
**Universidad:** Universidad de San Carlos de Guatemala  
**Facultad:** Ingeniería – Ciencias y Sistemas  

---

# 1. Introducción

El proyecto **Golampi Interpreter** consiste en el desarrollo de un intérprete para el lenguaje Golampi, un lenguaje académico inspirado en la sintaxis de Go.  

El sistema implementa las fases principales de procesamiento de lenguajes de programación:

- Análisis léxico
- Análisis sintáctico
- Análisis semántico
- Ejecución del programa
- Generación de reportes

El intérprete permite ejecutar programas escritos en Golampi mediante una interfaz web.

---

# 2. Arquitectura del sistema

El sistema utiliza una arquitectura **cliente-servidor monolítica**.

## Componentes

### Frontend

Implementado con:

- HTML
- CSS
- JavaScript

Responsabilidades:

- Editor de código
- Envío del código al servidor
- Visualización de resultados
- Visualización de errores
- Visualización de la tabla de símbolos

---

### Backend

Implementado con:

- PHP
- ANTLR4

Responsabilidades:

- Interpretar código Golampi
- Ejecutar análisis léxico
- Ejecutar análisis sintáctico
- Ejecutar análisis semántico
- Ejecutar el programa

---

# 3. Tecnologías utilizadas

| Tecnología | Uso |
|-----------|------|
| PHP | Implementación del intérprete |
| ANTLR4 | Generación del parser |
| HTML | Interfaz gráfica |
| CSS | Estilos |
| JavaScript | Comunicación con backend |
| Apache / XAMPP | Servidor web |

---

# 4. Estructura del proyecto


golampi-interpreter
│
├── grammar
│ └── Golampi.g4
│
├── generated
│ └── grammar
│ ├── GolampiLexer.php
│ ├── GolampiParser.php
│ └── GolampiVisitor.php
│
├── src
│ ├── Interpreter
│ │ └── GolampiInterpreter.php
│ │
│ ├── Semantics
│ │ ├── SymbolTable.php
│ │ └── SemanticError.php
│ │
│ └── Http
│ └── SyntaxErrorListener.php
│
├── public
│ ├── index.php
│ ├── run.php
│ ├── app.js
│ └── style.css
│
└── vendor


---

# 5. Flujo de ejecución

El proceso de interpretación sigue el siguiente flujo:

1. El usuario escribe código Golampi en el editor.
2. El código se envía al backend mediante HTTP.
3. El backend ejecuta el análisis léxico.
4. Se genera el árbol sintáctico mediante ANTLR.
5. Se realiza el análisis semántico.
6. Se ejecuta el programa desde la función `main`.
7. Se generan los reportes de salida, errores y tabla de símbolos.

---

# 6. Tabla de símbolos

La tabla de símbolos almacena la información de los identificadores utilizados durante el programa.

| Campo | Descripción |
|------|-------------|
| ID | Nombre del identificador |
| Tipo | Tipo de dato |
| Valor | Valor actual |
| Ámbito | Contexto donde fue declarado |
| Línea | Línea de declaración |
| Columna | Posición |

Ejemplo:

ID: x | Tipo: int32 | Valor: 10 | Ámbito: block_1 | Línea: 2 | Columna: 4

---

# 7. Manejo de errores

El sistema detecta tres tipos de errores:

## Errores léxicos

Caracteres no reconocidos en el código.

Ejemplo:

@
Errores sintácticos

Errores en la estructura del programa.

Ejemplo:

if x > 10

Falta {}.

Errores semánticos

Errores relacionados con la lógica del programa.

Ejemplo:

x = y

cuando y no ha sido declarada.

8. Funciones embebidas

El lenguaje Golampi implementa las siguientes funciones:

Función	Descripción
fmt.Println	Imprime valores
len	Retorna longitud
now	Fecha actual
substr	Extrae subcadena
typeOf	Retorna tipo de variable