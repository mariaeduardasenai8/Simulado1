@extends('layouts.app')

@section('content')
<div style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; max-width: 600px; margin: 40px auto; background: #ffffff; border: 1px solid #dee2e6; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); overflow: hidden;">
    
    <div style="background-color: #f8f9fa; padding: 16px 20px; border-bottom: 1px solid #dee2e6;">
        <h2 style="margin: 0; font-size: 18px; color: #212529; font-weight: 600;">📋 Solicitação de Pedido de Compra</h2>
    </div>

    
    <form action="{{ route('estoque.pedido.salvar') }}" method="POST" style="padding: 20px; display: flex; flex-direction: column; gap: 16px;">
        @csrf
        
        <input type="hidden" name="id_produto" value="{{ request('id') }}">

        <div>
            <label style="display: block; font-size: 12px; font-weight: 600; color: #4a5568; text-transform: uppercase; margin-bottom: 6px;">Produto Solicitado</label>
            <input type="text" value="{{ request('nome') }}" style="width: 100%; border: 1px solid #cbd5e0; border-radius: 6px; padding: 10px; font-size: 14px; box-sizing: border-box; background-color: #e2e8f0; color: #4a5568; font-weight: bold;" readonly>
        </div>

        <div>
            <label style="display: block; font-size: 12px; font-weight: 600; color: #4a5568; text-transform: uppercase; margin-bottom: 6px;">Quantidade para reabastecimento</label>
            <input type="number" name="quantidade" value="100" style="width: 100%; border: 1px solid #cbd5e0; border-radius: 6px; padding: 10px; font-size: 14px; box-sizing: border-box; outline: none;" min="1" required>
        </div>

        <div>
            <label style="display: block; font-size: 12px; font-weight: 600; color: #4a5568; text-transform: uppercase; margin-bottom: 6px;">Data de Validade da Carga</label>
            <input type="date" name="data_validade" value="{{ date('Y-m-d', strtotime('+1 year')) }}" style="width: 100%; border: 1px solid #cbd5e0; border-radius: 6px; padding: 10px; font-size: 14px; box-sizing: border-box; outline: none;" required>
        </div>

        <div>
            <label style="display: block; font-size: 12px; font-weight: 600; color: #4a5568; text-transform: uppercase; margin-bottom: 6px;">Urgência do Pedido</label>
            <input type="text" value="ALTA - Estoque abaixo do mínimo ({{ request('minimo') }} un)" style="width: 100%; border: 1px solid #cbd5e0; border-radius: 6px; padding: 10px; font-size: 14px; box-sizing: border-box; background-color: #fff5f5; color: #c53030; font-weight: bold;" readonly>
        </div>

        <div style="display: flex; justify-content: space-between; margin-top: 10px;">
            <a href="{{ route('estoque.index') }}" style="padding: 10px 16px; background:#6c757d; color:white; text-decoration:none; border-radius:6px; font-size: 14px; font-weight: 600;">Cancelar</a>
            <button type="submit" style="padding: 10px 16px; background:#0d6efd; color:white; border:none; border-radius:6px; cursor:pointer; font-size: 14px; font-weight: 600;">Confirmar e Adicionar ao Estoque</button>
        </div>
    </form>
</div>
@endsection
