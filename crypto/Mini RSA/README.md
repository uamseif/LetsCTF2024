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
1. El exponente es muy pequeño.
2. Ejemplo: 5^3 = 20 (mod 21). Particularmente, 5^3 = 20 + 21*x, donde x es pequeño.
3. Prueba multiplicidades entre 3000 y 4000.
