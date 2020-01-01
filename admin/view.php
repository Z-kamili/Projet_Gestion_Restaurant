<?php
require 'database.php';

if(!empty($_GET['id'])){
    
    
  $id = checkInput($_GET['id']);  
    
}
$db = Database::connect();
$statement = $db->prepare('select items.id, items.name , items.image,items.description, items.price, categorie.name AS categorie from items LEFT JOIN categorie ON items.categorie = categorie.id where items.id = ? ');
$statement->execute(array($id));
$item = $statement->fetch();
Database::disconnect();


function CheckInput($data){
    $data = trim($data);
    $data =  stripslashes($data);
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
            <div class="col-sm-6">
                 <h1><strong>Voir un  item</strong></h1>
                <br>
            <form>
                
            <div class="form-group">
                <labe>Nom: </labe><?php echo '  '.$item['name']; ?>
                
                </div>   
                 <div class="form-group">
                <labe>Description:</labe><?php echo '  '.$item['description']; ?>
                
                </div>   
                 <div class="form-group">
                <labe>Prix: </labe><?php echo '  '.$item['price'] . '$'; ?>
                
                </div>   
                 <div class="form-group">
                <labe>categorie: </labe><?php echo '  '.$item['categorie']; ?>
                
                </div>   
                 <div class="form-group">
                <labe>Image: </labe><?php echo '  '.$item['image']; ?>
                
                </div>   
                
            </form>
                <div class="form-group">
                <a class="btn btn-primary" href="index.php">
                    
                    <span class="glyphicon glyphicon-arrow-left"></span>Retour
                    
                    </a>
                
                </div>
            </div>
            <div class="col-sm-6">
                
            <div class="thumbmail site">
                <img src="<?php echo '../images/' . $item['image'] ; ?>" alt="....." width="400px" height="300px">
                
                <div class="price"><?php echo '  '.$item['price'] . ' $'; ?> </div>
                <div class="cpation">
                <h4><?php echo '  '.$item['name']; ?></h4>
                    <p><?php echo '  '.$item['description']; ?></p>
                    
           <a href="#" class="btn btn-order" role="button">
               
               <span class="glyphicon glyphicon-shopping-cart"></span>
               Commander
                    </a>         
                
                
                </div>
                
                
                
                </div>
            </div>
            
            
       
            
           
            
        </div>
        
        
        </div>
    
    
    
    </body>
</html>