<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		echo view('templates/header');
		echo view('home/main');
		echo view('templates/footer');
	}
	
	
	
	public function about()
	{
		echo view('templates/header');
		echo view('home/about');
		echo view('templates/footer');
	}
}