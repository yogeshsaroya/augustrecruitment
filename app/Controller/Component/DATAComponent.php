<?php
class DATAComponent extends Component {
    public $components = array('Session');


    public function getCategory($id = null){
    	$t = ClassRegistry::init('Category');
    	$name = null;
    	$d = $t->find('first',array('conditions'=>array('Category.id'=> $id),'fields'=>array('Category.id','Category.name')));
    	if(isset($d['Category']['name']) && !empty($d['Category']['name'])){ 
    		$name = $d['Category']['name']; 
    	}
    	return  $name;
    }

    
    function RandomString($length = 10 ){
    	$keys = array_merge(range(0,9), range('a', 'z')); 
    	$key = ""; 
    	for($i=0; $i < $length; $i++) {  $key .= $keys[mt_rand(0, count($keys) - 1)]; } 
    	return $key;
    }
    
    function CleanHtml($str = null) {
        $str = htmlspecialchars_decode(html_entity_decode($str));
        return $str;
    }

    function ClearStr($str = null) {
        $str = str_replace('\n', '', $str);
        $str = str_replace('\r', '', $str);
        $str = str_replace('\r\n', '', $str);
        $str = stripslashes_deep(trim($str));

        return $str;
    }

    function getBrowser() {
        $u_agent = $_SERVER['HTTP_USER_AGENT'];
        $bname = 'Unknown';
        $platform = 'Unknown';
        $ub = $version = "";

        //First get the platform?
        if (preg_match('/linux/i', $u_agent)) {
            $platform = 'linux';
        } elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
            $platform = 'mac';
        } elseif (preg_match('/windows|win32/i', $u_agent)) {
            $platform = 'windows';
        }
        // Next get the name of the useragent yes seperately and for good reason
        if (preg_match('/MSIE/i', $u_agent) && !preg_match('/Opera/i', $u_agent)) {
            $bname = 'Internet Explorer';
            $ub = "MSIE";
        } elseif (preg_match('/Firefox/i', $u_agent)) {
            $bname = 'Mozilla Firefox';
            $ub = "Firefox";
        } elseif (preg_match('/Chrome/i', $u_agent)) {
            $bname = 'Google Chrome';
            $ub = "Chrome";
        } elseif (preg_match('/Safari/i', $u_agent)) {
            $bname = 'Apple Safari';
            $ub = "Safari";
        } elseif (preg_match('/Opera/i', $u_agent)) {
            $bname = 'Opera';
            $ub = "Opera";
        } elseif (preg_match('/Netscape/i', $u_agent)) {
            $bname = 'Netscape';
            $ub = "Netscape";
        }

        // finally get the correct version number
        $known = array('Version', $ub, 'other');
        $pattern = '#(?<browser>' . join('|', $known) .
                ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
        if (!preg_match_all($pattern, $u_agent, $matches)) {
            // we have no matching number just continue
        }

        // see how many we have
        $i = count($matches['browser']);
        if ($i != 1) {
            //we will have two since we are not using 'other' argument yet
            //see if version is before or after the name
            if (strripos($u_agent, "Version") < strripos($u_agent, $ub)) {
                $version = $matches['version'][0];
            } else {
                $version = $matches['version'][1];
            }
        } else {
            $version = $matches['version'][0];
        }

        // check if we have a number
        if ($version == null || $version == "") {
            $version = "?";
        }

