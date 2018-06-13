<?php

namespace IoT\Controller;

use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class IndexController
 * @package IoT\Controller
 */
class IndexController extends AbstractController
{
    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function index($request, $response)
    {
        return $this->render($response, 'index.twig', []);
    }
}
