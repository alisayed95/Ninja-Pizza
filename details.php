<?php 

	include ("config/db_connect.php");

	//check is deleted
	if(isset($_POST["delete"])){
		$id_to_delete = mysqli_real_escape_string($conn,$_POST["id_to_delete"]);

		$sql = "DELETE FROM pizzas WHERE id = $id_to_delete";

		if(mysqli_query($conn, $sql)){
			//success
			header('Location: index.php');
		}else {
			//failure
			echo "Query Error" . mysqli_error($conn);
		}
	}

	// check GET request id param
	if(isset($_GET["id"])){
		$id = mysqli_real_escape_string($conn,$_GET["id"]);

		// make sql
		$sql = "SELECT * from pizzas WHERE id = $id";

		// get the query result
		$result = mysqli_query($conn, $sql);

		//fetch result in array format
		$pizza = mysqli_fetch_assoc($result);

		//free result from the memory
		mysqli_free_result($result);

		//close connection
		mysqli_close($conn);
	}

	
?>


<!DOCTYPE html>
<html>
	<?php include('templates/header.php'); ?>
	<div class="container center">
		<?php if($pizza): ?>
			<h4><?php echo htmlspecialchars($pizza["title"]); ?></h4>
			<p>Created by: <?php echo htmlspecialchars($pizza["email"]); ?></p>
			<p>Date: <?php echo date($pizza["created_at"]); ?></p>
			<h5>Ingredients:</h5>
			<p><?php echo htmlspecialchars($pizza["ingredients"]) ?></p>
			<form action="details.php" method="POST">
				<input type="hidden" name="id_to_delete" value="<?php echo $pizza["id"]; ?>" />
				<input type="submit" name="delete" value="Delete" class="btn brand">
			</form>
		<?php else: ?>
			<h4>No Data Found</h4>
		<?php endif; ?>
	</div>
	<?php include('templates/footer.php'); ?>
</html>