<?php
include_once './application/config/config.php';

include_once './application/class/selectEmail.php';
include_once './application/class/verify.php';
include_once './application/class/mailSender.php';

class verifyUser {

	private $uid;
	private $e;
	private $eresult;
	private $email;
	private $username;
	private $v;

	public	function __construct()	{
		$this->uid = filter_input(INPUT_GET, 'token', FILTER_SANITIZE_STRING);
		$this->e = new selectEmail();
		$this->eresult = $this->e->emailPull($this->uid);
		$this->email = $this->eresult['email'];
		$this->username = $this->eresult['username'];
		$this->v = new verify();
		self::init();
	}

	function init()	{

		if (isset($this->uid) && !empty(str_replace(' ', '', $this->uid))) {

			$vresponse = $this->v->verifyUser($this->uid, $this->email);

			if ($vresponse == 'true') {
				echo activemsg;
				$this->m = new mailSender;
				$this->m->sendMail($this->email, $this->username, $this->uid, 'Active');
			}
			else {
				echo $vresponse;
			}
		}
		else {
			echo 'An error occurred... click <a href="./index.php">here</a> to go back.';
		}
	}
}
