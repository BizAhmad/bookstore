<div>
    <?php if(isset($_SESSION['is_logged_in'])) : ?>
    <?php endif; ?>
    <?php foreach($viewmodel as $item) :

        if(isset($_GET['add']) && $_GET['add'] == $item["isbn"]){
            if (isset($_SESSION["cart"])){
                $item_array_id = array_column((array)$_SESSION["cart"],"product_id");
                if (!in_array($item["isbn"],$item_array_id)){
                    $count = count($_SESSION["cart"]);
                    $item_array = array(
                        'product_id' => $item["isbn"],
                        'item_name' => $item["title"],
                        'product_price' => $item["price"],
                        'available_quantity' => $item["quantity_on_hand"],
                        'ytd' => $item['year_to_date_quantity_sold'],
                    );
                    $_SESSION["cart"][$count] =(array) $item_array;
                }
            }else{
                $item_array = array(
                    'product_id' => $item["isbn"],
                    'item_name' => $item["title"],
                    'product_price' => $item["price"],
                    'available_quantity' => $item["quantity_on_hand"],
                    'ytd' => $item['year_to_date_quantity_sold'],
                );
                $_SESSION["cart"][0] = $item_array;
            }
        }
        ?>
			<div class="well">
				<h3><?php echo $item['title']; ?></h3>
				<?php if ($item['quantity_on_hand'] != 0) :?>
				<label> ISBN: <?php echo $item['isbn']; ?></label>
				<br>
				<label> Quantity: <?php echo $item['quantity_on_hand']; ?> </label>
				<br />
				<a class="btn btn-primary text-center" href="?add=<?= $item['isbn'] ?>"> Add To Order</a>
				<?php endif;?>
			</div>
    <?php endforeach; ?>
</div>
