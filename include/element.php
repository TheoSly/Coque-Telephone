<?php

include('connexion.php');
 
// examen du résultat
 
// utilisation d'une boucle pour afficher les objets
//foreach ($tableau as $objet) {
//  $objet->affiche();
//}

class Element {
  public $id;
  public $balise;
  public $contenu;
  public $src;
  public $alt;
  public $class;
  public $font;
  public $fichier;
  public $id_article;

  function chargePOST() {
    // On teste si la case '' existe, si oui on copie sa valeur, sinon on utilise une valeur par défaut
    if (isset($_POST['balise'])) {
      $this->balise = $_POST['balise'];
    } else {
      $this->balise = 'sans balise';
    }
    if (isset($_POST['contenu'])) {
      $this->contenu = $_POST['contenu'];
    } else {
      $this->contenu = 'sans contenu';
    }

	if (isset($_FILES['src']) && $_FILES['src']['error'] === UPLOAD_ERR_OK) {
    $imageType = $_FILES['src']['type'];
    if (
      $imageType !== "image/png" &&
      $imageType !== "image/jpg" &&
      $imageType !== "image/jpeg"
    ){
      echo '<p>Pas bon</p>';
      die();
    }
	  $this->src = $_FILES["src"]["tmp_name"];
	} else {
	  $this->src = 'sanssss src';
	}


	if (isset($_POST['alt'])) {
	  $this->alt = $_POST['alt'];
	} else {
	  $this->alt = 'sans alt';
	}
	if (isset($_POST['class'])) {
	  $this->class = $_POST['class'];
	} else {
	  $this->class = 'sans class';
	}
  if (isset($_POST['font'])) {
	  $this->font = $_POST['font'];
	} else {
	  $this->font = 'sans font';
	}
  if (isset($_POST['fichier'])) {
	  $this->fichier = $_POST['fichier'];
	} else {
	  $this->fichier = 'sans fichier';
	}
  if (isset($_POST['id_article'])) {
	  $this->id_article = $_POST['id_article'];
	} else {
	  $this->id_article = 'sans id_article';
	}
  
	if (isset($_POST['id'])) {
		$this->id = intval($_POST['id']);
	  } else {
		$this->id = 0;
	  }
  }

  public function modifier($balise, $contenu, $src, $alt, $class, $font, $fichier) {
    $this->balise = $balise;
    $this->contenu = $contenu;
    $this->src = $src;
    $this->alt = $alt;
    $this->class = $class;
    $this->font = $font;
    $this->fichier = $fichier;
  }

  static function readByArticle($id)
    {
    $sql = "SELECT * FROM element WHERE id_article = :id";


    // connexion à la base de données
    $pdo = connexion();
 
    // préparation de la requête
    $query = $pdo->prepare($sql);
     $query->bindParam(':id', $id, PDO::PARAM_INT);
     $query->execute();
 
    // récupération de l'unique ligne
    $objet = $query->fetchAll(PDO::FETCH_ASSOC);
 
    return $objet;
        
    }
  

  static function readAll() {
    // définition de la requête SQL
    $sql= 'select * from element';
 
    // connexion
    $pdo = connexion();
 
    // préparation de la requête
    $query = $pdo->prepare($sql);
 
    // exécution de la requête
    $query->execute();
 
    // récupération de toutes les lignes sous forme d'objets
    $tableau = $query->fetchAll(PDO::FETCH_CLASS,'element');
 
    // retourne le tableau d'objets
    return $tableau;
  }
  

  static function readOne($id) {
    // définition de la requête SQL avec un paramètre :valeur
    $sql = "SELECT * FROM articles WHERE id = :valeur";

    // connexion à la base de données
    $pdo = connexion();
 
    // préparation de la requête
    $query = $pdo->prepare($sql);
 
    // on lie le paramètre :valeur à la variable $id reçue
    $query->bindValue(':valeur', $id, PDO::PARAM_INT);
 
    // exécution de la requête
    $query->execute();
 
    // récupération de l'unique ligne
    $objet = $query->fetchObject('element');
 
    // retourne l'objet contenant résultat
    return $objet;
  }

  function create() {
    $sql = 'INSERT INTO element (balise, contenu, src, alt, class, font, fichier, id_article) VALUES (:balise, :contenu, :src, :alt, :class, :font, :fichier, :id_article);';

    // connexion à la base de données
    $pdo = connexion();
 
    // préparation de la requêtecontroleur.php?page=element&action=create
    $query = $pdo->prepare($sql);



	if ($_FILES['src']['error'] === UPLOAD_ERR_OK) {

    $nouvelleimage =basename($_FILES["src"]["name"]);
    $uploadedImage = $nouvelleimage;

    if (is_uploaded_file($_FILES["src"]["tmp_name"])) {
      if(!move_uploaded_file($_FILES["src"]["tmp_name"],
        "image/uploads/".$uploadedImage)){
          echo '<p>Pas bon la sauv</p>';
          die();
        }
    }
	  $this->src = $uploadedImage;
	} else {
	  $this->src = 'sansssss src';
	}
 
    // on donne une valeur aux paramètres à partir des attributs de l'objet courant
    $query->bindValue(':balise', $this->balise, PDO::PARAM_STR);
    $query->bindValue(':contenu', $this->contenu, PDO::PARAM_STR);
	  $query->bindValue(':src', $this->src, PDO::PARAM_STR);
    $query->bindValue(':alt', $this->alt, PDO::PARAM_STR);
	  $query->bindValue(':class', $this->class, PDO::PARAM_STR);
    $query->bindValue(':font', $this->font, PDO::PARAM_STR);
    $query->bindValue(':fichier', $this->fichier, PDO::PARAM_STR);
    $query->bindValue(':id_article', $this->id_article, PDO::PARAM_STR);


 
    // exécution de la requête
    $query->execute();
 
    // on récupère la clé de l'element inséré
    $this->id = $pdo->lastInsertId();

  }


  static function delete($id) {
    $sql = 'DELETE FROM element WHERE id = :id;';
 
    // connexion à la base de données
    $pdo = connexion();
 
    // préparation de la requête
    $query = $pdo->prepare($sql);
 
    // on lie le paramètre :id à la variable $id reçue
    $query->bindValue(':id', $id, PDO::PARAM_INT);
 
    // exécution de la requête
    $query->execute();
  }


  
  

  function update() {
  $sql = 'UPDATE element SET balise = :balise , contenu = :contenu , src = :src , alt = :alt , class = :class , fichier = :fichier, font = :font WHERE id = :id;';
 
  // connexion à la base de données
  $pdo = connexion();

  // préparation de la requête
  $query = $pdo->prepare($sql);

  // on donne une valeur aux paramètres à partir des attributs de l'objet courant
  $query->bindValue(':id', $this->id, PDO::PARAM_INT);
  $query->bindValue(':balise', $this->balise, PDO::PARAM_STR);
  $query->bindValue(':contenu', $this->contenu, PDO::PARAM_STR);
  $query->bindValue(':src', $this->src, PDO::PARAM_STR);
  $query->bindValue(':alt', $this->alt, PDO::PARAM_STR);
  $query->bindValue(':class', $this->class, PDO::PARAM_STR);
  $query->bindValue(':font', $this->font, PDO::PARAM_STR);
  $query->bindValue(':fichier', $this->fichier, PDO::PARAM_STR);


  // exécution de la requête
  $query->execute();
  }

}













