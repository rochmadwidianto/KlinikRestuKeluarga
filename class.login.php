<!-- 
================= doc ====================
 filename     : class.login.php
 @package     : dashboard
 scope        : PUBLIC
 @Analysts    : Rochmad Widianto
 @Author      : Rochmad Widianto <widiantorochmad@gmail.com>
 @Created     : 2017-11-02
 @Modified    : 2017-11-02
 @copyright   : Copyright (c) 2017
================= doc ====================
-->

<?php
	 
	class Login {
	    private $db; //database conection link
	     
	    public function __construct($database) {
	        $this->db = $database;
	    }
	    public function loginAdmin($username, $password) {
		    $result = $this->db->prepare("SELECT * FROM users WHERE username= ? AND password= ? ");
		    $result->bindParam(1, $username);
		    $result->bindParam(2, $password);
		    $result->execute();
		    $rows = $result->fetch();
		    return $rows;
		}
	}
?>