<?php
class Users extends Controller{
	protected function register(){
		$viewmodel = new UserModel();
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if ($post['submit']){
            if ($post['type'] == 'customer') {
                $this->returnView($viewmodel->registerCustomer(), true);
            }
            else {
                $this->returnView($viewmodel->registerEmployee(), true);
            }
        }
        $this->returnView($viewmodel->registerEmployee(), true);
    }

	protected function login(){
		$viewmodel = new UserModel();
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		if ($post['submit']){
            if ($post['type'] == 'customer') {
                $this->returnView($viewmodel->signinCustomer(), true);
            }
            else {
                $this->returnView($viewmodel->signinEmployee(), true);
            }
        }
        $this->returnView($viewmodel->signinEmployee(), true);
	}

	protected function logout(){
		unset($_SESSION['is_logged_in']);
		unset($_SESSION['user_data']);
		unset($_SESSION['cart']);
		session_destroy();
		// Redirect
		header('Location: '.ROOT_URL);
	}
	
	protected function viewOrders() {
	    $viewmodel = new UserModel();
	    $this->returnView($viewmodel->fetchUserOrders(), true);
    }
}
