<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Empleado;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $datos['empleados']=Empleado::paginate(5);
        return response()->json(['success' => true, 'empleado' => $datos], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('empleado.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $campos=[
            'Nombre'=>'required|string|max:100',
            'Apellido'=>'required|string|max:100',
            'Email'=>'required|email',
            'Foto'=>'required|max:10000|mimes:jpeg,png,jpg'
        ];
        $mensaje=[
            'required'=>'El :attribute es requerido.',
            'Foto.required'=>'La Foto es requerida.'
        ];
        $this->validate($request,$campos,$mensaje);

        
        $datosEmpleado = request()->except('_token');
        
        if($request->hasFile('Foto')){
            $datosEmpleado['Foto']=$request->file('Foto')->store('uploads','public');   
        }

        Empleado::insert($datosEmpleado);
        //return response()->json($datosEmpleado);
        return response()->json(['success' => true, 'empleado' => $datosEmpleado], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado){
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $empleado=Empleado::findOrFail($id);
        return response()->json(['success' => true, 'empleado' => $empleado], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $campos=[
            'Nombre'=>'required|string|max:100',
            'Apellido'=>'required|string|max:100',
            'Email'=>'required|email',
        ];
        $mensaje=[
            'required'=>'El :attribute es requerido.',
        ];

        if ($request->hasFile('Foto')) {
            $campos=['Foto'=>'required|max:10000|mimes:jpeg,png,jpg'];
            $mensaje=['Foto.required'=>'La Foto es requerida.'];
        }
        $this->validate($request,$campos,$mensaje);
        
        $datosEmpleado = request()->except('_token','_method');
        if($request->hasFile('Foto')){
            $empleado=Empleado::findOrFail($id);
            Storage::delete('public/'.$empleado->Foto);    
            $datosEmpleado['Foto']=$request->file('Foto')->store('uploads','public');   
        }
        Empleado::where('id','=',$id)->update($datosEmpleado);
        $empleado=Empleado::findOrFail($id);
        //return view('empleado.edit',compact('empleado')); 
        return response()->json(['success' => true, 'empleado' => $empleado], 200);
    } 

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $empleado=Empleado::findOrFail($id);
        if(Storage::delete('public/'.$empleado->Foto)){
            Empleado::destroy($id);
        }
        //return redirect('empleado'); 
        return response()->json(['success' => true, 'empleado' => $empleado], 200);

    }
} 