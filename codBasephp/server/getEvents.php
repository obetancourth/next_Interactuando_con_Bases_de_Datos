<?php
/**
 * Obtiene los datos de eventos asociados a un usuario en espeífico
 */

require_once 'libs/db.php';
session_start();
try {
    $db = new Conn('127.0.0.1', 'next_user', 'N3xt.2018-11', 'next', '3306');

    if (isset($_SESSION["usuariocod"]) && $_SESSION["usuariocod"] > 0) {
        $sqlstr = "select * from eventos where usuariocod=%d;";
        $eventos = $db->obtenerRegistros($sqlstr, array($_SESSION["usuariocod"]));
        $eventObjects = array();
        /*
        eventocod bigint(18) UN AI PK
        eventotitulo varchar(128)
        eventofchini date
        eventohorini time
        eventofchfin date
        eventohorfin time
        usuariocod bigint(18) UN
        eventotododia tinyint(4)
        */
        foreach ($eventos as $evento) {
            $eventObjects[] = array(
                "id" => $evento["eventocod"],
                "title" => $evento["eventotitulo"],
                "start" => $evento["eventofchini"].' '.$evento["eventohorini"],
                "end" => $evento["eventofchfin"].' '.$evento["eventohorfin"],
                "allDay" => ($evento["eventotododia"] && true)
            );
        }
        echo json_encode(
            array(
                "msg"=>"OK",
                "eventos"=> $eventObjects
            )
        );
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
            "msg"=>"Error al extraer los eventos"
        )
    );
}

?>
