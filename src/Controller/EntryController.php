<?php

namespace IoT\Controller;

use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class EntryController
 * @package IoT\Controller
 */
class EntryController extends AbstractController
{
    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     */
    public function __invoke(Request $request, Response $response, array $args)
    {
        parent::__invoke($request, $response, $args);
        return $this->insertEntryAction();
    }

    /**
     * @return Response
     */
    private function insertEntryAction()
    {
        $post = $this->request->getParsedBody();
        $entryTime = $post['entry_time'];

        $camera_id = $post['camera_id'];

        if($this->container['entryRepo']->insertEntry($camera_id, $entryTime)) {
            return $this->response->withJson(['status' => 'success'], 200);
        }
        return $this->response->withJson(['status' => 'error'], 400);
    }
}
