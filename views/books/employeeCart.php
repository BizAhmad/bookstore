<div style="clear: both"></div>
<h3 class="title2">Orders List Details</h3>
<div class="well">
    <table class="table table-bordered">
        <tr>
            <th width="30%">Product Name</th>
            <th width="10%">Quantity</th>
            <th width="13%">Price Details</th>
            <th width="10%">Total Price</th>
            <th width="17%">Remove Item</th>
        </tr>

        <?php
        if(!empty($_SESSION["cart"])){
            $total = 0;
            foreach ($_SESSION["cart"] as $key => $value) {
                ?>
                <tr>
                    <td><?php echo $value["product_id"]; ?></td>
                    <td><?php echo $value["item_name"]; ?></td>
                    <td>$ <?php echo $value["product_price"]; ?></td>
                    <td>$ <?php echo number_format(1 * $value["product_price"], 2); ?></td>
                    <td><a class="btn btn-primary text-center" <?php
                        foreach ($_SESSION["cart"] as $k => $v){
															unset($_SESSION["cart"][$k]);
                        }
												?>"><span class="btn btn-danger">Remove Item</span></a></td>
                </tr>
                <?php $total = $total + (1 * $value["product_price"]);
            }
            ?>
            <tr>
                <td colspan="3" align="right">Total</td>
                <th align="right">$ <?php echo number_format($total, 2); ?></th>
                <td></td>
            </tr>
            <?php
        }
        ?>
    </table>
</div>
