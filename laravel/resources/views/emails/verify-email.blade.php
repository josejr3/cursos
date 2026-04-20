<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifica tu correo</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Manrope', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif; background-color: #0e0e11; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background-color: #1f1f23; border-radius: 12px; box-shadow: 0 20px 25px rgba(0, 0, 0, 0.3); overflow: hidden; border: 1px solid #25252a; }
        .header { background: linear-gradient(135deg, #e2007a 0%, #ff89b1 100%); color: #ffffff; padding: 40px 20px; text-align: center; position: relative; overflow: hidden; }
        .header::before { content: ''; position: absolute; top: -50%; right: -50%; width: 300px; height: 300px; background: rgba(0, 227, 253, 0.1); border-radius: 50%; }
        .logo { font-size: 28px; font-weight: 900; letter-spacing: -0.5px; margin-bottom: 10px; position: relative; z-index: 1; font-family: 'Plus Jakarta Sans', sans-serif; }
        .logo-highlight { color: #00e3fd; }
        .content { padding: 40px 30px; color: #f0edf1; }
        .greeting { font-size: 20px; font-weight: 600; margin-bottom: 16px; color: #f0edf1; }
        .message { font-size: 14px; line-height: 1.6; color: #acaaae; margin-bottom: 30px; }
        .button-container { text-align: center; margin: 30px 0; }
        .button { display: inline-block; background: linear-gradient(135deg, #c1004a 0%, #e2007a 100%); color: #ffffff; font-weight: 700; padding: 14px 36px; border-radius: 8px; text-decoration: none; font-size: 16px; box-shadow: 0 4px 14px rgba(226,0,122,0.15); transition: background 0.2s; }
        .button:hover { background: linear-gradient(135deg, #e2007a 0%, #c1004a 100%); }
        .footer { background: #18181b; color: #acaaae; text-align: center; font-size: 12px; padding: 18px 10px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">TalentCamp<span class="logo-highlight">TSCH</span></div>
        </div>
        <div class="content">
            <div class="greeting">¡Hola {{ $user->nombre ?? $user->email }}!</div>
            <div class="message">
                Gracias por registrarte. Para activar tu cuenta, por favor haz clic en el siguiente botón para verificar tu correo electrónico:
            </div>
            <div class="button-container">
                <a href="{{ $url }}" class="button">Verificar correo</a>
            </div>
            <div class="message" style="margin-top:24px;">
                Si no creaste una cuenta, puedes ignorar este mensaje.
            </div>
        </div>
        <div class="footer">
            © {{ date('Y') }} TalentCamp TSCH. Todos los derechos reservados.
        </div>
    </div>
</body>
</html>
