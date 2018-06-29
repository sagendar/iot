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
        $regex = '/^[\d]{4}-[0-1]{1}[\d]{1}-[0-3]{1}[\d]{1} [0-2]{1}[\d]{1}:[0-5]{1}[\d]{1}:[0-5]{1}[\d]{1}$/';

        $entryTime = $post['entry_time'];

        $camera_name = $post['camera_name'];

        if(preg_match($regex, $entryTime)) {
            if($this->container['entryRepo']->insertEntry($camera_name, $entryTime)) {
                return $this->response->withJson(['status' => 'success'], 200);
            }
        }

        return $this->response->withJson(['status' => 'error'], 400);
    }
}
