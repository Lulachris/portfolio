<?php

    require_once('BaseModel.php');

    class Article extends BaseModel {
        
        private $title;
        private $content;
        private $date;
        private $pseudo;
        private $resume_size;

        function __construct() {
            parent::__construct();
            $this->title = '';
            $this->content = '';
            $this->date = '';
            $this->pseudo = '';
            $this->resume_size = '';
        }

        public function FromRow($row) {
            parent::FromRow($row);
            $this->title = $row['TITLE'];
            $this->content = $row['CONTENT'];
            $this->date = $row['DATE_CREATION'];
            $this->pseudo = $row['PSEUDO'];
            $this->resume_size = $row['RESUME_SIZE'];
        }

        public function GetTitle() {
            return $this->title;
        }

        public function SetTitle($title) {
            $this->title = $title;
        }

        public function GetContent() {
            return $this->content;
        }

        public function SetContent($content) {
            $this->content = $content;
        }

        public function GetDate() {
            return $this->date;
        }

        public function SetDate($date) {
            $this->date = $date;
        }

        public function GetPseudo() {
            return $this->pseudo;
        }

        public function SetPseudo($pseudo) {
            $this->pseudo = $pseudo;
        }

        public function GetResumeSize(){
            return $this->resume_size;
        }

        public function SetResumeSize($size){
            $this->resume_size = $size;
        }

        public function GetResume() {
            return substr($this->content, 0, $this->resume_size). '[...]';
        }


    }

?>