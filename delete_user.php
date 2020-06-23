<?php
    require_once'database/connection.php';
    $id=(int)$_GET['id'];
    if($id>0){
    $query='DELETE FROM student_id WHERE id=:id';
    $stmt=$connection->prepare($query);
    $stmt->bindParam(':id',$id);
    $stmt->execute();
    var_dump($stmt);
}
header('Location: user.php');

?>