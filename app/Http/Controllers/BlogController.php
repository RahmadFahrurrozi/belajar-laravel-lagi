<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    public function indexBlog(Request $request)
    {
        $search = $request->input('search');
        $author = $request->input('author');

        $blogs = DB::table('blogs')
            ->when($search, function ($query, $search) {
                return $query->where('title', 'LIKE', '%' . $search . '%')
                             ->orWhere('content', 'LIKE', '%' . $search . '%');
            })
            ->when($author, function ($query, $author) {
                return $query->where('author', 'LIKE', '%' . $author . '%');
            })
            ->paginate(10);

        return view('blog', ['blogs' => $blogs, 'author' => $author, 'search' => $search]);
    }
}