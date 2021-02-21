<?php 
namespace App\Validation; 
use App\Models\UserModel; 


// I had to add this class to Config\Validation's class,  $ruleSets array, 
// so the system can find it with the others... 


class UserRules
{
	public function validate_user(string $str, string $fields, array $data)
	{
		//find in db the user that matches the given email
		$model = new UserModel(); 
		$user = $model->where('email', $data['email'])
					  ->first(); 
		
		//if no such email in db, return false
		if(!$user){
			return false; 
		}
		
		//if email found, check the password given at login with the one saved in db
		return password_verify($data['password'], $user['password']); 
	}
	
	
	
}
?>