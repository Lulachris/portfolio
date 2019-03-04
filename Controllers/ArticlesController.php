<?php
    require_once('BaseController.php');
    require_once('./Services/CategoryService.php');
    require_once('./Services/ArticleService.php');
    

    class ArticlesController extends BaseController {

        const TAB_SKELETON = self::TEMPLATES . 'common/';
        const ARTICLE_TEMPLATE = self::TEMPLATES . 'article/';

        private $categorySvc;
        private $categories;
        private $articles;

        function __construct() {
            $this->mainTemplatePage = 'article/articles';
            $this->mainSvc = new ArticleService();
            $this->categorySvc = new CategoryService();
            parent::__construct();
        }

        public function Index() {

            parent::Index();

            // Build the tabs
            $tabs = $this->BuildTabs();

            // Insert tabs in article content page
            $this->html->find('#app', 0)->outertext = $tabs;
            return $this->html;
        }

        private function BuildTabs() {
            // load the tab skeleton template
            $tabSkeleton = new simple_html_dom();
            $tabSkeleton->load_file(static::TAB_SKELETON . 'tabSkeleton.html');

            // load the categories from the database
            $this->categories = $this->categorySvc->GetAll();

            // Get all articles
            $this->articles = $this->mainSvc->GetArticlesByCategory();

            // loop on the category list
            foreach($this->categories as $key => $category) {
                // load the template of one tab
                $tab = new simple_html_dom();
                $tab->load_file(static::TAB_SKELETON . 'tab.html');
                $link = $tab->find('.nav-link', 0);

                // on loading the first tab must be active
                if ($key == 0) {
                    $link->class = $link->class . ' active';
                }

                // Inject data into the template HTML
                $link->href = '#' . $category->GetTitle();
                $link->id = $category->GetTitle() . '-tab';
                $link->innertext = $category->GetTitle();

                // Add the new tab into the existing HTML tab(s)
                $tabSkeleton->find('ul', 0)->innertext = $tabSkeleton->find('ul', 0)->innertext . $tab;

                // Build the content of the current tab
                $tabsContent = $this->BuildTabContent($category->GetTitle(), $key);
                $tabSkeleton->find('div', 0)->innertext = $tabSkeleton->find('div', 0)->innertext . $tabsContent;
            }

            return $tabSkeleton;
        }

        private function BuildTabContent($title, $categoryNumber) {

            // load the content of each tab
            $tabContentTemplate = new simple_html_dom();
            $tabContentTemplate->load_file(static::TAB_SKELETON . 'tabContent.html');
            $tabPane = $tabContentTemplate->find('.tab-pane', 0);

            // on loading the first tab must be active
            if ($categoryNumber == 0) {
                $tabPane->class = $tabPane->class . ' active show';
            }

            // Inject category data into the template HTML
            $tabPane->id = $title;
            
            // Loop on the article list for the category in parameter
            $currentCategory = $this->articles[$title];
            $nbArticles = count($currentCategory);
            for ($i = 0; $i < $nbArticles; $i++) {
                $article = $currentCategory[$i];

                // load the content of each article
                $articleTemplate = new simple_html_dom();
                $articleTemplate->load_file(static::ARTICLE_TEMPLATE . 'article.html');

                $div = $articleTemplate->find('.article', 0);
                $div->class = $div->class . ' ' . $title;

                $articleTemplate->find('h3', 0)->innertext = $article->GetTitle();

                $tabPane->innertext = $tabPane->innertext . $articleTemplate;
            }

            return $tabContentTemplate->innertext;
        }
    }
// admin
    function admin_index(){
        
    }
?>