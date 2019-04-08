<?php
class Home extends Controller{
	protected function Index(){
		$viewmodel = new HomeModel();
		$this->returnView($viewmodel->Index(), true);
	}
	
	protected function customerHome() {
	    $viewmodel = new HomeModel();
	    $this->returnView($viewmodel->customerHome(), true);
    }
    
    protected function employeeHome(){
        $viewmodel = new HomeModel();
        $this->returnView($viewmodel->employeeHome(), true);
    }

}
