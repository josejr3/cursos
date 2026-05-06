<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer contraseña</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Manrope', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif; background-color: #0e0e11; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background-color: #1f1f23; border-radius: 12px; box-shadow: 0 20px 25px rgba(0, 0, 0, 0.3); overflow: hidden; border: 1px solid #25252a; }
        .header { background: linear-gradient(145deg, #171720 0%, #0e0e11 100%); color: #ffffff; padding: 40px 20px; text-align: center; position: relative; overflow: hidden; border-bottom: 1px solid rgba(0,255,0,0.20); display: flex; align-items: center; justify-content: center; gap: 15px; }
        .header::before { content: ''; position: absolute; top: -50%; right: -50%; width: 300px; height: 300px; background: rgba(0,255,0,0.10); border-radius: 50%; }
        .logo { font-size: 28px; font-weight: 900; letter-spacing: -0.5px; margin-bottom: 0; position: relative; z-index: 1; font-family: 'Plus Jakarta Sans', sans-serif; }
        .header-content { display: flex; align-items: center; gap: 15px; position: relative; z-index: 1; }
        .header-img { max-width: 80px; height: auto; }
        .logo-highlight { color: #00ff00; }
        .content { padding: 40px 30px; color: #f0edf1; }
        .greeting { font-size: 20px; font-weight: 600; margin-bottom: 16px; color: #f0edf1; }
        .message { font-size: 14px; line-height: 1.6; color: #acaaae; margin-bottom: 30px; }
        .button-container { text-align: center; margin: 30px 0; }
        .button { display: inline-block; background: #00ff00; color: #000000; font-weight: 700; padding: 14px 36px; border-radius: 8px; text-decoration: none; font-size: 16px; box-shadow: 0 4px 14px rgba(0,255,0,0.30); transition: all 0.2s; }
        .button:hover { box-shadow: 0 6px 20px rgba(0,255,0,0.45); filter: brightness(1.08); }
        .link-text { word-break: break-all; color: #00ff00; font-size: 12px; line-height: 1.5; margin-top: 10px; }
        .expiry-warning { background-color: #161c16; border-left: 4px solid #00ff00; padding: 15px; margin: 20px 0; border-radius: 4px; font-size: 13px; color: #d2d4d2; line-height: 1.5; }
        .highlight-text { color: #00ff00; }
        .footer { background: #18181b; color: #acaaae; text-align: center; font-size: 12px; padding: 18px 10px; border-top: 1px solid rgba(0,255,0,0.15); }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="header-content">
                <img src="{{ asset('images/logo.png') }}" alt="TalentCamp TSCH" class="header-img">
                <div class="logo">TalentCamp<span class="logo-highlight">TSCH</span></div>
            </div>
        </div>
        <div class="content">
            <div class="greeting">¡Hola {{ $user->nombre ?? $user->email }}!</div>
            <div class="message">
                Hemos recibido una solicitud para restablecer tu contraseña. Si no realizaste esta solicitud, puedes ignorar este correo sin problemas.
            </div>
            <div class="button-container">
                <a href="{{ $url }}" class="button">Restablecer contraseña</a>
            </div>
            <div class="expiry-warning">
                <strong>⏱️ Importante:</strong> Este enlace expira en <span class="highlight-text">60 minutos</span>. Si el enlace ha expirado, puedes solicitar otro en la página de recuperación de contraseña.
            </div>
            <div class="message" style="margin-top:24px; border-top: 1px solid #25252a; padding-top: 20px;">
                Si el botón no funciona, copia y pega este enlace en tu navegador:
                <div class="link-text">{{ $url }}</div>
            </div>
        </div>
        <div class="footer">
            © {{ date('Y') }} TalentCamp TSCH. Todos los derechos reservados.
        </div>
    </div>
</body>
</html>

