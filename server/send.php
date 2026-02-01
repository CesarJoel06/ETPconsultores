<?php
/**
 * ETP Consultores — Handler simple de envío de correo (PHP)
 * --------------------------------------------------------
 * Requisitos:
 * - Hosting con PHP y función mail() habilitada (o un MTA configurado).
 *
 * Seguridad / buenas prácticas:
 * - Validación básica de campos obligatorios.
 * - Sanitización simple de entradas.
 * - Reply-To al correo del cliente.
 *
 * Nota:
 * - Para producción, se recomienda usar un proveedor SMTP (PHPMailer) o un backend dedicado.
 */

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  http_response_code(405);
  echo json_encode(['ok' => false, 'error' => 'Método no permitido']);
  exit;
}

// ========= CONFIGURACIÓN =========
$TO = 'contacto@etpconsultores.com'; // <-- Cambia aquí el destinatario real
$SUBJECT = 'Nueva consulta web — ETP Consultores (Lima)';
// ================================

function clean($v) {
  $v = is_string($v) ? trim($v) : '';
  $v = str_replace(["\r", "\n"], ' ', $v); // evita inyección de headers
  return $v;
}

$nombre  = clean($_POST['nombre'] ?? '');
$email   = clean($_POST['email'] ?? '');
$telefono= clean($_POST['telefono'] ?? '');
$empresa = clean($_POST['empresa'] ?? '');
$servicio= clean($_POST['servicio'] ?? '');
$mensaje = trim($_POST['mensaje'] ?? '');

if ($nombre === '' || $email === '' || $mensaje === '') {
  http_response_code(400);
  echo json_encode(['ok' => false, 'error' => 'Faltan campos obligatorios']);
  exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  http_response_code(400);
  echo json_encode(['ok' => false, 'error' => 'Email inválido']);
  exit;
}

$host = $_SERVER['HTTP_HOST'] ?? 'etpconsultores.com';
$from = 'no-reply@' . preg_replace('/[^a-z0-9\.-]/i', '', $host);

$bodyLines = [
  "Nueva consulta desde la web de ETP Consultores (Lima):",
  "",
  "Nombre: " . $nombre,
  "Email: " . $email,
  "Teléfono: " . $telefono,
  "Empresa: " . $empresa,
  "Servicio: " . $servicio,
  "",
  "Mensaje:",
  $mensaje,
  "",
  "— Enviado automáticamente desde el formulario web"
];

$body = implode("\n", $bodyLines);

$headers = [];
$headers[] = 'From: ETP Consultores <' . $from . '>';
$headers[] = 'Reply-To: ' . $nombre . ' <' . $email . '>';
$headers[] = 'Content-Type: text/plain; charset=UTF-8';

$sent = @mail($TO, $SUBJECT, $body, implode("\r\n", $headers));

if ($sent) {
  echo json_encode(['ok' => true]);
  exit;
}

http_response_code(500);
echo json_encode(['ok' => false, 'error' => 'No se pudo enviar. Verifica que mail() esté habilitado en el servidor.']);
