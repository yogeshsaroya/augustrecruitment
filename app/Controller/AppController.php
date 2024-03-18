<?php
App::uses('Sanitize', 'Utility', 'Controller', 'Controller');
class AppController extends Controller {

    var $uses = array('User','WebSetting');
    public $components = array('Flash','Auth','Cookie', 'Session', 'RequestHandler', 'Email','DATA');
    public $helpers = array('Html', 'Form', 'JqueryEngine', 'Session', 'Text', 'Time','Lab');
    
    function beforeFilter() {
        die('Hello');
        $url = Router::url(null,true);
        /* redirect to www */
        /*
        $url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $ur = str_replace("http://www.", "http://", $url);
        $pos = strpos($url, 'www');
        
        if ($pos === false) { 
            
            if ( !$this->RequestHandler->isSSL()) {
                $this->redirect('https://' . env('SERVER_NAME') . $this->here);
            }
            
        } else {
            $this->redirect($ur);
        }
        */
        
        /* end */
    	
    	if (isset($this->params['prefix']) && $this->params['prefix'] == 'back') {
            $this->layout = 'back'; 
            if ( $this->Auth->User('role') == 2) {
                unset($this->params['prefix']);
               $this->redirect('/');
            }
            
            
        }
        if (!isset($this->params['prefix']) && $this->params['prefix'] != 'back') {
            $this->params['prefix'];
            if ($this->Auth->user('id') != "") {
            	if (!defined('ME')) { define("ME", $this->Auth->user('id')); }
            } else {
                if (!defined('ME')){ define("ME", null);}
            }
        }
        
        $WebSetting = $this->WebSetting->find('first', array('conditions' => array('WebSetting.id' => 1)));
        if (!empty($WebSetting)) { 
        	$this->set('WebSetting', $WebSetting);
        	$this->Session->write('WebSetting', $WebSetting); }
        
        $this->set('IsMap', 'yes');
        if ($this->RequestHandler->isMobile()) { $this->set('IsMobile', 'yes'); }
        
        
    }

    //set layout for any error
    //function _setErrorLayout() { if ($this->name == 'CakeError') { $this->layout = '404'; } }
   	//function beforeRender () {$this->_setErrorLayout();	}
}
