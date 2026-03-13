---

# 📄 manual-usuario.md

```markdown
# Manual de Usuario
## Golampi Interpreter

**Curso:** Organización de Lenguajes y Compiladores 2  
**Universidad:** Universidad de San Carlos de Guatemala  

---

# 1. Introducción

El sistema **Golampi Interpreter** permite escribir, analizar y ejecutar programas escritos en el lenguaje Golampi mediante una interfaz web.

El sistema permite:

- Crear código
- Ejecutar programas
- Visualizar resultados
- Consultar errores
- Consultar tabla de símbolos

---

# 2. Interfaz del sistema

La interfaz está compuesta por cuatro áreas principales.

## Editor de código

Área donde el usuario escribe el programa.

Ejemplo:


func main() {
fmt.Println("Hola mundo")
}


---

## Barra de acciones

| Botón | Función |
|------|--------|
| Ejecutar / Analizar | Ejecuta el código |
| Limpiar editor | Borra el código |
| Limpiar consola | Limpia resultados |

---

## Consola de salida

Muestra el resultado del programa.

Ejemplo:


valor: 10


---

## Panel de reportes

El sistema muestra:

- Tabla de símbolos
- Tabla de errores

---

# 3. Cómo ejecutar un programa

Ejemplo:


func main() {
var x int32 = 10;
fmt.Println(x);
}


### Pasos

1. Escribir el código en el editor.
2. Presionar **Ejecutar / Analizar**.
3. El sistema procesa el programa.
4. El resultado aparece en la consola.

---

# 4. Ejemplo de uso

Código:


func main() {
var nums = [3]int32{10,20,30};
fmt.Println(nums[1]);
}


Resultado esperado:


20


---

# 5. Interpretación de errores

Si el programa contiene errores, se mostrará una tabla con la siguiente información:

| Tipo | Descripción | Línea | Columna |

Ejemplo:

| Tipo | Descripción | Línea |
|-----|-------------|------|
| Semántico | Variable no declarada | 3 |

---

# 6. Recomendaciones

- Todo programa debe contener la función `main`.
- Las variables deben declararse antes de usarse.
- Las operaciones deben respetar los tipos de datos.
