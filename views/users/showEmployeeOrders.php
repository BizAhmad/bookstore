<div>
    <?php if(isset($_SESSION['is_logged_in'])) : ?>
    <?php endif; ?>
    <?php foreach($viewmodel as $item) :
        ?>
        <div class="well">
            <h3>Received: <?php
                if ($item['is_received'] == 0) {
                    echo "no";
                }else {
                    echo "yes";
                }
                ?></h3>
            <br>
            <a class="btn btn-primary text-center" href="setReceived?id=<?echo $_GET['id'] = $item['id'] ?>"> mark as received</a>
					<a class="btn btn-primary text-center" href="orderDetails?employeeOrders_id=<?echo $_GET['id'] = $item['id'] ?>"> view details</a>
        </div>
    <?php endforeach; ?>
</div>
