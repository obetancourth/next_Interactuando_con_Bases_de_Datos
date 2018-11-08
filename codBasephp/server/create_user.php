<?php
/**
 * Script genera tres usuario con contraseña encriptada
 */

require_once 'libs/db.php';

$db = new Conn('127.0.0.1', 'next_user', 'N3xt.2018-11', 'next', '3306');

$insSQL = "INSERT INTO `usuarios`
(`usuarioemail`,`usuarioname`,`usuariopswd`,`usuarioestado`,`usuariofechanac`)
VALUES ('%s','%s','%s','%s','%s');";

$usuario = array(
  "usuario_1@gmail.com",
  "Usuario de Prueba 1",
  password_hash('C4rt@6en4%', PASSWORD_DEFAULT),
  "ACT",
  date('Ymd')
);
$db->ejecutarComando($insSQL, $usuario);


$usuario = array(
  "usuario_2@gmail.com",
  "Usuario de Prueba 2",
  password_hash('C4rt@6en5%', PASSWORD_DEFAULT),
  "ACT",
  date('Ymd')
);
$db->ejecutarComando($insSQL, $usuario);

$usuario = array(
  "usuario_3@gmail.com",
  "Usuario de Prueba 3",
  password_hash('C4rt@6en6%', PASSWORD_DEFAULT),
  "ACT",
  date('Ymd')
);
$db->ejecutarComando($insSQL, $usuario);

echo "Se generaro los tres usuarios";

?>
