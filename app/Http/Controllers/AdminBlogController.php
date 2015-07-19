<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AdminBlogsRequest;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Blog;
use Redirect;

class AdminBlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $blogs = Blog::all();
        return view('admin.blogs.index')->with('blogs',$blogs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(AdminBlogsRequest $request)
    {
        $blog = $request->All();

        // if a thumbnail is uploaded send file to be processed (cropped, resized ..etc) using our custom handler
        if ($request->hasFile('thumb')) {
            $this->dispatchFrom('\App\Jobs\processUploadedThumbs', $request);
        }

        $success = Blog::Create($blog);
        return Redirect::Route('admin.blogs.index')->withMessage('Success!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $blog= Blog::findOrFail($id);
        return View('admin.blogs.show')->with(compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $blog= Blog::findOrFail($id);
        return View('admin.blogs.edit')->with(compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(AdminBlogsRequest $request, $id)
    {
        $blog = Blog::findOrFail($id);

        // if a thumbnail is uploaded send file to be processed (cropped, resized ..etc) using our custom handler
        if ($request->hasFile('thumb')) {
            $this->dispatchFrom('\App\Jobs\processUploadedThumbs', $request);
        }
        
        $blog->update($request->All());
        return Redirect::Route('admin.blogs.index')->withMessage('Success!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
