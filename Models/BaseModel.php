<?php

    require_once('IBaseModel.php');

    class BaseModel implements IBaseModel {

        protected $id;

        function __construct() {
            $this->id = 0;
        }

        public function GetId() {
            return $this->id;
        }

        public function SetId($id) {
            $this->id = $id;
        }

        public function FromRow($row) {
            $this->id = $row['ID'];
        }
    }

?>