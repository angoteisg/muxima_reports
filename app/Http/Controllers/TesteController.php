<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class TesteController extends Controller
{

    public function index(){
        
        //$users = User::where('id', 1)->get()->first();

        $empregados = \DB::connection('sqlsrv')->select("SELECT * FROM Artigo");

        dd($empregados);

        echo "<pre>"; 
        print_r($empregados);
        print_r($users);
        exit();
    }
}
