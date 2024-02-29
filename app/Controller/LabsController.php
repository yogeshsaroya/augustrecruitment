<?php
App::uses('Sanitize', 'Utility', 'AppController', 'Controller');
class LabsController extends AppController {

    var $uses = array('User','EmailTemplate','WebSetting','Category');
    var $components = array('Auth', 'Session', 'Email', 'RequestHandler', 'Paginator','DATA');
    var $helpers = array('Html', 'Form', 'Session', 'Paginator');
    
    function beforeFilter() {


        AppController::beforeFilter();

    }
    
    public function back_index() {
    	$this->set('title_for_layout', 'Admin Dashboard : '.WEBTITLE);
    	$this->set('user', $this->User->find('count',array('conditions'=>array('User.role'=>array(2,3) ))));
    }
    


    /** Function for email templates */
    public function back_email_templates(){
    	$this->set('MenuHead','menu_templates');
    	$this->set('title_for_layout', 'Email templates : '.WEBTITLE);
    	$this->paginate = array('maxLimit' =>50,'limit' =>50,'order' => array('EmailTemplate.id' => 'DESC'));
    	$data = $this->paginate('EmailTemplate');
    	$this->set('data', $data);
    }
    
    public function back_add_email_template($id = null) {
    	$this->set('MenuHead','menu_templates');
    	if(!empty($id)){
    		$this->set('title_for_layout', 'Edit email templates : '.WEBTITLE);
    		$this->EmailTemplate->id = $id;
    		if ($this->request->is('get')) {
    			$e = $this->EmailTemplate->read();
    			if (!empty($e)) { $this->request->data = $e; }
    			else { $this->redirect(array('controller' => 'labs', 'action' => 'add_email_template')); }
    		} else {
    			
    			if ($this->EmailTemplate->save($this->request->data)) {
    				$this->Session->setFlash(__('Template has been updated.'), 'default', array('class' => 'alert alert-success'), 'msg');
    			} else {
    				$this->Session->setFlash(__('Template has been not updated.'), 'default', array('class' => 'alert alert-danger'), 'msg');
    			}
    		}
    		
    	}else{
    		$this->set('title_for_layout', 'Create new email template : '.WEBTITLE);
    		if (!empty($this->request->data))
    		{
    			
    			if ($this->EmailTemplate->save($this->request->data)) {  
    				//'SmsTemplate','MessageTemplate','NotificationTemplate'
    				$lid = $this->EmailTemplate->getLastInsertId();
    				
    				if(!empty($this->request->data['sms'])){
    					$is_sms = $this->SmsTemplate->find('count',array('conditions'=>array('SmsTemplate.type'=>$this->request->data['EmailTemplate']['type'])));
    					if($is_sms == 0){
    						$smsArr = array('type'=>$this->request->data['EmailTemplate']['type'],'message'=>$this->request->data['sms']);
    						$this->SmsTemplate->save($smsArr);
    					}
    				}
    				if(!empty($this->request->data['message'])){
    					$is_sms = $this->MessageTemplate->find('count',array('conditions'=>array('MessageTemplate.type'=>$this->request->data['EmailTemplate']['type'])));
    					if($is_sms == 0){
    						$smsArr = array('type'=>$this->request->data['EmailTemplate']['type'],'subject'=>$this->request->data['EmailTemplate']['subject'], 'message'=>$this->request->data['sms']);
    						$this->MessageTemplate->save($smsArr);
    					}
    				}
    				if(!empty($this->request->data['notification'])){
    					$is_sms = $this->NotificationTemplate->find('count',array('conditions'=>array('NotificationTemplate.type'=>$this->request->data['EmailTemplate']['type'])));
    					if($is_sms == 0){
    						$smsArr = array('type'=>$this->request->data['EmailTemplate']['type'],'message'=>$this->request->data['sms']);
    						$this->NotificationTemplate->save($smsArr);
    					}
    				}
    				
	    			$this->Session->setFlash('Email Template info has been save successfully', 'default', array('class' => 'alert alert-success'), 'msg');
	    			$this->redirect(SITEURL."back/labs/add_email_template/".$lid);
    			} 
    			else { $this->Session->setFlash('Not able to save', 'default', array('class' => 'alert alert-danger'), 'msg'); }
    		}
    	}
    }
    
