<?php
App::uses('AppController', 'Controller');
class PagesController extends AppController
{
	var $uses = array('User', 'EmailTemplate', 'Employer', 'Country', 'Category', 'Employee', 'JobTitle');
	var $components = array('Auth', 'Session', 'Email', 'RequestHandler', 'Paginator', 'DATA');
	var $helpers = array('Html', 'Form', 'Session', 'Paginator');
	function beforeFilter()
	{
		AppController::beforeFilter();
		$this->Auth->allow();
	}

	public function index()
	{
		$this->set('title_for_layout', 'Home : ' . WEBTITLE);
	}

	public function privacy_policy()
	{
		$this->set('title_for_layout', 'Privacy Policy : ' . WEBTITLE);
	}

	public function tnc()
	{
		$this->set('title_for_layout', 'Terms and conditions : ' . WEBTITLE);
	}

	public function title()
	{
		$this->autoRender = false;
		if ($this->RequestHandler->isAjax() && !empty($this->data)) {
			if (isset($this->data['total']) && !empty($this->data['total'])) {

				$ind = $this->Category->find('list', array('conditions' => array('Category.parent_Id' => 0), 'fields' => array('Category.id', 'Category.name'), 'order' => array('Category.sort_order' => 'ASC')));
				$this->set('num', $this->data['total']);
				$this->set('ind', $ind);
				$this->render('title');
			}
		}
	}

