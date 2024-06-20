# Super secure login
- **Categoría:** Web
- **Dificultad:** ★☆☆☆☆
- **Autor:** [navaj0](https://github.com/samu-delucas)

### Descripción
He programado mi primer login en php. El profesor insistió en que lo probaría
a fondo, así que he intentado hacerlo lo más seguro posible. ¿Puedes probarlo
para asegurarte de que todo está bien?

### Hints
1. Prueba a revisar el source de la página desde el navegador
2. Añadiendo ?debug a la URL conseguirás también el source del archivo PHP. 
3. Tal vez puedas crackear el hash md5...
4. crackstation/hashcat te serán de ayuda 

### Flag
``letsctf{md5_Is_no7_sECuRe_EnouGh}``

---

## Writeup 
Este reto presenta una página muy simple de login que solamente pide contraseña.
Inspeccionando el source de la página, vemos el siguiente comentario en el código:
```html
  <!-- append ?debug to the URL to see the source. TODO: remove this before uploading assignment to Moodle -->
```
Por tanto, añadimos `?debug` a la URL del reto para obtener el código php de la
página.

Analizando el mismo, encontramos la parte encargada de la comprobación de la
contraseña:
```php
$password = $_POST["password"];
if(md5($password) == "f789b2ed6dc5f173eb7851e51306164f"){
    echo('<h1><div class="alert alert-success centered" role="alert"> Flag: '.$flag.' </div></h1>');
} else {
    echo('<h1><div class="alert alert-danger centered" role="alert">Sorry, Wrong password!</div></h1>');
}
```

Es decir, la contraseña será la correspondiente al hash md5 `f789b2ed6dc5f173eb7851e51306164f`.

Podemos buscar este hash en [crackstation](https://crackstation.net/) o utilizar hashcat:
```console
$ hashcat -m 0 -a 0 "f789b2ed6dc5f173eb7851e51306164f" /usr/share/wordlists/rockyou.txt
[...]
f789b2ed6dc5f173eb7851e51306164f:cameron7
[...]
```

Por tanto, la contraseña utilizada es `cameron7`. Introduciéndola obtenemos la flag.

**Flag**: `letsctf{md5_Is_no7_sECuRe_EnouGh}`
