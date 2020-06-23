<?php
require_once 'database/connection.php';
$message=false;
if(isset($_POST['register'])){
    $myname=trim($_POST['name']);
    $roll=trim($_POST['roll']);
    $semister=trim($_POST['semister']);
    $shift=trim($_POST['shift']);
    if(!empty($_FILES['photo']['tmp_name'])){
        $name=$_FILES['photo']['name'];
        $filename_parts=explode('.', $name);
        $extension=end($filename_parts);
        $new_photo= uniqid('pp_',true).time(). '.'. $extension;
        move_uploaded_file($_FILES['photo']['tmp_name'],'upload/profile_photo/'.$new_photo);
        $message='File uploaded .';
    }
    $photo=$new_photo;
    $query="INSERT INTO student_id(`name`,`roll`,`semister`,`shift`,`photo`) VALUES(:name,:roll,:semister,:shift,:photo)";
    $stmt=$connection->prepare($query);
    $stmt->bindParam(':name',$myname);
    $stmt->bindParam(':roll',$roll);
    $stmt->bindParam(':semister',$semister);
    $stmt->bindParam(':shift',$shift);
    $stmt->bindParam(':photo',$photo);
    $response=$stmt->execute();
    if ($response){
        header('Location:user.php');
    }else{
        $message= 'Registration Unsuccessful .';
}
}
?>

<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>Students_Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <?php if (isset($massage)): ?>
        <div class="alert alert-success">
            <?php echo $message?>
        </div>
    <?php endif; ?>
    <form class="form-signin" action="" method="post" enctype="multipart/form-data">
        <img class="mb-4" src="" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Register</h1>
        <label for="inputName" class="sr-only">Your name</label>
        <input type="name" id="inputName" class="form-control mb-3" name="name" placeholder="Your name" required autofocus>
        <label for="inputRoll" class="sr-only"> Your roll</label>
        <input type="roll" id="inputRoll" class="form-control mb-3" name="roll" placeholder="Your roll" required>
        <label for="inputSemister" class="sr-only">semister</label>
        <input type="semister" id="inputSemister" class="form-control mb-3" name="semister" placeholder="Your semister" required>
        <label for="inputShift" class="sr-only">shift</label>
        <input type="shift" id="inputShift" class="form-control mb-3" name="shift" placeholder="Your shift" required>
        <label for="inputphoto" class="sr-only">photo</label>
        <input type="file" name="photo" class="form-control" required>
        <button class="btn btn-lg btn-primary btn-block mt-5" type="submit" name="register">Register</button>
        <p class="mt-5 mb-3 text-muted">&copy; 2017-2019</p>
    </form>
</div>
</body>
</html>
