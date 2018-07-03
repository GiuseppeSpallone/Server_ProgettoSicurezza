<?php

use api\routes\Route;
use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

require_once 'GestoreAggiornamenti.php';

class RoutesAggiornamenti extends Route
{
    public static function registerRoutes(App $app)
    {
        $app->get('/aggiornamento', self::class . ':getAggiornamento');

    }

    public function getAggiornamento(Request $request, Response $response)
    {
        $result = false;
        $message = null;
        $dataKey = "aggiornamento";
        $data = null;
        $status = null;

        $database = new Database();
        $con = $database->getConnection();

        if ($con) {

            $gestoreAggiornamento = new GestoreAggiornamenti();
            $data = $gestoreAggiornamento->getAggiornamento();

            if ($data) {
                $result = true;
                $message = "Aggiornamento presente";
                $status = 200;
            } else {
                $message = "Aggiornamento non presente";
                $status = 204;
            }
        } else {
            $message = "Database non connesso";
            $status = 503;
        }

        $myResponse = self::getResponse($response, $status, $result, $message, $dataKey, $data);

        return $myResponse;
    }
}
