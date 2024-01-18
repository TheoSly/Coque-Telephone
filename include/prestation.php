<?php
// examen du résultat
 
// utilisation d'une boucle pour afficher les objets
//foreach ($tableau as $objet) {
//  $objet->affiche();
//}
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'phpmailer/src/Exception.php'; 
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

class Prestation {
  public $id;
  public $titre;
  public $chapeau;
  public $auteur;

  function chargePOST() {
    
    // On teste si la case '' existe, si oui on copie sa valeur, sinon on utilise une valeur par défaut
    if (isset($_POST['titre'])) {
      $this->titre = $_POST['titre'];
    } else {
      $this->titre = 'sans titre';
    }
    if (isset($_POST['chapeau'])) {
      $this->chapeau = $_POST['chapeau'];
    } else {
      $this->chapeau = 'sans chapeau';
    }
	if (isset($_POST['auteur'])) {
	  $this->auteur = $_POST['auteur'];
	} else {
	  $this->auteur = 'sans auteur';
	}
  if (isset($_POST['id_categorie'])) {
	  $this->id_categorie = $_POST['id_categorie'];
	} else {
	  $this->id_categorie = 'sans id_categorie';
	}
	if (isset($_POST['id'])) {
		$this->id = intval($_POST['id']);
	  } else {
		$this->id = 0;
	  }

    echo $this->auteur;
  }

  public function affiche() {
    echo '<p>';
    echo $this->titre.' '.$this->chapeau.' '.$this->auteur;
    // Lien pour voir le detail
    echo '<a href="controleur.php?page=element&id='.$this->id.'">voir le détail</a>';
    // Lien pour supprimer
    echo '<a href="controleur.php?page=element&action=delete&id='.$this->id.'">supprimer</a>';  
    // Lien pour modifier
    echo '<a href="controleur.php?page=editeur&action=edit&id='.$this->id.'">Modifier</a>';  
    echo '</p>';
}

  public function modifier($titre, $chapeau, $auteur, $id_categorie) {
    $this->titre = $titre;
    $this->chapeau = $chapeau;
	  $this->auteur = $auteur;
    $this->id_categorie = $id_categorie;
  }

  static function readAll() {
    // définition de la requête SQL
    $sql= 'select * from prestation';
 
    // connexion
    $pdo = connexion();
 
    // préparation de la requête
    $query = $pdo->prepare($sql);
 
    // exécution de la requête
    $query->execute();
 
    // récupération de toutes les lignes sous forme d'objets
    $tableau = $query->fetchAll(PDO::FETCH_CLASS,'prestation');
 
    // retourne le tableau d'objets
    return $tableau;
  }

  static function readsolfege() {
    // définition de la requête SQL
    $sql= 'select * from prestation where prestation.id_categorie = 1';

    // connexion
    $pdo = connexion();
 
    // préparation de la requête
    $query = $pdo->prepare($sql);
 
    // exécution de la requête
    $query->execute();
 
    // récupération de toutes les lignes sous forme d'objets
    $tableau = $query->fetchAll(PDO::FETCH_CLASS,'prestation');
 
    // retourne le tableau d'objets
    return $tableau;
  }

  static function readvoix() {
    // définition de la requête SQL
    $sql= 'select * from prestation where prestation.id_categorie = 2';

    // connexion
    $pdo = connexion();
 
    // préparation de la requête
    $query = $pdo->prepare($sql);
 
    // exécution de la requête
    $query->execute();
 
    // récupération de toutes les lignes sous forme d'objets
    $tableau = $query->fetchAll(PDO::FETCH_CLASS,'prestation');
 
    // retourne le tableau d'objets
    return $tableau;
  }

  static function readpiano() {
    // définition de la requête SQL
    $sql= 'select * from prestation where prestation.id_categorie = 3';

    // connexion
    $pdo = connexion();
 
    // préparation de la requête
    $query = $pdo->prepare($sql);
 
    // exécution de la requête
    $query->execute();
 
    // récupération de toutes les lignes sous forme d'objets
    $tableau = $query->fetchAll(PDO::FETCH_CLASS,'prestation');
 
    // retourne le tableau d'objets
    return $tableau;
  }

  static function readguitare() {
    // définition de la requête SQL
    $sql= 'select * from prestation where prestation.id_categorie = 4';

    // connexion
    $pdo = connexion();
 
    // préparation de la requête
    $query = $pdo->prepare($sql);
 
    // exécution de la requête
    $query->execute();
 
    // récupération de toutes les lignes sous forme d'objets
    $tableau = $query->fetchAll(PDO::FETCH_CLASS,'prestation');
 
    // retourne le tableau d'objets
    return $tableau;
  }

  static function readbasse() {
    // définition de la requête SQL
    $sql= 'select * from prestation where prestation.id_categorie = 5';

    // connexion
    $pdo = connexion();
 
    // préparation de la requête
    $query = $pdo->prepare($sql);
 
    // exécution de la requête
    $query->execute();
 
    // récupération de toutes les lignes sous forme d'objets
    $tableau = $query->fetchAll(PDO::FETCH_CLASS,'prestation');
 
    // retourne le tableau d'objets
    return $tableau;
  }

