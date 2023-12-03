<?php
    class Concurso{
        public $id=0;
        public $fechaInicio;
        public $fechaFin;
        public $nombre="";
        public $descripcion="";
        public $estatus=0;

        public function __construct(){
            $this->fechaInicio=new DateTime();
            $this->fechaFin=new DateTime();
        }
    }
?>