     public function back_my_email_template($id = null) {
    	$this->set('MenuHead','menu_templates');
    	if(!empty($id)){
    		$this->set('title_for_layout', 'Edit email templates : '.WEBTITLE);
    		$this->EmailTemplate->id = $id;
    		if ($this->request->is('get')) {
    			$e = $this->EmailTemplate->read();
    			if (!empty($e)) { $this->request->data = $e; }
    			else { $this->redirect(array('controller' => 'labs', 'action' => 'add_email_template')); }
    		} else {
    			
    			if ($this->EmailTemplate->save($this->request->data)) {
    				$this->Session->setFlash(__('Template has been updated.'), 'default', array('class' => 'alert alert-success'), 'msg');
    			} else {
    				$this->Session->setFlash(__('Template has been not updated.'), 'default', array('class' => 'alert alert-danger'), 'msg');
    			}
    		}
    		
    	}else{
    		$this->set('title_for_layout', 'Create new email template : '.WEBTITLE);
    		if (!empty($this->request->data))
    		{
    			
    			if ($this->EmailTemplate->save($this->request->data)) {  
    				//'SmsTemplate','MessageTemplate','NotificationTemplate'
    				$lid = $this->EmailTemplate->getLastInsertId();
    				
    				if(!empty($this->request->data['sms'])){
    					$is_sms = $this->SmsTemplate->find('count',array('conditions'=>array('SmsTemplate.type'=>$this->request->data['EmailTemplate']['type'])));
    					if($is_sms == 0){
    						$smsArr = array('type'=>$this->request->data['EmailTemplate']['type'],'message'=>$this->request->data['sms']);
    						$this->SmsTemplate->save($smsArr);
    					}
    				}
    				if(!empty($this->request->data['message'])){
    					$is_sms = $this->MessageTemplate->find('count',array('conditions'=>array('MessageTemplate.type'=>$this->request->data['EmailTemplate']['type'])));
    					if($is_sms == 0){
    						$smsArr = array('type'=>$this->request->data['EmailTemplate']['type'],'subject'=>$this->request->data['EmailTemplate']['subject'], 'message'=>$this->request->data['sms']);
    						$this->MessageTemplate->save($smsArr);
    					}
    				}
    				if(!empty($this->request->data['notification'])){
    					$is_sms = $this->NotificationTemplate->find('count',array('conditions'=>array('NotificationTemplate.type'=>$this->request->data['EmailTemplate']['type'])));
    					if($is_sms == 0){
    						$smsArr = array('type'=>$this->request->data['EmailTemplate']['type'],'message'=>$this->request->data['sms']);
    						$this->NotificationTemplate->save($smsArr);
    					}
    				}
    				
	    			$this->Session->setFlash('Email Template info has been save successfully', 'default', array('class' => 'alert alert-success'), 'msg');
	    			$this->redirect(SITEURL."lab/labs/my_email_template/".$lid);
    			} 
    			else { $this->Session->setFlash('Not able to save', 'default', array('class' => 'alert alert-danger'), 'msg'); }
    		}
    	}
    }
    public function back_seo() {
    
    	$this->set('title_for_layout', 'Web Settings : '.WEBTITLE);
    	if (empty($this->data)) {
    		$this->WebSetting->id = 1;
    		$this->request->data = $this->WebSetting->read();
    	} else {
    		
    		if (!empty($this->request->data['WebSetting']['logo1'])) {
    			$file = $this->request->data['WebSetting']['logo1']['name'];
    			$ext = strtolower( pathinfo($file, PATHINFO_EXTENSION) );
    			$arr_ext = array('jpg', 'jpeg', 'gif','png');
    			if (in_array($ext, $arr_ext)) {
    				
    				$new_img = strtolower($file);
    				try {
    					if (move_uploaded_file($this->request->data['WebSetting']['logo1']['tmp_name'], WWW_ROOT."img/".$new_img)) {
    						$this->request->data['WebSetting']['logo'] = $new_img;
    					}
    				} catch (Exception $e) {
    					
    				}
    			}
    		}
    		
    		
    		if ($this->WebSetting->save($this->request->data)){ $this->Session->setFlash(__('Saved'), 'default', array('class' => 'message success'), 'msg'); }
    		else{ $this->Session->setFlash(__('not savedd'), 'default', array('class' => 'message error'), 'msg'); }
    
    	}
    }
    
