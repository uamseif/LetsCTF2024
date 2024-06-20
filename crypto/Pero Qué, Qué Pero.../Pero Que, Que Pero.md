# Pero Que, Que Pero
## Description
¿?

Archivos:
- `chall.py`
- `output.txt`

## Solution
Se puede expresar \( s \) como \( s = p^q + q^p + kn \) donde \( k \) es un integer. Calculando \( s \mod p \) y \( s \mod q \), se puede aplicar el teorema de Fermat para obtener:
\[ s \equiv q^p \equiv q \mod p \]
\[ s \equiv p^q \equiv p \mod q \]

Usando el teorema chino del resto junto a ese resultado se puede concluir que \( s = p + q \). Las soluciones para la ecuación cuadrática \( x^2 - sx + n = 0 \) son \( x = p, q \).

Estos valores se pueden usar para desencriptar.

```python
import ast
from math import isqrt

with open("./file/output.txt") as f:
    n = ast.literal_eval(f.readline())
    e = ast.literal_eval(f.readline())
    c = ast.literal_eval(f.readline())
    s = ast.literal_eval(f.readline())


def solve_quadratic_equation(b, c):
    """Solve x^2 + bx + c = 0"""
    D = b**2 - 4 * c
    return (-b + isqrt(D)) >> 1, (-b - isqrt(D)) >> 1


p, q = solve_quadratic_equation(-s, n)
assert p > 2 and q > 2 and p * q == n

d = pow(e, -1, (p - 1) * (q - 1))
m = pow(c, d, n)
m = int.to_bytes(m, (m.bit_length() + 7) >> 3, byteorder="big")
m = m.decode()
print(m)
```

## Flag
LetsCTF{p_q_p_q_521d0bd0c283}
