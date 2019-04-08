<?php
class BookModel extends Model{
	public function Index(){
		$this->query('SELECT * FROM Book ORDER BY author');
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
            $this->query('INSERT INTO Book (isbn, title, edition, price, available_quantity, author) VALUES(:isbn, :title, :edition, :price, :available_quantity, :author)');
            $this->bind(':isbn', $post['isbn']);
            $this->bind(':title', $post['title']);
            $this->bind(':edition', $post['edition']);
            $this->bind(':price', $post['price']);
            $this->bind(':available_quantity', $post['available_quantity']);
            $this->bind(':author', $post['author']);
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
}
