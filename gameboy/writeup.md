# Gameboy
- **Categoría:** Stego
- **Dificultad:** ★★☆☆☆
- **Autor:** [navaj0](https://github.com/samu-delucas)

### Descripción
Mi tío es un apasionado de la Gameboy, tanto que incluso la tiene tatuada. 
Me ha retado a adivinar su juego favorito, pero solo me ha mandado esta foto.
Yo ya lo he resuelto pero, ¿podrás adivinarlo tú?

### Archivos e instrucciones
- gameboy.jpg

### Hints
1. El reto es de la categoría stego
2. Tal vez tenga contraseña. A lo mejor se puede bruteforcear...
3. stegcracker

### Flag
``letsctf{Su_FavOri70_eS_poKEm0N_R0Jo}``

---

## Writeup 
El reto se puede resolver utilizando la herramienta `stegcracker`, que sin opciones
utiliza por defecto la wordlist `rockyou.txt`.

```console
$ stegcracker gameboy.jpg                                                 
StegCracker 2.1.0 - (https://github.com/Paradoxis/StegCracker)
Copyright (c) 2024 - Luke Paris (Paradoxis)

StegCracker has been retired following the release of StegSeek, which 
will blast through the rockyou.txt wordlist within 1.9 second as opposed 
to StegCracker which takes ~5 hours.

StegSeek can be found at: https://github.com/RickdeJager/stegseek

No wordlist was specified, using default rockyou.txt wordlist.
Counting lines in wordlist..
Attacking file 'gameboy.jpg' with wordlist '/usr/share/wordlists/rockyou.txt'..
Successfully cracked file with password: super
Tried 2519 passwords
Your file has been written to: gameboy.jpg.out
super

$ cat gameboy.jpg.out     
letsctf{Su_FavOri70_eS_poKEm0N_R0Jo}
```

**Nota**: Como indica la propia salida del programa, `stegcracker` ha sido sustituido por
`stegseek`, que es increíblemente más rápido. Se puede utilizar de la siguiente forma:
```console
$ stegseek --stegofile gameboy.jpg
StegSeek 0.6 - https://github.com/RickdeJager/StegSeek

[i] Found passphrase: "super"
[i] Original filename: "steganopayload490659.txt".
[i] Extracting to "gameboy.jpg.out".
```

**Flag**: `letsctf{Su_FavOri70_eS_poKEm0N_R0Jo}`