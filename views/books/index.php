<div>
	<?php if(isset($_SESSION['is_logged_in'])) : ?>
	<?php endif; ?>
	<?php foreach($viewmodel as $item) : ?>
		<div class="well">
			<h3><?php echo $item['isbn']; ?></h3>
			<small><?php echo $item['title']; ?></small>
			<hr />
			<p><?php echo $item['edition']; ?></p>
			<br />
			<a class="btn btn-default" href="<?php echo $item['link']; ?>" target="_blank">Go To Website</a>
		</div>
	<?php endforeach; ?>
</div>
