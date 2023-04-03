<?php 
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\Main_model;
class Pwsearch extends BaseController
{

	public function __construct()
    {
    }
    
    public function index()
    {
    //svete와 연동
    return view("../../../svelte/public/index.html");
    }
}
