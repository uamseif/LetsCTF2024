# Un presidente muy EXIFgente
- **Categoría:** Forense
- **Dificultad:** ★☆☆☆☆
- **Autor:** [navaj0](https://github.com/samu-delucas)

### Descripción
En mi empresa trabajamos con información sensible, y es importante anonimizar
los documentos antes de hacerlos públicos. Nuestro presidente es 
muy exigente, y acaba de despedir al chico nuevo por su última entrega. 
¿Puedes descubrir qué hizo mal?

### Archivos e instrucciones
- mail_export_7463_censored.pdf

### Hints
1. Tal vez el contenido del PDF sí que haya sido anonimizado correctamente
2. Has leído el título del reto?
3. exiftool

### Flag
`letsctf{d0nT_FoRg3t_EX1F_MeTADaT4}`

---

## Writeup

El documento entero ha sido anonimizado correctamente. El chico nuevo ha censurado
todas las direcciones de correo, los nombres y los números de teléfono que aparecían.
Aún así, se olvidó de los metadatos del archivo:

```console
$ exiftool mail_export_7463_censored.pdf                                                                           
ExifTool Version Number         : 12.70
File Name                       : mail_export_7463_censored.pdf
[...]
Author                          : david.perez@empresa.es   <--   letsctf{d0nT_FoRg3t_EX1F_MeTADaT4}
[...]
```

**Flag**: `letsctf{d0nT_FoRg3t_EX1F_MeTADaT4}`