<?php

namespace IoT\Controller;

use IoT\Repository\EntryRepository;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use IoT\Repository;


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
    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response|void
     */
    public function __invoke(Request $request, Response $response, array $args)
    {
        parent::__invoke($request, $response, $args);
        $this->indexAction();
    }

    /**
     * @return ResponseInterface
     */
    private function indexAction()
    {
        return $this->renderView($this->container['entryRepo']->getAllEntries());
    }

    /**
     * @return ResponseInterface
     */
    private function renderView($entries)
    {
        /**
         * @var $view \Slim\Views\Twig
         */
        $view = $this->container['view'];
        return $view->render(
            $this->response,
            'index.twig',
            [
                'entries' => $entries->entries
            ]
        );
    }
}
