<?php
    require_once('BaseController.php');

    class WelcomeController extends BaseController {

        function __construct() {
            $this->mainTemplatePage = 'welcome/welcome';
            parent::__construct();
        }
    }

?>