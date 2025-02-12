<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function indexAbout()
    {
        $profile = [
            'name' => 'John Doe',
            'email' => 'HcK8e@example.com',
            'phone' => '123-456-7890',
            'address' => '123 Main St, Springfield, IL 62701',
        ];
        return view('about', ['profile' => $profile]);
    }
}
