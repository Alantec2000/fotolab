<?php

namespace App\Models;

use App\DTOs\DadosCadastroServicoService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * @method static whereId($id)
 */
class Servico extends Model
{
    use HasFactory;

    const TABLE_NAME = 'fl_servicos';
    const STATUS_CLIENTE = [
        'criado',
        'cancelado',
        'avaliado',
    ];

    const STATUS_FOTOGRAFO = [
        'analisando',
        'proposta aceita',
        'proposta recusada',
        'finalizado',
    ];

    protected $table = self::TABLE_NAME;

    public $attributes = [
        'status' => 'criado',
        'avaliado' => false
    ];
    public $fillable = [
        'fotografo_id',
        'cliente_id',
        'data_inicio',
        'data_fim',
        'titulo',
        'descricao'
    ];

    public function fotografo()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function setDataInicioAttribute($value)
    {
        $this->attributes['data_inicio'] = Carbon::createFromFormat('d/m/Y H:i', $value)
            ->format('Y-m-d H:i:s');
    }

    public function setDataFimAttribute($value)
    {
        $this->attributes['data_fim'] = Carbon::createFromFormat('d/m/Y H:i', $value)
            ->format('Y-m-d H:i:s');
    }

    public function obterStatusFotografo()
    {
        return self::STATUS_FOTOGRAFO;
    }

    public function obterStatusCliente()
    {
        return self::STATUS_CLIENTE;
    }

    public function classeStatus()
    {
        $classes = [
            'criado' => 'bg-yellow',
            'cancelado' => 'bg-red',
            'analisando' => 'bg-yellow',
            'proposta aceita' => 'bg-green',
            'proposta recusada' => 'bg-red',
            'finalizado' => 'bg-yellow',
            'criado' => 'bg-yellow',
        ];

        return $classes[$this->status];
    }

    public function formatarDatas()
    {
        $dataInicio = Carbon::createFromFormat('Y-m-d H:i:s', $this->data_inicio)
        ->format('d/m/Y H:i');
        $dataFim = Carbon::createFromFormat('Y-m-d H:i:s', $this->data_fim)
        ->format('d/m/Y H:i');

        return "$dataInicio ~ $dataFim";
    }

    public static function fromDadosCadastro(DadosCadastroServicoService $dadosCadastroServico): self
    {
        return new self([
            'fotografo_id' => $dadosCadastroServico->fotografo,
            'cliente_id' => Auth::id(),
            'data_inicio' => $dadosCadastroServico->data_inicio,
            'data_fim' => $dadosCadastroServico->data_fim,
            'titulo' => $dadosCadastroServico->titulo,
            'descricao' => $dadosCadastroServico->descricao,
        ]);
    }
}
