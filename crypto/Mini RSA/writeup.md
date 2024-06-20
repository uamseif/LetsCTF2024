# Mini RSA
- **Categoría:** Crypto
- **Dificultad:** ★☆☆☆☆
- **Autor:** [Bubbasm](https://github.com/Bubbasm)

_Reto adaptado de picoCTF_

### Descripción
Seguro que te suena el método de cifrado RSA. Es un método seguro, pero
siempre que los parámetros tengan cierto tamaño suficientemente grande.
Veamos si puedes resolver el reto.

Nota: Puede ser de utilidad la librería de python `gmpy2`.

### Archivos e instrucciones
- datos.txt

### Hints
1. El exponente es muy pequeño, fuerza bruta.
2. Ejemplo: 5^3 = 20 (mod 21). Particularmente, 5^3 = 20 + 21*x, donde x es pequeño.
3. Prueba multiplicidades entre 3000 y 4000.

### Flag
`letsctf{e_deB3r1a_De_s3r_gr4nD3}`
---

## Writeup

Con probar varias multiplicidades podemos ver cual funciona. `gmpy2.iroot` nos devuelve la raíz n-ésima como número entero (más preciso que floats), y también nos indica si es una raíz exacta o no. El mensaje deberá de ser una raíz exacta, ya que se obtinen como M^e mod n.

```python
from gmpy2 import iroot
from Crypto.Util.number import long_to_bytes

n =...
e = 3
c = ...

mult = [iroot(c+n*i, e)[1] for i in range(10000)].index(True)
print(mult)

message = long_to_bytes(iroot(c+n*mult, e)[0])
print(message)
```

Así obtenemos la flag `letsctf{e_deB3r1a_De_s3r_gr4nD3}`.
