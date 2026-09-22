@extends('layouts.app')

@section('content')
<div style="font-family: sans-serif; max-width: 500px; margin: 20px auto; border: 1px solid #ccc; padding: 20px; border-radius: 5px;">
    <h2>Cadastrar Novo Material de Construção</h2>
    
    <form action="{{ route('produto.store') }}" method="POST">
        @csrf
        <div style="margin-bottom: 12px;">
            <label style="display:block; margin-bottom:4px;">Nome do Produto</label>
            <input type="text" name="nome" style="width: 95%; padding: 6px;" placeholder="Ex: Cimento Votoran CP II" required>
        </div>

        <div style="margin-bottom: 12px;">
            <label style="display:block; margin-bottom:4px;">Descrição</label>
            <textarea name="descricao" style="width: 95%; padding: 6px;" rows="2"></textarea>
        </div>

        <div style="margin-bottom: 12px;">
            <label style="display:block; margin-bottom:4px;">Categoria / Aplicação</label>
            <select name="categoria" style="width: 100%; padding: 6px;" required>
                <option value="Fundação">Fundação</option>
                <option value="Estrutura">Estrutura</option>
                <option value="Acabamento">Acabamento</option>
            </select>
        </div>

        <div style="margin-bottom: 12px;">
            <label style="display:block; margin-bottom:4px;">Unidade de Medida</label>
            <input type="text" name="unidade_medida" style="width: 95%; padding: 6px;" placeholder="Ex: kg, un, m3" required>
        </div>

        <div style="margin-bottom: 12px;">
            <label style="display:block; margin-bottom:4px;">Cor</label>
            <input type="text" name="cor" style="width: 95%; padding: 6px;" placeholder="Cinza">
        </div>

        <div style="margin-bottom: 12px;">
            <label style="display:block; margin-bottom:4px;">Textura</label>
            <input type="text" name="textura" style="width: 95%; padding: 6px;" placeholder="Pó">
        </div>

        <div style="margin-bottom: 12px;">
            <label style="display:block; margin-bottom:4px;">Peso (kg)</label>
            <input type="number" name="peso" step="0.01" style="width: 95%; padding: 6px;" placeholder="50.00">
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display:block; margin-bottom:4px;">Estoque Mínimo (Alerta)</label>
            <input type="number" name="estoque_minimo" style="width: 95%; padding: 6px;" value="0" required>
        </div>

        <div style="display: flex; justify-content: space-between;">
            <a href="{{ route('estoque.index') }}" style="padding: 8px 12px; background:#6c757d; color:white; text-decoration:none; border-radius:4px;">Voltar</a>
            <button type="submit" style="padding: 8px 12px; background:#28a745; color:white; border:none; border-radius:4px; cursor:pointer;">Salvar Produto</button>
        </div>
    </form>
</div>
@endsection
