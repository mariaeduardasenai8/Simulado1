<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrar - Site</title>
</head>
<body style="background-color: #f8f9fa; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; height: 100vh; margin: 0; display: flex; align-items: center; justify-content: center;">

    <div style="width: 100%; max-width: 330px; padding: 15px; margin: auto; text-align: center;">
        
        <!-- Logotipo customizado com a escrita DC -->
        <div style="background-color: #158fa1; color: white; width: 72px; height: 72px; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 32px; font-weight: 700; margin: 0 auto 20px auto; box-shadow: 0 4px 6px rgba(13,110,253,0.2); letter-spacing: -1px;">
            M
        </div>

        <h1 style="font-size: 30px; font-weight: 300; color: #212529; margin-bottom: 20px; letter-spacing: -0.5px;">
            Please sign in
        </h1>

       
        @if($errors->any())
            <div style="background-color: #f8d7da; color: #842029; border: 1px solid #f5c2c7; padding: 10px; border-radius: 4px; font-size: 14px; margin-bottom: 15px; text-align: left;">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST" style="margin-bottom: 15px;">
            @csrf
            
            
            <div style="margin-bottom: 15px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                <input type="text" name="login" placeholder="Usuário / Login" required autofocus
                    style="width: 100%; max-width: 298px; padding: 12px 15px; font-size: 16px; border: 1px solid #ced4da; border-top-left-radius: 6px; border-top-right-radius: 6px; border-bottom: none; outline: none; box-sizing: border-box; background-color: #ffffff;">
                
                <input type="password" name="senha" placeholder="Password" required
                    style="width: 100%; max-width: 298px; padding: 12px 15px; font-size: 16px; border: 1px solid #ced4da; border-bottom-left-radius: 6px; border-bottom-right-radius: 6px; outline: none; box-sizing: border-box; background-color: #ffffff;">
            </div>

            
            <div style="text-align: left; margin-bottom: 15px; padding-left: 16px;">
                <label style="font-size: 15px; color: #212529; cursor: pointer; display: flex; align-items: center; gap: 8px;">
                    <input type="checkbox" name="remember" style="width: 16px; height: 16px; cursor: pointer; margin: 0;"> 
                    Lembrar-me
                </label>
            </div>

            
            <button type="submit" style="width: 100%; padding: 12px; font-size: 16px; color: white; background-color: #1c7fa3; border: none; border-radius: 6px; cursor: pointer; font-weight: 400; transition: background-color 0.2s; box-shadow: 0 2px 4px rgba(13,110,253,0.2);">
                Entrar
            </button>
        </form>

        <p style="margin-top: 40px; margin-bottom: 0; color: #6c757d; font-size: 14px;">
            2026
        </p>
    </div>

</body>
</html>
