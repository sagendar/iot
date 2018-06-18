<?php

namespace IoT\Controller;

use Crealogix\Auth\Auth;
use Crealogix\Auth\Model\Person;
use Crealogix\NotificationApi\NotificationApi;
use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Zend\Session\Container;

/**
 * Class AbstractController
 * @package IoT\Controller
 */
abstract class AbstractController
{
    /**
     * @var Request
     */
    protected $request;
    /**
     * @var Response
     */
    protected $response;
    /**
     * @var []
     */
    protected $args;
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @param \Slim\Container|\Psr\Container\ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;

    }

    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     */
    public function __invoke(Request $request, Response $response, array $args)
    {
        $this->request = $request;
        $this->response = $response;
        $this->args = $args;
    }
}