<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Construtora Estoque</title>
    @livewireStyles
</head>
<body style="background-color: #f4f6f9; color: #333333; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; margin: 0; padding: 0; min-height: 100vh;">

    <!-- Menu Superior Robusto -->
    <nav style="background-color: #212529; padding: 0 20px; height: 60px; display: flex; align-items: center; justify-content: space-between; box-shadow: 0 2px 4px rgba(0,0,0,0.1); position: relative; z-index: 999;">
        <div style="display: flex; align-items: center; gap: 30px;">
            <span style="color: #ffffff; font-size: 18px; font-weight: bold; tracking-spacing: -0.5px;">
                 Depósito Central
            </span>
            <div style="display: flex; gap: 15px;">
                <a href="{{ route('estoque.index') }}" style="color: #f8f9fa; text-decoration: none; font-size: 14px; font-weight: 500; padding: 8px 12px; border-radius: 4px; background-color: #343a40;">Painel Geral</a>
                <a href="{{ route('produto.create') }}" style="color: #cfd2d6; text-decoration: none; font-size: 14px; font-weight: 500; padding: 8px 12px; border-radius: 4px;">Cadastrar Produto</a>
            </div>
        </div>

        <div style="display: flex; align-items: center; gap: 20px;">
           
            @php 
                $alertas = $listaNotificacoes ?? []; 
                $totalAlertas = count($alertas);
            @endphp
            <div style="position: relative; display: inline-block;">
                <button onclick="toggleNotificacoes()" style="background: none; border: none; font-size: 22px; cursor: pointer; position: relative; padding: 5px;">
                    🔔
                    @if($totalAlertas > 0)
                        <span style="position: absolute; top: 2px; right: 2px; background-color: #dc3545; color: white; border-radius: 50%; width: 18px; height: 18px; font-size: 11px; font-weight: bold; display: flex; align-items: center; justify-content: center; font-family: sans-serif;">
                            {{ $totalAlertas }}
                        </span>
                    @endif
                </button>

                
                <div id="caixa-notificacoes" style="display: none; position: absolute; right: 0; top: 40px; width: 320px; background-color: white; border: 1px solid #dee2e6; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); max-height: 350px; overflow-y: auto;">
                    <div style="padding: 12px 16px; font-weight: bold; font-size: 14px; border-bottom: 1px solid #dee2e6; background-color: #f8f9fa; color: #212529;">
                        Notificações de Estoque
                    </div>
                    <div style="padding: 5px 0;">
                        @if($totalAlertas > 0)
                            @foreach($alertas as $notificacao)
                                <div style="padding: 12px 16px; font-size: 13px; border-bottom: 1px solid #f1f3f5; line-height: 1.4; color: #495057;">
                                    {{ $notificacao }}
                                </div>
                            @endforeach
                        @else
                            <div style="padding: 20px; text-align: center; color: #6c757d; font-size: 13px;">
                                Nenhuma pendência encontrada. Tudo em ordem!
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                @csrf
                <button type="submit" style="background: none; border: 1px solid #dc3545; color: #dc3545; padding: 6px 12px; border-radius: 4px; font-size: 12px; cursor: pointer; font-weight: 500;">Sair</button>
            </form>
        </div>
    </nav>

    
    <div style="max-width: 1300px; margin: 0 auto; padding: 10px 0;">
        @yield('content')
    </div>

   
    <script>
        function toggleNotificacoes() {
            var caixa = document.getElementById('caixa-notificacoes');
            if (caixa.style.display === 'none') {
                caixa.style.display = 'block';
            } else {
                caixa.style.display = 'none';
            }
        }
        
        window.onclick = function(event) {
            if (!event.target.matches('button') && !event.target.closest('#caixa-notificacoes')) {
                var caixas = document.getElementsByClassName("caixa-notificacoes");
                var caixa = document.getElementById('caixa-notificacoes');
                if (caixa) caixa.style.display = 'none';
            }
        }
    </script>

    @livewireScripts
</body>
</html>
