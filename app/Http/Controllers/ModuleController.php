<?php

namespace App\Http\Controllers;

use App\Http\Requests\ModuleRequest;
use App\Module;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\AssignOp\Mod;

class ModuleController extends Controller
{
    // Récupérer les modules
    public function index(){
        $modules = Module::all();
        return response()->json($modules);
    }

    // Enregistrer un module dans la base de données    
    public function store(ModuleRequest $request){
        $module = new Module();
        $module = Module::create($request->all());
        return $module;
    }

    // Récupérer les détails d'un module
    public function show($id){
        $module = Module::find($id);
        return response()->json($module);
    }

    // Mettre à jour un module
    public function update(ModuleRequest $request,$id){
        $module = Module::find($id);
        $module->update($request->all());
        return $module;
    }

    // Supprimer un module
    public function destroy($id){
        $module = Module::destroy([$id]);
    }

    // Vérifier la température 
    public function check(){
        $data = Module::where('temperature', '>=', 20)->get('name');
        return response()->json($data);
    }
}
