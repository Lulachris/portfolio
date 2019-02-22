<?php 

    require_once('BaseRepository.php');
    require_once('./Models/Category.php');

    class CategoryRepo extends BaseRepository {

        function __construct() {
            parent::__construct();
        }

        public function GetAll()
        {
            $this->tableName = 'FROM CATEGORIE';
            $this->projection = 'ID, NOM AS TITLE'; 
            $this->order = 'TITLE';

            $this->ExecuteGetRequest();

            // Parcours de la liste des articles retournés par la requête
            $categories = array();
            while ($row = $this->reqResult->fetch(PDO::FETCH_ASSOC)) {
                $category = new Category();
                $category->FromRow($row);
                $categories[] = $category;
            }

            return $categories;
        }

    }