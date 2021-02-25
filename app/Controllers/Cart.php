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
	
	
	
	
	public function add($fid = null)
	{
		$cart = $this->session->get(CART); 
		if(!isset($cart[$fid])){
			$cart[$fid] = '1'; 
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
		
		if(!$this->request->isAJAX()){
			return redirect()->back(); 
		}
	}
	
	
	
	public function changeQty($fid, $newQty)
	{
		$cart = $this->session->get(CART); 
		if(isset($cart[$fid])){
			$cart[$fid] = $newQty; 
			$this->session->set(CART, $cart); 
			return '1';
		}
		return '0';
	}
	
	
	
	public function empty()
	{
		$cart = $this->session->get(CART); 
		$cart = []; 
		$this->session->set(CART, $cart); 
		
		return redirect()->back(); 
	}
	
}