<?php
include_once ('connection.php');
include_once ('functions/main.php');

$theNotes = new Main;
$notes;

if(isset($_SESSION['loggedin'])===false){
    header('Location: ../index.php');
    exit;
}else{

    if(isset($_GET['noteID'])){
        $noteID = $_GET['noteID'];
        $notes = $theNotes->fetchNoteData($noteID);

        if($_POST){
            $noteTitle = trim($_POST['noteTitle']); 
            $noteContent = $_POST['noteContent'];

            $cleanContent = strip_tags($noteContent);
            $cleanContent = trim($cleanContent);
            
            if(empty($noteTitle) or empty($cleanContent)){
                $errors = '<div class="alert alert-warning"><strong> Validation Error:</strong> Please provide a note title and content. 😒</div>';
            }else{
                $query = $pdo->prepare("UPDATE `notes` SET `noteTitle` =?, `noteContent` = ? WHERE `noteID` = ?;");
                $query->bindValue(1, $noteTitle);  
                $query->bindValue(2, $noteContent);
                $query->bindValue(3, $noteID);
                                
                $query -> execute(); 
                header('Location: ../index.php'); 
                exit; 
            }
        }
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Edit Note - CRUD</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../CSS/style.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css">     
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="../ckeditor/ckeditor.js"></script> 
    <style>
        .container {
            margin-top: 50px;
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            border-top: 3px solid #0d47a1;
        }
        input[type="text"], textarea {
            border-radius: 6px;
            border: 1px solid #ced4da;
            padding: 10px;
            width: 100%;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<div class="container">
    <h4 style="color:#0d47a1; margin-bottom: 20px;">Editing Note #<?php echo htmlspecialchars($noteID); ?></h4>
    <form action="" method="POST" onsubmit="return validateEditForm()">
        <div class="form-group">
            <label for="noteTitle"><h6>Note Title</h6></label>
            <input type="text" name="noteTitle" class="form-control" value="<?php echo htmlspecialchars($notes['noteTitle']);?>" >
        </div>
        
        <div class="form-group">
            <label for="noteContent"><h6>Note Content</h6></label>
            <textarea name="noteContent" id="editor" rows="10"><?php echo htmlspecialchars($notes['noteContent']) ?></textarea>
        </div>
        
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Changes</button>
        <a href="../index.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back to Notes</a>
    </form>
</div>

<div class="container">
<?php if(isset($errors)){
    echo $errors;
}?>
</div>
    
<script>

function validateEditForm() {
    var title = document.querySelector('input[name="noteTitle"]').value.trim();
    var content = CKEDITOR.instances.editor.getData().trim(); 

    if (title === "") {
        alert("Please enter the note title.");
        return false;
    }

    var textContent = content.replace(/<[^>]*>/g, '').trim(); 
    
    if (textContent === "") {
        alert("Please enter the note content.");
        return false;
    }
    return true;
}
</script>

</body>
</html>