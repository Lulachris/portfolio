<?php
    require_once('BaseController.php');

    class GraphismController extends BaseController {

        function __construct() {
            $this->mainTemplatePage = 'graphism/graphism';
            parent::__construct();
        }
    }

?>