    /** change admin user password*/
    public function back_change_pwd() {
    	$this->set('MenuHead','menu_settings');
    	$this->set('title_for_layout', 'Change password : '.WEBTITLE);
    	
    	if(!empty($this->data)){
    		$s = "<script>s();</script>";
    		if( empty($this->data['p']) || empty($this->data['p1']) ){ echo $s; echo "<div class='alert alert-danger fadeIn animated'>Please enter password</div>"; }
    		elseif( strlen($this->data['p']) <6){ echo $s; echo "<div class='alert alert-danger fadeIn animated'>password must be at least 6 characters</div>"; }
    		elseif( $this->data['p'] !=  $this->data['p1'] ){ echo $s; echo "<div class='alert alert-danger fadeIn animated'>Passwords Do Not Match!</div>"; }
    		else{
    			$arr = array('id'=>$this->Auth->user('id'),'password'=>$this->data['p']);
    			$this->User->save($arr);
    			echo $s; 
    			echo "<div class='alert alert-success fadeIn animated'>Password has been changed successfully</div>";
    		}
    		exit;
    	}
    }
	
	/** category list  */
    public function back_all_category() {
    	$this->set('MenuHead','menu_settings');
    	$this->set('title_for_layout', 'Category listing : '.WEBTITLE);
    	$this->loadModel('Category');
		$this->paginate = array('maxLimit' =>50,'limit' =>50,'order' => array('Category.name' => 'ASC'));
		$data = $this->paginate('Category');
		$data = $this->back_categoryList($data);
		$this->set('data', $data);
    }
	
	/** category list  */
    public function back_all_category_order($pid = 0) {
    	$this->set('MenuHead','menu_make');
    	$this->set('title_for_layout', 'Category listing : '.WEBTITLE);
    	$this->loadModel('Category');
		$this->paginate = array('maxLimit' =>50,'limit' =>50,'order' => array('Category.sort_order' => 'ASC'),'conditions' =>array('Category.parent_Id'=>$pid,'Category.status'=>1));
		$data = $this->paginate('Category');
		if($pid)
		{
			$this->set('parent', $this->back_categoryRecursive($pid));
		}
		if (!empty($this->data)) {
    		$this->set('title_for_layout', 'Add new Catrgory : '.WEBTITLE);
    		$this->request->data['Category']['slug'] = strtolower(Inflector::slug($this->data['Category']['name'], '-'));
			if ($this->Category->save($this->request->data))
			{
				$this->Session->setFlash(__('Saved'), 'default', array('class' => 'alert alert-success'), 'msg');
				//echo "<script>setTimeout(function(){ window.location.href ='".SITEURL."back/labs/all_category_order/'".$pid."'; }, 100);</script>";
				$this->redirect($this->referer());
			}
				else{
				$this->Session->setFlash(__('not savedd'), 'default', array('class' => 'alert alert-danger'), 'msg');
			}
		}
		
		
		$this->set('parent_Id', $pid);
		$this->set('data', $data);
    }
    
    /** Add new website settings  */
    public function back_add_category($id = null) {
    	$category = $this->Category->find('list',array('conditions'=>array('Category.status'=>1),'order'=>array('Category.name'=>'ASC'),'fields'=>array('id','name','parent_Id')));
		$category = $this->back_categoryDropDownList($category);
		
		$this->set('category', $category);
    	$this->set('MenuHead','menu_make');
    	
    	$this->loadModel('Category');
	
		if(!empty($id)){
    		$this->set('title_for_layout', 'Edit Category : '.WEBTITLE);
    		$this->Category->id = $id;
    		if ($this->request->is('get')) {
    			$e = $this->Category->read();
    			if (!empty($e)) { $this->request->data = $e; }
    			else { $this->redirect(array('controller' => 'labs', 'action' => 'add_category')); }
    		} else {
    			if ($this->Category->save($this->request->data)) {
    				$this->Session->setFlash(__('Category has been updated.'), 'default', array('class' => 'alert alert-success'), 'msg');
    			} else {
    				$this->Session->setFlash(__('Category has been not updated.'), 'default', array('class' => 'alert alert-danger'), 'msg');
    			}
    		}
    		
    	}
    	else if (!empty($this->data)) {
    		$this->set('title_for_layout', 'Add new Catrgory : '.WEBTITLE);
    		$this->request->data['Category']['slug'] = strtolower(Inflector::slug($this->data['Category']['name'], '-'));
			if ($this->Category->save($this->request->data))
			{
				$this->Session->setFlash(__('Saved'), 'default', array('class' => 'alert alert-success'), 'msg');
				echo "<script>setTimeout(function(){ window.location.href ='".SITEURL."back/labs/all_category'; }, 100);</script>";}
				else{
				$this->Session->setFlash(__('not savedd'), 'default', array('class' => 'alert alert-danger'), 'msg');
			}
    	}
    }
    
