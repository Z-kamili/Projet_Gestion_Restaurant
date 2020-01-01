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
            
        <h1><strong>Liste des items</strong>
            <a href="insert.php" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-plus"></span> Ajouter</a></h1>
            
            <table class="table table-striped table-bordered">
            
            <thead>
                <tr>
                
                <th>Nom</th>
                    <th>Description</th>
                    <th>Prix</th>
                    <th>categorie</th>
                    <th>Actions</th>
                
                </tr>
                
                
                
            </thead>
            
            <tbody>
                
                
                <?php 
                require 'database.php';
                
                $db = Database::connect();
                
                $statement = $db->query("select * from items");
                
                while($item = $statement->fetch())
                {
                    
                    
               echo      '<tr>';
               echo    '<td>' . $item['name'] .  '</td>';
               echo    '<td>' . $item['description'] .  '</td>';
               echo    '<td>' . $item['price'] .  '</td>';
               echo    '<td>' . $item['categorie'] .  '</td>'; 
               echo   '<td width=300>';
               echo     '<a class="btn btn-default" href="view.php?id=' . $item['id'] . '"><span class="glyphicon glyphicon-eye-open"></span> Voir </a>';
               echo ' ';
               echo   '<a class="btn btn-primary" href="update.php?id=' .$item['id'] . '"><span class="glyphicon glyphicon-pencil"></span> Modifier </a>';
               echo ' ';
               echo     '<a class="btn btn-danger" href="delete.php?id=' .$item['id'] . '"><span class="glyphicon glyphicon-remove"></span> delete </a>'; 
               echo    '</td>';
               echo '</tr>';     
                    
                    
                }
                
              Database::disconnect();  
                
                
                ?>
                
          
                
            </tbody>
            </table>
            
        </div>
        
        
        </div>
    
    
    
    </body>
</html>