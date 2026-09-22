<div style="display: flex; flex-direction: row; gap: 24px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; padding: 20px; box-sizing: border-box; flex-wrap: wrap; width: 100%;">

    <div style="width: 100%; margin-bottom: -10px;">
        <input type="text" wire:model.live="busca" placeholder=" Digite o nome de um material para pesquisar em tempo real..." 
            style="width: 100%; border: 1px solid #cbd5e0; border-radius: 8px; padding: 12px 16px; font-size: 14px; box-sizing: border-box; outline: none; box-shadow: 0 2px 4px rgba(0,0,0,0.02); background-color: #ffffff;">
    </div>

    <div style="flex: 2; min-width: 600px; background-color: #ffffff; border: 1px solid #dee2e6; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); overflow: hidden;">
        <div style="background-color: #f8f9fa; padding: 16px 20px; border-bottom: 1px solid #dee2e6; display: flex; justify-content: space-between; align-items: center;">
            <h3 style="margin: 0; font-size: 18px; color: #212529; font-weight: 600;"> Monitoramento em Tempo Real</h3>
            <span style="background-color: #e8f5e9; color: #2e7d32; font-size: 12px; font-weight: bold; padding: 4px 10px; border-radius: 50px;">Livewire Ativo</span>
        </div>

        <div style="padding: 0;">
            <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 14px;">
                <thead>
                    <tr style="background-color: #f1f3f5; color: #495057; text-transform: uppercase; font-size: 11px; tracking-wider: 1px; border-bottom: 2px solid #dee2e6;">
                        <th style="padding: 12px 16px;">Material de Construção</th>
                        <th style="padding: 12px 16px;">Categoria</th>
                        <th style="padding: 12px 16px; text-align: center;">Unidade</th>
                        <th style="padding: 12px 16px; text-align: center;">Mín.</th>
                        <th style="padding: 12px 16px; text-align: center;">Qtd Atual</th>
                        <th style="padding: 12px 16px; text-align: center;">Status</th>
                    </tr>
                </thead>
                <tbody style="color: #343a40;">
                    @forelse($produtos as $produto)
                    <tr style="border-bottom: 1px solid #edf2f7; transition: background-color 0.2s;">
                        <td style="padding: 14px 16px;">
                            <div style="font-weight: 600; color: #1a202c; font-size: 15px;">{{ $produto->nome }}</div>
                            <div style="color: #718096; font-size: 12px; margin-top: 2px;">{{ $produto->cor ?? 'Padrão' }} | {{ $produto->textura ?? 'N/A' }}</div>
                        </td>
                        <td style="padding: 14px 16px;">
                            <span style="background-color: #edf2f7; color: #4a5568; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 500;">{{ $produto->categoria }}</span>
                        </td>
                        <td style="padding: 14px 16px; text-align: center; font-family: monospace; font-size: 15px;">{{ $produto->unidade_medida }}</td>
                        <td style="padding: 14px 16px; text-align: center; color: #718096; font-family: monospace; font-size: 15px;">{{ $produto->estoque_minimo }}</td>
                        <td style="padding: 14px 16px; text-align: center; font-weight: bold; font-family: monospace; font-size: 16px; color: #1a202c;">{{ $produto->estoque_atual }}</td>
                        <td style="padding: 14px 16px; text-align: center;">
                            @if($produto->estoque_baixo)
                                <a href="{{ route('estoque.pedido', ['id' => $produto->id_produto, 'nome' => $produto->nome, 'minimo' => $produto->estoque_minimo]) }}" style="background-color: #fff5f5; color: #c53030; border: 1px solid #feb2b2; padding: 4px 12px; border-radius: 50px; font-size: 11px; font-weight: bold; display: inline-block; text-decoration: none; cursor: pointer;">
                                     COMPRAR
                                </a>
                            @else
                                <span style="background-color: #f0fff4; color: #2f855a; border: 1px solid #9ae6b4; padding: 4px 12px; border-radius: 50px; font-size: 11px; font-weight: bold; display: inline-block;">Seguro</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="padding: 30px; text-align: center; color: #718096;">Nenhum material encontrado com esse nome.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

   
    <div style="flex: 1; min-width: 300px; background-color: #ffffff; border: 1px solid #dee2e6; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); height: fit-content; overflow: hidden;">
        <div style="background-color: #f8f9fa; padding: 16px 20px; border-bottom: 1px solid #dee2e6;">
            <h3 style="margin: 0; font-size: 18px; color: #212529; font-weight: 600;">Entrada / Saída de prudutos</h3>
        </div>

        <form wire:submit.prevent="registrarMovimentacao" style="padding: 20px; display: flex; flex-direction: column; gap: 16px;">
            @if($mensagemSucesso)
            <div style="background-color: #e6fffa; color: #00695c; border: 1px solid #b2dfdb; padding: 10px; border-radius: 6px; font-size: 13px; text-align: center; font-weight: 500;">
                {{ $mensagemSucesso }}
            </div>
            @endif

            <div>
                <label style="display: block; font-size: 12px; font-weight: 600; color: #4a5568; text-transform: uppercase; margin-bottom: 6px;">Selecionar Material</label>
                <select wire:model="id_produto" style="width: 100%; border: 1px solid #cbd5e0; border-radius: 6px; padding: 10px; font-size: 14px; outline: none; background-color: #ffffff;" required>
                    @foreach($produtos as $produto)
                    <option value="{{ $produto->id_produto }}">{{ $produto->nome }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label style="display: block; font-size: 12px; font-weight: 600; color: #4a5568; text-transform: uppercase; margin-bottom: 6px;">Tipo de Fluxo</label>
                <select wire:model="tipo" style="width: 100%; border: 1px solid #cbd5e0; border-radius: 6px; padding: 10px; font-size: 14px; outline: none; background-color: #ffffff;" required>
                    <option value="ENTRADA"> ENTRADA </option>
                    <option value="SAÍDA"> SAÍDA </option>
                </select>
            </div>

            <div>
                <label style="display: block; font-size: 12px; font-weight: 600; color: #4a5568; text-transform: uppercase; margin-bottom: 6px;">Quantidade Numérica</label>
                <input type="number" wire:model="quantidade" style="width: 100%; border: 1px solid #cbd5e0; border-radius: 6px; padding: 10px; font-size: 14px; box-sizing: border-box; outline: none;" min="1" required>
            </div>

            @if($tipo === 'ENTRADA')
            <div>
                <label style="display: block; font-size: 12px; font-weight: 600; color: #4a5568; text-transform: uppercase; margin-bottom: 6px;">Data de Validade (Cimento/Tintas)</label>
                <input type="date" wire:model="data_validade" style="width: 100%; border: 1px solid #cbd5e0; border-radius: 6px; padding: 10px; font-size: 14px; box-sizing: border-box; outline: none;">
            </div>
            @endif

            <div>
                <label style="display: block; font-size: 12px; font-weight: 600; color: #4a5568; text-transform: uppercase; margin-bottom: 6px;">Justificativa / Documento</label>
                <input type="text" wire:model="motivo" style="width: 100%; border: 1px solid #cbd5e0; border-radius: 6px; padding: 10px; font-size: 14px; box-sizing: border-box; outline: none;" placeholder="Ex: Carga NF 8839">
            </div>

            <button type="submit" style="width: 100%; padding: 12px; font-size: 14px; color: white; background-color: #212529; border: none; border-radius: 6px; cursor: pointer; font-weight: 600; text-transform: uppercase; box-shadow: 0 2px 4px rgba(0,0,0,0.1); margin-top: 10px;">
                Lançar Registro Reativo
            </button>
        </form>
    </div>

    
    <div style="width: 100%; background-color: #ffffff; border: 1px solid #dee2e6; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); margin-top: 20px; overflow: hidden; box-sizing: border-box;">
        <div style="background-color: #f8f9fa; padding: 16px 20px; border-bottom: 1px solid #dee2e6;">
            <h3 style="margin: 0; font-size: 16px; color: #212529; font-weight: 600;"> Histórico Completo de Movimentações </h3>
        </div>
        
        <div style="overflow-x: auto; width: 100%;">
            <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 13px; table-layout: auto;">
                <thead>
                    <tr style="background-color: #f1f3f5; color: #495057; border-bottom: 2px solid #dee2e6; text-transform: uppercase; font-size: 11px; font-weight: bold;">
                        <th style="padding: 12px 16px; white-space: nowrap; width: 15%;">Data / Operação</th>
                        <th style="padding: 12px 16px; width: 25%;">Produto Solicitado</th>
