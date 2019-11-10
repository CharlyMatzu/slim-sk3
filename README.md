# Proyecto Skeleton de Slim Framework 3 para API Rest en PHP 
Este es un simple "setup" para comenzar rapidamente con proyectos. Incluye algunas algunas librerias con sus respectivos ejemplos funcionales. Este proyecto esta basado en algunas caracteriticas del skeleton oficial (v3): https://github.com/slimphp/Slim-Skeleton 

* Facil configuración haciendo uso de un archivo .env (Environment)
* Implementación de [Eloquent](https://laravel.com/docs/5.8/eloquent) con uso de modelos.
* Log de errores
* CORS
* ErrorHandler

## Estructura del proyecto
#### Root

* __app/__ Directorio que conforma los archivos requeridos por slim para funcionar así como su configuración de Rutas, middleware, controllers, etc.  
* __extra/__ En este caso, sólo el query mysql del ejemplo.
* __public/__ Contiene el archivo __index.php__ el cual hace la inclusión a todos los archivos requeridos, además es el directorio para aquellos elementos públicos correspondientes al front-end (embebido)
* __src/__ Contiene todos aquellos elementos que se usaran en el proyecto. Clases, Modelos, Excepciones, Dao (Persistencia), etc.
* __vendor/__ Dependencias de Composer (requiere __composer install__)
 run __"composer install"__ 
* __logs/__ directorio generado por el logger
