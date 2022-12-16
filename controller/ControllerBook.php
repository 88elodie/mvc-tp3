<?php

RequirePage::requireModel('CRUD');
RequirePage::requireModel('Book');
RequirePage::requireModel('Auteur');
RequirePage::requireModel('Editeur');
RequirePage::requireModel('Categorie');
RequirePage::requireLibrary('CheckSession');

class ControllerBook{
    public function index(){
        $livres = new ModelBook;
        $select = $livres->select();
        if(isset($_SESSION['privileges_id'])){
            $session = $_SESSION['privileges_id'];
        }else {
            $session = 0;
        }
        
        return Twig::render('book-index.php', ['livres' => $select, 'session' => $session]);
    }
    public function list(){
        $livres = new ModelBook;
        $select = $livres->select();
        CheckSession::SessionAuth();
        return Twig::render('book-list.php', ['livres' => $select]);
    }

    public function add(){
        
        //auteurs
        $auteurs = new ModelAuteur;
        $select_auteurs = $auteurs->select();
        //editeurs
        $editeurs = new ModelEditeur;
        $select_editeurs = $editeurs->select();
        //categories
        $categories = new ModelCategorie;
        $select_categories = $categories->select();

        CheckSession::SessionAuth();
        return Twig::render('book-add.php', ['auteurs' => $select_auteurs,
                                            'editeurs' => $select_editeurs,
                                            'categories' => $select_categories]);

    }

    public function insert(){
        $data = $_POST;
        $livre = new ModelBook;
        $livre->insert($data);
        $this->list();
    }

    public function edit(){
        $livres = new ModelBook;
        $select_livres = $livres->select();
        //auteurs
        $auteurs = new ModelAuteur;
        $select_auteurs = $auteurs->select();
        //editeurs
        $editeurs = new ModelEditeur;
        $select_editeurs = $editeurs->select();
        //categories
        $categories = new ModelCategorie;
        $select_categories = $categories->select();

        CheckSession::SessionAuth();
        return Twig::render('book-edit.php', ['livres' => $select_livres,
                                            'auteurs' => $select_auteurs,
                                            'editeurs' => $select_editeurs,
                                            'categories' => $select_categories]);
    }

    public function update(){
        $data = $_POST;
        if($data['livre_id']){
            $id = $data['livre_id'];
            $livres = new ModelBook;
            $livres->update($data, $id);
        }elseif($data['auteur_id']){
            $id = $data['auteur_id'];
            $auteur = new ModelAuteur;
            $auteur->update($data, $id);
        }elseif($data['editeur_id']){
            $id = $data['editeur_id'];
            $editeur = new ModelEditeur;
            $editeur->update($data, $id);
        }elseif($data['categorie_id']){
            $id = $data['categorie_id'];
            $categorie = new ModelCategorie;
            $categorie->update($data, $id);
        }
        $this->list();

    }

    public function delete(){
        $data = $_POST;
        $livres = new ModelBook;
        $livres->delete($data);
        $this->list();
    }
}