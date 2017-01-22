<?php
	include_once './application/config/config.php';
	include_once './application/class/newUserForm.php';
	include_once './application/class/mailSender.php';
	
	class createUSer{
		private $newid;
		private $newuser;
		private $newpw;
		private $pw1;
		private $pw2;
		private $newemail;

		public function __construct(){
			$bytes = openssl_random_pseudo_bytes(32, $cstrong);
			$hex   = bin2hex($bytes);
			$this->newid = md5($hex);
			$this->newuser = $_POST['newuser'];
			$this->newpw = password_hash($_POST['password1'], PASSWORD_DEFAULT);
			$this->pw1 = $_POST['password1'];
			$this->pw2 = $_POST['password2'];
			$this->newemail = $_POST['email'];
			self::init();
		}

		public function init(){
			
		include_once './application/config/config.php';

			if ($this->pw1 != $this->pw2){
				echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Password fields must match</div><div id="returnVal" style="display:none;">false</div>';
			}

			elseif (strlen($this->pw1) < 8){
				echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Password must be at least 8 characters</div><div id="returnVal" style="display:none;">false</div>';
			}

			elseif(!filter_var($this->newemail, FILTER_VALIDATE_EMAIL) == true ){
				echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Must provide a valid email address</div><div id="returnVal" style="display:none;">false</div>';
			} else {
				
				if (isset($_POST['newuser']) && !empty(str_replace(' ', '', $_POST['newuser'])) && isset($_POST['password1']) && !empty(str_replace(' ', '', $_POST['password1'])) ){
					$a = new newUserForm;
					$response = $a->createUser($this->newuser, $this->newid, $this->newemail, $this->newpw);
					
					if($response == 'true'){
						echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'. signupthanks .'</div><div id="returnVal" style="display:none;">true</div>';
						$m = new mailSender;
						$m->sendMail($this->newemail, $this->newuser, $this->newid, 'Verify');
					} else {
						//echo $response;
					echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'. $response .'</div><div id="returnVal" style="display:none;">true</div>';

					}

				} else {
					echo 'An error occurred on the form... try again';
				}

			}

		}

	}
