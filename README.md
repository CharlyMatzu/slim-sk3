# Proyecto Skeleton de Slim Framework 3 para API Rest en PHP 
Este es un simple "setup" para comenzar rápidamente con proyectos. Incluye algunas algunas librerías con sus respectivos ejemplos funcionales. Este proyecto esta basado en algunas características del skeleton oficial (v3): https://github.com/slimphp/Slim-Skeleton 

* Fácil configuración haciendo uso de un archivo `.env` (Environment).
* Implementación de [Eloquent ORM](https://laravel.com/docs/5.8/eloquent) para manejo de base de datos.
* `Monolog` para el registro de Log de errores.
* `Carbon` para el manejo de fechas y tiempo.
* `Twig` Render para vistas.
* `JWT` para la autenticación.
* `CORS` para el control de acceso.
* `CRSF` para seguridad contra ataques __Cross-site request forgery:__ https://github.com/slimphp/Slim-Csrf.
* Custom `ErrorHandlers` para personalización de __Error Responses__.

## Instalación
Este proyecto usa composer como gestor de dependencias por los cual es necesario instalarlo.
```
https://getcomposer.org/
```

Simplemente [descarga el proyecto](https://github.com/CharlyRonin/slim-sk3/archive/Master.zip) e Instala las dependencias con el comando siguiente:
```
$ composer install
```

NOTA: si utilizas Visual Studio Code es probable que este descargue las dependencias y es probable que el `autoload.php` no este del todo correcto. Si modificas el archivo `composer.json` debes generar los cambios con el comando anterior o con:
```
$ composer dump-autoload
```

## Estructura del proyecto
#### Root

* __app/__ Directorio que conforma los archivos requeridos por slim para funcionar así como su configuración de Rutas, middleware, controllers, etc.  
* __extra/__ En este caso, sólo el query mysql del ejemplo.
* __public/__ Contiene el archivo `index.php` el cual hace la inclusión a todos los archivos requeridos, además es el directorio para aquellos elementos públicos correspondientes al front-end (embebido)
* __src/__ Contiene todos aquellos elementos que se usaran en el proyecto. Clases, Modelos, Excepciones, Dao (Persistencia), etc.
* __vendor/__ Dependencias de Composer (requiere instalar dependencias).
* __logs/__ directorio generado por el logger

El proyecto cuenta con un script de composer para iniciar en el directorio actual.
```
$ composer start
```
o bien ejecutar el comando PHP:
```
$ php -S localhost:8090 -t public
```
Inicia por defecto apuntado al directorio `/public` ya que aquí es donde se encuentra el archivo `index.php` y podemos acceder mediante `http://localhost:8090`

NOTA: Asegurarse de que que el puerto no este ocupado. Si nos muestra el siguiente error: `The requested resource / was not found on this server.` podemos probar con un puerto distinto.