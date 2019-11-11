# Proyecto Skeleton de Slim Framework 3 para API Rest en PHP 
Este es un simple "setup" para comenzar rápidamente con proyectos. Incluye algunas algunas librerías con sus respectivos ejemplos funcionales. Este proyecto esta basado en algunas características del skeleton oficial (v3): https://github.com/slimphp/Slim-Skeleton 

* Fácil configuración haciendo uso de un archivo `.env` (Environment)
* Implementación de [Eloquent](https://laravel.com/docs/5.8/eloquent) `ORM` para manejo de base de datos.
* `Monolog` para el registro de Log de errores
* `Twig` Render para vistas
* `JWT` para la autenticación.
* `CORS` para el control de acceso.
* `CRSF` para seguridad.
* Custom `ErrorHandlers`

## Estructura del proyecto
#### Root

* __app/__ Directorio que conforma los archivos requeridos por slim para funcionar así como su configuración de Rutas, middleware, controllers, etc.  
* __extra/__ En este caso, sólo el query mysql del ejemplo.
* __public/__ Contiene el archivo __index.php__ el cual hace la inclusión a todos los archivos requeridos, además es el directorio para aquellos elementos públicos correspondientes al front-end (embebido)
* __src/__ Contiene todos aquellos elementos que se usaran en el proyecto. Clases, Modelos, Excepciones, Dao (Persistencia), etc.
* __vendor/__ Dependencias de Composer (requiere __composer install__)
 run __"composer install"__ 
* __logs/__ directorio generado por el logger

El proyecto cuenta con un script de composer para iniciar en el directorio actual.
```
$ composer start
```
Esto inicia en el directorio `/public` por lo que el directorio principal sería éste en las vistas.