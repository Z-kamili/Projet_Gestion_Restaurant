<?php
       require 'database.php';
  if(!empty($_GET['id'])){
      
      
      $id = checkInput($_GET['id']);
      
  }
      $nameError = $descriptionError = $priceError = $categoryError = $imageError = $name = $description = $price = $category = $image = "";

     if(!empty($_POST))
     {
    
         $name = checkInput($_POST['name']);
         $category = checkInput($_POST['categorie']);
         $description = checkInput($_POST['description']);
         $price = checkInput($_POST['price']);
         $image = checkInput($_FILES['image']['name']);
         $imagePath =  '../images/' . basename($image);
         $imageExtension  = pathinfo($imagePath,PATHINFO_EXTENSION);
         $isSuccess = true;
       
         
         
         if(empty($name)){
             
             
             $nameError = "ce champ ne peut pas etre vide"
;
             $isSuccess = false;
             
         }
          if(empty($description)){
             
             
             $descriptionError = "ce champ ne peut pas etre vide"
;
             $isSuccess = false;
             
         }
          if(empty($price)){
             
             
             $priceError = "ce champ ne peut pas etre vide"
;
             $isSuccess = false;
             
         }
          if(empty($category)){
             
             
             $categoryError = "ce champ ne peut pas etre vide"
;
             $isSuccess = false;
             
         }
         if(empty($image)){
             
             
             $isImageUpdated = false;
             
         }else{
             
             $isImageUpdated = true;
             $isUploadSuccess = true;
             if($imageExtension != "jpg" && $imageExtesion != "png" && $imageExtension != "jpeg" && $imageExtension != "gif"){
                 
                 $imageError = "Les fichier autorises sont : .jpg, .jpng , .png , .gif";
                 $isUploadSuccess = false;
                 
             }
             
             
             if(file_exists($imagePath)){
                 
                 
                 $imageError = "Le fichier existe deja";
                 $isUploadSuccess = false;
             }
             if($_FILES["image"]["size"] > 500000){
                 
                 
                 $imageError = "Le fichier ne doit pas depasser le 500KB";
                 $isUploadSuccess = false;
                 
                 
             }
             if($isUploadSuccess){
                 
                 if(!move_uploaded_file($_FILES["image"]["tmp_name"],$imagePath)){
                     
                     $imageError = "Il y a eu une erreur de l'upload";
                     $isUploadSuccess = false;
                     
                     
                 }
                 
                 
                 
             }
             
             
             
             
             
             
             
         }
         
         
         if(($isSuccess && $isImageUpdated && $isUploadSuccess) || ($isSuccess && !$isImageUpdated)){
             
             
             $db = Database::connect();
             if($isImageUpdated){
                 
                 $statement = $db->prepare("Update items set name = ?,description = ?,price = ?,categorie = ?,image = ? where  id = ?");
             $statement->execute(array($name,$description,$price,$category,$image,$id)); 
                 
             }else{
                 
                 $statement = $db->prepare("Update items set name = ?,description = ?,price = ?,categorie = ? where  id = ?");
             $statement->execute(array($name,$description,$price,$category,$id)); 
                 
                 
             }
             
             
            
             Database::disconnect();
             header("Location: index.php");
             
             
             
             
         }else if($isImageUpdated && !$isUploadSuccess){
             
    $db = Database::connect();
    $statement = $db->prepare("select * from items where id = ?");
    $statement->execute(array($id));
    $item = $statement->fetch();
    $image = $item['image'];   
    Database::disconnect();
             
         }
         
         
         
         
         
         
         
         
         
         
    
    
     }
else{
    
    
    $db = Database::connect();
    
    $statement = $db->prepare("select * from items where id = ?");
    $statement->execute(array($id));
    $item = $statement->fetch();
    $name = $item['name'];
    $description = $item['description'];
    $price = $item['price'];
    $category = $item['categorie'];
    $image = $item['image'];
            
    Database::disconnect();
            
    
    
    
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
          <div class="col-sm-6">
            <h1><strong>Modifier  un  item</strong></h1>
                <br>
            <form class="form" action="<?php echo 'update.php?id=' .$id; ?>" method="post">
            <div class="form-group" enctype="multipart/form-data">
                <labe for="name">Nom: </labe>
                <input type="text" class="form-control" id="name" name="name" placeholder="name" value="<?php echo $name; ?>">
                <span class="help-inline"> 
                <?php echo $nameError; ?>
                </span>
                
                </div>   
                 <div class="form-group">
                <labe for="description">Description: </labe>
                <input type="text" class="form-control" id="description" name="description" placeholder="description" value="<?php echo $description; ?>">
                <span class="help-inline"> 
                <?php echo $descriptionError; ?>
                </span>
                
                </div>   
                 <div class="form-group">
                <labe for="price">Prix: </labe>
                <input type="number" step="0.01" class="form-control" id="price" name="price" placeholder="price" value="<?php echo $price; ?>">
                <span class="help-inline"> 
                <?php echo $priceError; ?>
                </span>
                
                </div>   
                 <div class="form-group">
                <labe for="categorie">categorie: </labe>
                <select class="form-control" id="categorie" name="categorie">
                     
                     <?php
                    $db = Database::connect();
                    
                    foreach($db->query('Select * from categorie') as $row){
                        
                       if($row['id'] == $categorie){
                           
                            echo '<option selected="selected" value ="' .$row['id'] . '">' . $row['name'] . '</option>'; 
                           
                       }else{
                           
                            echo '<option  value ="' .$row['id'] . '">' . $row['name'] . '</option>'; 
                       }
                       
                        
                    }
                    Database::disconnect();
                    
                    ?>
                     
                     
                     </select>
                <span class="help-inline"> 
                <?php echo $categoryError; ?>
                </span>
                
                </div>   
                 <div class="form-group">
                     <label>Image</label>
                     <p><?php echo $image; ?> </p>
                 <labe for="image">Selectionner une image: </labe>
                <input type="file" id="image" name="image">
                <span class="help-inline"> 
                <?php echo $imageError; ?>
                </span>
                
                </div>
                
           
            <br>
            
            <div class="form-actions">
            
            <button type="submit" class="btn btn-success" > <span class="glyphicon glyphicon-pencil"></span>Modifier   </button>
   <a class="btn btn-primary" href="index.php"> <span class="glyphicon glyphicon-arrow-left"></span> Retour</a>            
            </div>
                 </form>
               
            
            
            
            </div>
                 
            
            <div class="col-sm-6">
                
            <div class="thumbmail site">
                <img src="<?php echo '../images/' . $image ; ?>" alt="....." width="400px" height="300px">
                
                <div class="price"><?php echo '  '.$price . ' $'; ?> </div>
                <div class="cpation">
                <h4><?php echo '  '.$name; ?></h4>
                    <p><?php echo '  '. $description; ?></p>
                    
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