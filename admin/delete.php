<?php
       require 'database.php';
  if(!empty($_GET['id'])){
      
      $id = checkInput($_GET['id']);
      
  }
if(!empty($_POST)){
    
    $id = checkInput($_POST['id']);
    $db = Database::connect();
    $statement = $db->prepare("delete from items where id = ?");
    $statement->execute(array($id));
    Database::disconnect();
    header("Location: index.php");
    
    
}
function checkInput($data){
    
    
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
    
    
}



?>

<!DOCTYPE html>
<html>
<head>
<title>Burger code</title>
    <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/style.css">
    <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type="text/css">
</head>
    <body>
   <h1 class="text-logo"> <span class="glyphicon glyphicon-cutlery"></span> Burger code  <span class="glyphicon glyphicon-cutlery" ></span> </h1>
        <div class="container admin">
            <div class="row">
            <h1> <strong>Supprimer un item</strong> </h1>
                <br>
              <form class="form" role="form" action="delete.php" method="post"  enctype="multipart/form-data">
                  <p class="alert alert-warning">Etes vous de vouloir supprimer ?</p>
                                    <input type="hidden" name="id" value="<?php echo $id;?>"/>
        <div class="form-actions">
            
            <button type="submit" class="btn btn-success" > Oui   </button>
   <a class="btn btn-primary" href="index.php">  Nom</a>
            
            </div>
                </form>
            </div>
        
        </div>
       
    
    
    
    </body>
</html>