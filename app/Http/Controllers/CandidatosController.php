<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Candidato;
use App\Models\Vaga;
use Redirect;
use Yajra\DataTables\DataTables;

class CandidatosController extends Controller
{

    public function index($id, Request $request)
    {
        $candidatos = Candidato::where('vaga_id', '=', $id)->get();
        $vaga = Vaga::findOrFail($id);
        return view('candidatos.list', ['candidatos' => $candidatos, 'vaga' => $vaga]);
    }


    // public function new(){
    //     return view('candidatos.form');
    // }

    public function add($id, Request $request)
    {
        $candidato = new candidato;
        $addcandidato = $request->all();
        $addcandidato['vaga_id'] = $id;
        $candidato = $candidato->create($addcandidato);
        return Redirect::to('/candidatos/' . $id);
    }

    public function edit($id, $vaga_id)
    {
        $candidato = Candidato::findOrFail($id);
        $vaga = Vaga::findOrFail($vaga_id);
        return view('candidatos.form', ['candidato' => $candidato, 'vaga' => $vaga]);
    }

    public function update($id, Request $request)
    {
        $candidato = Candidato::findOrFail($id);
        $atualizaCandidato['nome'] = $request->request->get("nome");
        $atualizaCandidato['resumo'] = $request->request->get("resumo");
        $atualizaCandidato['email'] = $request->request->get("email");
        $candidato->update($atualizaCandidato);
        return Redirect::to('/candidatos');
    }

    public function delete($id)
    {
        $candidato = Candidato::findOrFail($id);
        $candidato->delete();
        return Redirect::to('/candidatos');
    }

    public function getCandidatosData()
    {
        $candidatos = Candidato::select(['id', 'nome', 'resumo', 'email']);

        return DataTables::of($candidatos)->make(true);
    }
}