    public function back_delete_category($id = null) {
    	$this->autoRender = false;
		$this->loadModel('Category');
		if(!empty($id)){
		
			$d = $this->Category->find('first',array('conditions'=>array('id'=>$id)));
			if(!empty($d)){
				$this->Category->id = $d['Category']['id'];
				$this->Category->delete();
			}
			$this->redirect($this->referer());
			//echo "<script>setTimeout(function(){ window.location.href ='".SITEURL."back/labs/all_category'; }, 100);</script>";
		}
    }
	
	
	public function back_categoryDropDownList($cate)
	{
		$newCat = array();
		if($cate)
		{
			foreach ($cate as  $catlist)
			{
				foreach ($catlist as $key => $list)
				{
					if($list && $key){
						$cateData = $this->back_categoryRecursive($key);
						$newCat[$key] = $cateData;
					}
					else
					{
						$newCat[$key] = $list;
					}
				
				}
			}
		}
		return ($newCat);
	}
	
	public function back_categoryList($cate)
	{
		$newCat = array();
		foreach ($cate as $list)
		{
			if(isset($list['Category']) && $list['Category']['parent_Id'])
			{
				$cateData = $this->back_categoryRecursive($list['Category']['id']);
				$list['Category']['name'] = $cateData;
			}
			array_push($newCat,$list);
		}
		return ($newCat);
	}
	
	public function back_categoryRecursive($pid = null,$lname = null,$mid = null){
		//$this->autoRender = false;
        $lname = $lname ?  $lname : '';
        $mid = $mid ? $mid : $pid;
        if ($pid) {
			$cate = $this->Category->find('first',array('conditions'=>array('id'=>$pid)));
            if(isset($cate) &&!empty($cate)){
                $menuobj = array();
                if ($cate['Category']['parent_Id']) {
					if ($lname) {
						$lname =  $cate['Category']['name'] .' > '. $lname;
					}
					else
					{
						$lname =  $cate['Category']['name'] ;
					}
					return $this->back_categoryRecursive($cate['Category']['parent_Id'], $lname, $mid);
                }
                else
                {
					if ($lname) {
                        $lname =  $cate['Category']['name'] .' > '. $lname;
                    }
                    else
                    {
                        $lname =  $cate['Category']['name'] ;
                    }
					return $lname;
					
                }
            }
		}
    }
	
	/** Employer  */
	public function back_all_employer() {
		$condition = '';
		$ndata = array();
		$ndata['keyword'] = $ndata['location'] = $ndata['created'] = "";
		if(isset($this->params['url']) && isset($this->params['url']['keyword']) && !empty($this->params['url']['keyword']))
		{
			$keyword = $this->params['url']['keyword'];
			$condition[] =  array('OR'=>array(
											"Employer.first_name LIKE" =>"%".$keyword."%",
											"Employer.last_name LIKE" => "%".$keyword."%",
											"Employer.company_name LIKE" => "%".$keyword."%",
											"Employer.email LIKE" => "%".$keyword."%",
											"Employer.job_title LIKE" => "%".$keyword."%",)
										);
			
			$ndata['keyword'] = $keyword;
		}
		if(isset($this->params['url']) && isset($this->params['url']['location']) && !empty($this->params['url']['location']))
		{
			$country = $this->params['url']['location'];
			$ndata['location'] = $country;
			$condition[] =  array("Employer.city " =>$country);
		}
		if(isset($this->params['url']) && isset($this->params['url']['created']) && !empty($this->params['url']['created']))
		{
			
			$days = $this->params['url']['created'];
			$today = date("Y-m-d  h:i:s", time());
			$pastdate =date("Y-m-d 00:00:00", strtotime("-".$days." day"));
			$condition[]= array('Employer.created BETWEEN ? AND ?' => array($pastdate, $today));
			$ndata['created'] = $days;
		}
		$this->set('filterData', $ndata);
		$this->loadModel('Employer');
    	$country = $this->Employer->find('list',array('order'=>array('Employer.city'=>'ASC'),'group'=>array('city'),'fields'=>array('city','city')));
		$this->set('country',$country);
    	$this->set('MenuHead','Employer Form');
    	$this->set('title_for_layout', 'Employer listing : '.WEBTITLE);
    	$this->loadModel('Employer');
		$this->paginate = array('recursive'=>1, 'limit' => 15,'conditions' => $condition, 'order' => array('Employer.name' => 'ASC'));
		$data = $this->paginate('Employer');
		$this->set('data', $data);
    }
	
