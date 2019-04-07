<?php
class ShareModel extends Model{
	public function Index(){
		$this->query('SELECT * FROM Book ORDER BY author');
		$rows = $this->resultSet();
		return $rows;
	}
}
