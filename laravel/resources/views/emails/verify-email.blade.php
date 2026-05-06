<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifica tu correo</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Manrope', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif; background-color: #0e0e11; padding: 20px; }
        table { border-collapse: collapse; }
        td { padding: 0; }
        .table-main { border-radius: 12px; overflow: hidden; box-shadow: 0 20px 25px rgba(0, 0, 0, 0.3); }
    </style>
</head>
<body>
    <table width="100%" border="0" cellpadding="0" cellspacing="0" style="max-width: 600px; margin: 0 auto;" class="table-main">
        <!-- Header -->
        <tr>
            <td style="background: linear-gradient(145deg, #171720 0%, #0e0e11 100%); padding: 40px 20px; text-align: center; border-bottom: 1px solid rgba(0,255,0,0.20);">
                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                        <td align="center">
                            <table border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="padding-right: 15px; vertical-align: middle;">
                                        <img src="{{ asset('images/logo.png') }}" alt="TalentCamp TSCH" style="max-width: 80px; height: auto; display: block;">
                                    </td>
                                    <td style="vertical-align: middle; font-size: 28px; font-weight: 900; letter-spacing: -0.5px; color: #ffffff; font-family: 'Plus Jakarta Sans', sans-serif;">
                                        TalentCamp<span style="color: #00ff00;">TSCH</span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <!-- Content -->
        <tr>
            <td style="background-color: #1f1f23; padding: 40px 30px; color: #f0edf1; border: 1px solid #25252a; border-top: none;">
                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td style="font-size: 20px; font-weight: 600; padding-bottom: 16px; color: #f0edf1;">
                            ¡Hola {{ $user->nombre ?? $user->email }}!
                        </td>
                    </tr>
                    <tr>
                        <td style="font-size: 14px; line-height: 1.6; color: #acaaae; padding-bottom: 30px;">
                            Gracias por registrarte. Para activar tu cuenta, por favor haz clic en el siguiente botón para verificar tu correo electrónico:
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="padding: 30px 0;">
                            <a href="{{ $url }}" style="display: inline-block; background: #00ff00; color: #000000 !important; font-weight: 700; padding: 14px 36px; border-radius: 8px; text-decoration: none !important; font-size: 16px; box-shadow: 0 4px 14px rgba(0,255,0,0.30);">
                                Verificar correo
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td style="background-color: #161c16; border-left: 4px solid #00ff00; padding: 15px; margin: 20px 0; border-radius: 4px; font-size: 13px; color: #d2d4d2; line-height: 1.5;">
                            <strong>⏱️ Importante:</strong> Este enlace expira en <span style="color: #00ff00;">60 minutos</span>. Si el enlace ha expirado, puedes solicitar uno nuevo desde la página de inicio de sesión.
                        </td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid #25252a; padding-top: 20px; padding-bottom: 24px; font-size: 14px; line-height: 1.6; color: #acaaae; margin-top: 24px;">
                            Si el botón no funciona, copia y pega este enlace en tu navegador:<br><br>
                            <span style="color: #00ff00; font-size: 12px; word-break: break-all;">{{ $url }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-size: 14px; line-height: 1.6; color: #acaaae; padding-top: 24px;">
                            Si no creaste una cuenta, puedes ignorar este mensaje.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <!-- Footer -->
        <tr>
            <td style="background: #18181b; color: #acaaae; text-align: center; font-size: 12px; padding: 18px 10px; border: 1px solid #25252a; border-top: 1px solid rgba(0,255,0,0.15);">
                © {{ date('Y') }} TalentCamp TSCH. Todos los derechos reservados.
            </td>
        </tr>
    </table>
</body>
</html>
