# Las galletas de la abuelita
- **Categoría:** Web
- **Dificultad:** ★☆☆☆☆
- **Autor:** [navaj0](https://github.com/samu-delucas)

### Descripción
La abuelita ha dejado desatendido el tarro con las galletas. ¿Y si pruebas a coger una? 

### Hints
1. Hmmm, el reto va sobre galletas no?
2. Galletas -> cookies

### Flag
``letsctf{eDiT1NG_c00kiEs_iS_r3Ally_siMPle}``

---

## Writeup 
Este reto también es muy simple. El control de acceso a un recurso (las galletas)
se está realizando con la cookie `isAdmin`, sin ningún tipo
de seguridad sobre la misma. 

Podemos editar la cookie en nuestro navegador, modificando su valor a 1, para así
tener acceso a las galletas.

**Flag**: `letsctf{eDiT1NG_c00kiEs_iS_r3Ally_siMPle}`