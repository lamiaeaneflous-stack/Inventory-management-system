
<?php
	include('session.php');
    $sql = 'SELECT * FROM product';
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
		<title>Inventory</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="css/dashboard.css">
		<link rel="stylesheet" type="text/css" href="css/inventory.css">
		<script type="text/javascript">
			var products = <?php echo json_encode($rows); ?>;
		</script>
		<script src="js/dashboard.js"></script>
		<script src="js/inventory.js"></script>
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
				</div>

				<div id="addItem">
					<button class="editBtn" onclick="edit()">Edit</button>
					<button class="addBtn Btn">Add Item</button>
					<button class="addBtn Btn">Delete Item</button>
					<button id="updateBtn" class="Btn">Update Sale</button>

					<form class="submit" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
						<div id="addModal" class="modal">
							<div class="modal-content">
								<button type="button" class="close" aria-label="Close">&times;</button>
								<div class="modal-body">
									<table>
										<tr>
											<td><label for="item">Item Name:</label></td>
											<td><input type="text" id="item" placeholder="itemName" name="item"></td>
										</tr>
										<tr>
											<td><label for="storage">#In-Stock:</label></td>
											<td><input type="text" id="storage" placeholder="storage" name="storage"></td>
										</tr>
										<tr>
											<td><label for="unitPrice">Unit Price:</label></td>
											<td><input type="text" id="unitPrice" placeholder="unitPrice" name="unitPrice"></td>
										</tr>
										<tr>
											<td><label for="sellPrice">Sell Price:</label></td>
											<td><input type="text" id="sellPrice" placeholder="sellPrice" name="sellPrice"></td>
										</tr>
										<tr>
											<td><label for="date">Date:</label></td>
											<td><input type="date" id="date" name="date"></td>
										</tr>
									</table>
									<br>
									<button class="addBtn" name="add">Add</button>
								</div>
							</div>
						</div>

						<div>
							<?php echo $message; ?>
						</div>

						<div id="deleteModal" class="modal">
							<div class="modal-content">
								<button type="button" class="close" aria-label="Close">&times;</button>
								<div class="modal-body">
									<table>
										<tr>
											<td><label for="itemId">Item ID:</label></td>
											<td><input type="text" id="itemId" placeholder="itemId" name="itemId"></td>
										</tr>
									</table>
									<br>
									<button class="addBtn" name="delete">Delete</button>
								</div>
							</div>
						</div>
					</form>
				</div>

				<br>

				<form class="submit" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
					<div id="Product_Panel">
						<button name="edit" id="editBtn">Submit Change</button>

						<div id="updateModal" class="modal">
							<div class="modal-content">
								<button type="button" class="close" aria-label="Close">&times;</button>
								<div class="modal-body">
									<table>
										<tr>
											<td><label for="updateItemId">Item Id:</label></td>
											<td><input type="text" id="updateItemId" placeholder="itemId" name="itemId"></td>
										</tr>
										<tr>
											<td><label for="updateItem">Item Name:</label></td>
											<td><input type="text" id="updateItem" placeholder="itemName" name="item"></td>
										</tr>
										<tr>
											<td><label for="quantity">Quantity:</label></td>
											<td><input type="text" id="quantity" placeholder="quantity" name="quantity"></td>
										</tr>
										<tr>
											<td><label for="updateDate">Date:</label></td>
											<td><input type="date" id="updateDate" name="date"></td>
										</tr>
									</table>
									<br>
									<button class="editBtn" name="updateSale">Update Sale</button>
								</div>
							</div>
						</div>
					</div>
				</form>

				<script>
					// Get the modal
					var modal = document.getElementsByClassName("modal");

					// Get the button that opens the modal
					var btn = document.getElementsByClassName("Btn");

					// Get the element that closes the modal
					var span = document.getElementsByClassName("close");

					// When the user clicks the button, open the modal
					btn[0].onclick = function() {
					    modal[0].style.display = "block";
					}

					btn[1].onclick = function() {
					    modal[1].style.display = "block";
					}

					btn[2].onclick = function() {
					    modal[2].style.display = "block";
					}

					// When the user clicks on close, close the modal
					span[0].onclick = function() {
					    modal[0].style.display = "none";
					}

					span[1].onclick = function() {
					    modal[1].style.display = "none";
					}

					span[2].onclick = function() {
					    modal[2].style.display = "none";
					}

					// When the user clicks anywhere outside of the modal, close it
					window.onclick = function(event) {
					    for (var i = 0; i < modal.length; i++) {
					        if (event.target == modal[i]) {
					            modal[i].style.display = "none";
					        }
					    }
					}
				</script>
			</div>
		</div>
	</body>
</html>
