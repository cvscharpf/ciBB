<?php
namespace App\Controllers;
use App\Models\MenuModel; 


class Menu extends BaseController
{
	protected $model; 
	
	public function __construct()
	{
		$this->model = new MenuModel(); 
	}
	
	
	
	public function main($fid = null)
	{
		$data['menu'] = $this->model->getMenu($fid); 
		
		
		
		echo view('templates/header', $data);
		echo view('menu/main');
		echo view('templates/footer');
	}
	
	
}