# Integenerador
## Description
Este generador devuelve un integer de 16 dígitos si introduces cualquier integer entre 0 y 2^35. ¿Podrías decirnos cuáles son los valores de flag1, flag2 y flag3?

Archivos:
- `generator.py`
- `output.txt`

## Solution
Si se intenta encontrar el flag a base de una búsqueda, se van a tener que buscar entre más de 2^35 posibilidades, lo que no es muy acertado.

Si se prueba, la cantidad de impares es bastante alta.

Como cada una de las salidas son números pares, lo mejor es centrarse en eso. La paridad de estos valores retornados por el generador concuerda con la paridad del valor que retorna `pad()`.

En `pad()`, si el primer argumento es positivo, el valor de retorno es par; si el primer argumento es negativo, el resultado será impar. En nuestro caso, son números pares.

Hay que fijarse en `f(x)` para encontrar cuando el primer argumento de `pad()` es positivo. El signo del valor de retorno de `f(x)` cambia dependiendo de si \( x^2 \% r \) (r=2^k) es par o impar; es positivo cuando es par y negativo cuando es impar.

Teniendo en cuenta eso, se puede considerar el caso donde \( x^2 = 0 \mod r \), \( x = r \cdot i \) (para toda i entera contenida en \([0..2^{(k//2-1)}]\)).

Con \( 2^{(k//2-1)} = 2^{17} \), se puede hacer una búsqueda partiendo de ahí.

```python
import random

k = 36
maxlength = 16


def f(x, cnt):
    cnt += 1
    r = 2 ** k
    if x == 0 or x == r:
        return -x, cnt
    if x * x % r != 0:
        return -x, cnt
    else:
        return -x * (x - r) // r, cnt


def g(x):
    ret = x * 2 + x // 3 * 10 - x // 5 * 10 + x // 7 * 10
    ret = ret - ret % 2 + 1
    return ret, x // 100 % 100


def digit(x):
    cnt = 0
    while x > 0:
        cnt += 1
        x //= 10
    return cnt


def pad(x, cnt):
    minus = False
    if x < 0:
        minus = True
        x, cnt = g(-x)
    sub = maxlength - digit(x)
    ret = x
    for i in range(sub - digit(cnt)):
        ret *= 10
        if minus:
            ret += pow(x % 10, x % 10 * i, 10)
        else:
            ret += pow(i % 10 - i % 2, i % 10 - i % 2 + 1, 10)
    ret += cnt * 10 ** (maxlength - digit(cnt))
    return ret


def int_generator(x):
    ret = -x
    x_, cnt = f(x, 0)
    while x_ > 0:
        ret = x_
        x_, cnt = f(x_, cnt)
    return pad(ret, cnt)


target1 = 1008844668800884
target2 = 2264663430088446
target3 = 6772814078400884

divisor = 2 ** (k // 2)
bound = 2 ** (k // 2 - 1)

for i in range(bound + 1):
    ni = int_generator(i * divisor)
    if ni == target1:
        print("flag1:{}".format(i * divisor))
    if ni == target2:
        print("flag2:{}".format(i * divisor))
    if ni == target3:
        print("flag3:{}".format(i * divisor))
```

## Flag
LetsCTF{0_26476544_34359738368}
