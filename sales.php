
<?php
	include('session.php');
    $sql = 'SELECT * FROM sales';
	$result = mysqli_query($db,$sql);
	$rows = array();

	while($row = mysqli_fetch_array($result)){
    	$rows[] = $row;
	}
	include('inventoryAction.php');
?>

<!DOCTYPE html>
<html lang="en">

	<head>
		<title>Sales</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="css/dashboard.css">
		<link rel="stylesheet" type="text/css" href="css/sales.css">
		<script type="text/javascript">
			var products = <?php echo json_encode($rows); ?>;
		</script>
		<script src="js/dashboard.js"></script>
		<script src="js/sales.js"></script>
	</head>

	<body>
		<div id="top-bar">
			<nav>
				<ul>
					<li><a href="dashboard.php">Home</a></li>
					<li><a href="comment.php">Message</a></li>
					<li><a href="reference.php" target="_blank">About</a></li>
					<li><a href="logout.php">Logout</a></li>
				</ul>
			</nav>
		</div>

		<div id="side-navagate-bar">
			<button type="button" class="toggle-btn" onclick="toggleSideBar()" aria-label="Toggle navigation">
				<span></span>
				<span></span>
				<span></span>
			</button>
			<ul>
				<li><h2 id="logo">Inventory Sales Management</h2></li>
				<li><a href="sales.php">Sales</a></li>
				<li><a href="inventory.php">Inventory</a></li>
			</ul>
		</div>

		<div id="block">
			<div id="main-area">
				<div id="welcome">
					<h1>Welcome <?php echo $login_session; ?></h1>
					<div id="Product_Panel">
						<h1>Sales Results</h1>
						<br>
					</div>
				</div>
			</div>
		</div>
	</body>

</html>
