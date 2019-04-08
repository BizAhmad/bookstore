<div class="text-center">
    <h1>Welcome 353 Bookstore</h1>
    <p class="lead">If a book is not available, you may order it!</p>
    <a class="btn btn-primary text-center" href="<?php echo ROOT_PATH;?>books/adminCatalog">Browse Inventory</a><br><br>
    <a class="btn btn-primary text-center" href="<?php echo ROOT_PATH;?>books/addBook">Add Book</a><br><br>
    <a class="btn btn-primary text-center" href="<?php echo ROOT_PATH;?>users/listUsers">List Of Users</a><br><br>
    <a class="btn btn-primary text-center" href="<?php echo ROOT_PATH;?>users/listPublishers">List Of Publishers</a><br><br>
    <a class="btn btn-primary text-center" href="<?php echo ROOT_PATH;?>users/showEmployeeOrders">List Of My Orders</a><br><br>
    <a class="btn btn-primary text-center" href="<?php echo ROOT_PATH;?>users/showBackOrders">List Back Orders</a><br><br>
	
    <?php if (isset($_SESSION['cart'])) :?>
		<a class="btn btn-primary text-center" href="<?php echo ROOT_PATH;?>books/employeeCart">Cart</a>
		<?php endif;?>
    
</div>
