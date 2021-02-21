<?php
namespace App\Models; 
use CodeIgniter\Model; 



class MenuModel extends Model
{
	protected $table = 'foods'; 
	
	
	
	public function getMenu($fid = null)
	{
		if(!$fid){
			return $this->findAll();
		}
		
		return $this->asArray()
					->where(['id' => $fid])
					->findAll(); 
	}
	
	
	
}
?>
