<?php
	include_once 'session.php';
	include 'database.php';

	class user
	{
		private $db;
		function __construct()
		{
			$this->db= new database();
		}

		public function getRegistration($data){

			$name = $data['name'];
			$username = $data['username'];
			$email = $data['email'];
			$email = $data['password'];
			$check_email= $this->emailCheck($email);

			if ($name == "" OR $username == "" OR $email == "" OR $password == "") {
				$sms = "<div class='alert alert-danger'><strong>ERROR!</strong> Field must not be empty</div>";
					return $sms;
				}

			if (strlen($username) < 3) {
				$sms = "<div class='alert alert-danger'><strong>ERROR!</strong> Name should have at least three alphabet..</div>";
				return $sms;
		
			}
			elseif(preg_match('/[^a-z0-9_-]+/i', $username)) {
				
				$sms = "<div class='alert alert-danger'><strong>ERROR!</strong> Use letter or number.. </div>";
				return $sms;
			}

			if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
				$sms = "<div class='alert alert-danger'><strong>ERROR!</strong> Use valid email..</div>";	
					return $sms;

				}

			if ($check_email == true) {
					$sms = "<div class='alert alert-danger'><strong>ERROR!</strong> This email alredy exist..</div>";
					return $sms;
				}	

				$password = md5($data['password']);
				$sql = "INSERT INTO users(name,username,email,password) VALUES(:name,:username,:email,:password)";
				$query = $this->db->pdo->prepare($sql);

				$query->bindValue(':name',$name);
				$query->bindValue(':username',$username);
				$query->bindValue(':email',$email);
				$query->bindValue(':password',$password);
				$result = $query->execute();

				if ($result) {
					$sms = "<div class='alert alert-success'><strong>CONGRATULATIONS!</strong> Registration successfully done..!</div>";
					return $sms;
				}else{
					$sms = "<div class='alert alert-danger'><strong>ERROR!</strong> Some problems with registration, Try again..</div>";
					return $sms;
				}
		}

		public function emailCheck($email)
		{

			$sql = "SELECT email FROM users WHERE email = :email";
			$query = $this->db->pdo->prepare($sql);
			$query->bindValue(':email',$email);
			$query->execute();

			if ($query->rowCount()>0) {
				return true;
			}else{
				return false;
			}
		}

		public function getloginuser($email, $password){

			$sql = "SELECT * FROM users WHERE email = :email AND password = :password LIMIT 1";
			$query = $this->db->pdo->prepare($sql);
			$query->bindValue(':email',$email);
			$query->bindValue(':password',$password);
			$query->execute();
			$result = $query->fetch(PDO::FETCH_OBJ);
			return $result;
		}

		public function getlogin($data){

			
			$email = $data['email'];
			$password = md5($data['password']);
			$check_email= $this->emailCheck($email);

			if ($email == "" OR $password == "") {
				$sms = "<div class='alert alert-danger'><strong>ERROR!</strong> Field must not be empty</div>";
					return $sms;
				}

			if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
				$sms = "<div class='alert alert-danger'><strong>ERROR!</strong> Use valid email..</div>";	
					return $sms;

				}

			if ($check_email == false) {
					$sms = "<div class='alert alert-danger'><strong>ERROR!</strong> You have to REGISTER first...</div>";
					return $sms;
			}	

			$result = $this->getloginuser($email, $password);

			if ($result) {
				session::init();
				session::set("login",true);
				session::set("id",$result->id);
				session::set("name",$result->name);
				session::set("username",$result->username);
				session::set("loginsms","<div class='alert alert-success'><strong>SUCCESS!</strong> SUCCESS.! You are logged in..</div>");
				header("Location: index.php");
			}
			else {

				$sms = "<div class='alert alert-danger'><strong>ERROR!</strong> Soory.! DATA did not found..</div>";
					return $sms;
			}
		}


		public function getuserdata(){
			$sql = "SELECT * FROM users ORDER BY id DESC";
			$query = $this->db->pdo->prepare($sql);
			$query->execute();
			$result = $query->fetchAll();
			return $result;
		}

		public function getuserbyid($id){
			$sql = "SELECT * FROM users WHERE id = :id LIMIT 1";
			$query = $this->db->pdo->prepare($sql);
			$query->bindValue(':id',$id);
			$query->execute();
			$result = $query->fetch(PDO::FETCH_OBJ);
			return $result;

		}


		public	function updateUserData($id,$data){

			$name = $data['name'];
			$username = $data['username'];
			$email = $data['email'];

			if ($name == "" OR $username == "" OR $email == "") {
				$sms = "<div class='alert alert-danger'><strong>ERROR!</strong> Field must not be empty</div>";
					return $sms;
				}

			if (strlen($username) < 3) {
				$sms = "<div class='alert alert-danger'><strong>ERROR!</strong> Name should have at least three alphabet..</div>";
				return $sms;
		
			}
			elseif(preg_match('/[^a-z0-9_-]+/i', $username)) {
				
				$sms = "<div class='alert alert-danger'><strong>ERROR!</strong> Use letter or number.. </div>";
				return $sms;
			}

			if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
				$sms = "<div class='alert alert-danger'><strong>ERROR!</strong> Use valid email..</div>";	
					return $sms;

				}

				$sql = "UPDATE users set name = :name, username = :username,email = :email WHERE id = :id";
				$query = $this->db->pdo->prepare($sql);

				$query->bindValue(':name',$name);
				$query->bindValue(':username',$username);
				$query->bindValue(':email',$email);
				$query->bindValue(':id',$id);
				$result = $query->execute();

				if ($result) {
					$sms = "<div class='alert alert-success'><strong>CONGRATULATIONS!</strong> Update successfully done..!</div>";
					return $sms;
				}else{
					$sms = "<div class='alert alert-danger'><strong>ERROR!</strong> Try again..</div>";
					return $sms;
				}
		}

		public function checkPassword($id,$old_pass){

			$password = md5($old_pass);
			$sql = "SELECT password FROM users WHERE id = :id AND password = :password";
			$query = $this->db->pdo->prepare($sql);
			$query->bindValue(':id',$id);
			$query->bindValue(':password',$password);
			$query->execute();

			if ($query->rowCount()>0) {
				return true;
			}else{
				return false;
			}

		}



		public function updateUserPassword($id,$data){

			$old_pass = $data['old_pass'];
			$new_pass = $data['password'];
			$check_pass = $this->checkPassword($id,$old_pass);

			if ($old_pass == "" OR $new_pass == "") {
				$sms = "<div class='alert alert-danger'><strong>ERROR!</strong>Field must not be empty..</div>";
					return $sms;
				}

				if ($check_pass == false) {
					$sms = "<div class='alert alert-danger'><strong>ERROR!</strong> Password did not macth..! </div>";
					return $sms;
				}

				if (strlen ($new_pass) < 5) {
					$sms = "<div class='alert alert-danger'><strong>ERROR!</strong> Password atleast should have five characters.</div>";
					return $sms;
				}

				$password = md5($new_pass);
				$sql = "UPDATE users set password = :password WHERE id = :id";
				$query = $this->db->pdo->prepare($sql);

				$query->bindValue(':password',$password);
				$query->bindValue(':id',$id);
				$result = $query->execute();

				if ($result) {
					$sms = "<div class='alert alert-success'><strong>CONGRATULATIONS!</strong> Password updated...</div>";
					return $sms;
				}else{
					$sms = "<div class='alert alert-danger'><strong>ERROR!</strong> Try again..</div>";
					return $sms;
				}

		}

	}
?>