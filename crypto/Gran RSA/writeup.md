# Gran RSA
- **Categoría:** Crypto
- **Dificultad:** ★★★☆☆
- **Autor:** [Bubbasm](https://github.com/Bubbasm)

### Descripción
Típico challenge de RSA.

### Archivos e instrucciones
- encrypt.py

### Hints
1. Fuerza bruta con los k posibles
2. getPrime(2048)^2 es mucho menor que factorial(k)
3. gcd para sacar getPrime(256)

### Flag
`letsctf{gcd_E5_Muy_U7il}`
---

## Writeup 
Este es un reto típico de RSA, donde se encripta la flag con la clave pública y es necesario recuperar la clave privada para desencriptar.

Los pasos para resolverla son hacer fuerza bruta de los valores posibles de k (600 casos es muy poco). `leak - k` es múltiplo del primo getPrime(256), de ahora en adelante `x`. Al hacer módulo `factorial(k)` de `leak - k` obtenemos la parte que no lo está multiplicando, es decir, `e^2 * x`. Por otro lado, al realizar una división entera por `factorial(k)`, obtenemos `(e*d-1) * x` y el resto no sobrepasa factorial más porque `e^2` es mucho menor que `factorial(k)`.

Esta es una posible solución:

```python
from gmpy2 import isqrt
from math import gcd
from sympy import factorial

from Crypto.Util.number import isPrime, long_to_bytes

n = ...
c = ...
leak = ...

for k in range(600, 1200 + 1):
    f = int(factorial(k))
    e2_x = (leak - k) % f
    ed_1_x = (leak - k) // f
    x = gcd(e2_x, ed_1_x)

    if isPrime(x) and x.bit_length() == 256:
        e = isqrt(e2_x // x)
        d = (ed_1_x // x + 1) // e

        if isPrime(e) and e.bit_length() == 2047 and d.bit_length() >= 2047:
            k_phi_n = e * d - 1
            d_test = pow(65537, -1, k_phi_n)
            print(long_to_bytes(pow(c, d_test, n)))
            break
```

**Flag**: `letsctf{gcd_E5_Muy_U7il}`
