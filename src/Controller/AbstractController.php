<?php

namespace IoT\Controller;

use Crealogix\Auth\Auth;
use Crealogix\Auth\Model\Person;
use Crealogix\NotificationApi\NotificationApi;
use Slim\Http\Response;
use Zend\Session\Container;

/**
 * Class AbstractController
 * @package IoT\Controller
 */
abstract class AbstractController
{
    /**
     * @var \Slim\Container|\Psr\Container\ContainerInterface
     */
    private $container;

    /**
     * @param \Slim\Container|\Psr\Container\ContainerInterface $container
     */
    public function __construct($container)
    {
        $this->container = $container;

    }

    /**
     * @param string $var
     * @return mixed
     */
    protected function get($var)
    {
        return $this->container->get($var);
    }

    /**
     * renders template with $data, links and person
     * @param Response $response
     * @param string $template
     * @param array $data
     * @return Response
     */
    protected function render($response, $template, $data = [])
    {
        return $this->get('view')->render($response, $template, $data);
    }
}