<?php

class GestoreImmagini
{
    public function getImmagini()
    {
        $database = new Database();
        $con = $database->getConnection();

        $query = "SELECT id, nome, formato, file FROM immagine";

        $stmt = $con->prepare($query);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows() > 0) {
            $stmt->bind_result($id, $nome, $formato, $file);

            $immagini = array();

            while ($stmt->fetch()) {
                $temp = array();
                $temp['id'] = $id;
                $temp['nome'] = $nome;
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

        $query = "SELECT id, nome, formato, file FROM immagine WHERE id = ?";

        $stmt = $con->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $nome, $formato, $file);

            $immagine = array();
            $stmt->fetch();

            $immagine['id'] = $id;
            $immagine['nome'] = $nome;
            $immagine['formato'] = $formato;
            $immagine['file'] = $file;

            return $immagine;
        } else {
            return false;
        }
    }

    /**
     * Dato un nome, un cognome e un'email, inserisce un nuovo personale e lo restituisce
     * in output se l'inserimento è andato a buon fine, altrimenti restituisce
     * un valore false.
     * @authors Carlo De Dominicis, Nicolò Malatesta
     * @param string $nome
     * @param string $cognome
     * @param string $email
     * @return array|bool
     */
    public function inserisciPersonale($nome, $cognome, $email, $ID_sede)
    {
        $database = new Database();
        $con = $database->getConnection();

        //strtolower comverte le maiuscole in minuscole
        //$nome[0] . $nome[1] prende la prima e la seconda lettera della stringa
        $username = strtolower($nome[0]).$nome[1] . "." . strtolower($cognome);

        //creo una password random
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
        $password = substr(str_shuffle($chars), 0, 8);

        //cifro la password, in questo modo la posso inserire nel database e nessuno sarà in grado di capirla
        $password_criptata = sha1($password);

        $query = "INSERT INTO personale(username, password, nome, cognome, email, ID_sede) VALUES(?, ?, ?, ?, ?,?)";

        $stmt = $con->prepare($query);
        $stmt->bind_param("sssssi", $username, $password_criptata, $nome, $cognome, $email, $ID_sede);
        $stmt->execute();

        $stmt->store_result();

        if ($stmt) {
            $personale = self::getPersonaleById($stmt->insert_id);
            return $personale;
        } else {
            return false;
        }
    }

    /**
     * Dato un id, elimina il personale e lo restituisce
     * in output true se l'eliminazione è andata a buon fine, altrimenti restituisce
     * un valore false
     * @authors Carlo De Dominicis, Nicolò Malatesta
     * @param integer $id
     * @return bool
     */
    public function eliminaPersonaleById($id)
    {
        $database = new Database();

        $con = $database->getConnection();

        $personale = self::getPersonaleById($id);

        if ($personale['id']) {

            $query3 = "set foreign_key_checks=1";
            $query2 = "DELETE FROM personale WHERE ID = ?";
            $query1 = "set foreign_key_checks=0";

            $stmt = $con->prepare($query1);
            $stmt->execute();


            $stmt = $con->prepare($query2);
            $stmt->bind_param("i", $id);
            $stmt->execute();

            $stmt = $con->prepare($query3);
            $stmt->execute();

            return true;

        } else {
            return false;
        }
    }

    public function getSede()
    {

        $con = Database::getConnection();

        $query = "SELECT ID, nome FROM sede";

        $stmt = $con->prepare($query);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows() > 0) {
            $stmt->bind_result($ID, $nome);

            $sede = array();

            while ($stmt->fetch()) {
                $temp = array();
                $temp['ID'] = $ID;
                $temp['nome'] = $nome;

                array_push($sede, $temp);
            }
            return $sede;
        } else {
            return false;
        }

    }

public function getSedeById($ID)
{
    $con = Database::getConnection();

    $query = "SELECT nome FROM sede
                  WHERE ID = ?";

    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $ID);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows() > 0) {
        $stmt->bind_result($nome);

        $sede = array();
        $stmt->fetch();

        $sede['nome'] = $nome;

        return $sede;
    } else {
        return false;
    }

}
}







