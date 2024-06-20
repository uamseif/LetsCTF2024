# clicker bypass
- **Categoría:** Reversing
- **Dificultad:** ★☆☆☆☆
- **Autor:** [navaj0](https://github.com/samu-delucas)

### Descripción
Quieres conseguir el premio máximo de este juego. Lamentablemente, el premio 
máximo es tan caro que tienes que tomar métodos alternativos para ganarlo. 
Has conseguido hacerte con el archivo APK.


### Archivos e instrucciones
- clicker.apk

### Hints
1. La respuesta es no, no queremos que consigas las 100000 monedas
2. APKTool/APKLab tal vez te sean útiles

### Flag
``letsctf{6A58CDCFCFE5C3AA41E01A5908BD9F8D}``

---

## Writeup 
Se nos proporciona una aplicación Android en formato APK. 
Si la instalamos y ejecutamos en nuestro móvil (o mucho mejor, en un emulador) 
podemos ver que la aplicación es un _clicker_ en el que necesitamos 
100000 monedas para conseguir comprar la flag.

Para resolver este reto, vamos a utilizar APKLab en VSCode. 
[Tutorial básico de APKLab](https://braincoke.fr/blog/2021/03/android-reverse-engineering-for-beginners-decompiling-and-patching/).

Lo primero es decompilar el APK, marcando en el proceso la casilla de `decompile_java`.
De esta forma obtendremos el código java de la aplicación.

Como sabemos el formato de la flag, buscamos la cadena `letsctf{` en el código java obtenido:

```java
/* Líneas 75-86 de java_src/ctf/clickergame/MainActivity.java */
this.flag_button.setOnClickListener(new View.OnClickListener() { // from class: ctf.clickergame.MainActivity.3
    @Override // android.view.View.OnClickListener
    public void onClick(View view) {
        if (MainActivity.this.coins >= 100000) {
            MainActivity.this.coins -= 100000;
            MainActivity.this.counter.setText(String.valueOf(MainActivity.this.coins));
            MainActivity.this.flagView.setVisibility(0);
            MainActivity.this.FlagViewText.setVisibility(0);
            MainActivity.this.FlagViewText.setText("letsctf{" + MainActivity.this.textSet + "}");
        }
    }
});
```

Vemos que la flag se imprime cuando hacemos click en el botón de flag y tenemos más de 100000 monedas.

Buscamos en los archivos `smali` este fragmento de código. Para ello podemos
buscar el valor 100000 en hexadecimal (`0x186a0`) en los archivos del directorio `smali`.
De esta forma encontramos el segmento de código correspondiente al de arriba:

```smali
#Líneas 38-48 de smali/ctf/clickergame/MainActivity$3.smali
.method public onClick(Landroid/view/View;)V
    .locals 4

    .line 101
    iget-object p1, p0, Lctf/clickergame/MainActivity$3;->this$0:Lctf/clickergame/MainActivity;

    iget-wide v0, p1, Lctf/clickergame/MainActivity;->coins:J

    const-wide/32 v2, 0x186a0      # <--- Valor utilizado para la comparación

    cmp-long p1, v0, v2
```

Una vez encontrado, basta con modificar el valor `0x186a0` por `0x0`
en la instrucción `const-wide/32 v2, 0x186a0`
para que se imprima la flag cuando tengamos 0 o más monedas (es decir, siempre).

```smali
    const-wide/32 v2, 0x0
```

Una vez hemos hecho esto, volvemos a compilar el APK y lo instalamos en el teléfono/emulador.
Al abrir la aplicación y hacer click en el botón de flag, obtenemos la flag:

**Flag**: `letsctf{6A58CDCFCFE5C3AA41E01A5908BD9F8D}`

## Enlaces útiles
- [Tutorial de APKLab en VSCode](https://braincoke.fr/blog/2021/03/android-reverse-engineering-for-beginners-decompiling-and-patching/).