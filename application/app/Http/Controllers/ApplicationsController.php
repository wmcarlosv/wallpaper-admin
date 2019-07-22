<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Application;
use App\User;

class ApplicationsController extends Controller
{
    private $view = 'admin.applications.';
    private $router = 'applications.index';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $title = "Applications";
        $data = Application::all();

        return view($this->view.'index',['title' => $title, 'data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $title = "New Application";
        $action = "create";
        $users = User::where('role','=','operator')->get();

        return view($this->view.'save',['title' => $title,'action' => $action, 'users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'name' => 'required',
            'api_key' => 'required',
            'current_version' => 'required'
        ]);

        $object = new Application();
        $object->user_id = $request->input('user_id');
        $object->name = $request->input('name');
        $object->api_key = $request->input('api_key');
        $object->slug = str_replace(' ', '-', strtolower($request->input('name')));
        $object->description = $request->input('description');
        if($request->hasFile('icon')){
            $object->icon = $request->icon->store('applications/icons/');
        }else{
            $object->icon = NULL;
        }
        $object->current_version = $request->input('current_version');
        $object->author = $request->input('author');
        $object->email = $request->input('email');
        $object->website = $request->input('website');
        $object->phone = $request->input('phone');
        $object->about = $request->input('about');
        $object->privacy = $request->input('privacy');

        $object->dev_play_url = $request->input('dev_play_url');
        $object->publisher_id = $request->input('publisher_id');
        $object->banner_id = $request->input('banner_id');
        $object->interstitial_id = $request->input('interstitial_id');
        $object->interstitial_clicks = $request->input('interstitial_clicks');

        $object->one_signal_app_id = $request->input('one_signal_app_id');
        $object->one_signal_rest_key = $request->input('one_signal_rest_key');

        if($object->save()){
            flash()->overlay('Saved Successfully!!','Alert');
        }else{
            flash()->overlay('Error to Saved!!','Error');
        }

        return redirect()->route($this->router);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Application::findorfail($id); 
        $title = "Edit Application";
        $action = "edit";
        $users = User::where('role','=','operator')->get();

        return view($this->view.'save',['title' => $title,'action' => $action, 'data' => $data, 'users' => $users]); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required',
            'name' => 'required',
            'api_key' => 'required',
            'current_version' => 'required'
        ]);

        $object = Application::findorfail($id);
        $object->user_id = $request->input('user_id');
        $object->name = $request->input('name');
        $object->api_key = $request->input('api_key');
        $object->slug = str_replace(' ', '-', strtolower($request->input('name')));
        $object->description = $request->input('description');
        if($request->hasFile('icon')){
            Storage::delete($object->icon);
            $object->icon = $request->icon->store('applications/icons/');
        }
        $object->current_version = $request->input('current_version');
        $object->author = $request->input('author');
        $object->email = $request->input('email');
        $object->website = $request->input('website');
        $object->phone = $request->input('phone');
        $object->about = $request->input('about');
        $object->privacy = $request->input('privacy');

        $object->dev_play_url = $request->input('dev_play_url');
        $object->publisher_id = $request->input('publisher_id');
        $object->banner_id = $request->input('banner_id');
        $object->interstitial_id = $request->input('interstitial_id');
        $object->interstitial_clicks = $request->input('interstitial_clicks');

        $object->one_signal_app_id = $request->input('one_signal_app_id');
        $object->one_signal_rest_key = $request->input('one_signal_rest_key');
        
        if($object->update()){
            flash()->overlay('Updated Successfully!!','Alert');
        }else{
            flash()->overlay('Error to Updated!!','Error');
        }

        return redirect()->route($this->router);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $object = Application::findorfail($id);

        if($object->status == 'online'){
            $object->status = 'offline';
        }else{
            $object->status = 'online';
        }

        if($object->update()){
            flash()->overlay('Updated Successfully!!','Alert');
        }else{
            flash()->overlay('Error to Updated!!','Error');
        }

        return redirect()->route($this->router);
    }
}
