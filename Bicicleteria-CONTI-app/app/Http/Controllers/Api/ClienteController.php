<?php

namespace App\Http\Controllers\Api;;
use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Spatie\FlareClient\Api;

class ClienteController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $datos['clientes']=Cliente::paginate(5);
        return response()->json(['success' => true, 'cliente' => $datos], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('cliente.create');
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
            'Documento'=>'required|string|max:100',
            'Direccion'=>'required|string|max:100',
            'Foto'=>'required|max:10000|mimes:jpeg,png,jpg'
        ];
        $mensaje=[
            'required'=>'El :attribute es requerido.',
            'Foto.required'=>'La Foto es requerida.'
        ];
        $this->validate($request,$campos,$mensaje);

        
        $datosCliente = request()->except('_token');
        
        if($request->hasFile('Foto')){
            $datosCliente['Foto']=$request->file('Foto')->store('uploads','public');   
        }

        Cliente::insert($datosCliente);
        //return response()->json($datoscliente);
        return response()->json(['success' => true, 'cliente' => $datosCliente], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(cliente $cliente){
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $cliente=Cliente::findOrFail($id);
        return response()->json(['success' => true, 'cliente' => $cliente], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $campos=[
            'Nombre'=>'required|string|max:100',
            'Apellido'=>'required|string|max:100',
            'Email'=>'required|email',
            'Documento'=>'required|string|max:100',
            'Direccion'=>'required|string|max:100',
        ];
        $mensaje=[
            'required'=>'El :attribute es requerido.',
        ];

        if ($request->hasFile('Foto')) {
            $campos=['Foto'=>'required|max:10000|mimes:jpeg,png,jpg'];
            $mensaje=['Foto.required'=>'La Foto es requerida.'];
        }
        $this->validate($request,$campos,$mensaje);
        
        $datosCliente = request()->except('_token','_method');
        if($request->hasFile('Foto')){
            $cliente=Cliente::findOrFail($id);
            Storage::delete('public/'.$cliente->Foto);    
            $datosCliente['Foto']=$request->file('Foto')->store('uploads','public');   
        }
        Cliente::where('id','=',$id)->update($datosCliente);
        $cliente=Cliente::findOrFail($id);
        //return view('cliente.edit',compact('cliente')); 
        return response()->json(['success' => true, 'cliente' => $cliente], 200);
    } 

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $cliente=Cliente::findOrFail($id);
        if(Storage::delete('public/'.$cliente->Foto)){
            Cliente::destroy($id);
        }
        //return redirect('cliente'); 
        return response()->json(['success' => true, 'cliente' => $cliente], 200);

    }
} 