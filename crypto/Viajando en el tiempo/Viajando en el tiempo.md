# Viajando en el tiempo
## Description
Nadie puede saber mi secreto, por si acaso lo he encriptado. Buena suerte con ello, a menos que seas un viajero del tiempo...

Archivos:
- `chall.py`
- `flag.enc`

## Solution
El problema consiste en desencriptar un mensaje que ha sido cifrado en dos etapas:

1. **Paso 1: Encriptado por una permutación aleatoria de índices**: El mensaje original ha sido permutado usando una clave aleatoria que determina el orden de los índices del mensaje.

2. **Paso 2: Encriptado con la hora actual como semilla y XOR**: La hora actual (en forma de bytes) se añade al mensaje encriptado del Paso 1 y luego se realiza un XOR con `0x42` para obtener el mensaje final.

Para desencriptar:

- Se extraen los últimos 18 bytes del mensaje encriptado (`flag.enc`), que corresponden a la hora encriptada.
- Se hace XOR con `0x42` para recuperar la hora original.
- Usando esta hora como semilla, se genera la clave aleatoria para el Paso 1 y se recupera el mensaje encriptado original (eliminando los últimos 18 bytes que corresponden a la hora).
- Se realiza un proceso de fuerza bruta sobre todas las permutaciones posibles de `[0, 1, 2, 3, 4, 5, 6, 7]` (que son las posibles claves de permutación) para deshacer la permutación del Paso 1.
- Se comprueba cada mensaje desencriptado para verificar si contiene la estructura `LetsCTF{...}`.

```python
#!/usr/bin/env python3
import random
import itertools

def dec(ctxt, key):
    groups = []
    i = 0

    # Split ctxt into groups according to key
    for k in range(8):
        grp = []
        tmp = 0
        if key[k] < len(ctxt) % 8:
            tmp = 1
        for j in range(int(len(ctxt) / 8) + tmp):
            grp += [ctxt[i + j]]
        groups += [grp]
        i += j + 1

    # Arrange the letters according to key
    m = ['*'] * len(ctxt)
    for k in range(8):
        i = 0
        for j in range(key[k], len(ctxt), 8):
            m[j] = groups[k][i]
            i += 1

    return ''.join(m)

with open("flag.enc", "rb") as f:
    enc = list(f.read())
    time_info = enc[-18:]
    time = [i ^ 0x42 for i in time_info]
    msg = enc[:-18]

    random.seed(''.join([chr(i) for i in time]))

    key = [random.randrange(256) for _ in msg]
    c = [m ^ k for m, k in zip(msg + time, key + [0x42] * len(time))]

    answer = ''.join([chr(i) for i in c])
    answer = answer[:-18]  # Remove time info

    all_possible_keys = list(itertools.permutations([0, 1, 2, 3, 4, 5, 6, 7]))
    print('Possible Flags: ')

    # Brute-force the key
    for key in all_possible_keys:
        m = answer
        for _ in range(42):
            m = dec(m, key)
        if "LetsCTF{" in m and m[-1] == '}':
            print(m)
```

## Flag
LetsCTF{Y0U_F0UND_M3_1N_TH3_P4ST}
