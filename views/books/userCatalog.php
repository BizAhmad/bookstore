<div>
    <?php if(isset($_SESSION['is_logged_in'])) : ?>
    <?php endif; ?>
    <?php foreach($viewmodel as $item) :?>
			<div class="well">
				<h3><?php echo $item['title']; ?></h3>
				<label> ISBN: <?php echo $item['isbn']; ?></label>
				<br>
				<label> Quantity: <?php echo $item['edition']; ?> </label>
				<br />
				<form 
				<input class="btn btn-primary" name="submit" type="submit" value="Submit" />
				<a class="btn btn-primary text-center" <?php
        if (isset($_SESSION["cart"])){
            $item_array_id = array_column((array)$_SESSION["cart"],"product_id");
            if (!in_array($item["isbn"],$item_array_id)){
                $count = count($_SESSION["cart"]);
                $item_array = array(
                    'product_id' => $item["isbn"],
                    'item_name' => $item["title"],
                    'product_price' => $item["price"],
                );
                $_SESSION["cart"][$count] =(array) $item_array;
            }
        }else{
            $item_array = array(
                'product_id' => $item["isbn"],
                'item_name' => $item["title"],
                'product_price' => $item["price"],
            );
            $_SESSION["cart"][0] = $item_array;
        }
        ?>> Add To Cart</a>
			</div>
    <?php endforeach; ?>
</div>
