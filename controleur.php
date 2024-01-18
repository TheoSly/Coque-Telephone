<?php
include('include/element.php');
include('include/elementpres.php');
include('include/elementvente.php');
include('include/compte.php');
include('include/article.php');
include('include/vente.php');
include('include/sendemail.php');
include('include/prestation.php');
include('include/historique.php');
include('include/historiquevente.php');
include('include/historiquedownload.php');
include('include/twig.php');
$twig = init_twig();


// récupération de la variable page sur l'URL
if (isset($_GET['page'])) $page = $_GET['page']; else $page = '';
 
// récupération de la variable action sur l'URL
if (isset($_GET['action'])) $action = $_GET['action']; else $action = 'read';

// récupération de l'id s'il existe (par convention la clé 0 correspond à un id inexistant)
if (isset($_GET['id'])) $id = intval($_GET['id']); else $id = 0;
 
// test des différents choix
switch ($page) {
  case 'element' :
    switch ($action) {
        case 'read' :
            if ($id > 0) {
              $element = Element::readOne($id);
			  $view = 'base.twig';
			  $data = [
				// La requête readOne récupère les données à afficher
				'element' => $element,
			];
            }
            else {
              $article = Article::readAll();
              $view = 'article.twig';
              $data = [
                // La requête readOne récupère les données à afficher
                'element' => $element,
              ];
            }

        break;
      case 'new' :
          $view = 'create_element.twig';
              $data = [
                // La requête readOne récupère les données à afficher
              ];
      break;
      case 'create' :

        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
          $create_element = new Element();
          $create_element->chargePOST();   
          $create_element->create(); 
        }
        header("Location: " . $_SERVER["HTTP_REFERER"]);
        $view = 'detail_article.twig';
              $data = [
                // La requête readOne récupère les données à afficher
                'article' => article::readOne($id),
                'element' => element::readByArticle($id),
              ];
      break;
      case 'delete' :
        // suppression de l'element
        Element::delete($id);
          // premier choix : un message
          header("Location: " . $_SERVER["HTTP_REFERER"]);
          $view = 'detail_article.twig';
           $data = [

                ];
        break;
		case 'edit' :
			$element = Element::readOne($id);
			$element->afficheForm();
		  break;
		  case 'update' :
        $element = new element();
        $element->chargePOST();
        $element->update();
        header("Location: " . $_SERVER["HTTP_REFERER"]);
        $view = 'detail_article.twig';
        $data = [
              // La requête readOne récupère les données à afficher
            ];
      default :
		
    }
    break;



    case 'elementpres' :
      switch ($action) {
          case 'read' :
              if ($id > 0) {
                $elementpres = Elementpres::readOne($id);
          $view = 'base.twig';
          $data = [
          // La requête readOne récupère les données à afficher
          'elementpres' => $elementpres,
        ];
              }
              else {
                $prestation = Prestation::readAll();
                $view = 'prestation.twig';
                $data = [
                  // La requête readOne récupère les données à afficher
                  'elementpres' => $elementpres,
                ];
              }
  
          break;
        case 'new' :
            $view = 'create_elementpres.twig';
                $data = [
                  // La requête readOne récupère les données à afficher
                ];
        break;
        case 'create' :
          if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $create_elementpres = new Elementpres();
            $create_elementpres->chargePOST();   
            $create_elementpres->create();  
          } 
          header("Location: " . $_SERVER["HTTP_REFERER"]);
          $view = 'detail_prestation.twig';
                $data = [
                  // La requête readOne récupère les données à afficher
                  'prestation' => Prestation::readOne($id),
                  'elementpres' => Elementpres::readByPrestation($id),
                ];
        break;
        case 'delete' :
          // suppression de l'element
          Elementpres::delete($id);
            // premier choix : un message
            header("Location: " . $_SERVER["HTTP_REFERER"]);
            $view = 'detail_prestation.twig';
             $data = [

                  ];
          break;
        
      case 'edit' :
        $elementpres = Elementpres::readOne($id);
        $elementpres->afficheForm();
        break;
        case 'update' :
          $elementpres = new Elementpres();
          $elementpres->chargePOST();
          $elementpres->update();
          header("Location: " . $_SERVER["HTTP_REFERER"]);
          $view = 'detail_prestation.twig';
          $data = [
                // La requête readOne récupère les données à afficher
              ];
        default :
      }
      break;


      case 'elementvente' :
        switch ($action) {
            case 'read' :
                if ($id > 0) {
                  $elementvente = Elementvente::readOne($id);
            $view = 'base.twig';
            $data = [
            // La requête readOne récupère les données à afficher
            'elementvente' => $elementvente,
          ];
                }
                else {
                  $vente = Vente::readAll();
                  $view = 'vente.twig';
                  $data = [
                    // La requête readOne récupère les données à afficher
                    'elementvente' => $elementvente,
                  ];
                }
    
            break;
          case 'new' :
              $view = 'create_elementvente.twig';
                  $data = [
                    // La requête readOne récupère les données à afficher
                  ];
          break;
          case 'create' :
            if ($_SERVER['REQUEST_METHOD'] === 'POST'){
              $create_elementvente = new Elementvente();
              $create_elementvente->chargePOST();   
              $create_elementvente->create();  
            } 
            header("Location: " . $_SERVER["HTTP_REFERER"]);
            $view = 'detail_vente.twig';
                  $data = [
                    // La requête readOne récupère les données à afficher
                    'vente' => Prestation::readOne($id),
                    'elementvente' => Elementvente::readByvente($id),
                  ];
          break;
          case 'delete' :
            // suppression de l'element
            Elementvente::delete($id);
              // premier choix : un message
              header("Location: " . $_SERVER["HTTP_REFERER"]);
              $view = 'detail_vente.twig';
               $data = [
  
                    ];
            break;


        case 'edit' :
          $elementvente = Elementvente::readOne($id);
          $elementvente->afficheForm();
          break;
          case 'update' :
            $elementvente = new Elementvente();
            $elementvente->chargePOST();
            $elementvente->update();
            header("Location: " . $_SERVER["HTTP_REFERER"]);
            $view = 'detail_vente.twig';
            $data = [
                  // La requête readOne récupère les données à afficher
                ];
          default :
        }
        break;

        case 'autres' :
          switch ($action) {
            case 'sendnews' :
              Sendemail::sendnews();
              $view = 'confirmationnewsletters.twig';
              $data = [
              ];
            break;

            case 'confimationsendcontact' :
              $view = 'confirmationnewsletters.twig';
              $data = [
              ];
            break;

            case 'sendcontacterror' :
              $view = 'contacterror.twig';
              $data = [
              ];
            break;

            case 'sendcontact' :
              Sendemail::sendcontact();
              $view = 'confirmationnewsletters.twig';
              $data = [
              ];
            break;
              
            default :
          }
          break;




  case 'article' :
    switch ($action) {
      

        case 'mention' :
          $view = 'mention.twig';
          $data = [
          ];
        break;
      
      case 'detailread' :
        if ($id > 0) {
          $tousarticle = Article::readAll();
          $view = 'detail_article.twig';
          $data = [
            // La requête readOne récupère les données à afficher
            'tousarticle' => $tousarticle,
            'article' => article::readOne($id),
            'element' => element::readByArticle($id),

          ];
        }
          
      break;
        case 'read' :
          $article = Article::readAll();
              $view = 'article.twig';
              $data = [
                // La requête readOne récupère les données à afficher
                'articles' => $article,
              ];
        break;
        case 'readpoprock' :
          $article = Article::readpoprock();
              $view = 'articlepoprock.twig';
              $data = [
                // La requête readOne récupère les données à afficher
                'articles' => $article,
              ];
        break;
        case 'readjazz' :
          $article = Article::readjazz();
              $view = 'articlejazz.twig';
              $data = [
                // La requête readOne récupère les données à afficher
                'articles' => $article,
              ];
        break;
        case 'readpopus' :
          $article = Article::readpopus();
              $view = 'articlepopus.twig';
              $data = [
                // La requête readOne récupère les données à afficher
                'articles' => $article,
              ];
        break;
        case 'readmusiquedefilm' :
          $article = Article::readmusiquedefilm();
              $view = 'articlemusiquedefilm.twig';
              $data = [
                // La requête readOne récupère les données à afficher
                'articles' => $article,
              ];
        break;
        case 'readrap' :
          $article = Article::readrap();
              $view = 'articlerap.twig';
              $data = [
                // La requête readOne récupère les données à afficher
                'articles' => $article,
              ];
        break;

        case 'historiquedownload' :
          Historique::historiquedownload();
          $view = 'confirmationreservation.twig';
          $data = [
          ];
        break;

        case 'new' :
            $view = 'create_article.twig';
                $data = [
                  // La requête readOne récupère les données à afficher
                ];
        break;

        case 'create' :
          $create_article = new Article();
          $create_article->chargePOST();   
          $create_article->create();
          header('Location: controleur.php?page=article&action=read');
            $view = 'create_article.twig';
                $data = [
                  // La requête readOne récupère les données à afficher
                  'create_articles' => $create_article,
                ];
        break;
        case 'delete' :
          // suppression de l'element
          Article::delete($id);
          // premier choix : un message
          header("Location: " . $_SERVER["HTTP_REFERER"]);
          $view = 'base.twig';
                $data = [

                ];
          break;
          case 'edit' :
            if ($id > 0) {
              $view = 'edit_article.twig';
              $data = [
                // La requête readOne récupère les données à afficher
                'article' => article::readOne($id),
                'element' => element::readByArticle($id),
    
              ];
            }
            break;
            case 'update' :
            $article = new Article();
            $article->chargePOST();
            $article->update();
            header("Location: " . $_SERVER["HTTP_REFERER"]);
            $view = 'detail_article.twig';
            $data = [
                  // La requête readOne récupère les données à afficher
                ];
            break;
      default :
    }
    break;


    case 'vente' :
      switch ($action) {
        case 'detailread' :
          if ($id > 0) {
            $tousvente = Vente::readAll();
            $view = 'detail_vente.twig';
            $data = [
              // La requête readOne récupère les données à afficher
              'tousvente' => $tousvente,
              'vente' => Vente::readOne($id),
              'elementvente' => elementVente::readByVente($id),
  
            ];
          }
        break;
          case 'read' :
            $vente = Vente::readAll();
                $view = 'vente.twig';
                $data = [
                  // La requête readOne récupère les données à afficher
                  'ventes' => $vente,
                ];
          break;
          case 'readcorde' :
            $vente = Vente::readcorde();
                $view = 'ventecorde.twig';
                $data = [
                  // La requête readOne récupère les données à afficher
                  'ventes' => $vente,
                ];
          break;
          case 'readvent' :
            $vente = Vente::readvent();
                $view = 'ventevent.twig';
                $data = [
                  // La requête readOne récupère les données à afficher
                  'ventes' => $vente,
                ];
          break;
          case 'readpercussion' :
            $vente = Vente::readpercussion();
                $view = 'ventepercussion.twig';
                $data = [
                  // La requête readOne récupère les données à afficher
                  'ventes' => $vente,
                ];
          break;

          case 'sendvente' :
            Vente::sendvente();
            $view = 'confirmationachat.twig';
            $data = [
            ];
          break;

  
          case 'new' :
              $view = 'create_vente.twig';
                  $data = [
                    // La requête readOne récupère les données à afficher
                  ];
          break;
  
          case 'create' :
            $create_vente = new Vente();
            $create_vente->chargePOST();   
            $create_vente->create();
            header('Location: controleur.php?page=vente&action=read');
              $view = 'create_vente.twig';
                  $data = [
                    // La requête readOne récupère les données à afficher
                    'create_ventes' => $create_vente,
                  ];
          break;
          case 'delete' :
            // suppression de l'element
            Vente::delete($id);
            // premier choix : un message
            header("Location: " . $_SERVER["HTTP_REFERER"]);
            $view = 'base.twig';
                  $data = [
  
                  ];
            break;
            case 'edit' :
              if ($id > 0) {
                $view = 'edit_vente.twig';
                $data = [
                  // La requête readOne récupère les données à afficher
                  'vente' => Vente::readOne($id),
                  'elementvente' => elementvente::readByvente($id),
      
                ];
              }
              break;
              case 'update' :
              $vente = new Vente();
              $vente->chargePOST();
              $vente->update();
              header("Location: " . $_SERVER["HTTP_REFERER"]);
              $view = 'detail_vente.twig';
              $data = [
                    // La requête readOne récupère les données à afficher
                  ];
                  break;
                }
            break;

    case 'prestation' :
      switch ($action) {
        case 'detailread' :
          if ($id > 0) {
            $tousprestation = Prestation::readAll();
            $view = 'detail_prestation.twig';
            $data = [
              // La requête readOne récupère les données à afficher
              'tousprestation' => $tousprestation,
              'prestation' => Prestation::readOne($id),
              'elementpres' => Elementpres::readByPrestation($id),
            ];
          }
        break;

          case 'read' :
            $prestation = Prestation::readAll();
                $view = 'prestation.twig';
                $data = [
                  // La requête readOne récupère les données à afficher
                  'prestations' => $prestation,
                ];
          break;
          case 'readsolfege' :
            $prestation = Prestation::readsolfege();
                $view = 'prestationsolfege.twig';
                $data = [
                  // La requête readOne récupère les données à afficher
                  'prestations' => $prestation,
                ];
          break;
          case 'readvoix' :
            $prestation = Prestation::readvoix();
                $view = 'prestationvoix.twig';
                $data = [
                  // La requête readOne récupère les données à afficher
                  'prestations' => $prestation,
                ];
          break;
          case 'readpiano' :
            $prestation = Prestation::readpiano();
                $view = 'prestationpiano.twig';
                $data = [
                  // La requête readOne récupère les données à afficher
                  'prestations' => $prestation,
                ];
          break;
          case 'readguitare' :
            $prestation = Prestation::readguitare();
                $view = 'prestationguitare.twig';
                $data = [
                  // La requête readOne récupère les données à afficher
                  'prestations' => $prestation,
                ];
          break;
          case 'readbasse' :
            $prestation = Prestation::readbasse();
                $view = 'prestationbasse.twig';
                $data = [
                  // La requête readOne récupère les données à afficher
                  'prestations' => $prestation,
                ];
          break;
          case 'readbatterie' :
            $prestation = Prestation::readbatterie();
                $view = 'prestationbatterie.twig';
                $data = [
                  // La requête readOne récupère les données à afficher
                  'prestations' => $prestation,
                ];
          break;
  
          case 'new' :
              $view = 'create_prestation.twig';
                  $data = [
                    // La requête readOne récupère les données à afficher
                  ];
          break;
  
          case 'create' :
            $create_prestation = new Prestation();
            $create_prestation->chargePOST();   
            $create_prestation->create();
            header('Location: controleur.php?page=prestation&action=read');
              $view = 'create_prestation.twig';
                  $data = [
                    // La requête readOne récupère les données à afficher
                    'create_prestations' => $create_prestation,
                  ];
          break;
          case 'delete' :
            // suppression de l'element
            Prestation::delete($id);
            // premier choix : un message
            header("Location: " . $_SERVER["HTTP_REFERER"]);
            $view = 'comptemusiciencours.twig';
                  $data = [
  
                  ];
            break;
            case 'edit' :
              if ($id > 0) {
                $view = 'edit_prestation.twig';
                $data = [
                  // La requête readOne récupère les données à afficher
                  'prestation' => Prestation::readOne($id),
                  'elementpres' => Elementpres::readByPrestation($id),
                ];
              }
              break;
              case 'reservation' :
                Prestation::reservation();
                $view = 'confirmationreservation.twig';
                $data = [
                ];
              break;
              case 'update' :
              $prestation = new Prestation();
              $prestation->chargePOST();
              $prestation->update();
              header("Location: " . $_SERVER["HTTP_REFERER"]);
              $view = 'detail_prestation.twig';
              $data = [
                    // La requête readOne récupère les données à afficher
                  ];
                  break;
            default :
            }
          break;


      case 'compte' :
        switch ($action) {  

          case 'register' :
            $view = 'register.twig';
            $data = [
            ];
      break;

      case 'login' :
        $view = 'login.twig';
        $data = [
        ];
      break;
      case 'loginerror' :
        $view = 'loginerror.twig';
        $data = [
        ];
      break;


      case 'loginmusicien' :
        $view = 'loginmusicien.twig';
        $data = [
        ];
        break;

        case 'loginmusicienerror' :
          $view = 'loginmusicienerror.twig';
          $data = [
          ];
          break;


        case 'registermusicien' :
          $view = 'registermusicien.twig';
          $data = [
          ];
        break;
        case 'compteutilisateur' :
          $view = 'compteutilisateur.twig';
          $data = [
          ];
        break;
        case 'comptemusicien' :
          $view = 'comptemusicien.twig';
          $data = [
          ];
        break;
        case 'mespartitions' :
          $article = Article::readAll();

          $view = 'comptemusicienpartitions.twig';
          $data = [
            'articles' => $article,
          ];
        break;

        case 'mescours' :
          $prestation = Prestation::readAll();
          $view = 'comptemusiciencours.twig';
          $data = [
            'prestations' => $prestation,
          ];
        break;

        case 'mesventes' :
          $vente = Vente::readAll();
          $view = 'comptemusicienventes.twig';
          $data = [
            'ventes' => $vente,
          ];
        break;

        case 'mesventesutilisateur' :
          $vente = Vente::readAll();
          $view = 'comptemusicienventesutilisateur.twig';
          $data = [
            'ventes' => $vente,
          ];
        break;

        case 'contact' :
          $view = 'contact.twig';
          $data = [
          ];
        break;


          case 'loginadmin' :
            $view = 'loginadmin.twig';
            $data = [
            ];
          break;

          case 'loginadminerror' :
            $view = 'loginadminerror.twig';
            $data = [
            ];
          break;

          case 'connexionadmin' :
            Compte::loginadmin();
            $view = 'compteadmin.twig';
            $data = [
            ];
          break;

          case 'compteadmin' :
            $users = Compte::readusers();
            $usersmusiciens = Compte::readusersmusiciens();
            $view = 'compteadmin.twig';
            $data = [
              'userss' => $users,
              'usersmusicienss' => $usersmusiciens,

            ];
          break;

          case 'partitionsadmin' :
            $article = Article::readAll();
            $view = 'compteadminpartitions.twig';
            $data = [
              'articles' => $article,

            ];
          break;

          case 'coursadmin' :
            $prestation = Prestation::readAll();
            $view = 'compteadmincours.twig';
            $data = [
              'prestations' => $prestation,
            ];
          break;
  
          case 'ventesadmin' :
            $vente = Vente::readAll();
            $view = 'compteadminventes.twig';
            $data = [
              'ventes' => $vente,
            ];
          break;


          case 'registerutilisateur' :
            Compte::register();
            $view = 'login.twig';
            $data = [
            ];
          break;

          case 'loginutilisateur' :
            Compte::login();
            $view = 'compteutilisateur.twig';
            $data = [
            ];
          break;

          case 'registermusicienco' :
            Compte::registermusicien();
            $view = 'loginmusicien.twig';
            $data = [
            ];
          break;

          case 'loginmusicienco' :
            Compte::loginmusicien();
            $view = 'compteumusicien.twig';
            $data = [
            ];
          break;

            case 'historique' :
              $historique = Historique::readAll();
                  $view = 'comptehistorique.twig';
                  $data = [
                    // La requête readOne récupère les données à afficher
                    'historiques' => $historique,
                  ];
            break; 
            case 'delete' :
              // suppression de l'element
              Historique::delete($id);
              // premier choix : un message
              header('Location: controleur.php?page=compte&action=historique');
              $view = 'comptehistorique.twig';
                    $data = [
    
                    ];
              break;
              case 'historiquedownload' :
                $historiquedownload = Historiquedownload::readAll();
                    $view = 'comptehistoriquedownload.twig';
                    $data = [
                      'historiquedownloads' => $historiquedownload,
                    ];

              break; 
              case 'deletedownload' :
                // suppression de l'element
                Historiquedownload::delete($id);
                // premier choix : un message
                header('Location: controleur.php?page=compte&action=historiquedownload');
                $view = 'comptehistorique.twig';
                      $data = [
      
                      ];
                break;
                case 'deletedownloadutilisateur' :
                  // suppression de l'element
                  Historiquedownload::delete($id);
                  // premier choix : un message
                  header('Location: controleur.php?page=compte&action=historiquedownloadutilisateur');
                  $view = 'comptehistorique.twig';
                        $data = [
        
                        ];
                  break;

                case 'historiquevente' :
                  $historiquevente = Historiquevente::readAll();
                      $view = 'comptehistoriquevente.twig';
                      $data = [
                        // La requête readOne récupère les données à afficher
                        'historiqueventes' => $historiquevente,
                      ];
                break; 
                case 'deletevente' :
                  // suppression de l'element
                  Historiquevente::delete($id);
                  // premier choix : un message
                  header('Location: controleur.php?page=compte&action=historiquevente');
                  $view = 'comptehistoriquevente.twig';
                        $data = [
        
                        ];
                  break;
                  case 'deleteventeutilisateur' :
                    // suppression de l'element
                    Historiquevente::delete($id);
                    // premier choix : un message
                    header('Location: controleur.php?page=compte&action=historiqueventeutilisateur');
                    $view = 'comptehistoriquevente.twig';
                          $data = [
          
                          ];
                    break;

                  case 'historiqueventeutilisateur' :
                    $historiquevente = Historiquevente::readAll();
                        $view = 'comptehistoriqueventeutilisateur.twig';
                        $data = [
                          // La requête readOne récupère les données à afficher
                          'historiqueventes' => $historiquevente,
                        ];
                  break; 
                  case 'deleteventeutilisateur' :
                    // suppression de l'element
                    Historiquevente::delete($id);
                    // premier choix : un message
                    header('Location: controleur.php?page=compte&action=historiquevente');
                    $view = 'comptehistoriqueventeutilisateur.twig';
                          $data = [
          
                          ];
                    break;


                case 'historiqueutilisateur' :
                  $historique = Historique::readAll();
                      $view = 'comptehistoriqueutilisateur.twig';
                      $data = [
                        // La requête readOne récupère les données à afficher
                        'historiques' => $historique,
                      ];
                break; 
                case 'deleteutilisateur' :
                  // suppression de l'element
                  Historique::delete($id);
                  // premier choix : un message
                  header('Location: controleur.php?page=compte&action=historiqueutilisateur');
                  $view = 'comptehistoriqueutilisateur.twig';
                        $data = [
        
                        ];
                  break;
                  case 'historiquedownloadutilisateur' :
                    $historiquedownload = Historiquedownload::readAll();
                        $view = 'comptehistoriquedownloadutilisateur.twig';
                        $data = [
                          'historiquedownloads' => $historiquedownload,
                        ];
    
                  break; 
                  case 'deletedownloadutilisateur' :
                    // suppression de l'element
                    Historiquedownload::delete($id);
                    // premier choix : un message
                    $view = 'comptehistoriqueutilisateur.twig';
                          $data = [
          
                          ];
                    break;
          default :
        }
      break;
}

echo $twig->render($view,$data);