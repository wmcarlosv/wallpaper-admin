<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rate;

class RatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [];

        if($request->ajax()){

            $object = new Rate();
            $object->device_id = $request->input('device_id');
            $object->stars = $request->input('stars');
            $object->wallpaper_id = $request->input('wallpaper_id');

            if($object->save()){

                $data = [
                    'message' => 'Saved Successfully!!',
                    'error' => 'no'
                ];

            }else{

                $data = [
                    'message' => 'Error to Saved!!',
                    'error' => 'yes'
                ];
                
            }

        }else{

            $data = [
                'message' => 'The Request not Ajax!!!',
                'error' => 'yes'
            ];

        }

        return response()->json($data);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
