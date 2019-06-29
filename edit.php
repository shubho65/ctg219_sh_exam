<?php
include 'connection.php';
$connection = new Connection;
$the_id = $_GET['id'];
$result = $connection->getAll("SELECT * FROM task WHERE id=$the_id",null);

    $title = $_POST['title'];
    $description = $_POST['description'];
    $status= 'not_done';
    $array = array(
        ':title'=>$title,
        ':description'=>$description,
        ':status'=>$status
    );
    
    $connection->update("UPDATE task SET title = :title, description = :description, status = :status WHERE id=$the_id",$array);
    
    //header("location:index.php");
    

foreach($result as $res){
            $id = $res['id'];
            $title = $res['title'];
            $description = $res['description'];
            $status = $res['status'];
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Task</title>
</head>

<body>
    <form action="" method="post">
        <label for="task">Task</label><br>
        <input type="text" id="title" name="title" value="<?php echo $description ?>"><br>
        <textarea id="description" name="description"><?php echo $description ?></textarea>
        <br>
        <input type="submit" value="edit" name="edit">
    </form>
</body>

</html>