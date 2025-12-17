<?php 

    include ('connection.php');
    include ('functions/main.php');
    
    if(isset($_SESSION['loggedin'])===false){
        header('Location: ../index.php');
        exit;
    }else{
        if($_POST){
            $noteTitle = trim($_POST['noteTitle']);
            $noteContent = $_POST['noteContent'];
            
            $cleanContent = strip_tags($noteContent);
            $cleanContent = trim($cleanContent);

            if(empty($noteTitle) or empty($cleanContent)){
                $_SESSION['errors'] = '<div class="alert alert-warning"><strong> Validation Error:</strong> Please provide a note title and content. 😒</div>';
                header('Location: ../index.php');
                exit; 
            }else{
                $query = $pdo->prepare("INSERT INTO `crud`.`notes` ( `noteID` ,`noteTitle`, `noteContent`)
                VALUES ( NULL,?, ?)");
                $query->bindValue(1, $noteTitle);  
                $query->bindValue(2, $noteContent); 
                                    
                $query -> execute(); 
                header('Location: ../index.php');    
                exit; 
            }
        }
    }
?>