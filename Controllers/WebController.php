<?php
    require_once('BaseController.php');

    class WebController extends BaseController {

        function __construct() {
            $this->mainTemplatePage = 'web/web';
            parent::__construct();
        }
    }

?>