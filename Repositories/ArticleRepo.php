<?php 

    require_once('BaseRepository.php');
    require_once('./Models/Article.php');

    class ArticleRepo extends BaseRepository {

        private $requete_article = 
                'SELECT a.id, titre AS title, u.pseudo, contenu AS content, resume_size, DATE_FORMAT(date_publication, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation                          
                FROM articles a 
                INNER JOIN utilisateur u ON u.id = a.auteur ';

        function __construct() {
            parent::__construct();
        }

        public function GetAll()
        {
            $this->tableName = 'FROM ARTICLES a INNER JOIN UTILISATEUR u ON u.ID = a.AUTEUR';
            $this->projection = 'a.ID, TITRE AS TITLE, u.PSEUDO, CONTENU AS CONTENT, RESUME_SIZE, DATE_FORMAT(DATE_PUBLICATION, \'%d/%m/%Y à %Hh%imin%ss\') AS DATE_CREATION'; 

            $this->ExectuteGetRequest();

            // Parcours de la liste des articles retournés par la requête
            $articles = array();
            while ($row = $this->reqResult->fetch(PDO::FETCH_ASSOC)) {
                $article = new Article();
                $article->ArticleFromRow($row);
                $articles[] = $article;
            }

            return $articles;
        }

        public function GetArticleById($id)
        {
            global $requete_article;
            
            $bdd = BddConnector::OpenConnection();
            $id = intval($id);
            $req = $bdd->query($requete_article . ' WHERE a.id = ' . $id);
            BddConnector::CloseConnection($bdd);

            $row = $req->fetch();
            $article = new Article();
            $article->FromRow($row);
            
            return $article;
        }

        public function GetArticlesByCategory() {
            $this->tableName = 
                'FROM ARTICLES a 
                INNER JOIN UTILISATEUR u ON u.ID = a.AUTEUR
                INNER JOIN CATEGORIE_ARTICLE ca ON ca.ARTICLE_ID = a.ID 
                INNER JOIN CATEGORIE c ON c.ID = ca.CATEGORIE_ID';
            $this->projection = 'a.ID, TITRE AS TITLE, u.PSEUDO, CONTENU AS CONTENT, RESUME_SIZE, c.NOM as NAME, DATE_FORMAT(DATE_PUBLICATION, \'%d/%m/%Y à %Hh%imin%ss\') AS DATE_CREATION'; 
            $this->order = 'ca.CATEGORIE_ID AND NAME';

            $this->ExecuteGetRequest();

            $articles = array();
            // Parcours de la liste des articles retournés par la requête
            while ($row = $this->reqResult->fetch(PDO::FETCH_ASSOC)) {
                $article = new Article();
                $article->FromRow($row);
                $article->category = $row['NAME'];
                if (!array_key_exists($row["NAME"], $articles)) {
                    $articles[$row["NAME"]] = array();
                }

                $articles[$row["NAME"]][] = $article;
            }

            return $articles;
        }
    }