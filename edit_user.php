<?php
require_once 'database/connection.php';
$id=(int)$_GET['id'];
if ($id===0){
    header('Location:user.php');
    exit();
}
if (isset($_POST['update'])){
    $name=(trim($_POST['name']));
    $roll=(trim($_POST['roll']));
    $semister=(trim($_POST['semister']));
    $shift=(trim($_POST['shift']));

    if (!empty($_FILES['photo']['tmp_name'])){

        $name=$_FILES['photo']['name'];
        $filename_parts=explode('.',$name);
        $extension=end($filename_parts);
        $new_filename=uniqid('pp_',true).time().'.'.$extension;
        move_uploaded_file($_FILES['photo']['tmp_name'], 'upload/profile_photo/'.$new_filename);
        $message='file uploaded';
        $query='UPDATE student_id SET photo=:photo WHERE id=:id';
        $stmt=$connection->prepare($query);
        $stmt->bindParam('photo',$new_filename);
        $stmt->bindParam('id',$id);
        $stmt->execute();
        $message='User update';


    }
    $query='UPDATE student_id SET name=:name,roll=:roll,semister=:semister,shift=:shift WHERE id=:id';
    $stmt=$connection->prepare($query);
    $stmt->bindParam('name',$name);
    $stmt->bindParam('roll',$roll);
    $stmt->bindParam('semister',$semister);
    $stmt->bindParam('shift',$shift);
    $stmt->bindParam('id',$id);
    $stmt->execute();
    $message='User update';

}
$query='SELECT name,roll,semister,shift,photo FROM student_id WHERE id=:id';
$stmt=$connection->prepare($query);
$stmt->bindParam('id',$id);
$stmt->execute();
$user=$stmt->fetch();
$photo=!empty($user['photo'])?$user['photo']:false;
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>Edit From</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <?php if (isset($message)):?>
        <div class="alert alert-success">
            <?php echo $message ?>
        </div>
    <?php endif; ?>
    <form class="form-signin" action="" method="post" enctype="multipart/form-data">
        <img class="mb-4" src="/docs/4.3/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Edit</h1>

        <label for="inputName" class="sr-only">Your name</label>
        <input type="text" id="inputName" class="form-control " name="name"
               required value="<?php echo $user['name'];?>">

        <label for="inputName" class="sr-only">Your Roll</label>
        <input type="text" id="inputName" class="form-control mt-2" name="roll"
               required value="<?php echo $user['roll'];?>">
        <label for="inputName" class="sr-only">Your Semister</label>
        <input type="text" id="inputName" class="form-control mt-2" name="semister"
               required value="<?php echo $user['semister'];?>">

        <label for="inputName" class="sr-only">Your Shift</label>
        <input type="text" id="inputName" class="form-control mt-2" name="shift"
               required value="<?php echo $user['shift'];?>">

        <label for="inputPhoto" class="sr-only">Photo</label>
        <input type="file" name="photo" class="form-control mt-3">

        <?php if ($photo):?>
            <p>
                <img src="upload/profile_photo/<?php echo $photo;?>" alt="photo" width="100">
            </p>
        <?php endif; ?>

        <button class="btn btn-lg btn-primary btn-block mt-5 " type="submit" name="update">Update</button>
        <p class="mt-5 mb-3 text-muted">@2019-2021</p>
    </form>
</div>
</body>
</html>

