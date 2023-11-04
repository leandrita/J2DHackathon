# <div align="center">Skins Site<div>

- [Sobre el Proyecto](#skins-site)
  
- [Tecnologías](#tecnologías)

- [Herramientas](#herramientas)

- [Versiones](#versiones)

- [Requisitos](#requisitos)

- [Acesso al proyecto](#instrucciones-de-instalación)

- [Desarrolladora](#desarrolladora)


### Skins Site

Como proyecto de prueba para evaluar el nivel de los participantes de la Hackaton J2D 2023 se me ha solicitado crear una API que permita a las personas usuarias consultar, adquirir, modificar y eliminar skins para
un videojuego.


### Tecnologías 

- PHP
- Laravel
- Laravel/Sanctum
  

### Herramientas

- Visual Studio Code
- Git
- Github
- MAMP
- MySQL


### Versiones

-   php: 8.1
-   laravel/framework: 10.10
-   laravel/sanctum: 3.3


## Requisitos

- Debes tener instalado Apache mediante XAMPP o MAMP, Composer y MySQL para poder correr la aplicación


## Instrucciones de instalación

- Clona el repositorio en GitHub
  

**Instalación del Servidor**

- Abre el proyecto en tu editor de código y en la terminal ingresa al directorio del proyecto `./server`.
- Instala las dependencias mediante el comando `composer install`.
- Crea un archivo .env a partir del archivo .env.example. y agrega tu variable de entorno `APP_KEY`.
- Crea tu base de datos en mysql y configura el apartado de la base de datos en el archivo .env.
- Ejecuta las migraciones para crear las tablas de la base de datos `php artisan migrate`.
- Ejecuta los seeders para rellenar las tablas de la base de datos `php artisan db:seed`.
- Inicia el servidor: `php artisan serve`.


**Testeo de la aplicación**

- Abre postman u otra herramienta que utilices para testear APIs.
- Crea un request con la ruta que desees testear y rellena los campos necesarios. 
- Ten en cuenta que las rutas POST/skins/buy, GET/skins/myskins, PUT/skins/color y DELETE/skins/delete/{id} requieren de un token en el header Authorization para lo cual tienes que registrarte/loguearte previamente.
- Puedes revisar la documentación detallada de cada ruta en [este link](https://documenter.getpostman.com/view/27825598/2s9YXe8je4).
  

### Desarrolladora

 <div>
        <a href="https://www.linkedin.com/in/leandra-bujhamer/">
            <img src="https://media.licdn.com/dms/image/D4D03AQHlrb1Uiu9F5A/profile-displayphoto-shrink_200_200/0/1694700343841?e=1701302400&v=beta&t=SM0AjgJLSP87FAY9BEpoP1clf1ckVUva_tOkiyvRFxo"
                alt="Foto de perfil" width="100">
            <p>Leandra Bujhamer</p>
        </a>
  </div>
