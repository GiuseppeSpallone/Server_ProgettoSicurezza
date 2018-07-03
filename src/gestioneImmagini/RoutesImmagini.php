<?php

use api\routes\Route;
use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

require_once 'GestoreImmagini.php';

class RoutesImmagini extends Route
{
    public static function registerRoutes(App $app)
    {
        $app->get('/immagini', self::class . ':getImmagini');
        $app->get('/immagini/{id}', self::class . ':getImmagineById');
    }

    public function getImmagini(Request $request, Response $response)
    {
        $result = false;
        $message = null;
        $dataKey = "immagini";
        $data = null;
        $status = null;

        $database = new Database();
        $con = $database->getConnection();

        if ($con) {

            $gestoreImmagini = new GestoreImmagini();
            $data = $gestoreImmagini->getImmagini();

            if ($data) {
                $result = true;
                $message = "Immagini presenti";
                $status = 200;
            } else {
                $message = "Immagini non presenti";
                $status = 204;
            }
        } else {
            $message = "Database non connesso";
            $status = 503;
        }

        $myResponse = self::getResponse($response, $status, $result, $message, $dataKey, $data);

        return $myResponse;
    }

    public function getImmagineById(Request $request, Response $response)
    {
        $result = false;
        $message = null;
        $dataKey = "immagine";
        $data = null;
        $status = null;

        $database = new Database();
        $con = $database->getConnection();

        if ($con) {

            $id = $request->getAttribute('id');

            if ($id) {
                $gestoreImmagini = new GestoreImmagini();
                $data = $gestoreImmagini->getImmagineById($id);

                if ($data) {
                    $result = true;
                    $message = "Immagine presente";
                    $status = 200;
                } else {
                    $message = "Immagine non presente";
                    $status = 204;
                }
            } else {
                $message = "Richiesta errata";
                $status = 403;
            }
        } else {
            $message = "Database non connesso";
            $status = 503;
        }

        $myResponse = self::getResponse($response, $status, $result, $message, $dataKey, $data);

        return $myResponse;

    }
}
