# Loco tracéame
## Description

Ey conoces a mi amigo ltrace?

Archivos: 

- `tracer_l`

Resolución:

Es un problema hecho para ser resuelto con `ltrace`.

Para ello habrá que instalarlo (`sudo apt-get install -y ltrace`). Una vez le demos los permisos de ejecución al ejecutable `tracer_l` nos encontraremos con que debemos introducir una contraseña.

Para resolver el problema, lo que haremos será mantener una terminal a la espera antes de meter el input de la contraseña; y por otro lado, abrimos otra terminal para obtener el PID del proceso del ejecutable (`ps -C tracer_l`)

Una vez tenemos el PID, en la segunda terminal vamos a hacer uso de ltrace (`sudo ltrace -p PID`).

Volvemos a la primera terminal e introducimos un input de contraseña, eso nos hará ver en la segunda terminal (en la que hemos hecho uso de `ltrace` con el PID) con qué string compara el input, teniendo así la contraseña y pudiendo acceder al flag.

## Flag
LetsCTF{7r4c3d_dyn4m1c_l1br4ry_c4ll5_h3h3}