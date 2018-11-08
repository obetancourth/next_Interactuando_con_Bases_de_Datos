<?php

require_once 'libs/db.php';
session_start();
try {
    $db = new Conn('127.0.0.1', 'next_user', 'N3xt.2018-11', 'next', '3306');

    if (isset($_SESSION["usuariocod"])
        && isset($_POST["id"])
        && $_SESSION["usuariocod"] > 0
    ) {
        $sqlstr = "DELETE FROM  `eventos` WHERE `eventocod` = %d;";
        $data = array(
          intval($_POST["id"])
        );
        $deleteData = $db->ejecutarComando($sqlstr, $data);
        if ($deleteData > 0) {
            echo json_encode(
                array(
                    "msg"=>"OK"
                )
            );
        } else {
            echo json_encode(
                array(
                    "msg"=>"No se ha eliminado ningún evento"
                )
            );
        }
    } else {
        echo json_encode(
            array(
                "msg"=>"Error: no ha iniciado sesión!"
            )
        );
    }
} catch (Exception $error) {
    echo json_encode(
        array(
            "msg"=>"Error al eliminar los eventos"
        )
    );
}

?>
