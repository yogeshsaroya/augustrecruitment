<?php
App::uses('Sanitize', 'Utility', 'Model');
class User extends Model {
	
	
	public $hasOne = array();
    
    public $validate = array(
        'email' => array(
            'email' => array( 'rule' => 'email', 'message' => 'Please provide a valid email address.'),
            'isUnique' => array( 'rule' => 'isUnique','message' => 'Email address already in use.')),
        'first_name' => array( 'first_name' => array('rule' => 'notBlank', 'message' => 'First name cannot be left blank.',),
            'pattern' => array( 'rule' => '/^[A-Za-z ]*$/', 'message' => 'Only letters allowed')),
        
    	'last_name' => array( 'last_name' => array('rule' => 'notBlank', 'message' => 'Last name cannot be left blank.',),
            'pattern' => array( 'rule' => '/^[A-Za-z ]*$/', 'message' => 'Only letters allowed')),
        'password' => array( 'notBlank' => array( 'rule' => array('notBlank'), 'allowEmpty' => false, 'message' => 'Please enter password', ),
       			'minLength' => array( 'rule' => array('minLength', '6'), 'field' => 'login', 'message' => 'Minimum 6 characters' ) ),
		
    );

    public function beforesave($pwd = null) {
        if (!empty($this->data['User']['password'])) {
            $this->data['User']['password'] = md5($this->data['User']['password']); }
        if (!empty($this->data['User']['first_name'])) {
            $this->data['User']['first_name'] = ucwords(strtolower($this->data['User']['first_name'])); }
        if (!empty($this->data['User']['last_name'])) {
            $this->data['User']['last_name'] = ucwords(strtolower($this->data['User']['last_name'])); }
        if (!empty($this->data['User']['email'])) {
            $this->data['User']['email'] = strtolower($this->data['User']['email']); }
    }
    
    public function afterFind($results, $primary = false) {
    	$key = key($results);
    
    	if(is_int($key)){
    		
    		foreach ($results as $key => $val) {
    			if (isset($val['User']['first_name']) && isset($val['User']['last_name'])) {
    				$results[$key]['User']['full_name'] = trim($val['User']['first_name'])." ".trim($val['User']['last_name']); }
    		}
    	}
    	else{
    			if (isset($results['first_name']) && isset($results['last_name'])) {
    				$results['full_name'] = trim($results['first_name'])." ".trim($results['last_name']); }
    	}
    
    	return $results;
    }

    function unbindModelAll() {
        foreach (array(
    'hasOne' => array_keys($this->hasOne),
    'hasMany' => array_keys($this->hasMany),
    'belongsTo' => array_keys($this->belongsTo),
    'hasAndBelongsToMany' => array_keys($this->hasAndBelongsToMany) ) as $relation => $model) { $this->unbindModel(array($relation => $model)); }
    }

}

