<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Category;
use App\Application;

class CategoriesController extends Controller
{
    private $view = 'admin.categories.';
    private $router = 'categories.index';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug = NULL)
    {

        $title = "Categories";
        $data = Category::all();
        $application = Application::where('slug','=',$slug)->first();

        return view($this->view.'index',['title' => $title, 'data' => $data, 'application' => $application]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($slug = NULL)
    {

        $title = "New Category";
        $action = "create";
        $application = Application::where('slug','=',$slug)->first();

        return view($this->view.'save',['title' => $title,'action' => $action, 'application' => $application]);
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
            'application_id' => 'required'
        ]);

        $object = new Category();
        $object->name = $request->input('name');
        $object->application_id = $request->input('application_id');

        $application = Application::findorfail($request->input('application_id'))->first();

        if($request->hasFile('cover')){
            $object->cover = $request->cover->store('categories');
        }else{
            $object->cover = NULL;
        }

        if($object->save()){
            flash()->overlay('Saved Successfully!!','Alert');
        }else{
            flash()->overlay('Error to Saved!!','Error');
        }

        return redirect()->route($this->router,$application->slug);
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
    public function edit($slug, $id)
    {
        $data = Category::findorfail($id); 
        $title = "Edit Category";
        $action = "edit";

        $application = Application::where('slug','=',$slug)->first();

        return view($this->view.'save',['title' => $title,'action' => $action, 'data' => $data, 'application' => $application]); 
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
            'application_id' => 'required'
        ]);

        $object = Category::findorfail($id);
        $object->name = $request->input('name');
        $object->application_id = $request->input('application_id');

        $application = Application::findorfail($request->input('application_id'))->first();

        if($request->hasFile('cover')){
            Storage::delete($object->cover);
            $object->cover = $request->cover->store('categories');
        }

        if($object->update()){
            flash()->overlay('Updated Successfully!!','Alert');
        }else{
            flash()->overlay('Error to Updated!!','Error');
        }

        return redirect()->route($this->router,$application->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $object = Category::findorfail($id);

        if($object->status == 'active'){
            $object->status = 'inactive';
        }else{
            $object->status = 'active';
        }

        $application = Application::findorfail($object->application_id)->first();

        if($object->update()){
            flash()->overlay('Updated Successfully!!','Alert');
        }else{
            flash()->overlay('Error to Updated!!','Error');
        }

        return redirect()->route($this->router,$application->slug);
    }
}
