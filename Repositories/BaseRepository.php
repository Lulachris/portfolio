<?php

    require_once('IBaseRepository.php');
    require_once('config/BddConnector.php');

    abstract class BaseRepository implements IBaseRepository {

        // Table from DB where we want to get the data
        protected $tableName;
        // Columns to return from table
        protected $projection;
        // Request filter
        protected $where;
        // Order by
        protected $order;
        protected $request;
        protected $reqResult;

        function __construct() {
            $this->tableName = '';
            $this->projection = '*';
            $this->where = '';
            $this->order = '';
            $this->request = '';
        }

        public function ExecuteGetRequest() {
            $request = 'SELECT ' . self::CalculateProjection();
            $request = $request . self::CalculateJoin();
            $request = $request . self::CalculateWhere();
            $request = $request . self::CalculateOrder();

            // Ouverture de la connexion à la base de donne=ées
            $bdd = BddConnector::OpenConnection();

            // Exécution de la requête pour récupérer les articles
            $this->reqResult = $bdd->query($request);

            // Fermeture de la connexion à la base de données
            BddConnector::CloseConnection($bdd);
        }

        abstract public function GetAll();

        private function CalculateProjection() {
            if (is_array($this->projection)) {
                return implode(', ', $this->projection);
            } else {
                return $this->projection;
            }
        }

        private function CalculateJoin() {
            $join = ' ';

            if (is_array($this->tableName)) {
                foreach ($this->tableName as $key => $value) {
                    if ($join == ' ') {
                        $join = $value;
                    } else {
                        $join = $join . ' ' . $value;
                    }
                }
            } else {
                $join = $join . $this->tableName;
            }

            return $join;
        }

        private function CalculateWhere() {
            return ($this->where == '') ? 
                '' :
                ' WHERE ' . $this->where;
        }

        private function CalculateOrder() {
            return ($this->order == '') ?
                '' :
                ' ORDER BY ' . $this->order;
        }
    }

?>