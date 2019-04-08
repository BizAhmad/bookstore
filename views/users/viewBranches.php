<div>
    <?php if(isset($_SESSION['is_logged_in'])) : ?>
    <?php endif; ?>
    <?php foreach($viewmodel as $item) :

        ?>
        <div class="well">
            <h3><?php echo $item['branch_name']; ?></h3>
            <label> Manager: <?php echo $item['manager_name']; ?></label>
            <br>
            <label> Phone Number: <?php echo $item['phone_number']; ?> </label>
            <br />
            <label> email: <?php echo $item['email']; ?> </label>
            <br />
        </div>
    <?php endforeach; ?>
</div>
