<?php
require_once 'database/connection.php';

$query="SELECT id,name,roll,semister,shift,photo FROM student_id";
$stmt=$connection->prepare($query);
$stmt->execute();
$student_id=$stmt->fetchAll();
?>


<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>User From</title>
    <link rel="stylesheet" href="//stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="row">
        <table class="table table-bordered table-hovered">
            <thead>
            <tr>
                <td>ID</td>
                <td>Name</td>
                <td>Roll</td>
                <td>Semister</td>
                <td>Shift</td>
                <td>Photo</td>
                <td>Update</td>
            </tr>
            </thead>
            <tbody>
            <?php foreach($student_id as $user):?>
            <tr>
                <td><?php echo $user['id'];?></td>
                <td><?php echo $user['name'];?></td>
                <td><?php echo $user['roll'];?></td>
                <td><?php echo $user['semister'];?></td>
                <td><?php echo $user['shift'];?></td>
                <td><img src="upload/profile_photo/<?php echo $user['photo'];?>"
                alt="<?php echo $user['name'];?>" width="150"</td>

                <td class="">
                    <a href="edit_user.php?id=<?php echo $user['id'];?>"
                    class="btn btn-sm btn-info">
                        Edit
                    </a>
                    <a href="delete_user.php?id=<?php echo $user['id'];?>"
                    onclick="return confirm('Are you sure !')"
                           class="btn btn-sm btn-danger">
                        Delete
                    </a>
                </td>
            </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>

