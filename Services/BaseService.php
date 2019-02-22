<?php

    require_once('IBaseService.php');

    class BaseService implements IBaseService {

        protected $mainRepo;

        function __construct() {
        }

        public function GetAll() {
            $data = $this->mainRepo->GetAll();
            return $data;
        }
    }

?>