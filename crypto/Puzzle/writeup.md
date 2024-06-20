# Puzzle
- **Categoría:** Crypto
- **Dificultad:** ★☆☆☆☆
- **Autor:** [navaj0](https://github.com/samu-delucas)

### Descripción
Estar familiarizado con diferentes _encodings_ es una habilidad básica para 
competir en CTFs. ¿Podrás descifrar las piezas del puzzle para obtener el mensaje oculto?


### Archivos e instrucciones
- piezas.zip

### Hints
1. Tal vez dcode.fr te dé alguna pista sobre los cifrados
2. También puedes probar cyberchef.org
3. Las piezas están en orden

### Flag
``letsctf{diff3r3nt_3NcOdINGS_F0r_E@CH_pI3cE}``

---

## Writeup 

Para detectar los cifrados se puede utilizar el identificador de cifrados de [dcode.fr](dcode.fr/cipher-identifier).
Para descifrar cada pieza se puede utilizar la misma página, o también [cyberchef.org](cyberchef.org).
### Pieza 1
La pieza `bGV0c2N0ZntkaWY=` es un cifrado en **base64**, un tipo de _encoding_ muy utilizado.

Descifrado nos da `letsctf{dif`.

### Pieza 2
La pieza `66 33 72 33 6e 74 5f 33 4e 63` es algo más familiar, valores en **hexadecimal**.

Descifrado nos da `f3r3nt_3Nc`. 

### Pieza 3
La pieza `~5x}v$0u_C0` está cifrada con **ROT47**, una variante del cifrado césar.

Descifrado nos da `OdINGS_F0r_`.

### Pieza 4
La pieza `V@XS_kR3xV}` está cifrada con cifrado **Atbash**.

Descifrado nos da `E@CH_pI3cE}`.

### Resultado final
Juntando todas las piezas en orden obtenemos la flag.

**Flag**: `letsctf{diff3r3nt_3NcOdINGS_F0r_E@CH_pI3cE}`
