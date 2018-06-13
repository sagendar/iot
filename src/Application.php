<?php

namespace IoT;

use IoT\Controller\IndexController;
use PDO;
use Slim\App;
use Slim\Views\Twig;
use Zend\Config\Config;

/**
 * Class Application
 * @package IoT
 */
class Application
{
    /**
     * @var \Slim\App
     */
    private $app;

    /**
     * App constructor.
     * @internal param \Slim\App $app
     */
    public function __construct()
    {
        $this->app = new \Slim\App($this->getSettings());
        $this->registerServices();
        $this->registerMiddleware();
        $this->registerRoutes();
    }

    public function run()
    {
        $this->app->run();
    }

    protected function getSettings()
    {
        return require __DIR__ . '/../config/settings.php';
    }

    /**
     * Kind of a service manager
     */
    protected function registerServices()
    {
        // services
        $container = $this->app->getContainer();

        /**
         * view renderer
         * @return Twig
         */
        $container['view'] = function () {
            $view = new Twig(__DIR__ . '/../templates/');

            return $view;
        };

        /**
         * @param $c
         * @return PDO
         */
        $container['db'] = function ($c) {
            $db = $c['settings']['db'];
            $pdo = new PDO(
                "mysql:host=" . $db['host'] . ";dbname=" . $db['dbname'],
                $db['user'],
                $db['pass']
            );
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $pdo;
        };

    }

    /**
     * Register middleware
     */
    protected function registerMiddleware()
    {
        // middleware
    }

    /**
     * Register routes
     */
    protected function registerRoutes()
    {
        $container = $this->app->getContainer();

        // index
        $this->app->map(['GET', 'POST'], '/', [new IndexController($container), 'index'])
            ->setName('index');

        // logout
        $this->app->post('/api/entry', [new IndexController($container), 'logout'])
            ->setName('insertData');
    }
}