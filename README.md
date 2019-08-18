Mini Framework PHP!
===================


Estructura
-------------
 - <i class="icon-folder-open"></i>  src
	 - <i class="icon-folder-open"></i> Controllers
	 - <i class="icon-folder-open"></i> Database
	 - <i class="icon-folder-open"></i> Facades
	 - <i class="icon-folder-open"></i> Login
	 - <i class="icon-folder-open"></i> Pagination
	 - <i class="icon-folder-open"></i> Paths
	 - <i class="icon-folder-open"></i> Pagination
	 - <i class="icon-folder-open"></i> PHPMailer
	 -	<i class="icon-folder-open"></i> Routes
	 -	<i class="icon-folder-open"></i> Sorteable
	 -	<i class="icon-folder-open"></i> Views
	 -	<i class="icon-file"></i> Container.php
	 -	<i class="icon-file"></i> Magig.php
	 -	<i class="icon-file"></i> Model.php
   


Uso
-------------
> **1. Crear la siguiente extructura:** 

 >- <i class="icon-folder-open"></i>  [Core ](#carpeta-core)
	 - <i class="icon-folder-open"></i>  Classes
		 - <i class="icon-folder-open"></i>  Controllers
		 - <i class="icon-folder-open"></i>  Facades
		 - <i class="icon-file"></i>  archivo_clase.php
	 - <i class="icon-folder-open"></i>  Utils
		 - <i class="icon-file"></i>  helpers.php
	 - <i class="icon-folder-open"></i>  vendor
	 - <i class="icon-file"></i>  [constantes.php](#archivo-constantes)
	 - <i class="icon-file"></i>  [init.php](#archivo-init)
	 - <i class="icon-file"></i>  [composer.php](#archivo-composer)
 - <i class="icon-folder-open"></i>  assets
	 -  <i class="icon-folder-open"></i>  css
	 -  <i class="icon-folder-open"></i>  js
	 -  <i class="icon-folder-open"></i>  fonts
	 -  <i class="icon-folder-open"></i>  img
 -  <i class="icon-folder-open"></i>  inc
	 -  <i class="icon-file"></i>  head.php
	 -  <i class="icon-file"></i>  header.php
	 -  <i class="icon-file"></i>  footer.php
 -  <i class="icon-folder-open"></i>  views
	 -  <i class="icon-folder-open"></i>  partials
		 -  <i class="icon-file"></i>  home.php
	 -  <i class="icon-file"></i>  index.php
 -  <i class="icon-file"></i>  [index.php](#archivo-index)
 -  <i class="icon-file"></i>  [.htaccess](#archivo-htaccess)


----------


> **2. Con una terminal ir a la carpeta Core y ejecutar los siguientes comanados:**
> > 1. composer install
> > 2. composer dump-autoload
> > 3. [Crear las constantes que apunten a la carpeta de las vistas y de los includes](#archivo-constantes)


----------
> **3. Definir las rutas en el archivo [index](#archivo-index)**

----------
> **4. Crear el controlador para esa ruta**
> > Dentro de la carpeta core/classes/controller crear un nuevo [archivo](#ejemplo-archivo-indexcontroller):
> >Registrar en el archivo [init.php](#archivo-init)



----------
> **5. Crear la vista para ese archivo**
> Dentro de la carpeta views crear un archivo con el nombre de la ruta:
> > El nombre del archivo a de corresponder con la vista que se le pasa en el controlador:
> > Para la vista del paso 4  (return View::view('index');), en la carpeta Views deberá existir el archivo index.php.


----------

> ####**Carpeta core**: 

> Contiene todo el corazón de la aplicación. 
> 1. Clases:
 >- Controllers: para controlar las vistas.
 >- Facades: para usar clases dinámicas de forma estática
 >- Todas las clases
 > 2. Utils:
 >- Archivo helpers: funciones que no van dentro de una clase.
 > 3. vendor: se crear al ejecutar composer install
 > 4. Archivo [init](#archivo-init): 
 >> Este archivo engloba la configuración global donde asignamos un alias para poder hacer uso de los [Facades](#facades) y haremos uso de la [inyección de dependencias](#inyección-de-dependencias) para las diferentes clases. 

----------


> ####**Carpeta assets**: 

----------
> ####**Carpeta inc**: 

----------
> ####**Carpeta views**: 

----------
> **EJEMPLOS ARCHIVOS  CARPETA CORE:** 

----------

> ####**Archivo constantes**: 
> 

> **Conexión a la bd (obligatorio)**
> define("DB_HOST",  'localhost');
> define("DB_DATABASE",  'gmadees_grupoava');
> define("DB_USERNAME",  'root');
> define("DB_PASSWORD",  '');
> 
> **Básicos (obligatorio)**
> define("BASE_URL",  'http://grupoava.dev/');
> define("HASH",  '121512');
> define("ROWSPERPAGE",  '6');
> define("CHANGELIMIT",  'false');
> define("ROWSPERPAGE_OPTION", '');
> define('PAGE',  'pagina/');
> define('LIMIT',  '/limit/');
>  

  >**Includes y vistas**
    define('PATH_INCLUDES',  'includes/');
    define('PATH_VIEWS',  'views/');

> **Constantes para usar PHPMailer**
    define('PHPMAILER_HOST', 'smtp.gmail.com');
    define('PHPMAILER_SMTPAUTH', 'true');
    define('PHPMAILER_USERNAME', 'test@gmail.com');
    define('PHPMAILER_PASSWORD', 'pass');
    define('PHPMAILER_SMTPSECURE', 'tls');
    define('PHPMAILER_PORT', 587);
    define('PHPMAILER_CHARSET', 'UTF-8');
    define('PHPMAILER_SETFROM', 'test@gmail.com');
    define('PHPMAILER_ADDTOREPLY', 'test@gmail.com');
    define('PHPMAILER_ISHTML', true);

----------

> ####**Archivo init**: 

    <?php
    namespace GRDAR;
    
    use Grdar\core\Container;
    use Grdar\core\Views\View;
    use Grdar\core\Paths\Paths;
    use Grdar\core\Routes\Router;
    use Symfony\Component\Dotenv\Dotenv;
    /********************************************************/
    /*********************** CLASS **************************/
    require_once __DIR__.'/vendor/autoload.php';
    require_once __DIR__.'/constantes.php';
    
    // Uso de inyección de dependencias
    $container = Container::getInstance();
    \Grdar\core\Facades\Facade::setContainer($container);
    
    // Una línea por cada archivo de la carpeta Facades
    class_alias('GRDAR\Facades\Router', 'Rout');
    class_alias('GRDAR\Facades\View', 'View');


    // Una línea por cada archivo de la carpeta Controllers
    class_alias('GRDAR\Controllers\IndexController', 'Index');
   
    // Una línea por cada classe que tengamos y sea dinámica 
    $router = new Router;
    $View   = new View;
    $Mail = new Mail;
    
    // Una línea por cada classe que tengamos y sea dinámica 
    $container->instance('Rout', $router);
    $container->instance('View', $View);
    $container->instance('Mail', $Mail);
    
    
    // Errores
    // $whoops = new \Whoops\Run;
    // $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
    // $whoops->register(); 




----------
> ####**Archivo composer**: 
> En este archivo incluimos paquetes de terceros
>  

    {
        "name": "grdar/grupoava",
        "description": "Nombre del proyecto",
        "type": "project",
        "license": "",
        "authors": [{
            "name": "Team developer GRDAR",
            "email": "email desarrollador"
        }],
        "require": {
            "filp/whoops": "^2.1",
            "grdar/core": "^1.6"
        },
        "autoload": {
            "files": ["utils/helpers.php"],
            "psr-4": {
                "GRDAR\\": "classes/"
            }
        }
    }


----------

> ####**ARCHIVO  index:** 
 

    ob_start();
    session_start();
     
    require_once __DIR__.'/core/init.php';  
     
    Rout::setRequest($_SERVER['REQUEST_URI']);
    Rout::add('/', 'Index::index');
     
    Rout::add('/momentos', 'Momentos::index');
    Rout::add('/momentos/tipo/:tipo', 'Momentos::momentosTipo');
    
    Rout::run();


----------

> ####**ARCHIVO  .htaccess** 

    <IfModule mod_rewrite.c>  
        <IfModule mod_negotiation.c>
            Options -MultiViews
        </IfModule>
        RewriteEngine On
    
        # Redirect Trailing Slashes...
        RewriteRule ^(.*)/$ /$1 [L,R=301]
    
        # Handle Front Controller...
        RewriteCond %{REQUEST_FILENAME} !-d
        RewriteCond %{REQUEST_FILENAME} !-f
        RewriteRule ^ index.php [L]
    </IfModule>  


> ####**EJEMPLO ARCHIVO IndexController  ** 
    <?php 
    namespace GRDAR\Controllers;
    use GRDAR\View;
    use Grdar\core\Routes\Router;
    class IndexController
    {
	    public static function index($idioma)
	    {
	       self::$paginaActual = 'index';
	       $_REQUEST['page'] = 'index';
	       return View::view('index');
	   }
    }


----------
> ####**EJEMPLO FACADE  ** 

    <?php 
    namespace GRDAR\Facades;
    
    use  Grdar\core\Facades\Facade;
    
    class Actividad extends Facade
    {
        public static function getAccessor()
        {
            return 'Actividad';
        }
    }


----------


> ####**INYECCIÓN DE DEPENDENCIAS  ** 
> Con la inyección de dependencias conseguimos instanciar una clase una vez y tenerla disponible en toda la aplicación sin necesidad de tener que volver a instanciarla.
>  Para ello haremos uso de la clase Grdar\core\Container el cual deberemos añadir a nuestro archivo init de la siguiente forma:
>  `use Grdar\core\Container;` 
>  Luego añadimos la clase al container:
>  `$actividad  = new Actividad;`
>  `$container->instance('Actividad', $actividad);`
> *Si no hacemos hacemos uso de los Facades, usaremos llamaremos a la clase de la siguiente forma: 
>  
>  `$Actividad = Container::getInstance()->make('Actividad');`
>  `$Actividad->check('15');`
>  

----------
> ####**USO DE FACADES  ** 
> Con el uso de Facades logramos usar clases usar clases dinámicas de forma estática. Para esto dentro de la carpeta core/facades creamos un [archivo](#ejemplo-facade) con el nombre de la clase  y dentro del archivo init.php lo añadimos de la siguiente forma: 
> `class_alias('GRDAR\Facades\Actividad', 'Actividades');`
> De esta forma podemos hacer uso de la clase Actividad usando su alias:
> `$actividad = Actividades::check(15);`