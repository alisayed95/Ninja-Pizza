<?php 
	include ("config/db_connect.php");

	//write query for all pizza
	$sql = "SELECT id, title, ingredients FROM pizzas ORDER BY created_at";

	//make query & get the result
	$result = mysqli_query($conn, $sql);

	//fetch the resulting rows as an array
	$pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);

	//free result from the memory
	mysqli_free_result($result);

	//close connection
	mysqli_close($conn);

	// explode(",", $pizzas[0]["ingredients"]);

?>

<!DOCTYPE html>
<html>
	
	<?php include('templates/header.php'); ?>
	<h4 class="center grey-text">Pizzas!</h4>
	<div class="container">
		<div class="row">
			<?php foreach ($pizzas as $pizza): ?>
			<div class="col s6 md3">
				<div class="card z-depth-0">
					<div class="card-content center">
						<img src="img/pizza.svg" class="pizza">
						<h5><?php echo htmlspecialchars($pizza["title"]); ?></h5>
						<ul>
							<?php foreach (explode(",", $pizza["ingredients"]) as $ing): ?>
								<li><?php echo htmlspecialchars($ing) ?></li>
							<?php endforeach;  ?>	
						</ul>
					</div>
					<div class="card-action right-align">
						<a class="brand-text" href="details.php?id=<?php echo $pizza["id"]; ?>">more info</a>
					</div>
				</div>
			</div>
			<?php endforeach; ?>	
		</div>
	</div>
	
	<?php include('templates/footer.php'); ?>

</html>