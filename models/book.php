<?php
class BookModel extends Model{
	public function Index(){
		$this->query('SELECT * FROM Book ORDER BY authors');
		$rows = $this->resultSet();
		return $rows;
	}
	
	public function addBook() {
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if($post['submit']){
            if($post['isbn'] == '' || $post['title'] == '' || $post['edition'] == '' || $post['price'] == '' || $post['available_quantity'] == '' || $post['author'] == ''){
                Messages::setMsg('Please Fill In All Fields', 'error');
                return;
            }
            // Insert into MySQL
            $this->query('INSERT INTO Book (isbn, title, edition, price, quantity_on_hand, authors, publisher_id) VALUES(:isbn, :title, :edition, :price, :available_quantity, :authors, :publisher_id)');
            $this->bind(':isbn', $post['isbn']);
            $this->bind(':title', $post['title']);
            $this->bind(':edition', $post['edition']);
            $this->bind(':price', $post['price']);
            $this->bind(':available_quantity', $post['available_quantity']);
            $this->bind(':publisher_id', $post['publisher_id']);
            $this->bind(':authors', $post['author']);
            $this->execute();
            // Verify
            if($this->lastInsertId()){
                // Redirect
                header('Location: '.ROOT_URL.'books/index');
            }
        }
        return;
    }

    public function viewCart(){
	    return;
    }

    public function finalizeOrder()
    {
        if (!empty($_SESSION["cart"])) {
            $employee_id = $_SESSION['user_data']['id'];
            $this->query('INSERT INTO EmployeeOrders (employee_id, is_received) VALUES (:employee, :received)');
            $this->bind(':employee', $employee_id);
            $this->bind(':received', 0);
            $this->execute();
            $lastInputId = $this->lastInsertId();
            
            foreach ($_SESSION["cart"] as $key => $value) {

                $this->query('INSERT INTO EmployeeOrdersDetails (book_isbn,book_quantity, employeeOrder_id) VALUES (:book_isbn,:book_quantity, :employeeOrder_id)');
                $this->bind(':book_isbn', $value['product_id']);
                $this->bind(':book_quantity', 1);
                $this->bind(':employeeOrder_id', $lastInputId);
                $this->execute();
            }
            unset($_SESSION['cart']);
        }
        header('Location: ' . ROOT_URL . 'books/adminCatalog');
    }

    public function finalizeCart()
    {
        if (!empty($_SESSION["cart"])) {
            $customer_id = $_SESSION['user_data']['id'];
            $datetime = date_create()->format('Y-m-d H:i:s');

            $this->query('INSERT INTO CustomerOrder (date_created ,customer_id) VALUES (:date_created, :customer_id)');
            $this->bind(':date_created', $datetime);
            $this->bind(':customer_id', $customer_id);
            $this->execute();
            $lastInputId = $this->lastInsertId();

            $this->query('INSERT INTO Purchases (created_at ,customer_id) VALUES (:date_created, :customer_id)');
            $this->bind(':date_created', $datetime);
            $this->bind(':customer_id', $customer_id);
            $this->execute();
            $lastpurchase = $this->lastInsertId();

            foreach ($_SESSION["cart"] as $key => $value) {

                $this->query('INSERT INTO PurchaseDetails (purchase_id, book_isbn, book_price , quantity, to_be_ordered) VALUES (:purchase_id, :book_isbn, :book_price, :quantity, :to_be_ordered)');
                $this->bind(':purchase_id', $lastpurchase);
                $this->bind(':book_isbn', $value['product_id']);
                $this->bind(':book_price', $value['product_price']);
                $this->bind(':quantity', 1);
                if ($value['quantity_available'] <= 1) {
                    $this->bind(':to_be_ordered', 1);
                }else {
                    $this->bind(':to_be_ordered', 0);
                }
                $this->execute();
                
                $this->query('UPDATE Book SET quantity_on_hand = :quantity_available, year_to_date_quantity_sold = :ytd WHERE isbn = :isbn');
                $this->bind(':quantity_available', $value['quantity_available']-1);
                $this->bind(':ytd', $value['ytd']+1);
                $this->bind(':isbn', $value['product_id']);
                $this->execute();
                
                
                $this->query('INSERT INTO CustomerOrderDetails (book_isbn, book_quantity, order_id) VALUES (:book_isbn, :book_quantity, :order_id)');
                $this->bind(':book_isbn', $value['product_id']);
                $this->bind(':book_quantity', 1);
                $this->bind(':order_id', $lastInputId);
                $this->execute();
                
                $publisher_id=$value['publisher_id'];

                $this->query('UPDATE CustomerOrder SET publisher_id = :publisher_id WHERE id = :id');
                $this->bind(':id', $lastInputId);
                $this->bind(':publisher_id', $publisher_id);
                $this->execute();
            }
            unset($_SESSION['cart']);
        }
        header('Location: ' . ROOT_URL . 'books/userCatalog');
    }
    
    
}
