# Binario
## Description
Todo son ceros y unos. Utiliza ejemplo.py como referencia.

Archivos:
- `binario.csv`
- `ejemplo.py`

## Solution

Dado que simplemente estamos convirtiendo la cadena de bandera a binario y convirtiéndola en un número binario, todo lo que tenemos que hacer es condensarla 1 bit a la vez y generarla mientras la convertimos al tipo char. 

La primera columna del archivo csv es una marca de tiempo, por lo que debe mirar la segunda columna.

Se puede resolver por tanto el reto con el siguiente script:

```python
fp = open("./binario.csv", "r")

vals = fp.readlines()

c = 0
for i in range(len(vals)):
    val = int(vals[i])
    c = (c << 1) | val
    if i % 8 == 7:
        print(chr(c), end="")
        c = 0

print("")
```

## Flag
LetsCTF{now_you_speak_my_language}
