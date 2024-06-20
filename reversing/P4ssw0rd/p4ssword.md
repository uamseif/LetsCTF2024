# P4ssw0rd
## Description
Este archivo ELF requiere una contraseña. ¿Hay alguna forma de echar un ojo dentro sin conocerla?

Archivos: 

- `password`

## Solution

Muy sencillo, basta con utilizar el comando strings para obtener todos los strings del ejecutable.

```console
$ strings password | grep LetsCTF
FLAG is LetsCTF{y0u_kn0w_c0s1t4s_c0ngr4ts}
```

También se podría utilizar un decompilador o un editor binario.

## Flag
LetsCTF{y0u_kn0w_c0s1t4s_c0ngr4ts}
