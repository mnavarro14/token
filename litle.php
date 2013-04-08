<?php

	/*
	
	This file process Litle tokenization
	Mauricio Navarro (mauricio@greenbracket.com)
	
	*/

	include("common_func.php");

	session_start();

	$litle_user = $_GET['litle_user'];
	$litle_password = $_GET['litle_password'];
	//$litle_user = 'JoesStore';
	//$litle_password = 'JoeyIsTheBe$t';
	$gb_order_id = $_GET['gb_order_id'];
	$gb_account_number = $_GET['gb_account_number'];
	$gb_card_validation = $_GET['gb_card_validation'];
	
	$_SESSION['litle_user']=$litle_user;
	$_SESSION['litle_password']=$litle_password;
	
	//echo $litle_user." ".$litle_password." ".$gb_order_id." ".$gb_account_number." ".$gb_card_validation;
	
	$token = new Litle($litle_user,$litle_password);
	$data = $token->tokenization($gb_order_id,$gb_account_number,$gb_card_validation);

	$xml = simplexml_load_string($data);		

	if(!empty($xml->registerTokenResponse->litleTxnId)){	
		
			echo '<table cellpadding="2" cellspacing="2" border="0" width="98%">
				<tr><td colspan="2" align="center"><h3>Litle Token Response</h3></td></tr>
				<tr><td colspan="2">&nbsp;</td></tr>
				<tr><td class="text" align="right">Litle Transaction Number &#8594; </td>
				<td>
					<span class="vb">
						'.$xml->registerTokenResponse->litleTxnId.'
					</span>
				</td>
				</tr>
				<tr><td class="text" align="right">Order ID &#8594; </td>
				<td>
					<span class="vb">
						'.$xml->registerTokenResponse->orderId.'
					</span>
				</td></tr>
				<tr><td class="text" align="right">Litle Token &#8594; </td>
				<td>
					<span class="vb">
						'.$xml->registerTokenResponse->litleToken.'
					</span>
				</td></tr>
				<tr><td class="text" align="right">Response &#8594; </td>
				<td>
					<span class="vb">
						'.$xml->registerTokenResponse->response.'
					</span>
				</td></tr>
				<tr><td class="text" align="right">Response Time &#8594; </td>
				<td>
					<span class="vb">
						'.$xml->registerTokenResponse->responseTime.'
					</span>
				</td></tr>
				<tr><td class="text" align="right">Message &#8594; </td>
				<td>
					<span class="vb">
						'.$xml->registerTokenResponse->message.'
					</span>
				</td></tr>
				<tr><td colspan="2">&nbsp;</td></tr>
				<tr><td colspan="2" align="center"><h2><a href="index.php">Return To Form</a></h2></td></tr>
				<tr><td colspan="2" align="center"><?php echo $invalid_login; ?></td></tr>
				<tr><td colspan="2">&nbsp;</td></tr>
				</table>
				</div></td></tr>
			</table>';
		
	}else{
	
			echo '<table cellpadding="2" cellspacing="2" border="0" width="98%">
				<tr><td colspan="2" align="center"><h3>Litle Token Response</h3></td></tr>
				<tr><td colspan="2">&nbsp;</td></tr>
				<tr><td class="text" align="right">Response &#8594; </td>
				<td>
					<span class="vb">
						<font color="red">No response received from Litle</font>
					</span>
				</td>
				<tr><td colspan="2">&nbsp;</td></tr>
				<tr><td colspan="2" align="center"><h2><a href="index.php">Return To Form</a></h2></td></tr>
				<tr><td colspan="2">&nbsp;</td></tr>
				</table>
				</div></td></tr>
			</table>';	
	
	}
			
//print_r($xml);

?>