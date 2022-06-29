<?php
namespace App\Http\Controllers;
use App\Models\Equipamiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class EquipamientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $datos['equipamientos']=Equipamiento::paginate(5);
        return view('equipamiento.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('equipamiento.create');
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

        
        $datosEquipamiento = request()->except('_token');
        
        if($request->hasFile('Foto')){
            $datosEquipamiento['Foto']=$request->file('Foto')->store('uploads','public');   
        }

        Equipamiento::insert($datosEquipamiento);
        //return response()->json($datosequipamiento);
        return redirect('equipamiento')->with('mensaje','equipamiento agregado con Exito!.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Equipamiento  $equipamiento
     * @return \Illuminate\Http\Response
     */
    public function show(Equipamiento $equipamiento){
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Equipamiento  $equipamiento
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $equipamiento=Equipamiento::findOrFail($id);
        return view('equipamiento.edit',compact('equipamiento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Equipamiento  $equipamiento
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
        $this->validate($request,$campos,$mensaje);
        
        $datosEquipamiento = request()->except('_token','_method');
        if($request->hasFile('Foto')){
            $equipamiento=Equipamiento::findOrFail($id);
            Storage::delete('public/'.$equipamiento->Foto);    
            $datosEquipamiento['Foto']=$request->file('Foto')->store('uploads','public');   
        }
        Equipamiento::where('id','=',$id)->update($datosEquipamiento);
        $equipamiento=Equipamiento::findOrFail($id);
        //return view('equipamiento.edit',compact('equipamiento')); 
        return redirect('equipamiento')->with('mensaje','equipamiento modificado con Exito!.');

    } 

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Equipamiento  $equipamiento
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $equipamiento=Equipamiento::findOrFail($id);
        if(Storage::delete('public/'.$equipamiento->Foto)){
            Equipamiento::destroy($id);
        }
        //return redirect('equipamiento'); 
        return redirect('equipamiento')->with('mensaje','equipamiento eliminada con Exito!.');
    }
} 