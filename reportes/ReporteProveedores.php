<?php
require_once '../config/Conexion.php';
require_once '../dompdf/autoload.inc.php';
use Dompdf\Dompdf;

$dompdf = new Dompdf();

// Consulta a la BD
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

// Forzar que se muestre en el navegador
$dompdf->stream("reporte_proveedores.pdf", ["Attachment" => false]);
exit;
