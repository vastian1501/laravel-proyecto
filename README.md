# LimeLo - Proyecto DAW 

La aplicación que he realizado es una pequeña red social elaborada con Laravel, se basa
en que un usuario puede subir fotos, y estas fotos llamadas posts o publicaciones, pueden
ser comentadas por otros usuarios y se puede dar “me gusta” a la publicación.

Aparte un usuario puede seguir a otro usuario, y esto genera que el usuario pueda ver
todas las publicaciones de las personas que sigue en la vista principal.
Independientemente he generado un sistema de rutas con el nombre del usuario, con
esto se puede visitar el perfil de los distintos usuarios de la red social, tan solo con saber
su nombre de usuario, sin necesidad de saber su id.

Y para terminar un usuario puede
editar su foto de perfil y el nombre de usuario.
Desde luego, para acceder a la aplicación se ha creado un sistema de registro de usuarios
e inicio de sesión, una vez se hayan registrado en la aplicación.


## Tecnologias empleadas

[Laravel](https://laravel.com/), este es un framework de PHP
gratis y de código abierto que brinda un conjunto de herramientas para crear
aplicaciones modernas. Posee un ecosistema integral que combina funciones integradas
y una variedad de paquetes y extensiones compatibles.

Aparte incluye un ORM que nos facilita el contacto de nuestra aplicación en Laravel con
una base de datos relacional donde solo tendremos que hacer un llamado al modelo de la
entidad que se necesita y empezar a operar sobre ella desde el controlador. He usado
[MYSQL](https://www.mysql.com/) como sistema de gestión de bases de datos relacional.

Para los estilos del frontend de la aplicación he usado [Tailwind CSS](https://tailwindcss.com/), este es un framework de
CSS que permite un desarrollo ágil, basado en clases de utilidad que se pueden aplicar
con facilidad en el código HTML y unos flujos de desarrollo que permiten optimizar
mucho el peso del código CSS.

Además, Laravel incluye un motor de plantillas potente, conocido como Blade, que nos
permite modularizar y estilizar a un gran nivel nuestro HTML.

La aplicación utiliza una arquitectura de software bastante conocida, MVC. Utilizada
para separar el código por sus distintas responsabilidades, manteniendo distintas capas
que se encargan de hacer una tarea muy concreta, lo que ofrece beneficios diversos.



## Prueba del proyecto en local

Para probar este proyecto de Laravel 9 en local, se necesita PHP ^8.0.2 o superior, composer 2.5 o superior, nodejs 16 y npm. Para ello nos dirigimos a la carpeta del proyecto y ejecutamos los siguientes comandos

Instalamos las dependecias de composer
```bash
  composer install
```
Instalamos las dependecias de Node
```bash
  npm install
```
Y antes de ejecutar las migraciones, editamos las variables de entorno del archivo .env, con nuestras credenciales de nuestra base de datos. A continuación ejecutamos la migraciones
```bash
  php artisan migrate
```
Para lanzar el servidor 
```bash
  php artisan serve
```
Para que se apliquen los estilos de TailwindCSS
```bash
  npm run dev
```


## Demo


Hay dos usuarios creados para poder probar la aplicación

#### Usuario Javier
- email: javier@javier.com
- pass: 123123123
#### Usuario Juan
- email: juan@juan.com
- pass: 123123123

#### URL
http://proyecto.javieratiencia.site/


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

