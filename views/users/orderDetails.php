<div>
    <?php if(isset($_SESSION['is_logged_in'])) : ?>
    <?php endif; ?>
    <?php foreach($viewmodel as $item) :
        ?>
        <div class="well">
            <label> Book ISBN: <?php echo $item['book_isbn']; ?></label><br>
            <label> Book Quantity: <?php echo $item['book_quantity']; ?></label>
            <br>
        </div>
    <?php endforeach; ?>
</div>
