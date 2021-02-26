<?php
namespace App\Controllers;
use App\Models\UserModel; 
use App\Models\PaymentMethodModel as Pay; 



class Users extends BaseController
{
	//login
	public function index()
	{
		$data = []; 
		helper(['form']);
		
		if($this->request->getMethod() == 'post'){
			//validation rules for login
			// remember: 'validate_user' is a custom rule I made. Look it in 'App\Validation\UserRules'
			$rules = [	'email' => 'required|min_length[6]|max_length[50]|valid_email',
						'password' => 'required|min_length[8]|max_length[255]|validate_user[email, password]', 
					]; 
			$errors = [	'password' => ['validate_user' => 'Email or password don\'t match']
					]; 
			
			if(!$this->validate($rules, $errors)){
				//if it does not validate
				$data['validationResult'] = $this->validator; 
			}
			else{
				//successful validation - save user-data to session
				$model = new UserModel(); 
				$user = $model->getUserByField('email', $this->request->getVar('email')); 
				$this->setCustomerToSession($user); 
				
				$rrv = $this->session->get('returnAfterRedirect'); 
				if(!empty($rrv)){
					unset($_SESSION['returnAfterRedirect']);
					return redirect()->to($rrv); 
				}
				else{
					return redirect()->to('/users/orders');
				}
			}
		}
		
		//view
		echo view('templates/header', $data);
		echo view('users/login', ); 
		echo view('templates/footer');		
	}
	
	
	
	public function register()
	{
		$data = []; 
		$pm = new Pay();
		$data['pay_methods'] = $pm->getMethodNames();  
		helper(['form']);
		
		if($this->request->getMethod() == 'post'){
			//validation rules for registration
			$model = new UserModel(); 
			$rules = [	'firstname' => 'required|min_length[3]|max_length[20]', 
						'lastname' => 'required|min_length[3]|max_length[20]', 
						'email' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[' . $model->table . '.email]',
						'phone' => 'required|min_length[10]|max_length[12]',
						'password' => 'required|min_length[8]|max_length[255]', 
						'password_confirm' => 'matches[password]', 
					]; 
			
			if(!$this->validate($rules)){
				$data['validationResult'] = $this->validator; 
			}
			else{
				//everything ok. store user info
				$newUser = 	[ 'firstname' => $this->request->getVar('firstname'), 
							  'lastname' => $this->request->getVar('lastname'), 
							  'email' => $this->request->getVar('email'), 
							  'phone' => $this->request->getVar('phone'), 
							  'pay_method' => $this->request->getVar('pay_method'), 
							  'password' => $this->request->getVar('password'), 
							  'address' => trim($this->request->getVar('address')), 
							]; 
				$model->save($newUser); 
				$this->session->setFlashdata('successRegistration', 'Registration was successful. Please login'); 
				
				return redirect()->to('/users/login');
			}
		}
		
		echo view('templates/header', $data);
		echo view('users/register', ); 
		echo view('templates/footer');
	}
	
	
	
	//for customer to see account information but for updating as well
	public function account()
	{
		if($this->user)
		{
			//logged in
			$data = []; 
			$pm = new Pay();
			$data['pay_methods'] = $pm->getMethodNames();  
			helper(['form']);
			
			if($this->request->getMethod() == 'post'){
				$model = new UserModel(); 
				//validation rules
				$rules = [	'firstname' => 'required|min_length[3]|max_length[20]', 
							'lastname' => 'required|min_length[3]|max_length[20]', 
							'phone' => 'required|min_length[10]|max_length[12]'
						]; 
				
				//change password only if the user was actually trying to change it
				if($this->request->getPost('password') != ''){
					$rules['password'] = 'required|min_length[8]|max_length[255]'; 
					$rules['password_confirm'] = 'required|min_length[8]|max_length[255]'; 
				}
				
				
				//build an array with the information submitted
				$newUser = [ 'id' => $this->session->get('user')['id'], 
							 'firstname' => $this->request->getPost('firstname'), 
							 'lastname' => $this->request->getPost('lastname'), 
							 'phone' => $this->request->getPost('phone'), 
							 'pay_method' => $this->request->getPost('pay_method'), 
							 'address' => $this->request->getPost('address'), 
							]; 
				//same idea as before... if the user does not want to change password... 
				if($this->request->getPost('password') != ''){
					$newUser['password'] = $this->request->getPost('password'); 
				}				
				
				
				if(!$this->validate($rules)){
					//not good
					$data['validationResult'] = $this->validator; 
					$newUser['email'] = $this->session->get('user')['email']; 
					$data['user'] = $newUser; 
				}
				else{
					//everything ok. store user info
					$model->save($newUser); 
					
					//save to session and 
					$newUser['email'] = $this->session->get('user')['email']; 
					$this->setCustomerToSession($newUser); 
					$this->session->setFlashdata('successUpdateAccount', 'Update was successful'); 
					
					return redirect()->to('/users/account');
				}
			}
			else{
				//just show user information
				$data['user'] = $this->session->get('user'); 
			}
			
			echo view('templates/header', $data);
			echo view('users/account', ); 
			echo view('templates/footer');
		}
		else{
			//not logged in
			$this->session->setFlashdata('flash', 'You have to log in'); 
			return redirect()->to('/users/login'); 
		}
	}
	
	
	
	public function orders()
	{
		
		if($this->user)
		{
			$data = ['orders' => []]; 
			
			$model = new UserModel(); 
			$orders = $model->getUserOrders($this->user['id']); 
			$data['orders'] = $orders; 
			
			echo view('templates/header', $data);
			echo view('users/orders', ); 
			echo view('templates/footer');
		}
		else{
			$this->session->setFlashdata('flash', 'You have to log in'); 
			return redirect()->to('/users/login'); 
		}
	}
	
	
	
	public function logout()
	{
		if($this->user){
			$this->session->remove('user'); 
		}
		if(!empty($this->session->get(CART))){
			$this->session->setFlashdata('flash', 'You still have items in your cart'); 
		}
		return redirect()->to('/users/login'); 
	}
	
	
	
	private function setCustomerToSession($user)
	{
		$data['user'] = [	'id' => $user['id'], 
							'firstname' => $user['firstname'], 
							'lastname' => $user['lastname'], 
							'email' => $user['email'], 
							'phone' => $user['phone'], 
							'pay_method' => $user['pay_method'], 
							'address' => $user['address'], 
							'isLoggedIn' => true, 
							'type' => 'customer'
						]; 
		
		$this->session->set($data); 
		
		return true; 
	}
}