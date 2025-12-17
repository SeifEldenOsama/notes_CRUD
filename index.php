<?php
include_once ('backend/connection.php');
include_once ('backend/functions/main.php');

$theNotes = new Main;
$check = new Main;

$notes = $theNotes->getAllNotes();
$check_login = $check->logged_in();
if($check_login === false){
    header('Location: backend/login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>CRUD Notes</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css">

<script src="ckeditor/ckeditor.js"></script>

<style>
    body {
        background-color: #f0f2f5;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .container-header {
        background-color: #0d47a1;
        color: #fff;
        padding: 20px 30px;
        border-radius: 8px;
        margin-top: 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    .table-scroll {
        max-height: 70vh; 
        overflow-y: auto;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08); 
        background-color: #fff;
        margin-top: 20px;
    }

    .table-scroll thead th {
        position: sticky;
        top: 0;
        background: #343a40;
        color: #fff;
        z-index: 2;
    }
    
    table.table tbody tr:hover {
        background-color: #e3f2fd;
        transition: 0.2s;
    }

    .note-content-cell {
        max-width: 480px; 
        white-space: normal; 
        overflow: hidden;
        text-overflow: ellipsis; 
        font-size: 0.95rem;
        color: #555;
    }

    .btn-primary {
        background-color: #0d47a1;
        border-color: #0d47a1;
        border-radius: 50px;
        transition: background-color 0.2s;
    }
    .btn-primary:hover {
        background-color: #1565c0;
        border-color: #1565c0;
    }
    .btn-danger {
        border-radius: 50px;
    }
    .btn-light {
        color: #0d47a1; 
    }

    .form-section {
        background-color: #ffffff;
        padding: 30px;
        border-radius: 8px;
        margin-bottom: 30px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        border-top: 3px solid #0d47a1;
    }

    .form-section h6 {
        font-weight: 700;
        color: #333;
    }

    input[type="text"], textarea {
        border-radius: 6px;
        border: 1px solid #ced4da;
        padding: 10px;
    }

    hr {
        border-top: 1px solid #b3e5fc;
        margin: 1.5rem 0;
    }

    .cke_contents {
        border-radius: 6px !important;
        box-shadow: none !important;
        border: 1px solid #ced4da !important;
        min-height: 250px !important;
    }

    .cke_top {
        border-radius: 6px 6px 0 0;
        background: #f8f9fa !important;
        border: none !important;
    }

    @media (max-width: 768px) {
        .container-header {
            flex-direction: column;
            align-items: flex-start;
        }
        .btn {
            margin-top: 10px;
        }
    }
</style>
</head>

<body>

<div class="container container-header">
    <h5><i class="fas fa-sticky-note" style="margin-right: 10px;"></i> Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></h5> 
    <button class="btn btn-light btn-sm" onclick="logOut()"><i class="fas fa-sign-out-alt"></i> Logout</button>
</div>

<hr>

<div class="container form-section">
    <h6>Add New Note</h6>
    <form action="backend/submit.php" method="POST" onsubmit="return validateForm();">
        <div class="form-group">
            <label><h6>Note Title</h6></label>
            <input type="text" name="noteTitle" class="form-control" placeholder="Enter your note title">
        </div>

        <div class="form-group">
            <label><h6>Note Content</h6></label>
            <textarea name="noteContent" id="editor" rows="8" placeholder="Write your note here..."></textarea>
        </div>

        <button type="submit" class="btn btn-primary btn-lg"><i class="fas fa-paper-plane"></i> Publish Note</button>
    </form>
</div>

<div class="container mb-4">
    <h6 style="font-weight: 700; color: #333; margin-bottom: 10px;">All Notes</h6>
    <div class="table-scroll table-responsive">
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>Note ID</th>
                    <th>Title</th>
                    <th style="min-width: 500px;">Content</th> 
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($notes as $note){ ?>
                <tr>
                    <td><?php echo htmlspecialchars($note['noteID']); ?></td>
                    <td><?php echo htmlspecialchars($note['noteTitle']); ?></td>
                    <td class="note-content-cell">
                        <?php 
                            $clean_content = strip_tags($note['noteContent']);
                         
                            $max_length = 150;
                            if (strlen($clean_content) > $max_length) {
                                $display_content = substr($clean_content, 0, $max_length) . '...';
                            } else {
                                $display_content = $clean_content;
                            }
                  
                            echo htmlspecialchars($display_content);
                        ?>
                    </td>
                    <td><?php echo htmlspecialchars($note['noteDate']); ?></td>
                    <td>
                        <a href="backend/edit.php?noteID=<?php echo htmlspecialchars($note['noteID']); ?>" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit</a>
                        <button class="btn btn-danger btn-sm" onclick="deleteNote(<?php echo htmlspecialchars($note['noteID']); ?>)"><i class="fas fa-trash-alt"></i> Delete</button>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>


<div class="container mt-3">
    <?php
        if(isset($_SESSION['errors'])){
            echo $_SESSION['errors'];
            unset($_SESSION['errors']);
        }
    ?>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<script>
CKEDITOR.replace('editor');

function validateForm() {
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

function deleteNote(id){
    if(confirm("Are you sure you want to delete this note?")){
        window.location = "backend/delete.php?noteID=" + id;
    }
}

function logOut(){
    window.location = "backend/logout.php";
}
</script>

</body>
</html>