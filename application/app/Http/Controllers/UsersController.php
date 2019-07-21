<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{

    private $view = 'admin.users.';
    private $router = 'users.index';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $title = "Users";
        $data = User::all();

        return view($this->view.'index',['title' => $title, 'data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $title = "New User";
        $action = "create";

        return view($this->view.'save',['title' => $title,'action' => $action]);
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
            'name' => 'required',
            'email' => 'required',
            'role' => 'required'
        ]);

        $object = new User();
        $object->name = $request->input('name');
        $object->email = $request->input('email');
        $object->password = bcrypt('123456');
        $object->role = $request->input('role');

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
        $data = User::findorfail($id); 
        $title = "Edit User";
        $action = "edit";

        return view($this->view.'save',['title' => $title,'action' => $action, 'data' => $data]); 
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
            'name' => 'required',
            'email' => 'required',
            'role' => 'required'
        ]);

        $object = User::findorfail($id);
        $object->name = $request->input('name');
        $object->email = $request->input('email');
        $object->role = $request->input('role');
        
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
        $object = User::findorfail($id);

        if($object->status == 'active'){
            $object->status = 'inactive';
        }else{
            $object->status = 'active';
        }

        if($object->update()){
            flash()->overlay('Updated Successfully!!','Alert');
        }else{
            flash()->overlay('Error to Updated!!','Error');
        }

        return redirect()->route($this->router);
    }

    public function profile(){

    }

    public function update_profile(Request $request, $id){

    }

    public function update_password(Request $request, $id){

    }
}
