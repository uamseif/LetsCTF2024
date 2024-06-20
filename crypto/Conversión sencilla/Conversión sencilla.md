# Conversión sencilla
## Description
Ayúdame a devolverlo a su estado original, no sé cómo hacerlo...

Archivos:
- `easy_conversion.py`
- `output.txt`

## Solution
Esto es especialmente común en preguntas sobre criptografía, pero a menudo hay situaciones en las que se desea tratar las cadenas como números enteros. Como ejemplo de esta conversión, utilizamos `int.from_bytes` para convertir la bandera en un número entero.

El proceso inverso a este, `int.to_bytes`, se puede hacer usando esto:

```python
flag.to_bytes((flag.bit_length() + 7) // 8, byteorder='big')
```

El script para resolverlo es muy sencillo:

```python
flag = 45931515605221015360233374431880296807621296221414030630676697270864438034431726887206259813910273514610615152253
flag = flag.to_bytes((flag.bit_length() + 7) // 8, byteorder="big")
print(flag)
```

## Flag
LetsCTF{numb3rs_0r_m3554g3s_th4ts_th3_qu3st10n}
