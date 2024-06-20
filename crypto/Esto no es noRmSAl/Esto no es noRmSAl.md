# Esto no es noRmSAl
## Description
A veces un solo parámetro extra lo cambia todo... JAJAJAJAJRSAJA

Archivos:
- `encrypt.py`
- `output.txt`

## Solution
Este problema \( M = 2p + q \) tiene un parámetro que normalmente no existe en un RSA normal. Esto es porque hay 2 variables \( p, q \) desconocidas y dos variables \( p, q \) conocidas para \( N, M \).

\[ x^2 - (2p+q)x + 2pq = 0 \]

Se puede hacer factorización y se puede transformar en \( (x - 2p)(x - q) = 0 \) y encontrar dos soluciones que son \( 2p \) y \( q \).

Desde que a partir de esto se puede encontrar \( p \) y \( q \), se puede desencriptar hallando la clave privada de \( q \).

```python
import gmpy2
from Crypto.Util.number import long_to_bytes

with open("../output.txt") as f:
    N = int(f.readline().split(" = ")[-1])
    M = int(f.readline().split(" = ")[-1])
    e = int(f.readline().split(" = ")[-1])
    c = int(f.readline().split(" = ")[-1])


def solve_quad_equation(a, b, c):
    d = gmpy2.isqrt(b ** 2 - 4 * a * c)
    return (d - b) // (2 * a), (-d - b) // (2 * a)


P, Q = solve_quad_equation(1, -M, 2 * N)

if P % 2 == 0:
    p, q = P // 2, Q
else:
    p, q = Q, P // 2

d = pow(e, -1, (p - 1) * (q - 1))
m = pow(c, d, N)
plaintext = long_to_bytes(m)
print(plaintext.decode().strip())
```

## Flag
LetsCTF{h3h3_n0_ex7ra_param3ters_pl34s3}
