<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<?php

	session_start();
	
	$index_path = '/token/';

	include("config.php");
	include("common_func.php");
	
	if($_POST['login_submit']){
	
		$login = new User($_POST['user_email'],$_POST['user_password']);
		if($login->login()){
			$_SESSION['user_id']=$login->getUserID();
			$_SESSION['user_email']=$login->getUserEmail();
			$_SESSION['user_first']=$login->getUserFirst();
			$_SESSION['user_last']=$login->getUserLast();
			$_SESSION['user_type']=$login->getUserType();
			header("Location: $index_path");
		}else{
			$invalid_login="<span class='v'>You have provided invalid credentials - please try again.</span>";
		}
	
	}
	

	if(!empty($_SESSION['user_email'])){
		$login_details = '<tr><td>&nbsp;</td></tr>
		<tr><td align="right"><span class="regular">Your are logged in as <b>'.$_SESSION['user_first'].' '.$_SESSION['user_last'].'</b> (<b>'.$_SESSION['user_email'].'</b>)</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>';
		$login_nav_menu = '<tr><td align="center">
			<table cellpadding="2" cellspacing="2" border="0" width="90%" id="bgtable" bgcolor="#2858a6">
			<tr><td align="center">
				<table cellpadding="2" cellspacing="2" border="0" width="95%">
					<tr><td align="center" class="top_links" width="20%"><a href="'.$index_path.'">START MENU</a></td><td align="center" class="top_links" width="20%"><a href="settings.php?keepThis=true&TB_iframe=true&height=600&width=700" class="thickbox">ACCOUNT SETTINGS</a></td><td align="center" class="top_links" width="20%"><a href="password.php?keepThis=true&TB_iframe=true&height=600&width=700" class="thickbox">CHANGE PASSWORD</a></td><td align="center" class="top_links" width="20%"><a href="users.php?keepThis=true&TB_iframe=true&height=600&width=700" class="thickbox">USER ADMINISTRATION</a></td><td align="center" class="top_links" width="20%"><a href="logout.php" onclick="return logout();">LOGOUT</a></td></tr>
				</table>
			</td></tr>
			</table>
		</td></tr>';
	}else{
		$login_details = '';
		$login_nav_menu = '';
	}

?>
<html>
<head>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<meta name="description" content="">
<meta name="keywords" content="">
<base href="http://207.171.8.36/token/">
<title>Register Token Transactions</title>
<script src="js/jquery.js"></script>
<script src="js/validation.js"></script>
<script src="js/thickbox.js"></script>

<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/thickbox.css" type="text/css" media="screen" />

<?php //<script type="text/javascript" src="http://code.jquery.com/jquery-1.4.2.min.js"></script>	?>


