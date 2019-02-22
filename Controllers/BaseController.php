<?php

    require_once('IBaseController.php');
    require_once('./modules/simple_html_dom.php');

    abstract class BaseController implements IBaseController {

        const TEMPLATES = './Views/templates/';
        const REPO_DIRECTORY = './Repositories/';
        const JS_DIRECTORY = '/js/';

        protected $html;
        protected $mainTemplatePage;
        protected $mainSvc;
        protected $jsList;

        function __construct() {
            $this->html = new simple_html_dom();
            $this->html->load_file(self::TEMPLATES . $this->mainTemplatePage . '.html');
        }

        public function Index() {
            return $this->html;
        }

        public function AddJavaScript() {
            $scripts = '';
            if (isset($this->jsList)) {
                if (is_array($this->jsList)) {
                    foreach($this->jsList as $js) {
                        $scripts = $scripts . '<script src="' . self::JS_DIRECTORY . $js . '" ></script>';
                    }
                } else {
                    $scripts = '<script src="' . self::JS_DIRECTORY . $this->jsList . '" ></script>';
                }
            }

            return $scripts;
        }
    }

?>