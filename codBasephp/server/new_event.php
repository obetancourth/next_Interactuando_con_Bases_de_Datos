<?php

require_once 'libs/db.php';
session_start();
try {
    $db = new Conn('127.0.0.1', 'next_user', 'N3xt.2018-11', 'next', '3306');

    if (isset($_SESSION["usuariocod"])
        && isset($_POST["titulo"])
        && $_SESSION["usuariocod"] > 0
    ) {
        $sqlstr = "INSERT INTO `eventos`(`eventotitulo`, `eventofchini`,
            `eventohorini`, `eventofchfin`, `eventohorfin`, `usuariocod`,
            `eventotododia`) VALUES('%s','%s','%s',%s, %s, %d, %d);";
        $data = array(
          $_POST["titulo"],
          $_POST["start_date"],
          ($_POST["start_hour"]==="")?"00:00":$_POST["start_hour"],
          ($_POST["end_date"]==="")?"null":"'".$_POST["end_date"]."'",
          ($_POST["end_hour"]==="")?"null":"'".$_POST["end_hour"]."'",
          $_SESSION["usuariocod"],
          ($_POST["allDay"]==="true")
        );
        $insertedData = $db->ejecutarComando($sqlstr, $data);
        if ($insertedData > 0) {
            $newId = $db->obtenerUltimoId();
            echo json_encode(
                array(
                    "msg"=>"OK",
                    "id"=>$newId
                )
            );
        } else {
            echo json_encode(
                array(
                    "msg"=>"No se ha guardado ningún evento"
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
            "msg"=>"Error al ingresar los eventos"
        )
    );
}

?>
