<div>
    <?php if(isset($_SESSION['is_logged_in'])) : ?>
    <?php endif; ?>
    <?php foreach($viewmodel as $item) :
        ?>
        <div class="well">
            <label> Book ISBN: <?php echo $item['book_isbn']; ?></label><br>
            <label> Book Price: <?php echo $item['book_price']; ?></label><br>
            <label> Book Quantity: <?php echo $item['quantity']; ?></label>
					<br>
					<?php if ($_SESSION['user_data']['type'] == 'e') :?>
						<label> To Be Ordered : <?php
								if ($item['to_be_ordered'] == '0') {
									echo "false";
								}else {
									echo "true";
								}
								?></label>
					<?php endif; ?>
            <br>
        </div>
    <?php endforeach; ?>
</div>
