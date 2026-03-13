# Manual de Usuario
## Intérprete Golampi

**Curso:** Organización de Lenguajes y Compiladores 2  
**Universidad:** Universidad de San Carlos de Guatemala  
**Facultad:** Ingeniería – Ciencias y Sistemas  

---

# 1. Introducción

El **Intérprete Golampi** es una aplicación web que permite escribir, analizar y ejecutar programas en el lenguaje Golampi.  

La herramienta proporciona un entorno simple donde el usuario puede:

- Escribir código Golampi
- Ejecutar programas
- Visualizar la salida del programa
- Consultar errores del código
- Visualizar la tabla de símbolos generada durante la ejecución

Este sistema permite comprender el funcionamiento de un intérprete de lenguajes de programación mediante una interfaz sencilla y accesible desde el navegador.

---

# 2. Requisitos del sistema

Para utilizar el intérprete Golampi se requiere:

- Navegador web moderno (Chrome, Firefox, Edge, Opera)
- Servidor web con soporte PHP
- XAMPP o entorno equivalente
- Conexión local al servidor

---

# 3. Acceso al sistema

Para acceder al intérprete se debe abrir el navegador e ingresar la siguiente dirección:


http://localhost/golampi-interpreter/public/


Al ingresar, se mostrará la interfaz principal del sistema.

---

# 4. Interfaz del sistema

La interfaz está compuesta por cuatro secciones principales.

## 4.1 Editor de código

Es el área donde el usuario escribe el programa en lenguaje Golampi.

Ejemplo de código:


func main() {
fmt.Println("Hola mundo")
}


El editor permite modificar libremente el código antes de ejecutarlo.

---

## 4.2 Barra de acciones

Debajo del editor se encuentran los botones principales del sistema.

| Botón | Descripción |
|------|-------------|
| Ejecutar / Analizar | Ejecuta el programa escrito en el editor |
| Limpiar editor | Elimina el contenido del editor |
| Limpiar consola | Limpia los resultados de ejecución |

---

## 4.3 Consola de salida

La consola muestra el resultado de la ejecución del programa.

Ejemplo:


Hola mundo


También se mostrarán valores impresos por funciones como:


fmt.Println()


---

## 4.4 Tabla de símbolos

La tabla de símbolos muestra las variables utilizadas en el programa.

La tabla incluye la siguiente información:

| Campo | Descripción |
|------|-------------|
| ID | Nombre de la variable |
| Tipo | Tipo de dato |
| Valor | Valor actual de la variable |
| Ámbito | Bloque donde fue declarada |
| Línea | Línea de declaración |
| Columna | Posición en el código |
| Constante | Indica si es constante |

Ejemplo:

| # | ID | Tipo | Valor | Ámbito | Línea | Columna | Constante |
|---|----|------|------|------|------|------|------|
| 1 | x | int32 | 10 | block_1 | 2 | 4 | no |

---

## 4.5 Tabla de errores

La tabla de errores muestra los problemas detectados durante el análisis del programa.

Los errores pueden ser:

- Léxicos
- Sintácticos
- Semánticos

La tabla muestra la siguiente información:

| Campo | Descripción |
|------|-------------|
| Tipo | Tipo de error |
| Descripción | Explicación del error |
| Línea | Línea donde ocurre |
| Columna | Posición del error |

Ejemplo:

| # | Tipo | Descripción | Línea | Columna |
|---|------|-------------|------|------|
| 1 | Semántico | Variable no declarada | 3 | 5 |

---

# 5. Ejecución de un programa

Para ejecutar un programa en Golampi se deben seguir los siguientes pasos.

### Paso 1
Escribir el código en el editor.

Ejemplo:


func main() {
var x int32 = 10;
fmt.Println("valor:", x);
}


### Paso 2
Presionar el botón **Ejecutar / Analizar**.

### Paso 3
El sistema procesará el código.

### Paso 4
Se mostrarán los resultados en:

- Consola de salida
- Tabla de símbolos
- Tabla de errores (si existen)

---

# 6. Ejemplo completo de ejecución

Programa:


func main() {
var nums = [3]int32{10,20,30};
fmt.Println(nums[1]);
}


Resultado en consola:


20


Tabla de símbolos generada:

| ID | Tipo | Valor |
|----|------|------|
| nums | array | [10,20,30] |

---

# 7. Manejo de errores

Si el programa contiene errores, el sistema los mostrará automáticamente.

## Ejemplo de error semántico

Código:


func main() {
fmt.Println(x)
}


Resultado:

| Tipo | Descripción |
|------|-------------|
| Semántico | Variable x no declarada |

---

# 8. Recomendaciones de uso

Para evitar errores durante la ejecución del programa se recomienda:

- Declarar las variables antes de utilizarlas.
- Asegurarse de que el programa contenga la función `main`.
- Utilizar correctamente los tipos de datos.
- Verificar la sintaxis del código.

---
