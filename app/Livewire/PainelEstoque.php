<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Produto;
use App\Models\Movimentacao;
use App\Models\LoteValidade;
use Illuminate\Support\Facades\Auth;

class PainelEstoque extends Component
{
    public $id_produto;
    public $tipo = 'ENTRADA';
    public $quantidade;
    public $motivo;
    public $data_validade;

   
    public $mensagemSucesso;

    
    protected $rules = [
        'id_produto' => 'required|exists:produtos,id_produto',
        'tipo' => 'required|in:ENTRADA,SAÍDA',
        'quantidade' => 'required|integer|min:1',
        'motivo' => 'nullable|string|max:255',
        'data_validade' => 'nullable|date'
    ];

    
    public function registrarMovimentacao()
    {
        $this->validate();

        
        Movimentacao::create([
            'id_produto' => $this->id_produto,
            'id_usuario' => Auth::id() ?? 1, 
            'tipo' => $this->tipo,
            'quantidade' => $this->quantidade,
            'motivo' => $this->motivo
        ]);

        
        if ($this->tipo === 'ENTRADA') {
            LoteValidade::create([
                'id_produto' => $this->id_produto,
                'quantidade_atual' => $this->quantidade,
                'data_validade' => $this->data_validade
            ]);
        } else {
            
            $quantidadeParaDarBaixa = $this->quantidade;
            $lotes = LoteValidade::where('id_produto', $this->id_produto)
                                 ->where('quantidade_atual', '>', 0)
                                 ->orderBy('data_validade', 'asc')
                                 ->get();

            foreach ($lotes as $lote) {
                if ($quantidadeParaDarBaixa <= 0) break;

                if ($lote->quantidade_atual >= $quantidadeParaDarBaixa) {
                    $lote->quantidade_atual -= $quantidadeParaDarBaixa;
                    $lote->save();
                    $quantidadeParaDarBaixa = 0;
                } else {
                    $quantidadeParaDarBaixa -= $lote->quantidade_atual;
                    $lote->quantidade_atual = 0;
                    $lote->save();
                }
            }
        }

        
        $this->reset(['quantidade', 'motivo', 'data_validade']);
        
        
        $this->mensagemSucesso = 'Estoque atualizado instantaneamente!';
    }

   
         public function render()
    {
        
        $produtos = Produto::with(['lotes', 'movimentacoes'])->get();

       
        $notificacoes = [];
        foreach ($produtos as $produto) {
            
           
            if ($produto->estoque_atual < 10) {
                $notificacoes[] = " ATENÇÃO: '{$produto->nome}' está com estoque crítico abaixo de 10 un! Atual: ({$produto->estoque_atual} un).";
            }

            
            if ($produto->estoque_baixo && $produto->estoque_atual >= 10) {
                $notificacoes[] = " O produto '{$produto->nome}' atingiu o nível mínimo configurado ({$produto->estoque_atual} un).";
            }
           
            if ($produto->estoque_atual > 200) {
                $notificacoes[] = " Estoque ALTO para '{$produto->nome}' ({$produto->estoque_atual} un). Risco de custos extras!";
            }
        }

        
        view()->share('listaNotificacoes', $notificacoes);

       
        if (!$this->id_produto && $produtos->count() > 0) {
            $this->id_produto = $produtos->first()->id_produto;
        }

        return view('livewire.painel-estoque', compact('produtos'));
    }
}

