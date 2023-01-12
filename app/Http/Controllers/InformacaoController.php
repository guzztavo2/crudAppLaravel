<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Models\Informacao;
use Illuminate\Http\Request;

class InformacaoController extends Controller
{
    const PORPAGINA = 10;

    public function editarInformacao(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'editarInformacao' => 'required|max:100|min:10|string',
                'idInformacao' => 'required|string',
            ],
            $messages = [
                'required' => 'Esse campo: ":attribute". Não pode ficar vazio.',
                'min' => 'Esse campo: ":attribute". Aceita no minimo 10 caracter(es).',
                'max' => 'Esse campo: ":attribute". Aceita no maximo 100 caracter(es).',
                'string' => 'Esse campo: ":attribute". Aceita apenas caracteres.',
            ],
        );
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator, 'editarInformacao');
        }

        try {
            $informacao = Informacao::find((string) filter_var($request->idInformacao, FILTER_DEFAULT));
            $informacao->atualizarInformacao((string) filter_var($request->editarInformacao, FILTER_DEFAULT));
            $informacao->save();
            return redirect(route('home', ['buscar' => $informacao->informacao]))->with('sucessoInserirInformacao', 'A informação foi salva no nosso banco de dados com sucesso!');
        } catch (Exception $e) {
            return redirect()
                ->back()
                ->with('editarInformacaoErro', 'Não foi possível salvar a informação editada no momento, por favor, tente novamente.');
        }
    }
    public function removerInformacao(Request $request)
    {
        $listResultado = [];
        foreach ($request->informacoes as $key => $value) {
            $listResultado[] = Informacao::where('id', '=', $key)->get()[0];
            $listResultado[count($listResultado) - 1]->forceDelete();
        }
        return redirect()
            ->back()
            ->with('ErroLimparInformacao', 'As informações selecionadas foram removidas com sucesso!');
    }
    function inserirNovaInformacao(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'inserirInformacao' => 'required|max:100|min:10|string',
            ],
            $messages = [
                'required' => 'Esse campo não pode ficar vazio.',
                'min' => 'Esse campo aceita no minimo 10 caracter(es).',
                'max' => 'Esse campo aceita no maximo 100 caracter(es).',
                'string' => 'Esse campo aceita apenas caracteres.',
            ],
        );

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator, 'inserirInformacao');
        }

        $informacao = (string) filter_var($request->inserirInformacao, FILTER_DEFAULT);

        try {
            $info = new Informacao();
            $info->construirInformacao($informacao);
            $info->save();
            return redirect(route('home', ['id' => 'desc']))->with('sucessoInserirInformacao', 'A informação foi salva no nosso banco de dados com sucesso!');
        } catch (Exception $e) {
            return redirect()
                ->back()
                ->with('ErrorInserirInformacao', 'Não foi possível salvar a informação no momento, por favor, tente novamente.');
        }
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
        $buscar = isset($request->buscar) ? (string) filter_var($request->buscar, FILTER_DEFAULT) : '';

        if ($buscar !== '') {
            $informacao = Informacao::where('informacao', 'LIKE', '%' . $buscar . '%')
                ->orWhere('dataCriacao', 'LIKE', '%' . $buscar . '%')
                ->orWhere('dataAtualizacao', 'LIKE', '%' . $buscar . '%')
                ->get();
            $paginacao = ceil(count($informacao) / self::PORPAGINA);

            $informacao = Informacao::where('informacao', 'LIKE', '%' . $buscar . '%')
                ->orWhere('dataCriacao', 'LIKE', '%' . $buscar . '%')
                ->orWhere('dataAtualizacao', 'LIKE', '%' . $buscar . '%')
                ->orderBy($orderBy[0], $orderBy[1])
                ->limit(self::PORPAGINA)
                ->offset($inicio)
                ->get();
        } else {
            $informacao = Informacao::orderBy($orderBy[0], $orderBy[1])
                ->limit(self::PORPAGINA)
                ->offset($inicio)
                ->get();
            $paginacao = ceil(count(Informacao::all()) / self::PORPAGINA);
        }
        $orderByInvertido = '';
        if ($orderBy[1] === 'desc') {
            $orderByInvertido = (string) 'asc';
        } else {
            $orderByInvertido = (string) 'desc';
        }

        if ($buscar !== '') {
            return view('render', ['listInformacoes' => $informacao, 'paginacao' => $paginacao, 'paginaAtual' => $paginaAtual, 'orderByInvertido' => $orderByInvertido, 'buscar' => $buscar, 'orderBy' => $orderBy]);
        } else {
            return view('render', ['listInformacoes' => $informacao, 'paginacao' => $paginacao, 'paginaAtual' => $paginaAtual, 'orderByInvertido' => $orderByInvertido, 'orderBy' => $orderBy]);
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
