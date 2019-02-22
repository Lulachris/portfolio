<?php

    require_once('BaseService.php');
    require_once('./Repositories/CategoryRepo.php');

    class CategoryService extends BaseService {

        function __construct() {
            $this->mainRepo = new CategoryRepo();
        }
    }

?>