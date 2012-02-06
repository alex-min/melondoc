<?php
include_once "sdk_facebook.php";

class		libfacebook
{
  private		$db;
  private		$template;
  private		$facebook = null;
  private		$loginUrl;
  private		$logoutUrl;
  private		$uid;
  private		$infos;
  private		$isGood = true;

  public function	__construct($class)
  {
    $this->template = &$class['template'];
    $this->db = &$class['database'];
    $this->facebook = new Facebook(array(
				   'appId'  => FB_APPID,
				   'secret' => FB_SECRET_KEY,
				   'fileUpload' => false
				   ));
    try {
      $this->logoutUrl = $this->facebook->getLogoutUrl();
      $this->uid = $this->facebook->getUser();
      $this->infos = $this->facebook->api("/".$this->uid);
    }
    catch (Exception $e)
      {
	$this->isGood = false;
      }
  }

  public function	needFacebook()
  {
    return $this->isGood;
  }

  public function	deconnexionFacebook()
  {
    if ($this->facebook)
      $this->facebook->destroySession();
  }
  
  public function	getInfos()
  {
    return $this->infos;
  }

  public function	getID()
  {
    return $this->uid;
  }

  public function	getLoginUrl($url)
  {
    $array = array('scope'         => 'email,offline_access,publish_stream,user_birthday,user_location,user_work_history,user_about_me,user_hometown,read_stream',
		   'redirect_uri'  => "http://".$_SERVER['HTTP_HOST'].$url);
    $this->loginUrl = $this->facebook->getLoginUrl($array);
    return $this->loginUrl;
  }

  public function	getLogoutUrl()
  {
    return $this->logoutUrl;
  }

  public function	multiquery($queries)
  {
    try{
      $param = array(
		     'method'    => "fql.multiquery",
		     'queries'     => $queries,
		     'callback'  => ''
		     );
      $fqlResult = $this->facebook->api($param);
      return $fqlResult;
    }
    catch(Exception $o){
      return NULL;
    }
    return NULL;
  }

  public function	query($query) // peut etre aussi fql.multiquery
  // les multiqueries ressemblent a ca : 
  {
    try{
      $param = array(
		     'method'    => "fql.query",
		     'query'     => $query,
		     'callback'  => ''
		     );
      $fqlResult = $this->facebook->api($param);
      return $fqlResult;
    }
    catch(Exception $o){
      return NULL;
    }
    return NULL;
  }

  public function	publish($name, $message, $link, $picture, $description, $user = "me")
  {
    if ($user == "me")
      $user = $this->uid;
    try {
      $array = array('message' => $message,
		     'link'    => $link,
		     'picture' => $picture,
		     'name'    => $name,
		     'description'=> $description
		     );
      $publishStream = $this->facebook->api("/$user/feed", 'post', $array);
      return TRUE;
    } catch (FacebookApiException $e) {
      return FALSE;
    }
    return FALSE;
  }
}
?>