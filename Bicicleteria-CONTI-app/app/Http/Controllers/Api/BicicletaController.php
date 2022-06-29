<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bicicleta;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Spatie\FlareClient\Api;

class BicicletaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $datos['bicicletas']=Bicicleta::paginate(5);
        return response()->json(['success' => true, 'bicicleta' => $datos], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('bicicleta.create');
        //return response()->json(['success' => true, 'bicicleta' => $bicicleta], 200);
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
            'Modelo'=>'required|string|max:100',
            'Tipo'=>'required|string|max:100',
            'Terreno'=>'required|string|max:100',
            'Edad'=>'required|string|max:100',
            'Marca'=>'required|string|max:100',
            'DetalleEquipamiento'=>'required|string|max:100',
            'Anio'=>'required|string|max:100',
            'Precio'=>'required|string|max:100',
            'Foto'=>'required|max:10000|mimes:jpeg,png,jpg'
        ];
        $mensaje=[
            'required'=>'El :attribute es requerido.',
            'Foto.required'=>'La Foto es requerida.'
        ];
        
        $this->validate($request,$campos,$mensaje);

        
        $datosBicicleta = request()->except('_token');
        
        if($request->hasFile('Foto')){
            $datosBicicleta['Foto']=$request->file('Foto')->store('uploads','public');   
        }

        bicicleta::insert($datosBicicleta);
        //return response()->json($datosbicicleta);
        //return redirect('bicicleta')->with('mensaje','bicicleta agregada con Exito!.');
        return response()->json(['success' => true, 'bicicleta' => $datosBicicleta], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bicicleta  $bicicleta
     * @return \Illuminate\Http\Response
     */
    public function show(Bicicleta $bicicleta){
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bicicleta  $bicicleta
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $bicicleta=Bicicleta::findOrFail($id);
        //return view('bicicleta.edit',compact('bicicleta'));
        return response()->json(['success' => true, 'bicicleta' => $bicicleta], 200);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bicicleta  $bicicleta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $campos=[
            'Nombre'=>'required|string|max:100',
            'Modelo'=>'required|string|max:100',
            'Tipo'=>'required|string|max:100',
            'Terreno'=>'required|string|max:100',
            'Edad'=>'required|string|max:100',
            'Marca'=>'required|string|max:100',
            'DetalleEquipamiento'=>'required|string|max:100',
            'Anio'=>'required|string|max:100',
            'Precio'=>'required|string|max:100',
        ];
        $mensaje=[
            'required'=>'El :attribute es requerido.',
        ];

        if ($request->hasFile('Foto')) {
            $campos=['Foto'=>'required|max:10000|mimes:jpeg,png,jpg'];
            $mensaje=['Foto.required'=>'La Foto es requerida.'];
        }
        
        //$this->validate($request,$campos,$mensaje);
        
        $datosBicicleta = request()->except('_token','_method');
        if($request->hasFile('Foto')){
            $bicicleta=Bicicleta::findOrFail($id);
            Storage::delete('public/'.$bicicleta->Foto);    
            $datosBicicleta['Foto']=$request->file('Foto')->store('uploads','public');   
        }
        Bicicleta::where('id','=',$id)->update($datosBicicleta);
        $bicicleta=bicicleta::findOrFail($id);
        //return view('bicicleta.edit',compact('bicicleta')); 
        //return redirect('bicicleta')->with('mensaje','bicicleta modificada con Exito!.');
        return response()->json(['success' => true, 'bicicleta' => $bicicleta], 200);

    } 

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bicicleta  $bicicleta
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $bicicleta=Bicicleta::findOrFail($id);
        if(Storage::delete('public/'.$bicicleta->Foto)){
            Bicicleta::destroy($id);
        }
        //return redirect('bicicleta'); 
        //return redirect('bicicleta')->with('mensaje','bicicleta eliminada con Exito!.');
        return response()->json(['success' => true, 'bicicleta' => $bicicleta], 200);
    }
} 