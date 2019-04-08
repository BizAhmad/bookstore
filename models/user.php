<?php
class UserModel extends Model{
	public function registerEmployee(){
		// Sanitize POST
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

		$password = md5($post['password']);

		if($post['submit']){
			if($post['username'] == '' || $post['password'] == ''){
				Messages::setMsg('Please Fill In All Fields', 'error');
				return;
			}

			// Insert into MySQL
			$this->query('INSERT INTO Employee (username, password) VALUES(:username, :password)');
			$this->bind(':username', $post['username']);
			$this->bind(':password', $password);
			$this->execute();
			// Verify
			if($this->lastInsertId()){
				// Redirect
				header('Location: '.ROOT_URL.'users/login');
			}
		}
		return;
	}

    public function registerCustomer(){
        // Sanitize POST
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $password = md5($post['password']);

        if($post['submit']){
            if($post['username'] == '' || $post['password'] == ''){
                Messages::setMsg('Please Fill In All Fields', 'error');
                return;
            }

            // Insert into MySQL
            $this->query('INSERT INTO Customer (username, password) VALUES(:username, :password)');
            $this->bind(':username', $post['username']);
            $this->bind(':password', $password);
            $this->execute();
            // Verify
            if($this->lastInsertId()){
                header('Location: '.ROOT_URL.'users/login');
            }
        }
        return;
    }

	public function signinEmployee(){
		// Sanitize POST
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

		$password = md5($post['password']);

		if($post['submit']){
			// Compare Login
			$this->query('SELECT * FROM Employee WHERE username = :username AND password = :password');
			$this->bind(':username', $post['username']);
			$this->bind(':password', $password);
			$row = $this->single();

			if($row){
				$_SESSION['is_logged_in'] = true;
				$_SESSION['user_data'] = array(
					"id"	=> $row['id'],
					"username"	=> $row['username'],
                    "type" => "e",
				);
				header('Location: '.ROOT_URL.'home/employeeHome');
			} else {
				Messages::setMsg('Incorrect Login', 'error');
			}
		}
		return;
	}

    public function signinCustomer(){
        // Sanitize POST
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $password = md5($post['password']);

        if($post['submit']){
            // Compare Login
            $this->query('SELECT * FROM Customer WHERE username = :username AND password = :password');
            $this->bind(':username', $post['username']);
            $this->bind(':password', $password);

            $row = $this->single();

            if($row){
                $_SESSION['is_logged_in'] = true;
                $_SESSION['user_data'] = array(
                    "id"	=> $row['id'],
                    "username"	=> $row['username'],
                    "type" => "c",
                );
                header('Location: '.ROOT_URL.'home/customerHome');
            } else {
                Messages::setMsg('Incorrect Login', 'error');
            }
        }
        return;
    }
    
    public function fetchUserOrders(){
	    
	    if (isset($_GET['id'])){
            $customer_id = $_GET['id'];
            $this->query('SELECT * FROM Purchases WHERE customer_id = :customer_id');
            $this->bind(':customer_id', $customer_id);
            return $this->resultSet();
        }
	    else{
            $this->query('SELECT * FROM Purchases WHERE customer_id = :customer_id');
            $this->bind(':customer_id', $_SESSION['user_data']['id']);
            return $this->resultSet();
        }
        
    }
    
    public function purchaseDetails() {
	    $purchase_id = $_GET['id'];
	    $this->query('SELECT * FROM PurchaseDetails WHERE purchase_id = :purchase_id');
	    $this->bind(':purchase_id', $purchase_id);
	    
	    return $this->resultSet();
    }
    
    public function listUsers() {
        $this->query('SELECT * FROM Customer');
        return $this->resultSet();
    }
    
    public function listPublishers() {
	    $this->query('SELECT * FROM Publisher');
	    return $this->resultSet();
    }
    
    public function listBranches() {
	    $publisher_id = $_GET['id'];
        $this->query('SELECT * FROM Branches WHERE publisher_id = :publisher_id');
        $this->bind(':publisher_id', $publisher_id);
        return $this->resultSet();
    }
    
    public function showEmployeeOrders(){
	    $this->query('SELECT * FROM EmployeeOrders WHERE employee_id = :employee_id');
	    $this->bind(':employee_id', $_SESSION['user_data']['id']);
	    return $this->resultSet();
    }
    
    public function orderDetails(){
        $employeeOrder_id = $_GET['employeeOrders_id'];
        $this->query('SELECT * FROM EmployeeOrdersDetails WHERE employeeOrder_id= :employeeOrder_id');
        $this->bind(':employeeOrder_id', $employeeOrder_id);
        return $this->resultSet();
    }
    
    public function updateReceived() {
	    $id = $_GET['id'];
	    $this->query('UPDATE EmployeeOrders SET is_received = :isReceived WHERE id = :id');
	    $this->bind(':isReceived', 1);
	    $this->bind(':id', $id);
	    $this->execute();
        header('Location: '.ROOT_URL.'users/showEmployeeOrders');
	}

}
