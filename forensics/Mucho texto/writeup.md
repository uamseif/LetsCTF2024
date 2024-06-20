# Mucho texto
- **Categoría:** Forense
- **Dificultad:** ★☆☆☆☆
- **Autor:** [navaj0](https://github.com/samu-delucas)

### Descripción
En ocasiones se utilizan archivos muy grandes para ocultar información. ¿Puedes encontrar la flag?


### Archivos e instrucciones
- muchotexto.txt

### Hints
1. Tal vez en linux haya un comando para buscar texto dentro de un archivo...
2. grep 
3. Recuerda que el formato de las flags es `letsctf{...}`

### Flag
``letsctf{GreP_i5_R34l1y_U5EfUL}``

---

## Writeup 
Efectivamente, para este reto no hay que leerse el texto entero. Basta con buscar
dentro del texto una cadena que pueda parecer una flag. El formato de las flags es
`letsctf{...}`, por lo que podemos buscar la flag con
```console
$ grep letsctf muchotexto.txt 
    we think that the men of letsctf{GreP_i5_R34l1y_U5EfUL} are our
```

**Flag**: `letsctf{GreP_i5_R34l1y_U5EfUL}`
