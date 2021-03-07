<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index() {

        $fame = "Robin hood Panday";
        $age = "70";
//        return view('home', compact('fame', 'age'));
//        return view('home')
//                ->with('fame', $fame)
//                ->with('age', $age);
        return view('home', [
            'fame'=>$fame,
            'age'=>$age
        ]);


    }

    public function add() {
        return 'Hello About';
    }
}
