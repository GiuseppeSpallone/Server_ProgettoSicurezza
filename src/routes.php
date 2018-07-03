<?php

require_once 'utilities/Database.php';
require_once 'utilities/Route.php';

require_once 'gestioneImmagini/RoutesImmagini.php';
require_once 'gestioneAggiornamenti/RoutesAggiornamenti.php';

RoutesImmagini::registerRoutes($app);
RoutesAggiornamenti::registerRoutes($app);



