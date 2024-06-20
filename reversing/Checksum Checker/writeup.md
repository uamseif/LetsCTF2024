# Checksum Checker
- **Categoría:** Reversing
- **Dificultad:** ★☆☆☆☆
- **Autor:** [Bubbasm](https://github.com/Bubbasm)

### Descripción
Se realiza una comprobación de la clave de alguna forma. ¿Podrás encontrar qué clave poner para sacar la flag?

### Archivos e instrucciones
- checker

### Hints
1. Busca entre las strings del programa.
2. ¿Qué algoritmo de checksum se utiliza en el programa?
3. Aplica el algoritmo a la string.

### Flag
`letsctf{d286fdb1b2567940e8857d9a875764df}`
---

## Writeup  
Si intentamos ejecutar el programa sin ninguna flag, obtenemos un mensaje de error pidiendo la clave:

``
Usage:
./checker <clave>
``

Poniendo cualquier clave incorrecta obtenemos:

``
$ ./checker 123
Incorrecto, vuelve a intentarlo mas tarde.
``

Ejecutando `ltrace` sobre el programa vemos que se obtiene el siguiente resultado:

```
$ ltrace ./checker test
strlen("es_esta_la_flag?")                                                                  = 16
sprintf("d2", "%02x", 0xd2)                                                                 = 2
sprintf("86", "%02x", 0x86)                                                                 = 2
sprintf("fd", "%02x", 0xfd)                                                                 = 2
sprintf("b1", "%02x", 0xb1)                                                                 = 2
sprintf("b2", "%02x", 0xb2)                                                                 = 2
sprintf("56", "%02x", 0x56)                                                                 = 2
sprintf("79", "%02x", 0x79)                                                                 = 2
sprintf("40", "%02x", 0x40)                                                                 = 2
sprintf("e8", "%02x", 0xe8)                                                                 = 2
sprintf("85", "%02x", 0x85)                                                                 = 2
sprintf("7d", "%02x", 0x7d)                                                                 = 2
sprintf("9a", "%02x", 0x9a)                                                                 = 2
sprintf("87", "%02x", 0x87)                                                                 = 2
sprintf("57", "%02x", 0x57)                                                                 = 2
sprintf("64", "%02x", 0x64)                                                                 = 2
sprintf("df", "%02x", 0xdf)                                                                 = 2
strlen("test")                                                                              = 4
printf("Incorrecto, vuelve a intentarlo "...)                                               = 42
Incorrecto, vuelve a intentarlo mas tarde.+++ exited (status 0) +++
```

Genera gran sospecha la string "es_esta_la_flag?" y las asignaciones a una string de los valores en hexadecimal.
Si probamos a introducir la flag "es_esta_la_flag?", nos vuelve a salir el mensaje de error.

`sprintf` está asignando a una string los bytes especificados. Poniendo las piezas juntas, obtenemos la string `d286fdb1b2567940e8857d9a875764df`, que si lo buscamos en dcode.fr, nos indica que es un código MD5. 
Podemos abrir el programa con nuestro debugger de confianza, por ejemplo ghidra. Vemos que se realiza una llamada `md5String("es_esta_la_flag?",local_48);`. En efecto, la string que habíamos sacado es el checksum MD5 de "es_esta_la_flag?".

Probando el checksum obtenemos la flag:

``
$ ./checker d286fdb1b2567940e8857d9a875764df
Correcto, la flag es letsctf{d286fdb1b2567940e8857d9a875764df}
``

**Flag**: `letsctf{d286fdb1b2567940e8857d9a875764df}`.
