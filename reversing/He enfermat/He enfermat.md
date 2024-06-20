# He enfermat
## Description
He enfermado y creo que no tiene solución...

Archivos: 

- `enfermat`

## Solution

En este caso lidiamos con un problema que necesita de cierta información sobre matemáticas. El último teorema de Fermat dice así: 

> Si $n$ es un número entero mayor o igual que $3$, entonces no existen números enteros positivos $a$, $b$ y $c$, tales que se cumpla la igualdad $a^3 + b^3= c3$.

La aplicación de este teorema la encontramos a la hora de ejecutar el archivo `enfermat`, ya que se nos pedirán los valores de a, b y c para obtener el flag y de ninguna manera será posible.

Existen varios métodos para abordar este problema, como el análisis dinámico, que implica saltar a `print_flag` usando depuradores como GDB, o el análisis estático, que implica analizar y replicar las zonas que dan como salida el flag usando decompiladores como Ghidra.

En primer lugar vamos a ver de que tipo de archivo se trata:

```console
$ file enfermat
enfermat: ELF 64-bit LSB pie executable, x86-64, version 1 (SYSV), dynamically linked, interpreter /lib64/ld-linux-x86-64.so.2, BuildID[sha1]=bcffc3048542c15898f0224deeba749ecd62af4a, for GNU/Linux 3.2.0, not stripped
```

Una vez vemos que es ELF (Executable and Linkable Format) procedemos a examinarlo con GDB:

```console
gdb enfermat
info functions
```

En este punto listaremos las funciones para ver si hay algo interesante:

```
0x0000000000001000  _init
0x0000000000001030  puts@plt
0x0000000000001040  printf@plt
0x0000000000001050  __isoc99_scanf@plt
0x0000000000001060  __cxa_finalize@plt
0x0000000000001070  _start
0x00000000000010a0  deregister_tm_clones
0x00000000000010d0  register_tm_clones
0x0000000000001110  __do_global_dtors_aux
0x0000000000001150  frame_dummy
0x0000000000001159  check
0x00000000000011b3  print_flag
0x0000000000001351  main
0x000000000000144c  _fini
```

En este punto ya sabemos que hay un función que probablemente chequee los números que metemos y otra que nos va a imprimir posiblemente la flag. Comenzamos poniendo un punto de ruptura en la función `check`:

```console
break check
Breakpoint 1 at 0x115d
(gdb) run
Starting program: /home/kali/kali_Shared/enfermat 
[Thread debugging using libthread_db enabled]
Using host libthread_db library "/lib/x86_64-linux-gnu/libthread_db.so.1".
Input a> 1
Input b> 2
Input c> 3
(a, b, c) = (1, 2, 3)

Breakpoint 1, 0x000055555555515d in check ()
```

Finalmente llamamos a la función que contiene la flag de la siguiente forma:

```
(gdb) call (void) 0x00005555555551b3()
``` 

## Flag
LetsCTF{y0u_n33d_4_l0t_0f_t1me_4nd_3ff0rt_t0_s0lv3_r3v3rs1ng_208b47bd66c2}