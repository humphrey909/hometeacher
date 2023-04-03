<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
    echo "home232342";
    $data = ['name' => 'humphrey', 'age' => 30];
    //return view("/main.php", $data);
        //return view('welcome_message');
    }
    public function main(){
        echo "123123";
    }
}
