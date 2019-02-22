<?php

    require_once('BaseModel.php');

    class Category extends BaseModel {
        
        private $title;

        function __construct() {
            parent::__construct();
            $this->title = '';
        }

        // override function FromRow from BaseModel
        public function FromRow($row) {
            // Call FromRow from BaseModel
            parent::FromRow($row);
            $this->title = $row['TITLE'];
        }

        public function GetTitle() {
            return $this->title;
        }

        public function SetTitre($title) {
            $this->title = $title;
        }
    }

?>