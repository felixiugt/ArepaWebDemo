<?php

namespace App\Http\Controllers;

use App\People;
use Illuminate\Http\Request;
use Validator;
use DB;
class PeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return People::get();
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

        $this->validate($request,[
         'nombre' => 'required|alpha|max:100',
         'correo' => 'required|email',
         'cedula' => 'required|max:6|unique:people,cedula',
      ]);
      DB::beginTransaction();
      try {
        $datos = People::create([
          'nombre' => $request->nombre,
          'correo' => $request->correo,
          'cedula' => $request->cedula,
          'cargo' => $request->cargo
        ]);
      } catch (\Exception $e) {
          DB::rollback();
        return response()->json($e,403);
      }

      DB::commit();
      return response()->json($datos, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\People  $people
     * @return \Illuminate\Http\Response
     */
    public function show($people)
    {
      return People::findOrFail($people);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\People  $people
     * @return \Illuminate\Http\Response
     */
    public function edit($people)
    {
        return People::findOrFail($people);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\People  $people
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $this->validate($request,[
       'nombre' => 'required|alpha|max:100',
       'correo' => 'required|email',
    ]);
    DB::beginTransaction();
    try {
      $datos = People::where('id', '=', $id)->update([
        'nombre' => $request->nombre,
        'correo' => $request->correo,
        'cargo' => $request->cargo
      ]);
    } catch (\Exception $e) {
        DB::rollback();
      return response()->json($e,403);
    }

    DB::commit();
    return response()->json($datos, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\People  $people
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $People = People::findOrFail($id);
      $People->delete();
    }
}
