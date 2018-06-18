<?php

namespace IoT;

use IoT\Controller\EntryController;
use IoT\Controller\IndexController;
use IoT\Entity\EntryCollection;
use IoT\Repository\EntryRepository;
use PDO;
use Slim\App;
use Slim\Views\Twig;

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

    public function getContainer()
    {
        return $this->app->getContainer();
    }

    protected function getSettings()
    {
        return require __DIR__ . '/../config/settings.php';
    }

    protected function registerServices()
    {
        $container = $this->app->getContainer();
        /**
         * view renderer
         * @return Twig
         */
        $container['view'] = function () {
            $view = new Twig(__DIR__ . '/../template/');

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

        /**
         * @param $c
         * @return EntryRepository
         */
        $container['entryRepo'] = function ($c) {
            return new EntryRepository($c);
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

        $this->app->get('/', IndexController::class)->setName("index");
        $this->app->post('/api/entry', EntryController::class)->setName("entry");
    }
}