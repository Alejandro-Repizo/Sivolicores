<?php

class ConexionDB {
    private $mySQLI;
    private $sql;
    private $result;
    private $filasAfectadas;
    private $datos;
    private $extraer;


    public function abrir(){
        $this->mySQLI = new mysqli("localhost","root","","dbsivolicores");
        if(mysqli_connect_errno()){
            return 1;
        }else{
            return 2;
        }
    }

    public function cerrar(){
        $this->mySQLI->close();
    }

    public function consulta($sql){
        $this->sql = $sql;
        $this->result = $this->mySQLI->query($this->sql);
        $this->filasAfectadas = $this->mySQLI->affected_rows;
    }

    public function obtenerResult(){
        return $this->result;
    }

    public function obtenerFilasAfectadas(){
        return $this->filasAfectadas;
    }

    public function confirmarDatos(){
        return $this->datos;
    }
}