<script language="javascript">
function verify(t,qs){
	var agree=confirm("Are you sure you want to delete: '"+t+"'?");
	if (agree){
		location.href=qs;
	}else{
		return false;
	}
}
function logout(){
	var qs='logout.php';
	var agree=confirm("Are you sure you want to logout?");
	if (agree){
		location.href=qs;
	}else{
		return false;
	}
}

	function process()
	{
	var litleUser = document.getElementById("litle_user").value;
	var litlePass = document.getElementById("litle_password").value;
	var orderID = document.getElementById("gb_order_id").value;
	var accountNumber = document.getElementById("gb_account_number").value;
	var cardValidation = document.getElementById("gb_card_validation").value;
		if (window.XMLHttpRequest)
		  {// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		  }
		else
		  {// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		  }
		xmlhttp.onreadystatechange=function()
		  {
			  if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
					document.getElementById("process").innerHTML = '';
					document.getElementById("process").innerHTML=xmlhttp.responseText;
				}
		  }
		document.getElementById("process").innerHTML = '<center><br><br><font size="2" face="Verdana"><b>Registering token request..</b><br><br><img src="img/ajax-loader.gif" /></font></center><br>';
		xmlhttp.open("GET","litle.php?litle_user="+litleUser+"&litle_password="+litlePass+"&gb_order_id="+orderID+"&gb_account_number="+accountNumber+"&gb_card_validation="+cardValidation,true);
		//xmlhttp.open("GET","litle.php",true);
		xmlhttp.send();
	}
</script>

<script language="javascript">
  function DoNav(theUrl)
  {
  document.location.href = theUrl;
  }
  </script>


</head>

<body>
<center>
<?php if(!empty($_SESSION['user_email'])){	?>

<br><br>
		<table cellpadding="0" cellspacing="0" border="0" width="75%" id="bgtable">
		<tr><td>&nbsp;</td></tr>
		<tr><td align="center" valign="top">
			<h2>REGISTER TOKEN TRANSACTIONS</h2>
		</td></tr>
		<tr><td align="center" valign="top" class="regular">
			You are logged in as <b><?php echo $_SESSION['user_first']; ?> <?php echo $_SESSION['user_last']; ?></b> (<a href="logout.php">Logout</a>)
		</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td align="center" valign="top" class="regular">
			<a href="index.php">HOME</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href="password.php?keepThis=true&TB_iframe=true&height=300&width=500" class="thickbox">PASSWORD</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href="">DATABASE SETTINGS</a>
		</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td align="center" valign="top">
			<form name="user_login">
			<table cellpadding="2" cellspacing="2" border="0" width="60%" id="bgtable3" bgcolor="#ffffff">
			<tr><td><div id="process">
				<table cellpadding="5" cellspacing="5" border="0" width="98%">
				<tr><td colspan="2" align="center"><h3>Litle Account Information</h3></td></tr>
				<tr><td class="text" align="right">Litle User</td>
				<td>
					<span class="v">
						<input type="text" name="litle_user" id="litle_user" placeholder="Litle User ID.." value="<?php echo $_SESSION['litle_user']; ?>" size="40px">
					</span>
				</td>
				</tr>
				<tr><td class="text" align="right">Litle Password</td>
				<td>
					<span class="v">
						<input type="password" name="litle_password" id="litle_password" placeholder="Litle Password.." value="<?php echo $_SESSION['litle_password']; ?>" size="40px">
					</span>
				</td></tr>
				<tr><td colspan="2">&nbsp;</td></tr>
				<tr><td colspan="2" align="center"><h3>Token Request Information</h3></td></tr>
				<tr><td class="text" align="right">Order ID</td>
				<td>
					<span class="v">
						<input type="text" name="gb_order_id" id="gb_order_id" placeholder="Enter Order ID.." value="" size="40px">
					</span>
				</td>
				</tr>
				<tr><td class="text" align="right">Credit Card Number</td>
				<td>
					<span class="v">
						<input type="text" name="gb_account_number" id="gb_account_number" placeholder="Enter Credit Card Number.." value="" size="40px">
					</span>
				</td></tr>
				<tr><td class="text" align="right">Card Validation Number</td>
				<td>
					<span class="v">
						<input type="text" name="gb_card_validation" id="gb_card_validation" placeholder="Card Code.." value="" size="15px">
					</span>
				</td></tr>
				<tr><td colspan="2">&nbsp;</td></tr>
				<tr><td colspan="2">&nbsp;</td></tr>
				<tr><td colspan="2" align="center"><span style="cursor: pointer;" onclick="process();"><input type="button" style="font-size: 22px; font-family: Verdana;" name="login_submit" value=" Get Token for this Credit Card Number "></span></td></tr>
				<tr><td colspan="2" align="center"><?php echo $invalid_login; ?></td></tr>
				<tr><td colspan="2">&nbsp;</td></tr>
				</table>
				</div></td></tr>
			</table>
			</form>
		</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>
		
		</td></tr>
		
		
		</table>
		
<?php 	}elseif(empty($_SESSION['user_email'])){	?>
<br><br>
		<table cellpadding="0" cellspacing="0" border="0" width="75%" id="bgtable">
		<tr><td>&nbsp;</td></tr>
		<tr><td align="center" valign="top">
			<h2>REGISTER TOKEN TRANSACTIONS</h2>
		</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td align="center" valign="top">
			<h3>Alpha Version 1.0<h3>
		</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td align="center" valign="top">
			<form name="user_login" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<table cellpadding="5" cellspacing="5" border="0" width="45%" id="bgtable" bgcolor="#2858a6">
				<tr><td colspan="2">&nbsp;</td></tr>
				<tr><td colspan="2" align="center"><h3><font color="#ffffff">Account Login</font></h3></td></tr>
				<tr><td class="text" align="right"><font color="#ffffff">Email</font></td>
				<td>
				<span class="v">
				<input type="text" name="user_email" id="user_email" value="" size="45px">
				<script type="text/javascript">
				var user_email = new LiveValidation('user_email',{onlyOnSubmit: true });
				user_email.add( Validate.Presence );
				user_email.add( Validate.Email );				
				</script></span>
				</td>
				</tr>
				<tr><td class="text" align="right"><font color="#ffffff">Password</font></td>
				<td>
				<span class="v">
				<input type="password" name="user_password" id="user_password" value="" size="45px">
				<script type="text/javascript">
				var user_password = new LiveValidation('user_password',{onlyOnSubmit: true });
				user_password.add( Validate.Presence );				
				</script></span>
				</td></tr>
				<tr><td colspan="2" align="right"><input type="submit" style="font-size: 22px; font-family: Verdana;" name="login_submit" value=" User Login ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>
				<tr><td colspan="2" align="center"><?php echo $invalid_login; ?></td></tr>
				<tr><td colspan="2">&nbsp;</td></tr>
			</table>
			</form>
		</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>
		
		</td></tr>
		
		
		</table>
<?php 	}else{	header("Location: $index_path");	}	?>

<br><br>
<span class="copyright">Copyright &#169; <?php echo date('Y'); ?> Green Bracket LLC</span>
</center>

</body>
<?php
	
	mysql_close($link);

?>
</html>