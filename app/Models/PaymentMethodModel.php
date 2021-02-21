<?php
namespace App\Models;
use CodeIgniter\Model; 

class PaymentMethodModel extends Model
{
	protected $table = 'pay_methods'; 
	public $methods = []; 
	
	
	public function __construct(...$params)
	{
		parent::__construct(...$params);
		$this->methods = $this->findAll(); 
	}
	
	
	public function getMethodName($id)
	{
		foreach($this->methods as $method){
			if($method['id'] == $id){
				return $method['name']; 
			}
		}
	}
	
	
	public function getMethod($id)
	{
		foreach($this->methods as $method){
			if($method['id'] == $id){
				return $method; 
			}
		}
	}
	
	
	public function getMethodNames()
	{
		return $this->methods; 
	}
	
	
}	
