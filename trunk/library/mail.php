<?php
class		mail
{
  //this function is used for send mail. The first parameters is the dest (string) but he can to be a array.
  //For that to be a array, $tab must be equal true else one mail will be send.
  //the second parameters is the subject of the mail.
  //the third parameters is to define if $dest is a array or a string.
  //$head is for additional headers. For example, Cc, BCc, From, ...
  //$param is for additional parameters. For example -f.
  private	$class;

  /**
   * @fn function __construct($class)
   * @brief 
   * @file mail.php
   * 
   * @param class               
   * @return		
   */
  public function			__construct($class)
  {
    foreach ($class AS $key => $value)
      $this->$key = $value;
  }

  /**
   * @fn function __get($key)
   * @brief 
   * @file mail.php
   * 
   * @param key         
   * @return		
   */
  public function __get($key)
  {
    return (isset($this->class[$key])) ? $this->class[$key] : NULL;
  }

  /**
   * @fn function __set($key, $val)
   * @brief 
   * @file mail.php
   * 
   * @param key         
   * @param val         
   * @return		
   */
  public function __set($key, $val)
  {
    $this->class[$key] = $val;
  }

  /**
   * @fn function sendMail($dest, $subject, $mess, $tab = false, $head = "", $param = "")
   * @brief 
   * @file mail.php
   * 
   * @param dest                
   * @param subject             
   * @param mess                
   * @param tab         
   * @param head                
   * @param param		
   * @return		
   */
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
  /**
   * @fn function sendMailHtml($dest, $subject, $mess, $tab = false, $head = "", $param = "")
   * @brief 
   * @file mail.php
   * 
   * @param dest                
   * @param subject             
   * @param mess                
   * @param tab         
   * @param head                
   * @param param		
   * @return		
   */
  public function		sendMailHtml($dest, $subject, $mess, $tab = false, $head = "", $param = "")
  {
    $mess = wordwrap($message, 70);
    if ($tab == true)
    {
    	$destinataires = "";
    	for ($i = 0; $dest[$i]; $i++)
    	{
    		$destinataires .= $dest[$i];
    		if ($dest[$i + 1])
    			$destinataires .= ", ";
		}
    }
    else
      $destinaires = $dest;
    if ($head == "")
    {
      $head  = 'MIME-Version: 1.0' . "\r\n";
      $head .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    }
    else if ($head == "")
    {
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