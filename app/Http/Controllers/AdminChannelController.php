<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AdminChannelRequest;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Channel;
use Redirect;
class AdminChannelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('admin.channels.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        // build list of options for parent channel
        $options = $this->getOptions();

        return view('admin.channels.create')->with(['options'=>$options]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(AdminChannelRequest $request)
    {
        $newChannel = Channel::create([
            'shorthand'=> $request->shorthand,
            'description'=> $request->description,
            'color'=>$request->color
        ]);

        $newChannel->parent()->associate($request->parent_id);
        $newChannel->save();

        return Redirect::Route('admin.channels.index')->withMessage('Success!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        // build list of options for parent channel
        $options = $this->getOptions();

        $channel = Channel::findOrFail($id);
        return View('admin.channels.edit')->with(compact('channel'))->with(compact('options'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(AdminChannelRequest $request, $id)
    {
        $channel = Channel::findOrFail($id);
        $channel->shorthand = $request->shorthand;
        $channel->description = $request->description;
        $channel->color = $request->color;
        $channel->parent()->associate($request->parent_id);
        $channel->save();
        return Redirect::Route('admin.channels.index')->withMessage('Success!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $channel = Channel::findOrFail($id);
        $channel->delete();
        return Redirect::Route('admin.channels.index')->withMessage('Success!');
    }

    public function getOptions(){
        $options = [0 => "Select"];
        $options2 = (new Channel)->topLevel()->lists('shorthand', 'id')->toArray();
        $options = $options + $options2;
        return $options;
    }
}
