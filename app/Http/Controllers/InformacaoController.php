<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Models\Informacao;
use Illuminate\Http\Request;

class InformacaoController extends Controller
{
    const PORPAGINA = 10;
    public function index(Request $request)
    {
        $informacao = new Informacao;
        $paginaAtual = isset($request->pagina) ? ((int)$request->pagina !== 0) ? (int)$request->pagina : 1 : 1;
        $paginacao = ceil(count(Informacao::all()) / self::PORPAGINA);
        $inicio = (self::PORPAGINA * $paginaAtual) - self::PORPAGINA;

        $informacao = Informacao::limit(self::PORPAGINA)->offset($inicio)->get();

        return view('render', ['listInformacoes' => $informacao, 'paginacao' => $paginacao, 'paginaAtual' => $paginaAtual]);
    }

    public function gerarInformacao(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'gerarInformacao' => 'required|max-digits:2|integer',
            ],
            $messages = [
                'required' => 'Esse campo não pode ficar vazio.',
                'max-digits' => 'Esse campo aceita apenas 2 caracteres numéricos.',
                'integer' => 'Esse campo aceita apenas números.',
            ],
        );

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator, 'gerarInformacao');
        }else{
            Informacao::gerarInformacao($request->gerarInformacao);
            return redirect()->back()->with('SucessoGerarInformacao', 'A informação foi salva e gerada com sucesso!');
        }

    }
    public function limparTodasInformacoes(Request $request){

    }
}
