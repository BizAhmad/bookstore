<div>
    <?php if(isset($_SESSION['is_logged_in'])) : ?>
    <?php endif; ?>
<?php foreach($viewmodel as $item) :
    ?>
    <div class="well">
        <h3>Created At: <?php echo $item['created_at']; ?></h3>
        <br>
        <a class="btn btn-primary text-center" href="purchaseDetails?id=<?echo $_GET['id'] = $item['id'] ?>"> view details</a>
    </div>
<?php endforeach; ?>
</div>
