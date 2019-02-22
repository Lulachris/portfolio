<?php
    require_once('BaseController.php');

    class AboutController extends BaseController {

        function __construct() {
            $this->mainTemplatePage = 'about/about';
            parent::__construct();
        }
    }

?>