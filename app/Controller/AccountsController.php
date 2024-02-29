<?php
App::uses('AppController', 'Controller');

class AccountsController extends AppController {
	public $uses = array('User','EmailTemplate','Employer','Country','Category','Employee');
	var $components = array('Auth', 'Session', 'Email', 'RequestHandler', 'Paginator','DATA');
    var $helpers = array('Html', 'Form', 'Session', 'Paginator');
	function beforeFilter() {
		AppController::beforeFilter();
		
	}
	
	public function index(){
		$this->set('title_for_layout', 'Home : '.WEBTITLE);
		$data = $this->User->find('first',array('conditions'=>array('User.id'=>ME)));
		
		if( $this->Auth->user('role') == 3 ){
			$e_data = $this->Employee->find('first',array('conditions'=>array('Employee.user_id'=>ME) ,'order'=>array('Employee.id'=>'DESC'),'limit'=>30 ));
			$this->set('e_data',$e_data);
		}
		$this->set('data',$data);
		
		if ($this->request->is('ajax') && isset($this->data['User']) && !empty($this->data['User'])) {
			$s = "<script>$('#login').prop('disabled',false); $('#login').text('Save');</script>";
			
			if(!empty($this->request->data['User']['password1'])){
				if(empty($this->request->data['User']['password2'])){ echo $s;  echo '<div class="alert alert-danger fadeIn animated">Please confirm password</div>'; exit; }
				
				if( $this->request->data['User']['password1'] != $this->request->data['User']['password2'] ){ echo $s;  echo '<div class="alert alert-danger fadeIn animated">Password does not match</div>'; exit; }
				
			}
			
			if(!empty($this->request->data['User']['password1'])){ $this->request->data['User']['password'] = $this->request->data['User']['password1']; }
			
			$this->User->set($this->request->data);
			if ($this->User->validates()) {
				if ($this->User->save($this->request->data)) {
					echo $s;  echo '<div class="alert alert-success fadeIn animated">Your changes have been saved.</div>';
				}
			} else {
				$str= null;
				$errors = $this->User->validationErrors;
				if(!empty($errors)){
					foreach ($errors as $err){ $str.=$err[0]."<br>"; }
					echo $s;  echo '<div class="alert alert-danger fadeIn animated">'.$str.'</div>'; }
			}
			exit;
		}

	}
	public function my_form() {
		$this->set('title_for_layout', 'My Applicaton : '.WEBTITLE);
		
		if( $this->Auth->user('role') == 2 ){
			$data = $this->Employer->find('all',array('conditions'=>array('Employer.user_id'=>ME) ,'order'=>array('Employer.id'=>'DESC'),'limit'=>30 ));
			$this->set('data',$data);
		}
		elseif( $this->Auth->user('role') == 3 ){
			$data = $this->Employee->find('all',array('conditions'=>array('Employee.user_id'=>ME) ,'order'=>array('Employee.id'=>'DESC'),'limit'=>30 ));
			
			$this->set('data',$data);
			$this->render('my_form_1');
		}
		
	}
	
}
