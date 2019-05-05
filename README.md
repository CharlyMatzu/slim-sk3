# Custom Slim Framework Skeleton for PHP Rest API Projects
This project is a simple custom setup for PHP API Rest projects using slim framework 3. 

* Easy Configuration
* Examples with database connection and Singleton dummy data
* Based on the original Slim Skeleton Project: https://github.com/slimphp/Slim-Skeleton

### Root/ Directory

* __Index.php:__ Slim App initialization, API files inclusion.
* __Config.php:__ Contains some constants for storage directory PATHS. Can be used for more useful configuration like database connection, error reporting (slim handles this) and more.
* __vendor/__ Composer dependencies (required). After download run __"composer install"__ command 
* __app/__ All project files used for the API (back-end)
* __public/__ All related with public files (html, js, css, media...)
* __logs/__ Generated log by __FlatLogger__

### App/ files
* __dependencies:__ Controllers to load
* __middleware:__ Middleware to load. Includes __CORS__ middleware
* __routes:__ API Endpoints
* __errorHandle:__ Custom responses for error handling.
* __setting:__ Extra configuration of the framework, see: https://www.slimframework.com/docs/v3/objects/application.html#application-configuration
* __autoload:__ optional autoloader for classes (currently composer autoloader is working in this project, see: __composer.json__, autoload section): __require_once "vendor/autoload.php"__ is used to include

### App/ Directories
All php files located in /App Directory separated depending of their functionality:

* __Controller:__ Request and Response Handlers. Receive and return responses only and send information to services.
* __Exceptions:__ Custom Exception classes. yeah...
* __Routers:__ Separated routes.
* __Middleware:__ Middleware logic.
* __Models:__ Optional
* __Service:__ Used by Controllers. Contains the business logic, data process, validations, etc.
* __Persistence:__ Contains all queries to execute with database (DAO), get and set result sets. Data handle only.
* __Utils:__ All Generic and useful classes.



### Feedback
Any advice is perfectly accepted, please, give me your feedback at carlosrozuma@gmail.com.