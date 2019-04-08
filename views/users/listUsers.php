<div>
    <?php if(isset($_SESSION['is_logged_in'])) : ?>
    <?php endif; ?>
<?php foreach($viewmodel as $item) :

    ?>
    <div class="well">
        <h3><?php echo $item['name']; ?></h3>
        <label> Phone Number: <?php echo $item['phone_number']; ?></label>
        <br>
        <label> email: <?php echo $item['email']; ?> </label>
        <br />
        <label> username: <?php echo $item['username']; ?> </label>
        <br />
        <a class="btn btn-primary text-center" href="viewOrders?id=<?echo $_GET['id'] = $item['id'] ?>"> Order Details</a>
    </div>
<?php endforeach; ?>
</div>
