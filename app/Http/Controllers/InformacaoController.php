<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Models\Informacao;
use Illuminate\Http\Request;

class InformacaoController extends Controller
{
    const PORPAGINA = 10;

    public function removerInformacao(Request $request){

    }
    public function index(Request $request)
    {
        $orderBy = [];
        switch ($request) {
            case $request['id'] !== null:
                $orderBy[0] = 'id';
                $orderBy[1] = (string) $request['id'];
                break;
                case $request['informacao'] !== null:
                    $orderBy[0] = 'informacao';
                    $orderBy[1] = (string) $request['informacao'];
                    break;
            case $request['dataCriacao'] !== null:
                $orderBy[0] = 'dataCriacao';
                $orderBy[1] = (string) $request['dataCriacao'];
                break;
            case $request['dataAtualizacao'] !== null:
                $orderBy[0] = 'dataAtualizacao';
                $orderBy[1] = (string) $request['dataAtualizacao'];
                break;
            default:
            $orderBy[0] = 'id';
            $orderBy[1] = 'asc';
            break;
        }

        $informacao = new Informacao();
        $paginaAtual = isset($request->pagina) ? ((int) $request->pagina !== 0 ? (int) $request->pagina : 1) : 1;

        $inicio = self::PORPAGINA * $paginaAtual - self::PORPAGINA;
        $buscar = isset($request->buscar) ? (string)filter_var($request->buscar, FILTER_DEFAULT) : '';

        if($buscar !== ''){
        $informacao = Informacao::where('informacao','LIKE','%'.$buscar.'%')
            ->orWhere('dataCriacao', 'LIKE', '%'.$buscar.'%')
            ->get();
            $paginacao = ceil(count($informacao) / self::PORPAGINA);

            $informacao = Informacao::where('informacao','LIKE','%'.$buscar.'%')
            ->orWhere('dataCriacao', 'LIKE', '%'.$buscar.'%')
            ->orderBy($orderBy[0], $orderBy[1])
            ->limit(self::PORPAGINA)
            ->offset($inicio)
            ->get();
        }
        else{
            $informacao = Informacao::orderBy($orderBy[0], $orderBy[1])
            ->limit(self::PORPAGINA)
            ->offset($inicio)
            ->get();
            $paginacao = ceil(count(Informacao::all()) / self::PORPAGINA);

        }
        $orderByInvertido = '';
        if($orderBy[1] === 'desc')
            $orderByInvertido = (string)'asc';
        else
            $orderByInvertido = (string)'desc';

        if($buscar !== ''){
            return view('render', ['listInformacoes' => $informacao,
            'paginacao' => $paginacao,
            'paginaAtual' => $paginaAtual,
            'orderByInvertido' => $orderByInvertido,
            'buscar' => $buscar,
            'orderBy' => $orderBy]);

        } else{
            return view('render', ['listInformacoes' => $informacao,
            'paginacao' => $paginacao,
            'paginaAtual' => $paginaAtual,
            'orderByInvertido' => $orderByInvertido,
            'orderBy' => $orderBy]);
        }

    }
    public function up(Request $request, $pagina)
    {
        dd($pagina);
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
        } else {
            Informacao::gerarInformacao($request->gerarInformacao);
            return redirect()
                ->back()
                ->with('SucessoGerarInformacao', 'A informação foi salva e gerada com sucesso!');
        }
    }
    public function limparTodasInformacoes(Request $request)
    {
        if (count(Informacao::all()) === 0) {
            return redirect()
                ->back()
                ->with('ErroLimparInformacao', 'A tabela já está zerada, não será possível deletar informações que já não existem.');
        }

        Informacao::query()->delete();
        return redirect()
            ->back()
            ->with('SucessoLimparInformacao', 'Todas as informações da tabela foram deletadas com sucesso!');
    }
}
