<?php

class GestoreImmagini
{
    public function getImmagini()
    {
        $database = new Database();
        $con = $database->getConnection();

        $query = "SELECT id, titolo, formato, file FROM immagine";

        $stmt = $con->prepare($query);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows() > 0) {
            $stmt->bind_result($id, $titolo, $formato, $file);

            $immagini = array();

            while ($stmt->fetch()) {
                $temp = array();
                $temp['id'] = $id;
                $temp['titolo'] = $titolo;
                $temp['formato'] = $formato;
                $temp['file'] = $file;
                array_push($immagini, $temp);

            }
            return $immagini;
        } else {
            return false;
        }
    }

    public function getImmagineById($id)
    {
        $database = new Database();
        $con = $database->getConnection();

        $query = "SELECT id, titolo, formato, file FROM immagine WHERE id = ?";

        $stmt = $con->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $titolo, $formato, $file);

            $immagine = array();
            $stmt->fetch();

            $immagine['id'] = $id;
            $immagine['titolo'] = $titolo;
            $immagine['formato'] = $formato;
            $immagine['file'] = $file;

            return $immagine;
        } else {
            return false;
        }
    }
}







