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
                // Redirect
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
                    "full_name"	=> $row['full_name'],
                    "type" => "c"
                );
                header('Location: '.ROOT_URL.'books');
            } else {
                Messages::setMsg('Incorrect Login', 'error');
            }
        }
        return;
    }
    
    public function fetchUserOrders(){
	    return;
    }
}
