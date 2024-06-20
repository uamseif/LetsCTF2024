# Una Más
## Description
A ver cuántos intentos te lleva..

Archivos:
- `unamas.py`
- `output.txt`

## Solution
Este programa genera un array `arr` de longitud 41 de integers entre 1 y \( 2^{64} \). Luego genera un array `s_arr` de forma que cada elemento es la suma de `arr[j]` multiplicado por `ord(FLAG[j])` y en cada paso `arr` es rotado en sentido horario una vez.

El archivo `output.txt` contiene el output del programa tras usar la flag, y sabemos que la longitud del array `s_arr` es 41.

Si consideramos que cada caracter del flag tiene un valor ASCII \( f_i \) y el valor de `arr` será \( a_i \) para \( i = 0..40 \), tendremos ecuaciones de la forma:

\[ f_0 \cdot a_0 + f_1 \cdot a_1 + \ldots + f_{40} \cdot a_{40} = s_0 \]
\[ f_0 \cdot a_{40} + f_1 \cdot a_0 + \ldots + f_{40} \cdot a_{39} = s_1 \]
\[ f_0 \cdot a_{39} + f_1 \cdot a_{40} + \ldots + f_{40} \cdot a_{38} = s_2 \]
\[ \ldots \]
\[ f_0 \cdot a_2 + f_1 \cdot a_3 + \ldots + f_{40} \cdot a_1 = s_{39} \]

Por lo tanto, tenemos 40 ecuaciones con 40 variables desconocidas \( f_i \) para \( i = 1, 2, \ldots, 40 \). Sin embargo, conocemos el valor de algunas de ellas ya que sabemos que el flag tiene la forma `LetsCTF{[0-9a-f]{32}}`.

Por ejemplo, se sabe que \( f_6 = \text{ord}('f') = 102 \), lo que reduce en una el número de ecuaciones desconocidas y se pueden resolver usando álgebra lineal.

Se ha utilizado SymPy para este caso porque permite trabajar con precisión infinita en las operaciones algebraicas:

```python
from z3 import *

arr = eval(open('salida.txt', 'r').read().split('\n')[0])
arr_s = eval(open('salida.txt', 'r').read().split('\n')[1])

s = Solver()

# Longitud del flag es 41
flag = [Int(f'flag_{i}') for i in range(41)]

s.add(flag[0] == ord('L'))
s.add(flag[1] == ord('e'))
s.add(flag[2] == ord('t'))
s.add(flag[3] == ord('s'))
s.add(flag[4] == ord('C'))
s.add(flag[5] == ord('T'))
s.add(flag[6] == ord('F'))
s.add(flag[7] == ord('{'))
s.add(flag[-1] == ord('}'))

# Restricciones para los caracteres del flag
for i in range(8, len(flag) - 1):
    s.add(Or(And(flag[i] >= ord('a'), flag[i] <= ord('f')), And(flag[i] >= ord('0'), flag[i] <= ord('9'))))

# Establecer las ecuaciones
for i in range(40):
    s.add(Sum([arr[j] * flag[j] for j in range(41)]) == arr_s[i])
    arr = [arr[-1]] + arr[:-1]

# Verificar si hay solución
if s.check() == sat:
    m = s.model()
    print('flag: ', end='')
    print(''.join([chr(m[flag[i]].as_long()) for i in range(41)]))
else:
    print('unsat')
```

## Flag
LetsCTF{adfa3c65b743ff5d3eef3a501c4ba110}
