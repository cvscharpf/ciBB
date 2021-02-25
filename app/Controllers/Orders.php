<?php
namespace App\Controllers;
use App\Models\MenuModel; 
use App\Models\OrderModel; 


class Orders extends BaseController
{
	protected $menuModel; 
	protected $orderModel; 
	
	
	public function __construct()
	{
		$this->menuModel = new MenuModel(); 
		$this->orderModel = new OrderModel(); 	
	}

	
	
	public function checkout()
	{
/*
		echo '<pre>';
		var_dump($_POST);
		echo '</pre>';
		echo '<br />';
		
		$data = []; 
		$itemsInCart = $this->session->get(CART); 
		foreach($itemsInCart as $id => $item){
					$data[] = $this->menuModel->getMenu($id)[0]; 
				}		
		
		
		echo '<pre>';
		var_dump($data);
		echo '</pre>';
		echo '<br />';
		
		
		echo '<pre>';
		var_dump($this->session->get(CART));
		echo '</pre>';
		echo '<br />';
		
*/
		$data = []; 
		$contents = []; 
		helper(['form']);
		
		if($this->user){
			$itemsInCart = $this->session->get(CART); 
			if(empty($itemsInCart)){
				//nothing to check out -- redirect
				return redirect()->to('/menu/'); 
			}
			else{
				$data['itemsInCart'] = []; 
				foreach($itemsInCart as $id => $qty){
					$data['itemsInCart'][] = $this->menuModel->getMenu($id)[0]; 
					$contents[] = ['f_id' => $id, 'qty' => $qty]; 
				}
				$data['userAddress'] = $this->user['address']; 				
				
				
				if($this->request->getMethod() == 'post'){
					//form was submitted
					$rules = ['deliveryType' => 'required', 'time' => 'required']; 
					if($this->request->getPost('deliveryType') == 'pickup'){
						$rules['carDescription'] = 'required|min_length[3]';  
					}
					else{
						$rules['deliveryAddress'] = 'required|min_length[3]'; 
					}
					
					if(!$this->validate($rules)){
						//show the form and error messages
						$data['validationResult'] = $this->validator; 
					}
					else{
						//success -- send to payment
						$newOrder = [ 
							'cust_id' => $this->user['id'], 
							'car_description' => $this->request->getVar('carDescription'), 
							'delivery_address' => $this->request->getVar('deliveryAddress'), 
							'timePref' => date('Y-m-d H:i', strtotime($this->request->getVar('time'))), 
							'deliveryType' => $this->request->getVar('deliveryType'), 
							'total' => $this->request->getVar('orderTotal'), 
							'completed' => 0, 
							'cancelled' => 0, 
							'ready' => 0, 
							'contents' => $contents
						]; 
						if($newOrder['deliveryType'] == 'pickup'){
							$newOrder['delivery_address'] = null; 
						}
						
						$orderId = $this->orderModel->registerOrder($newOrder); 
						return redirect()->to('/orders/payment')->with('orderId', $orderId);
					}
				}
				//display the form
				
				echo view('templates/header');
				echo view('orders/checkout', $data);
				echo view('templates/footer');
			}
		}
		else{
			$this->session->setFlashdata('flash', 'You have to be logged in, to complete that action'); 
			$this->session->set('returnAfterRedirect', 'orders/checkout'); 
			return redirect()->to('/users/login'); 
		}
	}
	
	
	
	public function payment()
	{
		$orderId = $this->session->get('orderId'); 
		
		
		
		if(empty($orderId)){
			$this->session->setFlashdata('flash', 'You do not have access there'); 
			return redirect()->to('/');
		}
		
		$order = $this->orderModel->getOrder($orderId); 
		
		$data['orderId'] = $orderId; 
		$data['orderTotal'] = $order['total']; 
		
		
		echo view('templates/header');
		echo view('orders/payment', $data);
		echo view('templates/footer');
	}
	
	
	
	public function confirmation()
	{
		if($this->request->getMethod() == 'post'){
			$orderId = $this->request->getVar('orderId'); 
			if(is_numeric($orderId)){
				$this->orderModel->completeOrder($orderId); 
				$order = $this->orderModel->getOrder($orderId); 
				$data = ['order' => $order]; 
			}
			$this->session->set(CART, []);
			
			echo view('templates/header');
			echo view('orders/confirmation', $data);
			echo view('templates/footer');
		}
	}
	
	
	public function createPdf($orderInfo)
	{
		$order = $this->orderModel->getOrder($orderInfo); 
		$mpdf = new \Mpdf\Mpdf(); 
		
		$text = '
	<div style="width: 80%; margin: auto; padding: 20px; font-size: 11px;">
		<div style="margin: 20px 0px 60px 0px; font-size: 4em;">
			Order Receipt
		</div>
		<div style="margin: 20px 0px 40px 0px;">
			Thank you for your order.<br />
			This confirms that your order was placed successfully and it is now being processed. Please keep this for your records. 
		</div>
		<div style="margin-top: 20px; margin-bottom: 20px; ">
			<table cellpadding="10" style="font-size: 11px;">
				<tr>
					<th>Name</th>
					<th>Total</th>
					<th>Date</th>
					<th>Info</th>
				</tr>
				<tr>
					<td>' . $this->user['firstname'] . ' ' . $this->user['lastname'] . '</td>
					<td>$' . number_format($order['total'], 2) . '</td>
					<td>' . $order['created'] . '</td>
					<td>
						<div>
							Delivery type: ' . $order['deliveryType'] . '<br />'; 
		if($order['deliveryType'] == 'pickup'){
			$text .= 'Car description: ' . $order['car_description'] . '<br />
					  Pickup time: ' . $order['timePref'] . '<br />'; 
		}
		else{
			$text .= 'Delivery address: ' . $order['delivery_address'] . '<br />
					  Delivery time: ' . $order['timePref'] . '<br />'; 
		}
		$text .= '
						</div>
					</td>
				</tr>
			</table>
		</div>
	</div>
	<br /><br />'; 
		
		
		$mpdf->WriteHTML($text); 
		$mpdf->Output('order_' . $orderInfo . '.pdf', 'D');
	}
	
}
