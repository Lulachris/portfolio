<?php 

    require_once('BaseRepository.php');
    require_once('./Models/Menu.php');

    class MenuRepo extends BaseRepository {

        function __construct() {
            parent::__construct();
        }

        public function GetAll()
        {
            $this->tableName = 'FROM MENU';
            $this->order = 'MENU_ORDER';
            $this->where = 'ACTIVE = 1';

            $this->ExecuteGetRequest();

            // Parcours de la liste des articles retournés par la requête
            $menus = array();
            while ($row = $this->reqResult->fetch(PDO::FETCH_ASSOC)) {
                $menu = new Menu();
                $menu->FromRow($row);
                $menus[] = $menu;
            }

            return $menus;
        }

    }