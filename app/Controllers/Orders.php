<?php
namespace App\Controllers;
use App\Models\MenuModel; 
use App\Models\OrderModel; 



class Orders extends BaseController
{
	public function checkout()
	{
		$data['itemsInCart'] = []; 
		foreach($this->session->get(CART) as $id => $item){
			$data['itemsInCart'][] = $this->model->getMenu($id)[0]; 
		}
		
		echo view('templates/header');
		echo view('cart/main', $data);
		echo view('templates/footer');
	}


}
