<div class="text-center">
    <h1>Welcome 353 Bookstore</h1>
    <p class="lead">If a book is not available, you may order it!</p>
    <a class="btn btn-primary text-center" href="<?php echo ROOT_PATH;?>books/adminCatalog">Browse Inventory</a>
    <a class="btn btn-primary text-center" href="<?php echo ROOT_PATH;?>books/addBook">Add Book</a>
    <?php if (isset($_SESSION['cart'])) :?>
		<a class="btn btn-primary text-center" href="<?php echo ROOT_PATH;?>books/employeeCart">Cart</a>
		<?php endif;?>
    
</div>
