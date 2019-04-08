<?php
class Users extends Controller{
	protected function register(){
		$viewmodel = new UserModel();
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if ($post['submit']){
            echo $post['type'];
            if ($post['type'] == 'c') {
                $this->returnView($viewmodel->registerCustomer(), true);
            }
            if ($post['type'] == 'e') {
                $this->returnView($viewmodel->registerEmployee(), true);
            }
        }
        $this->returnView($this, true);
    }

	protected function login(){
		$viewmodel = new UserModel();
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		if ($post['submit']){
            if ($post['type'] == 'c') {
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
    
    protected function purchaseDetails(){
	    $viewmodel = new UserModel();
	    $this->returnView($viewmodel->purchaseDetails(), true);
    }
    
    protected function listUsers(){
	    $viewmodel = new UserModel();
	    $this->returnView($viewmodel->listUsers(), true);
    }
    
    protected function listPublishers() {
        $viewmodel = new UserModel();
        $this->returnView($viewmodel->listPublishers(), true);
    }
    
    protected function viewBranches() {
        $viewmodel = new UserModel();
        $this->returnView($viewmodel->listBranches(), true);
    }
    
    protected function showEmployeeOrders(){
        $viewmodel = new UserModel();
        $this->returnView($viewmodel->showEmployeeOrders(), true);
    }
    
    protected function orderDetails(){
        $viewmodel = new UserModel();
        $this->returnView($viewmodel->orderDetails(), true);
    }
    
    protected function showBackOrders() {
        if(!($_SESSION['user_data']['type']==='e')){
            if (isset($_POST["add"])){
                if (isset($_SESSION["cart"])){
                    $item_array_id = array_column($_SESSION["cart"],"isbn");
                    if (!in_array($_GET["isbn"],$item_array_id)){
                        $count = count($_SESSION["cart"]);
                        $item_array = array(
                            'isbn' => $_GET["isbn"],
                        );
                        $_SESSION["cart"][$count] = $item_array;
                        header('Location: '.ROOT_URL.'books/adminCatalog');
                    }else{
                        echo '<script>alert("Product is already Added to Cart")</script>';
                        header('Location: '.ROOT_URL.'books/adminCatalog');
                    }
                }else{
                    $item_array = array(
                        'isbn' => $_GET["isbn"],
                    );
                    $_SESSION["cart"][0] = $item_array;
                }
            }
        }

        $viewmodel = new BookModel();
        $this->returnView($viewmodel->Index(), true);
    }
    
    protected function setReceived(){
	    $viewmodel = new UserModel();
	    $this->returnView($viewmodel->updateReceived(), true);
	    
    }
    
}