	public function back_delete_employer($id = null) {
    	$this->autoRender = false;
		$this->loadModel('Employer');
		if(!empty($id)){
		
			$d = $this->Employer->find('first',array('conditions'=>array('id'=>$id)));
			if(!empty($d)){
				$this->Employer->id = $d['Employer']['id'];
				$this->Employer->delete();
			}
			echo "<script>setTimeout(function(){ window.location.href ='".SITEURL."back/labs/all_employer'; }, 100);</script>";
		}
    }
	
	public function back_view_employer($id) {
    	$this->set('MenuHead','Employer Detail');
    	$this->set('title_for_layout', 'Employer listing : '.WEBTITLE);
    	$this->loadModel('Employer');
		if(!empty($id)){
			$this->Employer->bindModel(array('belongsTo'=>array('User'),'hasMany'=>array('JobTitle')));
			$data = $this->Employer->find('first',array('conditions'=>array('Employer.id'=>$id)));
			if($data)
			{
				$this->set('data', $data);
			}
			else{ $this->layout = 'lab_404';}
		}
		else{ $this->layout = 'lab_404';}
		
    }
	
	/** Employee  */
	public function back_all_employee() {
	    $condition = $ndata = array();
		$ndata['keyword'] = $ndata['industry_id'] = $ndata['department_id'] = $ndata['job_title_id'] = $ndata['created'] = "";
		if(isset($this->params['url']) && isset($this->params['url']['keyword']) && !empty($this->params['url']['keyword']))
		{
			$keyword = $this->params['url']['keyword'];
			$condition[] =  array('OR'=>array(
											"Employee.first_name LIKE" =>"%".$keyword."%",
											"Employee.last_name LIKE" => "%".$keyword."%",

											"Employee.email LIKE" => "%".$keyword."%",
											"Employee.job_title LIKE" => "%".$keyword."%",)
										);
			
			$ndata['keyword'] = $keyword;
		}
		
		if( isset($this->params['url']['industry_id']) && !empty($this->params['url']['industry_id'])) {
			$industry_id = $this->params['url']['industry_id'];
			$ndata['industry_id'] = $industry_id;
			$condition['Employee.industry_id'] =  $industry_id;
			$dep = $this->Category->find('list',array('conditions'=>array('Category.parent_Id'=>$industry_id),'fields'=>array('Category.id','Category.name'),'order'=>array('Category.name'=>'ASC')));
			$this->set(compact('dep'));
		}
		if(isset($this->params['url']) && isset($this->params['url']['department_id']) && !empty($this->params['url']['department_id']))
		{
			$department_id = $this->params['url']['department_id'];
			$ndata['department_id'] = $department_id;
			$condition[] =  array("Employee.department_id " =>$department_id);
			$jt = $this->Category->find('list',array('conditions'=>array('Category.parent_Id'=>$department_id),'fields'=>array('Category.id','Category.name'),'order'=>array('Category.name'=>'ASC')));
			$this->set(compact('jt'));
		}
		if(isset($this->params['url']) && isset($this->params['url']['job_title_id']) && !empty($this->params['url']['job_title_id']))
		{
			$job_title_id = $this->params['url']['job_title_id'];
			$ndata['job_title_id'] = $job_title_id;
			$condition[] =  array("Employee.job_title_id " =>$job_title_id);
			
		}
		if(isset($this->params['url']) && isset($this->params['url']['created']) && !empty($this->params['url']['created']))
		{
			
			$days = $this->params['url']['created'];
			$today = date("Y-m-d  h:i:s", time());
			$pastdate =date("Y-m-d 00:00:00", strtotime("-".$days." day"));
			$condition[]= array('Employee.created BETWEEN ? AND ?' => array($pastdate, $today));
			$ndata['created'] = $days;
		}
		
		
		$this->set('filterData', $ndata);
		$this->loadModel('Country');
		$i = $this->Category->find('list',array('conditions'=>array('Category.parent_Id'=>0),'fields'=>array('Category.id','Category.name'),'order'=>array('Category.name'=>'ASC')));
		$this->set(compact('i'));
		$this->set('MenuHead','Employee Form');
    	$this->set('title_for_layout', 'Employee listing : '.WEBTITLE);
    	$this->loadModel('Employee');
		$this->paginate = array('recursive'=>1, 'limit' => 15,'conditions' => $condition, 'order' => array('Employer.name' => 'ASC'));
		$data = $this->paginate('Employee');
		$this->set('data', $data);
    }
	
