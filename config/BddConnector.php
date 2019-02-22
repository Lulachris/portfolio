<?php

    require_once('configBdd.php');

    // Singleton : initialized once when the server starts
    class BddConnector {

        private static $initialized = false;

        private static function initialize()
        {
            if (self::$initialized)
                return;

            self::$initialized = true;
        }

        public static function OpenConnection()
        {
            self::initialize();

            /* On se connecte via PDO, on attrapera les exceptions au besoin afin d'éviter les fuites de données */
            try {
                global $connection;
                global $login;
                global $password;
                $bdd = new PDO($connection, $login, $password);
            } catch (Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }
            return $bdd;
        }

        public static function CloseConnection($bdd)
        {
            self::initialize();
            $bdd = null;
        }
    }

?>