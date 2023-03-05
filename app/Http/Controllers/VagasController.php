<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vaga;
use App\Models\TipoVaga;
use Redirect;
use Yajra\DataTables\DataTables;

class VagasController extends Controller
{

    public function index(Request $request)
    {
        $vagas = Vaga::get();
        $tipos_vaga = TipoVaga::all()->keyBy('id')->toArray();
        return view('Vagas.list', ['vagas' => $vagas, 'tipos_vaga' => $tipos_vaga]);
    }
    

    // public function new(){
    //     return view('Vagas.form');
    // }

    public function add(Request $request)
    {
        $vaga = new Vaga;
        $addVaga = $request->all();
        $vaga = $vaga->create($addVaga);
        return Redirect::to('/vagas');
    }

    public function edit($id)
    {
        $vaga = Vaga::findOrFail($id);
        $tipos_vaga = TipoVaga::all()->keyBy('id')->toArray();

        return view('Vagas.form', ['vaga' => $vaga, 'tipos_vaga' => $tipos_vaga]);
    }

    public function update($id, Request $request)
    {
        $vaga = Vaga::findOrFail($id);
        $atualizaVaga['tipo'] = $request->request->get("tipo");
        $atualizaVaga['descricao'] = $request->request->get("descricao");
        $atualizaVaga['status'] = $request->request->get("status");
        $vaga->update($atualizaVaga);
        return Redirect::to('/vagas');
    }

    public function delete($id)
    {    
        $vaga = Vaga::findOrFail($id);
        $vaga->delete();
        return Redirect::to('/vagas');
    }
    public function getVagasData()
    {
        $vagas = Vaga::select(['id', 'nome', 'resumo', 'email']);

        return DataTables::of($vagas)->make(true);
    }
}