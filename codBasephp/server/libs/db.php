<?php
/**
 * Libreria de Conexión a la base de datos
 */

class Conn
{
    private $_conn;
    private $_host;
    private $_user;
    private $_pswd;
    private $_database;
    private $_port;

    /**
     * Constructor
     *
     * @param string  $host     Ip o nombre de Dominio del servidor de Base de Datos
     * @param string  $user     Usuario al que se conecta la base de datos
     * @param string  $pswd     Contraseña para conectar la base de datos
     * @param string  $database Nombre de la base de datos
     * @param integer $port     Puerto de conexión a la base de datos
     */
    public function __construct($host, $user, $pswd, $database, $port = 3306)
    {
        $this->_host = $host;
        $this->_user = $user;
        $this->_pswd = $pswd;
        $this->_database = $database;
        $this->_port = $port;
        // Conectando a la base de datos desde el conector
        $this->_conn = new mysqli(
            $this->_host,
            $this->_user,
            $this->_pswd,
            $this->_database,
            $this->_port
        );
        if ($this->_conn->errno) {
            die($this->_conn->error);
        }
        $this->_conn->set_charset('utf8');
    }
    /**
     * Obtiene todos los registros del query con sus parametros
     *
     * @param string $sqlstr cadena SQL STANDARD con etiquetas de formato %s %d %f
     * @param array  $params arreglo con los valores que se remplazaran en el formato
     *
     * @return array Resultado del Query en un arreglo asociativo
     */
    public function obtenerRegistros($sqlstr, $params)
    {
        $sqlToExecute = vsprintf($sqlstr, $params);
        $resultset = array();
        $dataCursor = $this->_conn->query($sqlToExecute);
        foreach ($dataCursor as $row) {
            $resultset[] = $row;
        }
        return $resultset;
    }

    /**
     * Obtiene un registro del query con sus parametros
     *
     * @param string $sqlstr cadena SQL STANDARD con etiquetas de formato %s %d %f
     * @param array  $params arreglo con los valores que se remplazaran en el formato
     *
     * @return array Resultado del Query en un arreglo asociativo
     */
    public function obtenerUnRegistro($sqlstr, $params)
    {
        $sqlToExecute = vsprintf($sqlstr, $params);
        $resultset = array();
        $dataCursor = $this->_conn->query($sqlToExecute);
        foreach ($dataCursor as $row) {
            $resultset = $row;
            break;
        }
        return $resultset;
    }

    /**
     * Ejecuta un query que no devuelve datos, insert, update y delete
     *
     * @param string $sqlstr cadena SQL STANDARD con etiquetas de formato %s %d %f
     * @param array  $params arreglo con los valores que se remplazaran en el formato
     *
     * @return array Resultado del Query en un arreglo asociativo
     */
    public function ejecutarComando($sqlstr, $params)
    {
        $sqlToExecute = vsprintf($sqlstr, $params);
        $queryOk = $this->_conn->query($sqlToExecute);
        if ($queryOk) {
            return $this->_conn->affected_rows;
        } else {
            return 0;
        }

    }
    /**
     * Obtiene el último valor autonumerico generado en la conexión
     *
     * @return mixed Valor del ultimo identificador autonumerico generado
     */
    public function obtenerUltimoId()
    {
        return $this->_conn->insert_id;
    }
}
?>
