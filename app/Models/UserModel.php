<?php
namespace App\Models;
use CodeIgniter\Model; 
use App\Models\PaymentMethodModel as PayMethod; 



class UserModel extends Model
{
	protected $table = 'customers'; 
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