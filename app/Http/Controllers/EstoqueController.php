<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Movimentacao;
use App\Models\LoteValidade;
use Illuminate\Support\Facades\Auth;

class EstoqueController extends Controller
{

    public function index()
    {
      
        $produtos = Produto::with(['lotes', 'movimentacoes'])->get();
        
        return view('estoque.index', compact('produtos'));
    }

    
    public function create()
    {
        return view('estoque.cadastro_produto');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:100',
            'categoria' => 'required|string',
            'unidade_medida' => 'required|string|max:10',
            'estoque_minimo' => 'required|integer',
        ]);

        Produto::create($request->all());

        return redirect()->route('estoque.index')->with('sucesso', 'Produto cadastrado com sucesso!');
    }

   
    public function movimentar(Request $request)
    {
        $request->validate([
            'id_produto' => 'required|exists:produtos,id_produto',
            'tipo' => 'required|in:ENTRADA,SAÍDA',
            'quantidade' => 'required|integer|min:1',
            'motivo' => 'nullable|string|max:255',
            'data_validade' => 'nullable|date'
        ]);

       
        Movimentacao::create([
            'id_produto' => $request->id_produto,
            'id_usuario' => Auth::id() ?? 1, 
            'quantidade' => $request->quantidade,
            'motivo' => $request->motivo
        ]);

        
        if ($request->tipo === 'ENTRADA') {
            LoteValidade::create([
                'id_produto' => $request->id_produto,
                'quantidade_atual' => $request->quantidade,
                'data_validade' => $request->data_validade
            ]);
        } else {
            
            $quantidadeParaDarBaixa = $request->quantidade;
            $lotes = LoteValidade::where('id_produto', $request->id_produto)
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

        return redirect()->route('estoque.index')->with('sucesso', 'Movimentação realizada com sucesso!');
    }

    
    public function salvarPedidoCompra(Request $request)
    {
        $request->validate([
            'id_produto' => 'required|exists:produtos,id_produto',
            'quantidade' => 'required|integer|min:1',
            'data_validade' => 'required|date'
        ]);

       
        \App\Models\Movimentacao::create([
            'id_produto' => $request->id_produto,
            'id_usuario' => \Illuminate\Support\Facades\Auth::id() ?? 1, 
            'tipo' => 'ENTRADA',
            'quantidade' => $request->quantidade,
            'motivo' => 'Reabastecimento Emergencial via Painel de Compras'
        ]);

        \App\Models\LoteValidade::create([
            'id_produto' => $request->id_produto,
            'quantidade_atual' => $request->quantidade,
            'data_validade' => $request->data_validade
        ]);

        return redirect()->route('estoque.index')->with('sucesso', 'Estoque reabastecido com sucesso através da ordem de compra!');
    }
} 

