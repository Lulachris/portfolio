<?php

    require_once('BaseController.php');
    require_once('./Services/MenuService.php');

    class PageController extends BaseController {

        private $menu;
        private $menuSvc;

        function __construct() {
            $this->mainTemplatePage = 'index';
            $this->menuSvc = new MenuService();
            parent::__construct();
            $this->BuildMenu();
        }

        public function Index() {
            $html = parent::Index();
            $html->find('.navbar-nav', 0)->innertext = $this->menu;
            return $html;
        }


        private function BuildMenu() {
            $menus = $this->menuSvc->GetAll();
            
            // loop on the menu list
            foreach ($menus as $key => $menu) {
                $menuHtml = new simple_html_dom();
                $menuHtml->load_file(self::TEMPLATES . 'menu.html');
                $menuItem = $menuHtml->find('.nav-link', 0);
                $menuItem->href = $menu->GetLink();
                $menuItem->innertext = $menu->GetTitle();
                if ($key == 0) {
                    $menuItem->class = $menuItem->class . ' active';
                }

                if ($menu->GetNewTab() == 1) {
                    $menuItem->{'target'} = '_blank';
                }
                
                $this->menu = $this->menu . $menuHtml;
            }
        }
    }

?>