<?php
class Database
{
    const host = 'localhost';
    const database = 'my_progettosicurezza';
    const username = 'progettosicurezza';
    const password = '';

    public static function getConnection(){
        $con = mysqli_connect(self::host, self::username, self::password, self::database);

        return $con;
    }

}