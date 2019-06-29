<?php
session_start();
include 'connection.php';
$connection = new Connection;

if(isset($_SESSION['logged_id'])){

	$result = $connection->getAll("SELECT * FROM task",null);

	if(isset($_POST['submit'])){
	    $title = $_POST['title'];
	    $description = $_POST['description'];
	    $array = array(
	        ':title'=>$title,
	        ':description'=> $description ,
	        ':status'=>'not_done'
	        
	    );
	    $connection->update("INSERT INTO task(title,description,status) VALUES(:title,:description,:status)",$array);
	    
		}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin Page</title>
</head>
<body>
<?php
if(isset($_SESSION['logged_id'])){
echo "Welcome ".$_SESSION['logged_id'];
?>
<a href="logout.php">Logout</a>

     <form action="" method="post">
        <label for="task">Create task</label><br>
        <input type="text" name="title" placeholder="title"><br>
        <textarea id="description" name="description"></textarea>
        <br>
        <input type="submit" value="Create Task" name="submit">
    </form>

    <hr>
    <hr>
    <table border="1">
        <tr>
            <td>id</td>
            <td>title</td>
            <td>description</td>
            <td>status</td>
            <td>Edit</td>
            <td>Delete</td>
        </tr>

        <?php
        foreach($result as $res){
            $id = $res['id'];
            $title = $res['title'];
            $description = $res['description'];
            $status = $res['status'];
        ?>
        <tr>
            <td><?php echo $id ?></td>
            <td><?php echo $title ?></td>
            <td><?php echo $description ?></td>
            <td><?php echo $status ?></td>
            <td><a href="edit.php?id=<?php echo $id ?>">Edit</a></td>
            <td><a href="delete.php?id=<?php echo $id ?>">Delete</a></td>
        </tr>

        <?php } ?>

    </table>
   <?php } ?>

<?php
	if(!isset($_SESSION['logged_id'])){
		echo "Please Log in to see dashboard";
		header("location:login.php");
	}

?>

</body>
</html>