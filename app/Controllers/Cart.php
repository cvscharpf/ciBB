<?php
namespace App\Controllers;
use App\Models\MenuModel; 


class Cart extends BaseController
{
	protected $model; 
	
	
	public function __construct()
	{
		$this->model = new MenuModel(); 
		
	}
	
	
	
	public function main($op = null, $fid = null)
	{
		if($op){
			return $this->{$op}($fid); 
		}
		
		
		//else, show what's in cart
		$data['itemsInCart'] = []; 
		foreach($this->session->get(CART) as $id => $item){
			$data['itemsInCart'][] = $this->model->getMenu($id)[0]; 
		}
		
		echo view('templates/header');
		echo view('cart/main', $data);
		echo view('templates/footer');
	}
	
	
	protected function total()
	{
		return 100; 
	}
	
	
	public function add($fid = null)
	{
		$cart = $this->session->get(CART); 
		if(!isset($cart[$fid])){
			$cart[$fid] = 'some info about product with id ' . $fid; 
			$this->session->set(CART, $cart); 
			$this->session->setFlashdata('flash', 'Your product was added to Cart'); 
		}
		
		return redirect()->back(); 
	}
	
	
	public function remove($fid = null)
	{
		$cart = $this->session->get(CART); 
		if(isset($cart[$fid])){
			unset($cart[$fid]); 
			$this->session->set(CART, $cart); 
		}
		
		return redirect()->back(); 
	}
	
	
	public function empty()
	{
		
		return null; 
		
	}
	
	
	public function checkout()
	{
		if($this->user){
			$data = []; 
			
			
			echo view('templates/header');
			echo view('cart/checkout', $data);
			echo view('templates/footer');
		}
		else{
			$this->session->setFlashdata('flash', 'You have to be logged in, to complete that action'); 
			return redirect()->to('/users/login'); 
		}
		
	}
	
	
	
	
}