        return array(
            'userAgent' => $u_agent,
            'name' => $bname,
            'version' => $version,
            'platform' => $platform,
            'pattern' => $pattern
        );
    }

    public function SaveGetBrowser($tbl = null, $id = null) {
        $rt = 0;
        if (!empty($tbl) && !empty($id)) {
            $model = ClassRegistry::init($tbl);
            $ua = $this->getBrowser();
            $yourbrowser = "browser: " . $ua['name'] . " " . $ua['version'] . " on " . $ua['platform'] . " reports: <br >" . $ua['userAgent'];
            if ($model->updateAll(array($tbl . '.user_browser' => "'$yourbrowser'"), array($tbl . '.id' => $id))) {
                $rt = 1;
            }
        }
        return $rt;
    }

   
	/**
	 * compress image
	 * @paran source file path, destination path and qulity
	 * @return destination path
	 * */
	function compress_image($source_url, $destination_url, $quality = 100) {
		$r = 1;
		if(file_exists($source_url)){
			$info = getimagesize($source_url);
			if ($info['mime'] == 'image/jpeg'){ 
				$image = imagecreatefromjpeg($source_url);
				imagejpeg($image, $destination_url, $quality);
			}
			elseif ($info['mime'] == 'image/gif'){ 
				$image = imagecreatefromgif($source_url);
				imagejpeg($image, $destination_url, $quality);
			}
			elseif ($info['mime'] == 'image/png'){
				copy($source_url, $destination_url);
				/*
				$image = imagecreatefrompng($source_url);
				imagepng($image, $destination_url, 9);
				imagejpeg($image, $destination_url, $quality);
				*/
			}
			else{ $r = 0;}
	
			if($r == 1){
				//imagejpeg($image, $destination_url, $quality);
			}
		}
		
		//return destination file url
		return $r;
	}
	public function EmailTemplateSkeleton($s = null){
	
		$t = '<html><head><title></title></head><body><div id="ssSub" class="notification" align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="min-width: 320px;"><tr><td align="center" bgcolor="#eff3f8"><!--[if gte mso 10]><table width="680" border="0" cellspacing="0" cellpadding="0"><tr><td><![endif]--><table border="0" cellspacing="0" cellpadding="0" class="table_width_100" width="100%" style="max-width: 680px; min-width: 300px;"> <tr><td><!-- padding --><div style="height: 80px; line-height: 80px; font-size: 10px;"> </div></td></tr> <!--header --><tr><td align="center" bgcolor="#ffffff"><!-- padding --><div style="height: 30px; line-height: 30px; font-size: 10px;"> </div><table width="90%" border="0" cellspacing="0" cellpadding="0"><tr><td align="left"><!--Item --><div class="mob_center_bl" style=""><table class="mob_center" width="115" border="0" cellspacing="0" cellpadding="0" align="left" style="border-collapse: collapse;"><tr><td align="left" valign="middle"><!-- padding --><div style="height: 20px; line-height: 20px; font-size: 10px;"> </div><table width="115" border="0" cellspacing="0" cellpadding="0" ><tr><td align="left" valign="top" class="mob_center"><a href="#" target="_blank" style="color: #596167; font-family: Arial, Helvetica, sans-serif; font-size: 13px;"><font face="Arial, Helvetica, sans-seri; font-size: 13px;" size="3" color="#596167"><img src="http://corelogictech.com/gforce/img/logo.png" alt="" border="0" style="display: block;width: 200px;" /></font></a></td></tr></table></td></tr></table></div><!-- Item END--><!--[if gte mso 10]></td><td align="right"><![endif]--><!--Item --><div class="mob_center_bl" style="float: right; display: inline-block; width: 88px;"><table width="88" border="0" cellspacing="0" cellpadding="0" align="right" style="border-collapse: collapse;"><tr><td align="right" valign="middle"><!-- padding --><div style="height: 20px; line-height: 20px; font-size: 10px;"> </div><table width="100%" border="0" cellspacing="0" cellpadding="0" ><tr><td align="right"></td></tr></table></td></tr></table></div><!-- Item END--></td></tr></table><!-- padding --><div style="height: 50px; line-height: 50px; font-size: 10px;"> </div></td></tr><!--header END--><!--content 1 --><tr><td bgcolor="#fbfcfd" style="padding: 20px;font-family: Arial, Helvetica, sans-serif; color: #57697e;">[TEMPLATE_TEXT]</td></tr><!--content 1 END--><!--footer --><tr><td class="iage_footer" align="center" bgcolor="#ffffff"><!-- padding --><div style="height: 80px; line-height: 80px; font-size: 10px;"> </div><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td align="center"><font face="Arial, Helvetica, sans-serif" size="3" color="#96a5b5" style="font-size: 13px;"><span style="font-family: Arial, Helvetica, sans-serif; font-size: 13px; color: #96a5b5;">[CYEAR] &copy; '.WEBTITLE.' </span></font></td></tr></table><!-- padding --><div style="height: 30px; line-height: 30px; font-size: 10px;"> </div></td></tr><!--footer END--><tr><td><!-- padding --><div style="height: 80px; line-height: 80px; font-size: 10px;"> </div></td></tr></table><!--[if gte mso 10]></td></tr></table><![endif]--></td></tr></table></div><div style="display:none; white-space:nowrap; font:15px courier; color:#ffffff;">- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -</div></body></html>';
		$t = str_replace('[TEMPLATE_TEXT]', $s, $t);
		return $t;
	}
	
	public function EmailServers($to = null, $from = null, $sub = null, $body = null,$dateTime = DATE) {
		$msg = 0;
		$today_year = date("Y");
		$today_date = date("j F, Y", strtotime(TODAYDATE));
	
		if (!empty($to) && !empty($from) && !empty($body)) {
			$emails = ClassRegistry::init('EmailServer');
			$body = $this->EmailTemplateSkeleton($body);
			$body = str_replace('[CYEAR]', $today_year, $body);
			$body = str_replace('[DATE]', $today_date, $body);
			$body = str_replace('[WEBNAME]', WEBTITLE, $body);
			
			try{
				$emails->create();
				$emails->set('email_to', $to);
				$emails->set('email_from', $from);
				$emails->set('subject', $sub);
				$emails->set('message', $body);
				$emails->set('created', $dateTime);
				$emails->save(null, false);
				$msg = 1;
				 
			} catch (Exception $e) {}
	
			
		}
		return $msg;
	}
	
	/**send email */
	public function AppMail($to, $type, $parameters = array(),$dateTime = DATE) {
		if(!empty($to) && !empty($type)){
		$mdata = ClassRegistry::init('EmailTemplate');
		$today_date = date("j F, Y", strtotime(TODAYDATE));
		$today_year = date("Y");
		$emailformat = $mdata->find('first', array('conditions' => array('EmailTemplate.type' => $type,'EmailTemplate.status'=>1)));
		if (!empty($emailformat)) {
			$sub = $emailformat['EmailTemplate']['subject'];
			foreach ($parameters as $param_name => $param_value) { $sub = str_replace('[' . $param_name . ']', $param_value, $sub); }
			$body = $emailformat['EmailTemplate']['message'];
			foreach ($parameters as $param_name => $param_value) { $body = str_replace('[' . $param_name . ']', $param_value, $body); }
			$from = $emailformat['EmailTemplate']['sender_name'] . "<" . $emailformat['EmailTemplate']['email'] . ">";
			$this->EmailServers($to, $from, $sub, $body,$dateTime);
		}
		return true;
		}
	}
	
	
	public function parse_yturl($url)
	{
		$pattern = '#^(?:https?://|//)?(?:www\.|m\.)?(?:youtu\.be/|youtube\.com/(?:embed/|v/|watch\?v=|watch\?.+&v=))([\w-]{11})(?![\w-])#';
		preg_match($pattern, $url, $matches);
		return (isset($matches[1])) ? $matches[1] : false;
	}
	
	public function crypto_rand_secure($min, $max)
	{
		$range = $max - $min;
		if ($range < 1) return $min; // not so random...
		$log = ceil(log($range, 2));
		$bytes = (int) ($log / 8) + 1; // length in bytes
		$bits = (int) $log + 1; // length in bits
		$filter = (int) (1 << $bits) - 1; // set all lower bits to 1
		do {
			$rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
			$rnd = $rnd & $filter; // discard irrelevant bits
		} while ($rnd > $range);
		return $min + $rnd;
	}
	public function getToken($length)
	{
		$token = "";
		$codeAlphabet = "0123456789";
		$codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
	
		$max = strlen($codeAlphabet); // edited
	
		for ($i=0; $i < $length; $i++) {
			$token .= $codeAlphabet[ $this->crypto_rand_secure(0, $max-1)];
		}
	
		return $token;
	}
	
	function Get_Lat_lng($address = null) {
		$map_code = array();
		if (!empty($address)) {
			$prepAddr = str_replace(' ', '+', $address);
			$geocode = file_get_contents('http://maps.google.com/maps/api/geocode/json?address=' . $prepAddr . '&sensor=false');
			$output = json_decode($geocode, true);
			if ($output['status'] == 'OK') {
				$lat = $output['results'][0]['geometry']['location']['lat'];
				$lng = $output['results'][0]['geometry']['location']['lng'];
				$map_code = array('status' => 'ok', 'lat' => $lat, 'lng' => $lng);
				
			}
		} 
		return $map_code;
	}
	
}
?>