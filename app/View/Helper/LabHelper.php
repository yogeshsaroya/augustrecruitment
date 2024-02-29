<?php

class LabHelper extends AppHelper {
	
	

	public function get_ind($id = null){
		$t = ClassRegistry::init('Category');
		$list = array();
		$list = $t->find('list',array('conditions'=>array('Category.parent_Id'=>$id),'fields'=>array('Category.id','Category.name'),'order'=>array('Category.name'=>'ASC')));
		return $list;
	}
	
	public function getCatName($id = null){
		$t = ClassRegistry::init('Category');
		$list = array();
		$list = $t->find('first',array('conditions'=>array('Category.id'=>$id),'fields'=>array('Category.id','Category.name')));
		return $list;
	}

	
	public function replaceUrlParam($url, $find, $replace){
		if (preg_match("/\b".$find."\b/i", $url, $match))
		{
			return str_replace($find,$replace,$url);
		} else {
			return $url;
		}
	}
	

	public function getDesignation (){
		return array('mr'=>'MR','ms'=>'MS','mrs'=>'MRS');
	}
	
	public function getEmp1(){
		return array('1-10'=>'1-10','10-50'=>'10-50','50-250'=>'50-250','250-500'=>'250-500','500-1000'=>'500-1000','>1000'=>'>1000');
	}
	public function getEmp2 (){
		return array('1-5'=>'1-5','5-25'=>'5-25','>100'=>'>100');
	}
	
	public function getHowManyEmp (){
		$a = array();
		for($i=1; $i<=10; $i++){ $a[$i]= $i; }
		return $a;
	}
	
	public function getEducation (){
	
		return array('high school'=>'High School','graduate'=>'Graduate','post graduate'=>'Post Graduate');
	}
	
	
	public function getCountry(){ 
		
		$t = ClassRegistry::init('Country');
		$d = $t->find('list',array('recursive'=>-1,'order'=>array('Country.short_name'), 'fields'=>array('Country.id','Country.short_name')));
		return $d;
	}
	
	public function checkDevice ( $type = NULL ) {
        $user_agent = strtolower ( $_SERVER['HTTP_USER_AGENT'] );
        if ( $type == 'bot' ) {
                // matches popular bots
                if ( preg_match ( "/googlebot|adsbot|yahooseeker|yahoobot|msnbot|watchmouse|pingdom\.com|feedfetcher-google/", $user_agent ) ) {
                        return true;
                        // watchmouse|pingdom\.com are "uptime services"
                }
        } else if ( $type == 'browser' ) {
                // matches core browser types
                if ( preg_match ( "/mozilla\/|opera\//", $user_agent ) ) {
                        return true;
                }
        } else if ( $type == 'mobile' ) {
                // matches popular mobile devices that have small screens and/or touch inputs
                // mobile devices have regional trends; some of these will have varying popularity in Europe, Asia, and America
                // detailed demographics are unknown, and South America, the Pacific Islands, and Africa trends might not be represented, here
                if ( preg_match ( "/phone|iphone|itouch|ipod|symbian|android|htc_|htc-|palmos|blackberry|opera mini|iemobile|windows ce|nokia|fennec|hiptop|kindle|mot |mot-|webos\/|samsung|sonyericsson|^sie-|nintendo/", $user_agent ) ) {
                        // these are the most common
                        return true;
                } else if ( preg_match ( "/mobile|pda;|avantgo|eudoraweb|minimo|netfront|brew|teleca|lg;|lge |wap;| wap /", $user_agent ) ) {
                        // these are less common, and might not be worth checking
                        return true;
                }
        }
        return false;
	}


   
}?>