	public function employer_enrollment($id = null)
	{
		$this->set('title_for_layout', 'employer enrollment : ' . WEBTITLE);

		$i = $this->Category->find('list', array('conditions' => array('Category.parent_Id' => 0), 'fields' => array('Category.id', 'Category.name'), 'order' => array('Category.sort_order' => 'ASC')));
		$code = $this->Country->find('list', array('order' => array('Country.short_name' => 'ASC'), 'fields' => array('Country.calling_code', 'Country.short_name')));
		$this->set(compact('i', 'code'));



		if ($this->Auth->user('id') != '' && $this->Auth->user('role') == 3) {
			$this->redirect('/');
		}

		if (isset($id) && $this->Auth->user('id') != "") {
			$this->Employer->bindModel(array('belongsTo' => array('User'), 'hasMany' => array('JobTitle')));
			$d = $this->Employer->find('first', array('conditions' => array('Employer.id' => $id, 'Employer.user_id' => ME)));
			$this->set(compact('d'));
		}


		if ($this->RequestHandler->isAjax() && !empty($this->data)) {
			$s = "<script>$('#sendrequest').prop('disabled',false); $('#sendrequest').val('Save');</script>";
			$rCAP = '<script>grecaptcha.reset();</script>';
			$jobTitle = $jobTitleArr = array();
			$pwd = rand(123456, 987654);
			$this->request->data['User']['password'] = $pwd;


			$this->request->data['Employer']['first_name'] = $this->request->data['User']['first_name'];
			$this->request->data['Employer']['last_name'] = $this->request->data['User']['last_name'];
			$this->request->data['Employer']['email'] = $this->request->data['User']['email'];

			$this->request->data['User']['role'] = 2;
			$this->request->data['User']['status'] = 0;
			$this->request->data['User']['verification_code'] = base64_encode($this->request->data['User']['email']);
			$this->request->data['User']['verification_status'] = 0;

			/* echo $s; echo $rCAP; */


			$e = 0;
			if (isset($this->data['JobTitle']) && !empty($this->data['JobTitle'])) {
				foreach ($this->data['JobTitle'] as $jList) {
					if (empty($jList['industry_id']) && empty($jList['department_id']) && empty($jList['job_title_id'])) {
						$e++;
					}
				}

				foreach ($this->data['JobTitle'] as $jList1) {
					$jb = $jList1;
					$jb['industry'] = $this->DATA->getCategory($jList1['industry_id']);
					$jb['department'] = $this->DATA->getCategory($jList1['department_id']);
					$jb['job_title'] = $this->DATA->getCategory($jList1['job_title_id']);
					$jobTitle[] = $jb;
				}
			} else {
				/* echo $rCAP; echo $s;  echo '<div class="alert alert-danger fadeIn animated">Please Select how many employees you are looking to make today?</div>'; exit; */
			}

			if ($e > 0) {
				echo $rCAP;
				echo $s;
				echo '<div class="alert alert-danger fadeIn animated">Please Select Industry / department / job title</div>';
				exit;
			}


			if (isset($this->data['g-recaptcha-response']) && !empty($this->data['g-recaptcha-response'])) {
				$u  = "https://www.google.com/recaptcha/api/siteverify?secret=" . DataSecret . "&response=" . $this->data['g-recaptcha-response'] . "&remoteip=" . $_SERVER['REMOTE_ADDR'];
				$response = @file_get_contents($u);
				$arr = json_decode($response, true);
				if (isset($arr['success'])) {

					if ($this->Auth->user('id') == '') {
						$this->User->set($this->request->data);
						if ($this->User->validates()) {
							$this->User->save($this->request->data);
							$lid = $this->User->getLastInsertId();
						} else {
							$str = null;
							$errors = $this->User->validationErrors;
							if (!empty($errors)) {
								foreach ($errors as $err) {
									$str .= $err[0] . "<br>";
								}
								echo $rCAP;
								echo $s;
								echo '<div class="alert alert-danger fadeIn animated">' . $str . '</div>';
							}
						}
					} else {
						$lid = $this->Auth->user('id');
					}

					if (isset($lid) && !empty($lid)) {

						$this->request->data['Employer']['user_id'] = $lid;
						$this->Employer->save($this->request->data);
						if (!isset($this->data['Employer']['id'])) {
							$eid = $this->Employer->getLastInsertId();

							$link = SITEURL . "users/verify?e=" . $this->request->data['User']['verification_code'];
							$parameters = array('NAME' => $this->request->data['User']['first_name'], 'EMAIL' => $this->request->data['User']['email'], 'PASSWORD' => $pwd, 'LINK' => $link, 'TYPE' => 'Employer');
							$this->DATA->AppMail($this->request->data['User']['email'], 'FromRec', $parameters, DATE);
							$WebSetting = $this->Session->read('WebSetting');
							if (isset($WebSetting['WebSetting']['email']) && !empty($WebSetting['WebSetting']['email'])) {
								$this->DATA->AppMail(employerEmail, 'newUserAdmin', $parameters, DATE);
							}
							$l_msg = 'Thank you for taking the time to fill out our enrollment form!<br><br> To complete your email verification process and to complete enrollment on our site, please follow the link in the verification email sent to you at the email address you entered in your application. Following email verification, you will be able to log in to our website and change or update your personal and professional details at your own discretion.<br>';
						} else {
							$eid = $this->data['Employer']['id'];
						}

						foreach ($jobTitle as $Alist) {
							$Alist['employer_id'] = $eid;
							$jobTitleArr[] = $Alist;
						}
						if (!empty($jobTitleArr)) {
							$this->JobTitle->saveMany($jobTitleArr);
						}
						$pr = '<div class="container clearfix"><div class="alert alert-success"><blockquote>' . $l_msg . ' We appreciate your visit to our website and for enrolling with August and we wish you the best of luck in your quest to find a great placement!<br><br> Yours truly,<br> August Hospitality Recruitment Team </blockquote></div></div>';
						echo "<script>$('#preview1').html('" . $pr . "');  $('#dfrm').remove(); $('#sendrequest').remove();</script>";
					} else {
						echo $s;
						echo $rCAP;
						echo '<div class="alert alert-danger fadeIn animated">Please try again latter.</div>';
					}
				} else {
					echo $s;
					echo $rCAP;
					echo "<div class='alert alert-danger'>Please verify that you are not a robot.</div>";
				}
			} else {
				echo $s;
				echo $rCAP;
				echo "<div class='alert alert-danger'>Please verify that you are not a robot.</div>";
			}
			exit;
		}
	}

