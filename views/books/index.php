<div>
	<?php if(isset($_SESSION['is_logged_in'])) : ?>
	<?php endif; ?>
	<?php foreach($viewmodel as $item) : ?>
		<div class="well">
			<h3><?php echo $item['title']; ?></h3>
			<label> ISBN: <?php echo $item['isbn']; ?></label>
			<br>
			<label> Quantity: <?php echo $item['edition']; ?> </label>
			<br />
			<a class="btn btn-default" href="<?php echo $item['link']; ?>" target="_blank">Go To Website</a>
		</div>
	<?php endforeach; ?>
</div>
