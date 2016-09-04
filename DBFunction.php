<?php
session_start();
class DBFunction {
	// query to execute
	protected $query = null;
	protected $connection = null;
	private $results = null;
	// transaction check
	private $transaction = false;

	public function __construct() {
        try
        {
            $this->connection = new PDO("mysql:host=localhost;dbname=onlineshop","root","");
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e)
        {
            echo "Connection failed: " . $e->getMessage();
        }
    	
    }

	public function __destruct() {
		$this->connection = null;
    }
    
    public function get($table,$order_by)
    {
        try {
            $pdo_query = "SELECT * FROM ".$table." ORDER BY ".$order_by;
            $stmt = $this->connection->prepare($pdo_query);
            $stmt->execute();
            // set the resulting array to associative
            $result = $stmt->setFetchMode(PDO::FETCH_OBJ);
            return $this->results[] = $stmt->fetchAll();
            
        }
        catch(PDOException $e)
        {
            return $pdo_query."<br>".$e->getMessage();
        }
    }
    public function get_where($table,$id)
    {
        if (!is_numeric($id)) {
            die('Non-numeric variable!');
        }

        try {
            $pdo_query = "SELECT * FROM ".$table." Where id = ".$id;
            $stmt = $this->connection->prepare($pdo_query);
            $stmt->execute();
            // set the resulting array to associative
            $result = $stmt->setFetchMode(PDO::FETCH_OBJ);
            return $this->results[] = $stmt->fetchAll();
            
        }
        catch(PDOException $e)
        {
            return $pdo_query."<br>".$e->getMessage();
        }
    }
    public function get_with_limit($table , $limit, $offset, $order_by) 
    {
        if ((!is_numeric($limit)) || (!is_numeric($offset))) {
            die('Non-numeric variable!');
        }
        try {
            $pdo_query = "SELECT * FROM ".$table." order by ".$order_by." limit ".$offset." , ".$limit ;
            $stmt = $this->connection->prepare($pdo_query);
            $stmt->execute();
            // set the resulting array to associative
            $result = $stmt->setFetchMode(PDO::FETCH_OBJ);
            return $this->results[] = $stmt->fetchAll();
            
        }
        catch(PDOException $e)
        {
            return $pdo_query."<br>".$e->getMessage();
        }
        
    }
    public function get_where_custom_single($table , $col, $value) 
    {
        try {
            $pdo_query = "SELECT * FROM ".$table." Where ".$col." = '".$value."'" ;
            $stmt = $this->connection->prepare($pdo_query);
            $stmt->execute();
            // set the resulting array to associative
            $result = $stmt->setFetchMode(PDO::FETCH_OBJ);
            return $this->results[] = $stmt->fetchAll();
            
        }
        catch(PDOException $e)
        {
            return $pdo_query."<br>".$e->getMessage();
        }
    }
    public function get_where_custom_multiple($table,$fields)
    {
        try {
            $sql = "SELECT * FROM $table WHERE ";
            $field_count = 0;
            foreach($fields as $key=>$value){
                if($field_count==0){
                    $sql.= "`".$key."`='".$value."'";
                }
                else
                {
                    $sql.= " && `".$key."`='".$value."'";
                }
                $field_count++;
            }
            
            $sql;
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            // set the resulting array to associative
            $result = $stmt->setFetchMode(PDO::FETCH_OBJ);
            return $this->results[] = $stmt->fetchAll();
            
        }
        catch(PDOException $e)
        {
            echo $sql . "<br>" . $e->getMessage();
        }
    }
    public function _insert($table, $data){
        try {
            $sql = "INSERT INTO $table (";
            $key_count = 0;
            foreach($data as $key=>$value){
                if($key_count==0){
                    $sql.= "`".$key."`";
                }
                else
                {
                    $sql.= ",`".$key."`";
                }
                $key_count++;
            }
            $sql.=") VALUES (";
            $val_count = 0;
            foreach($data as $key=>$value){
                if($val_count==0){
                    $sql.= "'".$value."'";
                }
                else
                {
                    $sql.= ",'".$value."'";
                }
                $val_count++;
            }
            $sql .= ")";
            //Sql Query Update Check to Uncomment $Sql
                //echo $sql;
            // Prepare statement
            $stmt = $this->connection->prepare($sql);

            // execute the query
            if($stmt->execute())
            {
                // echo a message to say the UPDATE succeeded
                return $stmt->rowCount();
            }
            else
            {
                return false;   
            }
        }
        catch(PDOException $e)
        {
            return $sql."<br>".$e->getMessage();
        }
    }
    