  static function readbatterie() {
    // définition de la requête SQL
    $sql= 'select * from prestation where prestation.id_categorie = 6';

    // connexion
    $pdo = connexion();
 
    // préparation de la requête
    $query = $pdo->prepare($sql);
 
    // exécution de la requête
    $query->execute();
 
    // récupération de toutes les lignes sous forme d'objets
    $tableau = $query->fetchAll(PDO::FETCH_CLASS,'prestation');
 
    // retourne le tableau d'objets
    return $tableau;
  }

  static function readOne($id) {
    // définition de la requête SQL avec un paramètre :valeur
    $sql= 'select * from prestation where id = :valeur';
 
    // connexion à la base de données
    $pdo = connexion();
 
    // préparation de la requête
    $query = $pdo->prepare($sql);
 
    // on lie le paramètre :valeur à la variable $id reçue
    $query->bindValue(':valeur', $id, PDO::PARAM_INT);
 
    // exécution de la requête
    $query->execute();
 
    // récupération de l'unique ligne
    $objet = $query->fetchObject('prestation');
 
    // retourne l'objet contenant résultat
    return $objet;
  }

  function create() {
    $sql = 'INSERT INTO prestation (titre, chapeau, auteur, id_categorie) VALUES (:titre, :chapeau, :auteur, :id_categorie);';
 
    // connexion à la base de données
    $pdo = connexion();
 
    // préparation de la requêtecontroleur.php?page=element&action=create
    $query = $pdo->prepare($sql);
 
    // on donne une valeur aux paramètres à partir des attributs de l'objet courant
    $query->bindValue(':titre', $this->titre, PDO::PARAM_STR);
    $query->bindValue(':chapeau', $this->chapeau, PDO::PARAM_STR);
    $query->bindValue(':auteur', $this->auteur, PDO::PARAM_STR);
    $query->bindValue(':id_categorie', $this->id_categorie, PDO::PARAM_STR);
 
    // exécution de la requête
    $query->execute();
 
    // on récupère la clé de l'element inséré
    $this->id = $pdo->lastInsertId();
  }

  static function delete($id) {
    $sql = 'DELETE FROM prestation WHERE id = :valeur;';
 
    // connexion à la base de données
    $pdo = connexion();
 
    // préparation de la requête
    $query = $pdo->prepare($sql);
 
    // on lie le paramètre :id à la variable $id reçue
    $query->bindValue(':valeur', $id, PDO::PARAM_INT);
 
    // exécution de la requête
    $query->execute();
  }

  function update() {
  $sql = 'UPDATE prestation SET titre = :titre , chapeau = :chapeau , auteur = :auteur , id_categorie = :id_categorie WHERE id = :id;';
 
  // connexion à la base de données
  $pdo = connexion();

  // préparation de la requête
  $query = $pdo->prepare($sql);

  // on donne une valeur aux paramètres à partir des attributs de l'objet courant
  $query->bindValue(':id', $this->id, PDO::PARAM_INT);
  $query->bindValue(':titre', $this->titre, PDO::PARAM_STR);
  $query->bindValue(':chapeau', $this->chapeau, PDO::PARAM_STR);
  $query->bindValue(':auteur', $this->auteur, PDO::PARAM_STR);
  $query->bindValue(':id_categorie', $this->id_categorie, PDO::PARAM_STR);

  // exécution de la requête
  $query->execute();
  }

  static function reservation() {

    if(isset($_POST["send"])){
        $nom = $_POST['nom'];
        $msg = $_POST['msg'];
        $email = $_POST['email'];
        $id_prestation = $_POST['id_prestation'];

        $mail = new PHPMailer(); $mail->IsSMTP(); $mail->Mailer = "smtp";

        $mail->SMTPDebug  = 1;  
        $mail->SMTPAuth   = TRUE;
        $mail->SMTPSecure = "tls";
        $mail->Port       = 587;
        $mail->Host       = "smtp.gmail.com";
        $mail->Username   = "no.reply.myzic@gmail.com";
        $mail->Password   = "uqri krhg xbid piii";

        $mail->IsHTML(true);
        $mail->addAddress($_POST["email"]);
        $mail->SetFrom("no.reply.myzic@gmail.com", "MYZIC");
        $mail->AddReplyTo("no.reply.myzic@gmail.com", "MYZIC");
        $mail->Subject = "Bonjour, $nom votre reservation a bien ete pris en compte !";
        $content = "<b>Le message envoye au musicien profesionnel est</b>
        <i>$msg</i>";


        $mail->MsgHTML($content); 
        if(!$mail->Send()) {
        echo "Error while sending Email.";
        header("Refresh:0"); 
        } else {
        echo "Email sent successfully";
        header("Refresh:0"); 
        

        $sql = "INSERT INTO historique (nom, email, msg, id_prestation) VALUES (:nom, :email, :msg, :id_prestation);";

        $pdo = connexion();

        // Préparation de la requête
        $query = $pdo->prepare($sql);

        // Liaison des paramètres
        $query->bindParam(':nom', $nom, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':msg', $msg, PDO::PARAM_STR);
        $query->bindParam(':id_prestation', $id_prestation, PDO::PARAM_INT);  // Assurez-vous que l'ID est un entier

        $query->execute();
        

        }
    }


}
}