	public function employee_enrollment($id = null)
	{
		$this->set('title_for_layout', 'employee enrollment : ' . WEBTITLE);

		if ($this->Auth->user('id') != '' && empty($id)) {
			$f = $this->Employee->find('first', array('conditions' => array('Employee.user_id' => ME)));
			if (!empty($f)) {
				$this->redirect('/accounts/my_form/');
			}
		}

		if ($this->Auth->user('id') != '' && $this->Auth->user('role') == 2) {
			$this->redirect('/');
		}
		$i = $this->Category->find('list', array('conditions' => array('Category.parent_Id' => 0), 'fields' => array('Category.id', 'Category.name'), 'order' => array('Category.sort_order' => 'ASC')));
		$code = $this->Country->find('list', array('order' => array('Country.short_name' => 'ASC'), 'fields' => array('Country.calling_code', 'Country.short_name')));
		$this->set(compact('i', 'code'));
		if (isset($id) && $this->Auth->user('id') != "") {
			$this->Employee->bindModel(array('belongsTo' => array('User')));
			$d = $this->Employee->find('first', array('conditions' => array('Employee.id' => $id, 'Employee.user_id' => ME)));
			if (!empty($d)) {
				$dep = $this->Category->find('list', array('conditions' => array('Category.parent_Id' => $d['Employee']['industry_id']), 'fields' => array('Category.id', 'Category.name'), 'order' => array('Category.sort_order' => 'ASC')));
				$jt = $this->Category->find('list', array('conditions' => array('Category.parent_Id' => $d['Employee']['department_id']), 'fields' => array('Category.id', 'Category.name'), 'order' => array('Category.sort_order' => 'ASC')));
			}
			$this->set(compact('d', 'dep', 'jt', 'c'));
		}

		if ($this->RequestHandler->isAjax() && !empty($this->data)) {
			$s = "<script>$('#sendrequest').prop('disabled',false); $('#sendrequest').val('Save');</script>";
			$rCAP = '<script>grecaptcha.reset();</script>';

			$format = array('image/x-png', 'image/png', 'image/jpeg', 'application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document');

			if (isset($this->data['Employee']['cv']['name']) && !empty($this->data['Employee']['cv']['name'])) {
				if (in_array($this->data['Employee']['cv']['type'], $format)) {
					if (!file_exists('cdn/cv')) {
						mkdir('cdn/cv', 0777, true);
					}
					$ext = pathinfo($this->data['Employee']['cv']['name'], PATHINFO_EXTENSION);
					$name = uniqid('emp_cv_');
					$f_name = $name . '.' . $ext;
					$destination1 = 'cdn/cv/' . $f_name;
					$r1_full_path = SITEURL . $destination1;
					try {
						if (move_uploaded_file($this->data['Employee']['cv']['tmp_name'], $destination1)) {
							if (file_exists($destination1)) {
								$size = filesize($destination1);
								$mb = ($size / 1024) / 1024;
								if ($mb > 1) {
									echo $s;
									echo $rCAP;
									echo '<div class="alert alert-danger fadeIn animated">File size cannot be bigger than 1MB</div>';
									die;
								} else {
									$this->request->data['Employee']['my_cv'] = $f_name;
								}
							}
						}
					} catch (Exception $e) {
					}
				}
				unset($this->request->data['Employee']['cv']);
			}

			if (!empty($this->data['Employee']['industry_id'])) {
				$d = $this->Category->find('first', array('conditions' => array('Category.id' => $this->data['Employee']['industry_id']), 'fields' => array('Category.id', 'Category.name')));
				if (!empty($d)) {
					$this->request->data['Employee']['industry'] = $d['Category']['name'];
				}
			}


			if (!empty($this->data['Employee']['field_id'])) {
				$d6 = $this->Category->find('first', array('conditions' => array('Category.id' => $this->data['Employee']['field_id']), 'fields' => array('Category.id', 'Category.name')));
				if (!empty($d6)) {
					$this->request->data['Employee']['field'] = $d6['Category']['name'];
				}
			}

			if (!empty($this->data['Employee']['department_id'])) {
				$d1 = $this->Category->find('first', array('conditions' => array('Category.id' => $this->data['Employee']['department_id']), 'fields' => array('Category.id', 'Category.name')));
				if (!empty($d1)) {
					$this->request->data['Employee']['department'] = $d1['Category']['name'];
				}
			}

			if (!empty($this->data['Employee']['job_title_id'])) {
				$d2 = $this->Category->find('first', array('conditions' => array('Category.id' => $this->data['Employee']['job_title_id']), 'fields' => array('Category.id', 'Category.name')));
				if (!empty($d2)) {
					$this->request->data['Employee']['job_title'] = $d2['Category']['name'];
				}
			}

			if (!empty($this->data['Employee']['nationality_id'])) {
				$d3 = $this->Country->find('first', array('conditions' => array('Country.id' => $this->data['Employee']['nationality_id'])));
				if (!empty($d3)) {
					$this->request->data['Employee']['nationality'] = $d3['Country']['short_name'];
				}
			}



			$pwd = rand(123456, 987654);
			$this->request->data['User']['password'] = $pwd;

			$this->request->data['Employee']['job_title_other'] = $this->request->data['Employee']['job_title_other'];

			$this->request->data['Employee']['first_name'] = $this->request->data['User']['first_name'];
			$this->request->data['Employee']['middle_name'] = $this->request->data['User']['middle_name'];
			$this->request->data['Employee']['last_name'] = $this->request->data['User']['last_name'];
			$this->request->data['Employee']['email'] = $this->request->data['User']['email'];
			$this->request->data['User']['role'] = 3;
			$this->request->data['User']['status'] = 0;
			$this->request->data['User']['verification_code'] = base64_encode($this->request->data['User']['email']);
			$this->request->data['User']['verification_status'] = 0;


			if (isset($this->data['g-recaptcha-response']) && !empty($this->data['g-recaptcha-response'])) {
				$u  = "https://www.google.com/recaptcha/api/siteverify?secret=" . DataSecret . "&response=" . $this->data['g-recaptcha-response'] . "&remoteip=" . $_SERVER['REMOTE_ADDR'];
				$response = @file_get_contents($u);
				$arr = json_decode($response, true);
				
				if (isset($arr['success'])) {

					if ($this->Auth->user('id') == '') {
						$this->User->set($this->request->data);
						if ($this->User->validates()) {
							$this->User->save($this->request->data);
							$lid = $this->User->getLastInsertId();
						} else {
							$str = null;
							$errors = $this->User->validationErrors;
							if (!empty($errors)) {
								foreach ($errors as $err) {
									$str .= $err[0] . "<br>";
								}
								echo $rCAP;
								echo $s;
								echo '<div class="alert alert-danger fadeIn animated">' . $str . '</div>';
							}
						}
					} else {
						$lid = $this->Auth->user('id');
					}

					if (isset($lid) && !empty($lid)) {
						$this->request->data['Employee']['user_id'] = $lid;
						$this->Employee->save($this->request->data);

						if (!isset($this->data['Employee']['id'])) {
							$link = SITEURL . "users/verify?e=" . $this->request->data['User']['verification_code'];
							$parameters = array('NAME' => $this->request->data['User']['first_name'], 'EMAIL' => $this->request->data['User']['email'], 'PASSWORD' => $pwd, 'LINK' => $link, 'TYPE' => 'Employee');
							$this->DATA->AppMail($this->request->data['User']['email'], 'EmployeeForm', $parameters, DATE);

							if (isset($WebSetting['WebSetting']['email']) && !empty($WebSetting['WebSetting']['email'])) {
								$this->DATA->AppMail(candidateEmail, 'newUserAdmin', $parameters, DATE);
							}

							$l_msg = 'Thank you for taking the time to fill out our enrollment form!<br><br> To complete your email verification process and to complete enrollment on our site, please follow the link in the verification email sent to you at the email address you entered in your application.<br> Following verification, if you have entered employment requests in your enrollment form, a member of our team will get in touch with you soon.  You will also be able to log in to our website and submit further employment requests at your own discretion as well as change or update your personal and professional details.  If you have not entered in any employment requests, you can do so at any time after email verification by signing in to your account and making a new request.<br>';
						}
						$pr = '<div class="container clearfix"><div class="alert alert-success"><blockquote>' . $l_msg . ' We appreciate your visit to our website and we look forward to a long and productive relationship with both yourself and your organization!<br><br>Yours truly,<br> August Hospitality Recruitment Team</blockquote></div></div>';
						echo "<script>$('#preview1').html('" . $pr . "'); $('#dfrm').remove(); $('#sendrequest').remove();</script>";
					} else {
						echo $s;
						echo $rCAP;
						echo '<div class="alert alert-danger fadeIn animated">Please try again latter.</div>';
					}
				} else {
					echo $s;
					echo $rCAP;
					echo "<div class='alert alert-danger'>Please verify that you are not a robot.</div>";
				}
			} else {
				echo $s;
				echo $rCAP;
				echo "<div class='alert alert-danger'>Please verify that you are not a robot.</div>";
			}
			exit;
		}
	}



