<?php
namespace App\Models;
use CodeIgniter\Model; 


class OrderModel extends Model
{
	protected $table = 'orders'; 
	protected $itemsTable = 'orders_contents'; 
	protected $primaryKey = 'id';
	protected $useAutoIncrement = true;
    protected $returnType = 'array';
	protected $allowedFields = ['cust_id', 'created', 'car_description', 'delivery_address', 'timePref', 'deliveryType', 'total', 'priority', 'completed', 'cancelled', 'ready']; 
	protected $createdField = 'created';
	
	
	
	
	public function getOrder($oid)
	{
		return $this->getOrderByField('id', $oid);
	}
	
	
	public function registerOrder($data)
	{
		$contents = $data['contents']; 
		unset($data['contents']); 
		$this->save($data); 
		$orderId = $this->getInsertID();
		
		//record cart contents
		$db = \Config\Database::connect(); 
		$builder = $db->table($this->itemsTable);
		foreach($contents as $item){
			$item['o_id'] = $orderId; 
			$builder->insert($item);
		}
		
		return $orderId;
	}
	
	
	public function completeOrder($oid)
	{
		$this->set('completed', 1, false)
			 ->where('id', $oid)
			 ->update();
		
	}
	
	
	private function getOrderByField($field, $value)
	{
		$order = $this->where([$field => $value])
					 ->first();
		
		return $order;   
	}
	
	
}
