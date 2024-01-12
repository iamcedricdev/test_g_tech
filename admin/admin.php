<?php 

session_start();
if(isset($_SESSION['admin'])){
 
if (isset($_GET['page'])) {

  require_once('config/datab.php');
  require_once('app/fonction.php');

  switch
  ($_GET['page']) {
    case 'acceuil':
     getTemplatesApp('acceuil', 'acceuil'); 
      break;
      case'compte':
        getTemplatesApp('compte', 'compte'); 
      break;
      case'event_busy':
        getTemplatesApp('event_busy', 'event_busy');
      break;
      case'event_chr':
        getTemplatesApp('event_chr', 'event_chr');
      break;
      case'event_list':
        getTemplatesApp('event_list', 'event_list');
      break;
      case'EditActu':
        getTemplatesApp('EditActu', 'EditActu');
      break;
      default:
      header('Location: ../admin/template/404/error404.php');
      break;
      
  }
}else{
  header('Location: ../admin/template/404/error404.php');
}
}else{

  header('Location: index.php');
}




?>