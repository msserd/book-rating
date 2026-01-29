<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class AboutController extends Controller
{
    public function index()
    {
        $integer = 123;
        $string = 'Строка';
        $array = [
            'Это', 
            'тестовый', 
            'массив', 
            'из', 
            'строк'
        ];
        $assocArray = [
            'firstName' => 'Иван',
            'lastName' => 'Иванов',
            'age' => 23,
            'gender' => 'male'
        ];

        return Inertia::render('About', [
            'integer' => $integer,
            'string' => $string,
            'array' => $array,
            'assocArray' => $assocArray,
        ]);
    }
}
