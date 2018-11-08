<?php

require_once 'libs/db.php';
session_start();
try {
    $db = new Conn('127.0.0.1', 'next_user', 'N3xt.2018-11', 'next', '3306');

    if (isset($_SESSION["usuariocod"])
        && isset($_POST["id"])
        && $_SESSION["usuariocod"] > 0
    ) {
        $sqlstr = "UPDATE `eventos` SET
            `eventofchini` = '%s',
            `eventohorini` = '%s',
            `eventofchfin` = %s,
            `eventohorfin` = %s
            WHERE `eventocod` = %d;";
        $data = array(
          $_POST["start_date"],
          ($_POST["start_hour"]==="")?"00:00":$_POST["start_hour"],
          ($_POST["end_date"]==="")?"null":"'".$_POST["end_date"]."'",
          ($_POST["end_hour"]==="")?"null":"'".$_POST["end_hour"]."'",
          intval($_POST["id"])
        );
        $updatedData = $db->ejecutarComando($sqlstr, $data);
        if ($updatedData > 0) {
            echo json_encode(
                array(
                    "msg"=>"OK"
                )
            );
        } else {
            echo json_encode(
                array(
                    "msg"=>"No se ha actualizado ningún evento"
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
            "msg"=>"Error al actualizar los eventos"
        )
    );
}

?>
