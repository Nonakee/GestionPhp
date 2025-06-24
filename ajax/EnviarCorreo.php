<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../librerias/PHPMailer/PHPMailer.php';
require '../librerias/PHPMailer/SMTP.php';
require '../librerias/PHPMailer/Exception.php';
require '../config/Conexion.php';

// ✅ Vuelve a generar el PDF y lo guarda en archivo temporal
require_once 'ReporteProveedores.php';
use Dompdf\Dompdf;

$dompdf = new Dompdf();

// Consulta BD
$sql = "SELECT p.nombreEmpresa, pr.nombre AS contacto, c.nombre AS categoria, 
        p.telefono, p.email, p.direccion 
        FROM proveedores p
        INNER JOIN personas pr ON p.contacto = pr.idPersona
        INNER JOIN categorias c ON p.idCategoria = c.idCategoria
        ORDER BY p.nombreEmpresa ASC";

$resultado = ejecutarConsulta($sql);

$html = '
  <h1 style="text-align:center;">Reporte de Proveedores</h1>
  <table border="1" width="100%" cellspacing="0" cellpadding="5">
    <thead>
      <tr>
        <th>Empresa</th>
        <th>Contacto</th>
        <th>Categoría</th>
        <th>Teléfono</th>
        <th>Email</th>
        <th>Dirección</th>
      </tr>
    </thead>
    <tbody>';

while ($row = $resultado->fetch_assoc()) {
  $html .= '<tr>
    <td>' . $row['nombreEmpresa'] . '</td>
    <td>' . $row['contacto'] . '</td>
    <td>' . $row['categoria'] . '</td>
    <td>' . $row['telefono'] . '</td>
    <td>' . $row['email'] . '</td>
    <td>' . $row['direccion'] . '</td>
  </tr>';
}
$html .= '</tbody></table>';

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// ✅ Guardar PDF en archivo temporal
$pdfOutput = $dompdf->output();
$tempFile = '../reportes/Reporte_Proveedores.pdf';
file_put_contents($tempFile, $pdfOutput);

// ✅ Enviar por correo
$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'jhonayker.cortegana@gmail.com';
    $mail->Password = 'yhmtmprgiowabrel'; // tu clave de aplicación Gmail
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom('jhonayker.cortegana@gmail.com', 'Sistema de Reportes');
    $mail->addAddress('jhonayker.cortegana@gmail.com');

    $mail->isHTML(true);
    $mail->Subject = 'Reporte de Proveedores';
    $mail->Body    = 'Adjunto encontrarás el reporte de proveedores.';
    $mail->addAttachment($tempFile);

    $mail->send();
    echo "✅ Correo enviado correctamente.";
} catch (Exception $e) {
    echo "❌ Error al enviar el correo: " . $mail->ErrorInfo;
}
