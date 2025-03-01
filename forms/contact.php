<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; // Asegúrate de que PHPMailer se cargue correctamente

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Cambia si usas otro proveedor
        $mail->SMTPAuth = true;
        $mail->Username = 'mlg.t.8020@gmail.com'; // Cambia por tu correo
        $mail->Password = 'tu-contraseña-o-app-password'; // Usa una App Password si es Gmail
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Configurar destinatarios
        $mail->setFrom($_POST['email'], $_POST['name']);
        $mail->addAddress('mlg.t.8020@gmail.com'); // Cambia al destinatario real

        // Configurar contenido
        $mail->isHTML(true);
        $mail->Subject = $_POST['subject'];
        $mail->Body    = "<strong>Mensaje:</strong> " . nl2br($_POST['message']);

        // Enviar el correo
        $mail->send();
        echo 'Mensaje enviado correctamente.';
    } catch (Exception $e) {
        echo "Error al enviar el mensaje: {$mail->ErrorInfo}";
    }
} else {
    http_response_code(405);
    echo "Método no permitido";
}
?>
