<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Add Book!</h3>
    </div>
    <div class="panel-body">
        <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label>ISBN</label>
                <input type="text" name="isbn" class="form-control" />
            </div>
            <div class="form-group">
                <label>title</label>
                <input type="text" name="title" class="form-control" />
            </div>
            <div class="form-group">
                <label>edition</label>
                <input type="text" name="edition" class="form-control" />
            </div>
            <div class="form-group">
                <label>price</label>
                <input type="text" name="price" class="form-control" />
            </div>
            <div class="form-group">
                <label>quantity</label>
                <input type="text" name="available_quantity" class="form-control" />
            </div>
            <div class="form-group">
                <label>author</label>
                <input type="text" name="author" class="form-control" />
            </div>
            <input class="btn btn-primary" name="submit" type="submit" value="Submit" />
            <a class="btn btn-danger" href="<?php echo ROOT_PATH; ?>shares">Cancel</a>
        </form>
    </div>
</div>
