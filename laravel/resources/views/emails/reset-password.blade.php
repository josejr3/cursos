<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer contraseña</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Manrope', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background-color: #0e0e11;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #1f1f23;
            border-radius: 12px;
            box-shadow: 0 20px 25px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            border: 1px solid #25252a;
        }
        .header {
            background: linear-gradient(135deg, #e2007a 0%, #ff89b1 100%);
            color: #ffffff;
            padding: 40px 20px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 300px;
            height: 300px;
            background: rgba(0, 227, 253, 0.1);
            border-radius: 50%;
        }
        .logo {
            font-size: 28px;
            font-weight: 900;
            letter-spacing: -0.5px;
            margin-bottom: 10px;
            position: relative;
            z-index: 1;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .logo-highlight {
            color: #00e3fd;
        }
        .content {
            padding: 40px 30px;
            color: #f0edf1;
        }
        .greeting {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 16px;
            color: #f0edf1;
        }
        .message {
            font-size: 14px;
            line-height: 1.6;
            color: #acaaae;
            margin-bottom: 30px;
        }
        .button-container {
            text-align: center;
            margin: 30px 0;
        }
        .button {
            display: inline-block;
            background: linear-gradient(135deg, #c1004a 0%, #e2007a 100%);
            color: #ffffff;
            padding: 14px 40px;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 700;
            font-size: 14px;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            box-shadow: 0 10px 20px rgba(226, 0, 122, 0.3);
            border: none;
            cursor: pointer;
        }
        .button:hover {
            text-decoration: none;
            transform: translateY(-2px);
            box-shadow: 0 15px 30px rgba(226, 0, 122, 0.4);
        }
        .alternative-text {
            font-size: 12px;
            color: #666570;
            text-align: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #25252a;
        }
        .link-text {
            word-break: break-all;
            color: #00e3fd;
            font-size: 12px;
            line-height: 1.5;
            margin-top: 10px;
        }
        .footer {
            background-color: #131316;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #666570;
            border-top: 1px solid #25252a;
        }
        .expiry-warning {
            background-color: #25252a;
            border-left: 4px solid #ff89b1;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
            font-size: 13px;
            color: #acaaae;
            line-height: 1.5;
        }
        .highlight-text {
            color: #00e3fd;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="logo">
                TALENT<span class="logo-highlight">CAMP</span>
            </div>
        </div>

        <!-- Content -->
        <div class="content">
            <div class="greeting">¡Hola {{ $user->nombre ?? 'Usuario' }}!</div>

            <p class="message">
                Hemos recibido una solicitud para restablecer tu contraseña. Si no realizaste esta solicitud, puedes ignorar este correo sin problemas.
            </p>

            <div style="text-align: center; margin: 30px 0;">
                <p style="font-size: 14px; color: #f0edf1; margin-bottom: 15px; font-weight: 500;">
                    Haz clic en el botón de abajo para restablecer tu contraseña:
                </p>
                <div class="button-container">
                    <a href="{{ $url }}" class="button">Restablecer Contraseña</a>
                </div>
            </div>

            <div class="expiry-warning">
                <strong>⏱️ Importante:</strong> Este enlace expira en <span class="highlight-text">60 minutos</span>. Si el enlace ha expirado, puedes solicitar otro en la página de recuperación de contraseña.
            </div>

            <div class="alternative-text">
                Si el botón anterior no funciona, copia y pega este enlace en tu navegador:
                <div class="link-text">
                    {{ $url }}
                </div>
            </div>

            <p class="message" style="margin-top: 30px; margin-bottom: 0; border-top: 1px solid #25252a; padding-top: 20px;">
                Por tu seguridad, nunca compartimos contraseñas por correo electrónico. Si recibiste este correo pero no solicitaste un restablecimiento de contraseña, <span class="highlight-text">ignóralo de inmediato</span>.
            </p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>
                TalentCamp © {{ date('Y') }} - Todos los derechos reservados
            </p>
            <p style="margin-top: 10px; color: #555458;">
                Este es un correo automático. Por favor, no respondas a este mensaje.
            </p>
        </div>
    </div>
</body>
</html>

