<?php

class GestoreAggiornamenti
{

    public function getAggiornamento()
    {
        $database = new Database();
        $con = $database->getConnection();

        $query = "SELECT id, versione, file FROM aggiornamento WHERE id=3";

        $stmt = $con->prepare($query);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $versione, $file);

            $aggiornamento = array();
            $stmt->fetch();

            $aggiornamento['id'] = $id;
            $aggiornamento['versione'] = $versione;
            $aggiornamento['file'] = $file;

            return $aggiornamento;
        } else {
            return false;
        }
    }
}







