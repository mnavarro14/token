<?php
	/*
	
	All classes in here for the tokenization of credit card numbers
	Mauricio Navarro (mauricio@greenbracket.com)
	
	*/

	// Application user class
	
	class User{
		
		var $user_id;
		var $email;
		var $pass;
		var $fname;
		var $lname;
		var $type;
		
		function __construct($e,$p){
		
			$this->email = mysql_real_escape_string($e);
			$this->pass = mysql_real_escape_string($p);
		
		}
	
		function login(){
		
			if($this->exists()){
				$qu_login = "SELECT * FROM users WHERE email='".$this->email."' and password='".md5($this->pass)."';";
				$qu_user = mysql_query($qu_login) or die("Errant query:".$qu_login);
				$qu_count = mysql_num_rows($qu_user);
				if($qu_count>0){
					$qu_info = mysql_fetch_assoc($qu_user);
					$this->id = $qu_info['id'];
					$this->fname = $qu_info['firstName'];
					$this->lname = $qu_info['lastName'];
					$this->type = $qu_info['type'];
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
		
		}
		
		function exists(){
			$q_user = "SELECT * FROM users WHERE email='".$this->email."';";
			$q_exists = mysql_query($q_user) or die("Errant query:".$q_user);
			$q_count = mysql_num_rows($q_exists);
			if($q_count>0) return true;
			else return false;
		}
		
		function getUserID(){	return $this->id;	}
		function getUserEmail(){	return $this->email;	}
		function getUserFirst(){	return $this->fname;	}
		function getUserLast(){	return $this->lname;	}
		function getUserType(){	return $this->type;	}

	
	}
	
	// Application Litle class and methods
	
	class Litle {
	
		var $litle_user;
		var $litle_password;
		var $gb_order_id;
		var $gb_account_number;
		var $gb_card_validation;
		
		function __construct($user,$pass){
			$this->litle_user=$user;
			$this->litle_password=$pass;
		}
		
		function tokenization($order,$cc,$cvv){
			$this->gb_order_id=$order;
			$this->gb_account_number=$cc;
			$this->gb_card_validation=$cvv;
			$xml_data ='<litleOnlineRequest version="8.10" xmlns="http://www.litle.com/schema" merchantId="default">
			<authentication>
				<user>'.$this->litle_user.'</user>
				<password>'.$this->litle_password.'</password>
			</authentication>
			<registerTokenRequest id="Id" reportGroup="UI Report Group">
				<orderId>'.$this->gb_order_id.'</orderId>
				<accountNumber>'.$this->gb_account_number.'</accountNumber>
				<cardValidationNum>'.$this->gb_card_validation.'</cardValidationNum>
			</registerTokenRequest>
			</litleOnlineRequest>';
			return $this->communicate($xml_data);
		}
		
		function communicate($xml_litle){
			
			$URL = "https://www.testlitle.com/sandbox/communicator/online";
			
			$ch = curl_init($URL);
			curl_setopt($ch, CURLOPT_MUTE, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
			curl_setopt($ch, CURLOPT_POSTFIELDS, "$xml_litle");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$output = curl_exec($ch);
			curl_close($ch);
			
			return $output;
		
		}
	
	}




?>