<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlogRequest;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    // public function __construct() {
    //     $this->middleware('auth');
    // }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::check()) {
            $categories = Category::get();
            return view('theme.blogs.create', compact('categories'));
        }
        abort(403);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::user()->id;
        // For Uploading Image
        // 1- get the image
        $image = $request->image;
        // 2- Change current name
        $newImageName = time() . '-' . $image->getClientOriginalName();
        // 3- move image to my project
        $image->storeAs('blogs', $newImageName, 'public');
        // 4- store the new image in db
        $data['image'] = $newImageName;
        // dd($data);
        Blog::create($data);
        return back()->with('storeBlogStatus', 'New Blog Has Stored Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        return view('theme.blog', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        //
    }

    public function myBlogs()
    {
        if(Auth::check()) {
            $blogs = Blog::where('user_id', Auth::user()->id)->paginate(4);
            return view('theme.user-blogs', compact('blogs'));
        } else {
            return view('theme.login');
        }
    }
}
