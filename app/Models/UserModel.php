<?php
namespace App\Models;
use CodeIgniter\Model; 
use App\Models\PaymentMethodModel as PayMethod; 



class UserModel extends Model
{
	protected $table = 'customers'; 
	protected $ordersTable = 'orders'; 
	protected $itemsTable = 'orders_contents'; 
	protected $foodsTable = 'foods'; 
	protected $primaryKey = 'id';
	protected $useAutoIncrement = true;
    protected $returnType = 'array';
	protected $allowedFields = ['firstname', 'lastname', 'email', 'phone', 'address', 'password', 'pay_method', 'created', 'last_in']; 
	protected $createdField = 'created';
    protected $updatedField = 'last_in';
	protected $beforeInsert = ['beforeInsert']; 
	protected $beforeUpdate = ['beforeUpdate']; 
	
	
	
	public function getUserByField($field, $value)
	{
		$user = $this->where([$field => $value])
					 ->first();
		
		$pm = new PayMethod(); 
		$user['pay_method'] = $this->getPaymentMethod($user['pay_method']);
		
		return $user;   
	}
	
	
	private function getPaymentMethod($pid)
	{
		$pm = new PayMethod(); 
		return $pm->getMethod($pid);
		
	}
	
	
	public function getUserOrders($uid)
	{
		$db = db_connect();
		$res = $db->query('SELECT o.*, i.qty, f.food_name, f.price, f.image 
							FROM ' . $this->ordersTable . ' AS o 
								RIGHT JOIN ' . $this->itemsTable . ' AS i ON i.o_id = o.id 
								RIGHT JOIN ' . $this->foodsTable . ' AS f on i.f_id = f.id  
							WHERE o.cust_id = ?', [$uid]);
		$orders = []; 
		
		foreach($res->getResult() as $row){
			if(array_key_exists($row->id, $orders)){
				$orders[$row->id]['food'][] = ['name' => $row->food_name, 'price' => $row->price, 'image' => $row->image, 'qty' => $row->qty]; 
			}
			else{
				//$orders[$row->id] = []; 
				$orders[$row->id]['info'] = ['id' => $row->id, 'created' => $row->created, 'car_description' => $row->car_description, 'delivery_address' => $row->delivery_address, 'timePref' => $row->timePref, 'deliveryType' => $row->deliveryType, 'total' => $row->total, 'ready' => $row->ready]; 
				$orders[$row->id]['food'][] = ['name' => $row->food_name, 'price' => $row->price, 'image' => $row->image, 'qty' => $row->qty]; 
			}
		}
		return $orders; 
	}
	


	
	//this will be called before every insert
	//$data contains all the data passed from the controller
	//keep in mind that you actually have   $data['data']
	protected function beforeInsert(array $data)
	{
		$data = $this->passwordHash($data); 
		
		return $data; 
	}
	
	
	//this will be called before every update
	protected function beforeUpdate(array $data)
	{
		$data = $this->passwordHash($data); 
		
		return $data; 
	}
	
	
	
	protected function passwordHash(array $data)
	{
		if(isset($data['data']['password'])){
			$data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT); 
		}
		return $data; 
	}
}

?>