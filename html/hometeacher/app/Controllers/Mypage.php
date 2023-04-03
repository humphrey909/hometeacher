<?php 
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\Main_model;
class Mypage extends BaseController
{

	public function __construct()
    {
    }
    
    public function index()
    {
    //svete와 연동
    return view("../../../svelte/public/index.html");
    }
    public function edit()
    {
        return view("../../../svelte/public/index.html");
    }
    public function rank()
    {
        return view("../../../svelte/public/index.html");
    }
    public function like()
    {
        return view("../../../svelte/public/index.html");
    }
    public function write()
    {
        return view("../../../svelte/public/index.html");
    }
    public function comment()
    {
        return view("../../../svelte/public/index.html");
    }
    public function makegamelist()
    {
        return view("../../../svelte/public/index.html");
    }
    public function makegameinfo()
    {
        return view("../../../svelte/public/index.html");
    }
    public function makegametest()
    {
        //echo "wef";
        return view("../../../svelte/public/index.html");
       
       //return view("main");
    }

    




}
