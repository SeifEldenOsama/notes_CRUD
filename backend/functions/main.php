<?php
class Main{
public function logged_in(){
    return (isset($_SESSION['loggedin'])) ? true : false;
}

public function getAllNotes(){
    global $pdo;

    $query = $pdo->prepare('SELECT * FROM notes Order by noteID DESC'); 
    $query->execute();

    return $query->fetchAll(PDO::FETCH_ASSOC);
}

public function fetchNoteData($noteID){
    global $pdo;

    $query = $pdo->prepare('SELECT * FROM notes where noteID = ?');
    $query->BindValue(1,$noteID);
    $query->execute();

    return $query->fetch();
}

public function fetchUser($username){
    global $pdo;

    $query = $pdo->prepare('SELECT COUNT(*) AS user_count FROM user WHERE username = ?');
    $query->bindValue(1, $username);
    $query->execute();
    
    return $query->fetchColumn();
}

}
?>