	public function back_delete_employee($id = null) {
    	$this->autoRender = false;
		$this->loadModel('Employee');
		if(!empty($id)){
		
			$d = $this->Employee->find('first',array('conditions'=>array('id'=>$id)));
			if(!empty($d)){
				$this->Employee->id = $d['Employee']['id'];
				$this->Employee->delete();
			}
			echo "<script>setTimeout(function(){ window.location.href ='".SITEURL."back/labs/all_employee'; }, 100);</script>";
		}
    }
	
	public function back_view_employee($id) {
    	$this->set('MenuHead','Employer Detail');
    	$this->set('title_for_layout', 'Employee Form : '.WEBTITLE);
    	$this->loadModel('Employee');
		if(!empty($id)){
			$this->Employee->bindModel(array('belongsTo'=>array('User')));
			$data = $this->Employee->find('first',array('conditions'=>array('Employee.id'=>$id)));
			if($data)
			{
				$this->set('data', $data);
			}
			else{ $this->layout = 'lab_404';}
		}
		else{ $this->layout = 'lab_404';}
		
    }
	
	public function back_all_users() {
    	$this->set('MenuHead','menu_user');
    	$this->set('title_for_layout', 'All Users List : '.WEBTITLE);
    	
    	if(isset($this->request->query['del']) && !empty($this->request->query['del'])){
    		$e = $this->User->find('first',array('recursive'=>-1,'conditions'=>array('User.id'=>$this->request->query['del'])));
    		if(!empty($e)){
				$id = $this->request->query['del'];
				$this->loadModel('Employee');
				$this->loadModel('Employer');
    			$this->User->id = $e['User']['id'];
				$this->User->delete();
				
				$this->Employee->deleteAll(['Employee.user_id'=>$id]);
				
				$this->Employer->deleteAll(['Employer.user_id'=>$id]);
				
    		}
    		$this->redirect(SITEURL."back/labs/all_users");
    	}
    	
    	if(isset($this->request->query['up_st']) && !empty($this->request->query['up_st'])){
    		$e = $this->User->find('first',array('recursive'=>-1,'conditions'=>array('User.id'=>$this->request->query['up_st'])));
    		if(!empty($e)){
    			
    			if($e['User']['role'] == 2){ $st = 3;}
    			elseif($e['User']['role'] == 3){ $st = 2;}
    			if(isset($st) && !empty($st)){
	    			$arr = array('id'=>$e['User']['id'],'role'=>$st);
	    			$this->User->save($arr);
    			}
    		}
    		$this->redirect(SITEURL."back/labs/all_users");
    	}
    	
    	if(isset($this->request->query['st']) && !empty($this->request->query['st'])){

    		$e = $this->User->find('first',array('conditions'=>array('User.id'=>$this->request->query['st'])));
    	
    		if(!empty($e)){

    			$st = 1;
    			if($e['User']['status'] == 1){ $st = 0;}
    			elseif($e['User']['status'] == 0){ $st = 1;}
    			$arr = array('id'=>$e['User']['id'],'status'=>$st);
    			$this->User->save($arr);
    			}else{
    				$this->Session->setFlash(__('can not be deactive. user added some website'), 'default', array('class' => 'alert alert-danger'), 'msg');
    				$this->redirect(array('controller' => 'labs', 'action' => 'all_users'));
    				
    			}
    		$this->redirect($this->referer());
    	}
    	$a = array(2,3);
    	$this->paginate = array('recursive'=>2,
    			'limit' => 50,
    			'conditions' => array('User.role' => $a,'User.role !='=>1),
    			'order' => array('User.created' => 'DESC'));
    	$data = $this->paginate('User');
    	$this->set('data', $data);
    }
	
	
	public function back_sort_category()
	{
		$this->autoRender = false;
		if($this->RequestHandler->isAjax()){
      
			if(isset($this->data['list']) && !empty($this->data['list'])){
				foreach($this->data['list'] as $key => $val) {
					$arr[] = array( 'id'=>$val,'sort_order'=>$key);
				}
				$this->Category->saveAll($arr);
			}
			
		}
	}
	
} 
