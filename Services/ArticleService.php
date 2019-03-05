<?php

    require_once('BaseService.php');
    require_once('./Repositories/ArticleRepo.php');

    class ArticleService {

        function __construct() {
            $this->mainRepo = new ArticleRepo();
        }
        
        public function GetArticlesByCategory() {
            $articles = $this->mainRepo->GetArticlesByCategory();
            return $articles;
        }
        
        public function getAllArticles() {
            var_dump($this->getAllArticles());
            return $this->mainRepo->GetAll();
        }

        
    }

?>