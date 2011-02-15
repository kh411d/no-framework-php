<?php
Class db
{
 public $dbh;
 public $num_rows;
 
 
 public function __construct()
 {
  if(!defined('DB_ENGINE') || !defined('DB_HOST') || !defined('DB_NAME') || !defined('DB_USER') )
   die('undefined db credential');

	try {
		$this->dbh = new PDO(DB_ENGINE.':'.'dbname='.DB_NAME.';host='.DB_HOST, DB_USER, DB_PASSWORD);
		$this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
		echo 'Connection failed: ' . $e->getMessage();
	}
 }
 
 public function query($sql,$params = NULL)
 {
	try 
	{
	$sth = $this->dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
	$sth->execute($params);
	return $sth->fetchAll(PDO::FETCH_OBJ);
	} 
	catch (PDOException $e)
	{
	 echo $e->getMessage()."-".$sql;
	 return false;
	}
 }
 
 public function get_row($sql,$params = NULL)
 {
	try 
	{
	$sth = $this->dbh->prepare($sql);
	$sth->execute($params);
	return $sth->fetch(PDO::FETCH_OBJ);
	} 
	catch (PDOException $e)
	{
	 echo $e->getMessage()."-".$sql;
	 return false;
	}
 }
 
 function get_var($sql,$params = NULL)
 {
	try 
	{
	$sth = $this->dbh->prepare($sql);
	$sth->execute($params);
	return $sth->fetchcolumn();
	} 
	catch (PDOException $e)
	{
	 echo $e->getMessage()."-".$sql;
	 return false;
	}
 }

 
 public function insert($table, $data) {
		$fields = array_keys($data);
		$param_fields = array();
		foreach ( $fields as $field ) {
			$param_fields[] = ":".addslashes($field);
		}
		//echo $sql;
		$sql = "INSERT INTO `$table` (`" . implode( '`,`', $fields ) . "`) VALUES (" . implode( ",", $param_fields ) . ")";

		try 
		{
		 $sth = $this->dbh->prepare($sql);
		 $sth->execute($data);
		 return $this->dbh->lastInsertId();
		} 
		catch (PDOException $e)
		{
		 echo $e->getMessage()."-".$sql;
		 return false;
		}
	}


 public	function update($table, $data, $where) {
		if ( !is_array( $where ) )
			return false;

		$bits = $wheres = array();
		foreach ( (array) array_keys($data) as $field ) {
				$form = ":".addslashes($field);
			$bits[] = "`$field` = {$form}";
		}

		foreach ( (array) array_keys($where) as $field ) {
				$form = ":".addslashes($field);
			$wheres[] = "`$field` = {$form}";
		}

		$sql = "UPDATE `$table` SET " . implode( ', ', $bits ) . ' WHERE ' . implode( ' AND ', $wheres );
		
		try 
		{
		 $sth = $this->dbh->prepare($sql);
		 $sth->execute($data);
		 return $this->dbh->rowCount();
		} 
		catch (PDOException $e)
		{
		 echo $e->getMessage()."-".$sql;
		 return false;
		}
	}
 
 public function start_transact()
 {
 $this->dbh->beginTransaction();
 }
 
 public function end_transact()
 {
  $this->dbh->commit();
 }
 
 public function rollback_transact()
 {
  $this->dbh->rollBack();
 }


}

