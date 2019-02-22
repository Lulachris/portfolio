<?php

    require_once('BaseModel.php');

    class Menu extends BaseModel {
        
        private $title;
        private $link;
        private $menuOrder;
        private $newTab;
        private $active;

        function __construct() {
            parent::__construct();
            $this->title = '';
            $this->link = '';
            $this->menuOrder = '';
            $this->newTab = '';
            $this->active = '';
        }

        // override function FromRow from BaseModel
        public function FromRow($row) {
            // Call FromRow from BaseModel
            parent::FromRow($row);
            $this->title = $row['TITLE'];
            $this->link = $row['LINK'];
            $this->menuOrder = $row['MENU_ORDER'];
            $this->newTab = $row['NEW_TAB'];
            $this->active = $row['ACTIVE'];
        }

        public function GetTitle() {
            return $this->title;
        }

        public function SetTitre($title) {
            $this->title = $title;
        }

        public function GetLink() {
            return $this->link;
        }

        public function SetLink($link) {
            $this->link = $link;
        }

        public function GetMenuOrder() {
            return $this->menuOrder;
        }

        public function SetMenuOrder($menuOrder) {
            $this->menuOrder = $menuOrder;
        }

        public function GetNewTab() {
            return $this->newTab;
        }

        public function SetNewTab($newTab) {
            $this->newTab = $newTab;
        }

        public function GetActive() {
            return $this->active;
        }

        public function SetActive($active) {
            $this->active = $active;
        }
    }

?>