	public function job()
	{
		$this->autoRender = false;
		if ($this->RequestHandler->isAjax() && !empty($this->data)) {
			$d = $t = array();
			if ($this->data['type'] == 2) {
				$i = $this->Category->find('all', array('conditions' => array('Category.parent_Id' => $this->data['id']), 'order' => array('Category.sort_order' => 'ASC')));
				if (!empty($i)) {
					foreach ($i as $iList) {
						$t[" " . $iList['Category']['id']] = $iList['Category']['name'];
					}
					if (!empty($t)) {
						echo json_encode($t);
					} else {
						echo json_encode($d);
					}
				} else {
					echo json_encode($d);
				}
			}
		}
	}


	/**
	 * run per min
	 * send email notification
	 * */
	public function send_email()
	{
		$this->autoRender = false;
		$current_date = DATE;
		$last_date = date("Y-m-d", strtotime("-7 day", strtotime(DATE)));
		$this->loadModel('EmailServer');
		$data = $this->EmailServer->find('all', array('recursive' => -1, 'conditions' => array('OR' => array(array('EmailServer.status' => 0), array('EmailServer.status' => 2))), 'limit' => 10));

		$num = 1;
		if (!empty($data)) {
			foreach ($data as $d) {

				if (filter_var($d['EmailServer']['email_to'], FILTER_VALIDATE_EMAIL)) {

					if (!empty($d['EmailServer']['email_to']) && !empty($d['EmailServer']['email_from']) && !empty($d['EmailServer']['subject'])) {
						$this->Email->sendAs = 'html';
						$this->Email->from = $d['EmailServer']['email_from'];
						$this->Email->to = $d['EmailServer']['email_to'];
						$this->Email->subject = $d['EmailServer']['subject'];

						try {
							$this->Email->send($d['EmailServer']['message']);
							if ($d['EmailServer']['status'] == 0) {
								$this->EmailServer->updateAll(array('EmailServer.status' => 1), array('EmailServer.id' => $d['EmailServer']['id']));
							} elseif ($d['EmailServer']['status'] == 2) {
								$this->EmailServer->updateAll(array('EmailServer.status' => 3), array('EmailServer.id' => $d['EmailServer']['id']));
							}
							$num++;
						} catch (Exception $e) {
							//return $e->getMessage();
							$this->EmailServer->updateAll(array('EmailServer.status' => 5), array('EmailServer.id' => $d['EmailServer']['id']));
							$this->THmail->cron('Error gn email', 'unexpected error with email cron id : ' . $d['EmailServer']['id']);
						}
					} else {
						$this->EmailServer->updateAll(array('EmailServer.status' => 5), array('EmailServer.id' => $d['EmailServer']['id']));
						$this->THmail->cron('Error gn email', 'unexpected error with email cron id : ' . $d['EmailServer']['id']);
					}
				}
			}
			echo "total " . $num . " has been send  <hr> thank you  <br>";
		} else {
			echo "No email <hr> thank you  <br>";
		}
	}

	public function my_mail($id = null)
	{
		$this->autoRender = false;
		$this->loadModel('EmailServer');

		$this->paginate = array('limit' => 100, 'order' => array('EmailServer.id' => 'desc'));
		$data = $this->paginate("EmailServer");
		if (!empty($data)) {
			foreach ($data as $m) {
				ec($m['EmailServer']['email_to'] . " : " . $m['EmailServer']['subject']);
				ec($m['EmailServer']['message']);
			}
		}
	}
}
