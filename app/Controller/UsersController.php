<?php
App::uses('AppController', 'Controller');
class UsersController extends AppController {

	public $uses = array('User');
	
	function beforeFilter() {
		AppController::beforeFilter();
		$this->Auth->allow();
	}
	
	public function log_out() {
	
		$this->autoRender = false;
		$this->Session->destroy();
		$this->Auth->logout();
		$this->redirect('/login');
	}
	
	public function back_login() {
		$this->layout="default";
		$this ->render('login');
	}
	
	public function verify() {
		$this->autoRender = false;
		if( isset( $this->request->query['e'] ) && !empty($this->request->query['e']) ){
			$e = $this->request->query['e'];
			$d = $this->User->find('first',array('conditions'=>array('User.verification_code'=>$e)));
			if(!empty($d)){
				if($d['User']['status'] == 0){
					if($d['User']['verification_status'] == 0){
						$arr = array('id'=>$d['User']['id'],'verification_code'=>1,'status'=>1);
						$this->User->save($arr);
						echo "<center> <h2>Your account has been activated</h2> </center><br>";
					}else{ echo "<center> <h2>Your account is already activated</h2> </center><br>"; }
				}else{ echo "<center> <h2>Your account is already activated</h2> </center><br>";}
			}else{ echo "<center> <h2>Incorrect verification link</h2> </center><br>"; }
		}
		$u = SITEURL.'login';
		echo "<center> <p>you are being redirected to login page</p> </center>";
		echo " <center><meta http-equiv='refresh' content='2;url=$u'><a href='$u'>if you don't want to wait you can click here.</a></center>";
	}
	public function login() {
		
		if (isset($_GET['return_url'])) {
			$return_url = urldecode($_GET['return_url']);
			$this->set('r_url',$_GET['return_url']);
			$this->Session->write('return_url', $return_url);
		}else{ $this->Session->delete('return_url'); }
		
		
		$this->set('title_for_layout', 'Welcome : '.WEBTITLE);
		
		if ($this->Auth->User('id') != "") { $this->redirect('/'); }
		 
		if ($this->RequestHandler->isAjax() && !empty($this->request->data)) {
			$return_url =  $this->Session->read('return_url');
			if (!empty($return_url)) { $log_url = $return_url; }
			else{ $log_url = SITEURL.'accounts'; }
			
			$adminUrl = SITEURL.'back/labs/';
			
			$s = "<script>$('#login').prop('disabled',false); $('#login').text('Login');</script>";
			$email = trim(strtolower($this->data['e']));
			$pwd = md5(trim($this->data['p']));
			if (empty($email)) { echo $s; echo '<div class="alert alert-danger fadeIn animated">Please enter user id.</div>'; }
			elseif (empty($pwd)) { echo $s;  echo '<div class="alert alert-danger fadeIn animated">Please enter login password.</div>'; }
			else {
				$c = array('User.email' => $email, 'User.password' => $pwd);
				$userdata = $this->User->find('first', array('recursive' => -1,'conditions' => $c));
				if (!empty($userdata)) {
					// write the cookie
					//$rem_arr = array($userdata['User']['email'], md5($userdata['User']['password']));
					//$this->Cookie->write('remember_me_cookie', $rem_arr, true, '2 weeks');
	
					if ($userdata['User']['status'] == 1) {
						$last_login = array('id'=>$userdata['User']['id'],'last_login'=>DATE);
						$this->User->save($last_login);
						if ($this->Auth->login($userdata['User'])) {
								if($userdata['User']['role']==1)
								{
										echo '<script type="text/javascript">window.location.href = "'.$adminUrl.'"</script>';
								}
								else
								{
										echo '<script type="text/javascript">window.location.href = "'.$log_url.'"</script>';
								}
							
						}
					} else { echo $s;  echo '<div class="alert alert-danger fadeIn animated">Your account has been temporarily deactivated by admin. If you have any questions about this, please contact support.</div>'; }
				} else { echo $s;  echo '<div class="alert alert-danger fadeIn animated">Incorrect login ID/password combination. Please try again.</div>'; }
			}exit;
		}
		 
	
	}

	function access($id = null) {
		$this->autoRender = false;
	
		$this->Cookie->destroy();
		$this->Session->destroy();
		$this->Auth->logout();
		$userdata = $this->User->Find('first', array('recursive'=>-1,'conditions' => array('User.id' => $id,'User.status' =>1)));
		if (!empty($userdata)) {
			if ($this->Auth->login($userdata['User'])) {
				$this->redirect('/');
			}
		}
	}
	

}
