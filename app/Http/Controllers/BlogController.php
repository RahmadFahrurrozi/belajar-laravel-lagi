<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
// use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function indexBlog(Request $request)
    {
        $search = $request->input('search');
        $author = $request->input('author');

        $blogs = DB::table('blogs')->orderBy('id', 'desc')
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

    public function addBlog()
    {
        return view('add_blog');
    }

    public function createBlog(Request $request)
    {
        // Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:10240', // Maksimal 10MB
        ]);

        // Simpan data ke database
        DB::table('blogs')->insert([
            'title' => $request->title,
            'author' => $request->author,
            'content' => $request->content,
            'description' => $request->description,
            'image' => $request->image, 
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        if($request->hasFile('image')) {
            $request->file('image')->store('public/images');
        }
        //buat pesan sukses
        // $request->Session()->flash('success', 'Blog berhasil ditambahkan');
        Session::flash('success', 'Blog added successfully');

        // Redirect ke halaman blog
        return redirect()->route('blog');
    }

    public function showBlog($id) {
        $blog = DB::table('blogs')->where('id', $id)->first();
        if(!Blog::find($id)) {
            abort(404);
        }
        return view('show_detail_blogs', ['blog' => $blog]);
    }

    public function editBlog($id) {
        $blog = DB::table('blogs')->where('id', $id)->first();
        if(!Blog::find($id)) {
            abort(404);
        }
        return view('edit_blog', ['blog' => $blog]);
    }
    public function updateBlog(Request $request, $id) {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:10240', // Maksimal 10MB
        ]);
        $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('public/images');
            }
        DB::table('blogs')->where('id', $id)->update([
            'title' => $request->title,
            'author' => $request->author,
            'content' => $request->content,
            'description' => $request->description,
            'image' => $imagePath, 
            'updated_at' => now(),
        ]);

        Session::flash('success', 'Blog updated successfully');
        return redirect()->route('blog');
    }
    public function deleteBlog($id) {
        DB::table('blogs')->where('id', $id)->delete();
        Session::flash('success', 'Blog deleted successfully');
        return redirect()->route('blog');
    }
}