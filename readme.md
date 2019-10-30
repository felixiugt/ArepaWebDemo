-Nombre del Desarrollador : Felix Teixeira

-Librerias adicionales o paquetes utilizados:
    Vuejs:
      Librerias:
           VueGoodTablePlugin
           VModal
           ValidationProvider
           VueSimpleAlert
    Bootstrap:
    Laravel:
      LaravelMix:  
-Versión de PHP:  7.2

-Versión de MySQL: --

-Ruta de archivo con parametros de conexión a Base de Datos: ---

-Instrucciones o comentarios que considere necesarios

Se debe configurar el .env, con la conexión a base de datos deseada.
Luego de descargar el proyecto se debe realizar el comando: " composer install " para installar las despendencias de Laravel
Una vez culminadas se debe proceder a realizar la ejecucución del comando "npm install" para instalar las librerias de vuejs (Muy importante debe tener instalado node y npm en la maquina).
Ya realizado dichos comando e instalados tolas las librerias y configurado el .env se procede a realizar el comando "php artisan migrate:fresh --seed" con este comando estariamos creando la base de dato, y las tablas que utiliza el proyecto. con sus respectivos seed "semillas" (debo destacar antes de configurar el .env deben crear la tabla y las respectivas credenciales colocarlas en dicho archivo).

Se desarrollo este demo teniendo encuenta los requerimientos, (Validación de campos tanto frontend y backend) y ciertas validaciones propias del framework Laravel, sin mas que acotar me despido....
