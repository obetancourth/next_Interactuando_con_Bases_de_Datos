<?php
/**
 * Valida las credenciales del usuario con los datos de la base de datos
 */
require_once 'libs/db.php';
session_start();

$db = new Conn('127.0.0.1', 'next_user', 'N3xt.2018-11', 'next', '3306');
if (isset($_POST["username"])) {
    $userEmail = $_POST["username"];
    $userPswd = $_POST["password"];
    $sqlstr = "select * from usuarios where usuarioemail='%s';";
    $usuario = $db->obtenerUnRegistro($sqlstr, array($userEmail));
    if (count($usuario) > 0) {
        if (password_verify($userPswd, $usuario["usuariopswd"])) {
            $_SESSION["usuariocod"] = $usuario["usuariocod"];
            $_SESSION["userdata"] = $usuario;
            echo json_encode(
                array(
                    "verified" => true,
                    "message" => "Se ha validad las credenciales",
                    "msg" => "OK"
                )
            );
        } else {
            echo json_encode(
                array(
                    "verified" => false,
                    "message" => "Las credenciales no son válidas",
                    "msg" => "Las credenciales no son válidas p"
                )
            );
        }
    } else {
        echo json_encode(
            array(
                "verified" => false,
                "message" => "Las credenciales no son válidas",
                "msg" => "Las credenciales no son válidas"
            )
        );
    }
}

?>