    public function _update($table, $data, $update_id)
    {
        try 
        {
            if(!is_numeric($update_id)){
                return false;
            }
            $sql = "UPDATE $table SET ";
            $data_count = 0;
            foreach($data as $key=>$value){
                if($data_count==0){
                    $sql.= "`".$key."`='".$value."'";
                }
                else
                {
                    $sql.= ", `".$key."`='".$value."'";
                }
                $data_count++;
            }
            $sql.=" WHERE id =$update_id";
            
            //Sql Query Update Check to Uncomment $Sql
                //echo $sql;
            // Prepare statement
            $stmt = $this->connection->prepare($sql);

            // execute the query
            if($stmt->execute())
            {
                // echo a message to say the UPDATE succeeded
                return $stmt->rowCount();
            }
            else
            {
                return false;   
            }
        }
        catch(PDOException $e)
        {
            return $sql."<br>".$e->getMessage();
        }
        
    }
    
    public function _update_by_fields($table, $data, $fields)
    {
        try 
        {
            $sql = "UPDATE $table SET ";
            $data_count = 0;
            foreach($data as $key=>$value){
                if($data_count==0){
                    $sql.= "`".$key."` = '".$value." '";
                }
                else
                {
                    $sql.= ", `".$key."` = '".$value."' ";
                }
                $data_count++;
            }
            $sql.=" WHERE ";
            $fields_count = 0;
            foreach($fields as $key=>$value){
                if($fields_count==0){
                   $sql.= "`".$key."` = '".$value."'";
                }
                else
                {
                    $sql.= "and `".$key."` = '".$value."'";
                }
                $fields_count++;
            }
            //Sql Query Update Check to Uncomment $Sql
            //$sql;
            // Prepare statement
            $stmt = $this->connection->prepare($sql);
            if($stmt->execute())
            {
                // echo a message to say the UPDATE succeeded
                return $stmt->rowCount();
            }
            else
            {
                return false;   
            }
        }
        catch(PDOException $e)
        {
            return $sql . "<br>" . $e->getMessage();
        }
        
    }
    public function _delete_where($table,$field_with_Condition,$value){
        try 
        {
            // sql to delete a record
            $sql = "DELETE FROM $table WHERE $field_with_Condition"."$value";
             
            // use exec() because no results are returned
            if($this->connection->exec($sql)){
                return true;
            }
            else
            {
                 return false;
            }
         
        }
        catch(PDOException $e)
        {
            return $sql."<br>".$e->getMessage();
        }
    }
    public function _delete($table,$update_id)
    {
        
        try 
        {
            if(!is_numeric($update_id)){
                return false;
            }
            // sql to delete a record
            $sql = "DELETE FROM $table WHERE id=$update_id";

            // use exec() because no results are returned
            if($this->connection->exec($sql)){
                return true;
            }
            else
            {
                 return false;
            }
        }
        catch(PDOException $e)
        {
            return $sql."<br>".$e->getMessage();
        }
    }
    
    public function count_where($table,$col, $value) 
    {
        try {
            $pdo_query = "SELECT * FROM ".$table." Where ".$col." = '".$value."'" ;
            $stmt = $this->connection->prepare($pdo_query);
            if($stmt->execute())
            {
                return $stmt->rowCount();
            }
            else
            {
                return false;   
            }
            
        }
        catch(PDOException $e)
        {
            return $pdo_query."<br>".$e->getMessage();
        }
    }
    
    public function get_max($table) 
    {
        try {
            $pdo_query = "SELECT * FROM ".$table." order by id desc limit 1";
            $stmt = $this->connection->prepare($pdo_query);
            if($stmt->execute())
            {
                $result = $stmt->setFetchMode(PDO::FETCH_OBJ);
                $this->results[] = $stmt->fetch();
                foreach($this->results as $row)
                {
                    $max_id = $row->id;
                }
                return $max_id;
            }
            else
            {
                return false;   
            }
            
        }
        catch(PDOException $e)
        {
            return $pdo_query."<br>".$e->getMessage();
        }
    }
    public function _custom_query($mysql_query) 
    {
        try 
        {
            $pdo_query = $mysql_query;
            $stmt = $this->connection->prepare($pdo_query);
            if($stmt->execute())
            {
                $result = $stmt->setFetchMode(PDO::FETCH_OBJ);
                return $this->results[] = $stmt->fetchAll();
            }
            else
            {
                return false;   
            }
            
        }
        catch(PDOException $e)
        {
            return $pdo_query."<br>".$e->getMessage();
        }
    }
}