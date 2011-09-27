<?php
class		mail
{
	//this function is used for send mail. The first parameters is the dest (string) but he can to be a array.
	//For that to be a array, $tab must be equal true else one mail will be send.
	//the second parameters is the subject of the mail.
	//the third parameters is to define if $dest is a array or a string.
	//$head is for additional headers. For example, Cc, BCc, From, ...
	//$param is for additional parameters. For example -f.
	public function		sendMail($dest, $subject, $mess, $tab = false, $head = "", $param = "")
	{
		$mess = wordwrap($message, 70);
		if ($tab == true)	{
			$destinataires = "";
			for ($i = 0; $dest[$i]; $i++)	{
				$destinataires .= $dest[$i];
				if ($dest[$i + 1])
					$destinataires .= ", ";
			}
		}
		else
			$destinaires = $dest;
		if ($head == "" && $param == "")
			mail($destinataires, $subject, $mess);
		else if ($head == "")
			mail($destinataires, $subject, $mess, null, $param);
		else if ($param == "")
			mail($destinataires, $subject, $mess, $head);
	}
	
	//this function is used for send mail with html. There is just a difference with the function precedently, we add a few lines in the headers.
	public function		sendMailHtml($dest, $subject, $mess, $tab = false, $head = "", $param = "")
	{
		$mess = wordwrap($message, 70);
		if ($tab == true)	{
			$destinataires = "";
			for ($i = 0; $dest[$i]; $i++)	{
				$destinataires .= $dest[$i];
				if ($dest[$i + 1])
					$destinataires .= ", ";
			}
		}
		else
			$destinaires = $dest;
		if ($head == "")	{
			$head  = 'MIME-Version: 1.0' . "\r\n";
			$head .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		}
		else ($head == "")	{
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= $head;
			$head = $headers;
		}
		if ($param != "")
			mail($destinataires, $subject, $mess, $head, $param);
		else if ($param == "")
			mail($destinataires, $subject, $mess, $head);
	}
}
?>