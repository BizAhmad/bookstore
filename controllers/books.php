<?php
class Books extends Controller{
	protected function adminCatalog(){
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
	
    protected function userCatalog(){
        $viewmodel = new BookModel();
        $this->returnView($viewmodel->Index(), true);
    }

    public function addBook() {
        $viewmodel = new BookModel();
        if(!isset($_SESSION['is_logged_in'])){
            header('Location: '.ROOT_URL.'home');
        }
        if(!($_SESSION['user_data']['type']==='e')){
            header('Location: '.ROOT_URL.'home');
        }
        $this->returnView($viewmodel->addBook(), true);
    }
    
    protected function employeeCart() {
	    $viewModel = new BookModel();
	    $this->returnView($viewModel->viewCart(), true);
    }
    
    protected function customerCart(){
	    $viewmodel = new BookModel();
	    $this->returnView($viewmodel->viewCart(), true);
    }
    
    protected function completeOrder(){
	    $viewmodel = new BookModel();
	    $this->returnView($viewmodel-> finalizeOrder(), true);
    }

    protected function completeCart(){
        $viewmodel = new BookModel();
        $this->returnView($viewmodel-> finalizeCart(), true);
    }

}
