<?php
    require_once('BaseController.php');

    class ContactController extends BaseController {

        function __construct() {
            $this->mainTemplatePage = 'contact/contact';
            $this->jsList = 'contact.js';
            parent::__construct();
        }

        public function SendMail() {
            mail(
                'mikael.andre@gmail.com',
                'test',
                'test message'
            );
        }
    }

?>