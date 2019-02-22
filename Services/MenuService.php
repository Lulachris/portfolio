<?php

    require_once('BaseService.php');
    require_once('./Repositories/MenuRepo.php');

    class MenuService extends BaseService {

        function __construct() {
            $this->mainRepo = new MenuRepo();
        }
    }

?>