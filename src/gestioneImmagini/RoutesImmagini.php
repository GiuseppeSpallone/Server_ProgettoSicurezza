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
        $app->post('/personale/nuovo', self::class . ':inserisciPersonale');
        $app->delete('/personale/elimina/{id}', self::class . ':eliminaPersonaleById');

        $app->get('/sede', self::class . ':getSede');
        $app->get('/sede/{ID}', self::class . ':getSedeById');

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

            $gestore = new GestoreImmagini();
            $data = $gestore->getImmagini();

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
                $gestore = new GestoreImmagini();
                $data = $gestore->getImmagineById($id);

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

    public function inserisciPersonale(Request $request, Response $response)
    {
        $result = false;
        $message = null;
        $dataKey = "personale";
        $data = null;
        $status = null;

        $database = new Database();
        $con = $database->getConnection();

        if ($con) {

            $username = $_SESSION['username'];
            $id = $_SESSION['id'];
            $permesso = $_SESSION['permesso'];

            if ($_SESSION && $permesso === 3) {
                $requestData = $request->getParsedBody();
                $nome = $requestData['nome'];
                $cognome = $requestData['cognome'];
                $email = $requestData['email'];
                $ID_sede = $requestData['ID_sede'];


                if ($nome && $cognome && $email && $ID_sede) {

                    $gestorePersonale = new GestoreImmagini();
                    $data = $gestorePersonale->inserisciPersonale($nome, $cognome, $email, $ID_sede);

                    if ($data) {
                        $result = true;
                        $message = "personale inserito";
                        $status = 201;
                    } else {
                        $message = "personale non inserito";
                        $status = 204;
                    }
                } else {
                    $message = "richiesta errata: non sono state inserite tutte le informazioni";
                    $status = 403;
                }
            } else {
                $message = "non autorizzato";
                $status = 401;
            }

        } else {
            $message = "database non connesso";
            $status = 503;
        }

        $myResponse = self::getResponse($response, $status, $result, $message, $dataKey, $data);

        return $myResponse;
    }

    public function eliminaPersonaleById(Request $request, Response $response)
    {
        $result = false;
        $message = null;
        $dataKey = "personale";
        $data = null;
        $status = null;

        $database = new Database();
        $con = $database->getConnection();

        if ($con) {

            $username = $_SESSION['username'];
            $id = $_SESSION['id'];
            $permesso = $_SESSION['permesso'];

            if ($_SESSION && $permesso === 3) {
                $id = $request->getAttribute('id');

                if ($id) {
                    $gestorePersonale = new GestoreImmagini();
                    $data = $gestorePersonale->eliminaPersonaleById($id);

                    if ($data) {
                        $result = true;
                        $message = "personale eliminato";
                        $status = 202;
                    } else {
                        $message = "personale non esistente";
                        $status = 204;
                    }

                } else {
                    $message = "richiesta errata";
                    $status = 403;
                }
            } else {
                $message = "non autorizzato";
                $status = 401;
            }
        } else {
            $message = "database non connesso";
            $status = 503;
        }

        $myResponse = self::getResponse($response, $status, $result, $message, $dataKey, $data);

        return $myResponse;
    }

    public function getSede(Request $request, Response $response)
    {
        $result = false;
        $message = null;
        $dataKey = "sede";
        $data = null;
        $status = null;

        $database = new Database();
        $con = $database->getConnection();

        if ($con) {

            $username = $_SESSION['username'];
            $id = $_SESSION['id'];
            $permesso = $_SESSION['permesso'];

            if ($_SESSION) {
                $gestoreSede = new GestoreImmagini();
                $data = $gestoreSede->getSede();

                if ($data) {
                    $result = true;
                    $message = "Lista: ";
                    $status = 200;
                } else {
                    $message = "Lista vuota";
                    $status = 204;
                }
            } else {
                $message = "non autorizzato";
                $status = 401;
            }
        } else {
            $message = "database non connesso";
            $status = 503;
        }

        $myResponse = self::getResponse($response, $status, $result, $message, $dataKey, $data);

        return $myResponse;
    }

    public function getSedeById(Request $request, Response $response)
    {
        $result = false;
        $message = null;
        $dataKey = "sede";
        $data = null;
        $status = null;

        $database = new Database();
        $con = $database->getConnection();

        if ($con) {
            $username = $_SESSION['username'];
            $id = $_SESSION['id'];
            $permesso = $_SESSION['permesso'];

            if ($_SESSION) {
                $ID_sede = $request->getAttribute('ID');

                $gestoreSede = new GestoreImmagini();
                $data = $gestoreSede->getSedeById($ID_sede);

                if ($data) {
                    $result = true;
                    $message = "ID presente";
                    $status = 200;
                } else {
                    $message = "ID non presente";
                    $status = 204;
                }
            } else {
                $message = "non autorizzato";
                $status = 401;
            }
        } else {
            $message = "database non connesso";
            $status = 503;
        }

        $myResponse = self::getResponse($response, $status, $result, $message, $dataKey, $data);

        return $myResponse;
    }
}
