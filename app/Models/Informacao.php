<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Informacao extends Model
{
    //use HasFactory;
    public $timestamps = false;
    protected $table = 'tb-informacao';
    protected $fillable = ['informacao', 'dataCriacao', 'dataAtualizacao'];
    private const palavrasGerarInformacoes = ["Octagon","Hexágono","Paralelogramo","Octagon","Atravessar","Losango","Estrela","Nonagon","Retângulo"];
    public function construirInformacao(string $informacao):void{
        $this->informacao = $informacao;
        $this->dataCriacao = date("Y-m-d H:i:s");
    }
    public function atualizarInformacao(string $informacao):void{
        $this->informacao = $informacao;
        $this->dataAtualizacao = date("Y-m-d H:i:s");
    }
    private static function reorganizarIDTabela(){
        $listInformacoes = self::all();

        $count = 1;
        foreach($listInformacoes as $informacao){
            $informacao->id = $count;
            $informacao->save();
            $count++;
        }

    }
    // Gerar uma informação pseudo-aleatória
    private static function gerarInformacaoAleatoria():Informacao{
        $informacao = new Informacao();
        $info = self::palavrasGerarInformacoes[rand(0, count(self::palavrasGerarInformacoes) - 1)];
        $informacao->construirInformacao($info);
        return $informacao;
    }
    public static function gerarInformacao(int $quantidade){

        for($n = 1; $n <= $quantidade; $n++){
            $informacao = self::gerarInformacaoAleatoria();
            $informacao->save();
        }
        self::reorganizarIDTabela();
    }
}
