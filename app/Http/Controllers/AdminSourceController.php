<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AdminSourcesRequest;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Source;
use Redirect;

class AdminSourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $sources = Source::all();
        return view('admin.sources.index')->with('sources',$sources);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.sources.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(AdminSourcesRequest $request)
    {
        $source = $request->All();
        // if a thumbnail is uploaded send file to be processed (cropped, resized ..etc), else, use twitter's thumb.
        if ($request->hasFile('thumb')) {
            $this->dispatchFrom('\App\Jobs\processUploadedThumbs', $request);
        }else {
            $this->dispatchFrom('\App\Jobs\processTwitterThumbs', $request);
        }

        $result = Source::Create($source);

        // now associate channels

        $channels = $request->channels;
        $result->channels()->sync($channels);

        return Redirect::Route('admin.sources.index')->withMessage('Success!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $source= Source::findOrFail($id);
        return View('admin.sources.show')->with(compact('source'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $source= Source::findOrFail($id);
        return View('admin.sources.edit')->with(compact('source'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(AdminSourcesRequest $request, $id)
    {
        $source = Source::findOrFail($id);

        // if a thumbnail is uploaded send file to be processed (cropped, resized ..etc) using our custom handler
        if ($request->hasFile('thumb')) {
            $this->dispatchFrom('\App\Jobs\processUploadedThumbs', $request);
        }
        
        $source->update($request->All());

        // now update channels

        $channels = $request->channels;
        $source->channels()->sync($channels);

        return Redirect::Route('admin.sources.index')->withMessage('Success!');

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
