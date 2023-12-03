<?php
//importa la clase conexión y el modelo para usarlos
require_once 'conexion.php'; 
require_once '../modelos/concurso.php'; 

class DAOConcurso
{
    
	private $conexion; 
    
    private function conectar(){
        try{
			$this->conexion = Conexion::conectar(); 
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
    }
    
	public function obtenerTodos()
	{
		try
		{
            $this->conectar();
            
			$lista = array();
			$sentenciaSQL = $this->conexion->prepare("SELECT * FROM Concurso");
			$sentenciaSQL->execute();
            $resultado = $sentenciaSQL->fetchAll(PDO::FETCH_OBJ);
			foreach($resultado as $fila)
			{
				$obj = new Concurso();
                $obj->id = $fila->id_Concurso;
                $obj->fechaInicio = $fila->fechaInicio;
                $obj->fechaFin = $fila->fechaFin;
                $obj->nombre = $fila->nombreConcurso;
                $obj->descripcion = $fila->descripcion;
                $obj->estatus = $fila->estatus;
                $lista[] = $obj;
			}
            
			return $lista;
		}
		catch(PDOException $e){
			return $e;
		}finally{
            Conexion::desconectar();
        }
	}
    
    public function obtenerUno($id_Concurso)
	{
		try
		{ 
            $this->conectar();
			$obj = null; 
			$sentenciaSQL = $this->conexion->prepare("SELECT * FROM Concurso WHERE id_Concurso=?"); 
            $sentenciaSQL->execute([$id_Concurso]);
			$fila=$sentenciaSQL->fetch(PDO::FETCH_OBJ);
            $obj = new concurso();
            
            $obj->id_Concurso = $fila->id_Concurso;
            $obj->fechaInicio =  DateTime::createFromFormat('Y-m-d',$fila->fechaInicio);
            $obj->fechaFin =  DateTime::createFromFormat('Y-m-d',$fila->fechaFin);
            $obj->nombre = $fila->nombreConcurso;
            $obj->descripcion = $fila->descripcion;
            $obj->estatus = $fila->estatus;
           
            return $obj;
		}
		catch(Exception $e){
            return null;
		}finally{
            Conexion::desconectar();
        }
	}

	public function eliminar($id_Concurso)
	{
		try 
		{
			$this->conectar();
            
            $sentenciaSQL = $this->conexion->prepare("DELETE FROM Concurso WHERE id_Concurso = ?");			          
			$resultado=$sentenciaSQL->execute(array($id_Concurso));
			return $resultado;
		} catch (PDOException $e) 
		{
			return false;	
		}finally{
            Conexion::desconectar();
        }

		
        
	}

	public function editar(cooncurso $obj)
	{
		try 
		{
			$sql = "UPDATE Concurso
                    SET
                    fechaInicio = ?,
                    fechaFin = ?,
                    nombreConcurso = ?,
                    descripcion = ?,
                    estatus = ?,
                    WHERE id_Concurso = ?;";

            $this->conectar();
            
            $sentenciaSQL = $this->conexion->prepare($sql);
			$sentenciaSQL->execute(
				array($obj->fechaInicio,
                $obj->fechaFin,
                $obj->nombreConcurso,
                $obj->descripcion,
                $obj->estatus,
                $obj->id_Concurso)
				);
            return true;
		} catch (PDOException $e){
			return false;
		}finally{
            Conexion::desconectar();
        }
	}

    public function agregar(concurso $obj)
	{
        $clave=0;
		try 
		{
            $sql = "INSERT INTO concurso(fechaInicio,fechaFin,nombreConcurso,descripcion,estatus) 
                VALUES
                (:fechaInicio,
                :fechaFin,
                :nombreConcurso,
                :descripcion,
                :estatus)";
            $this->conectar();
            $this->conexion->prepare($sql)
                 ->execute(array(
                    ':fechaInicio'=>$obj->fechaInicio->format('Y-m-d'),
                    ':fechaFin'=>$obj->fechaFin->format('Y-m-d'),
                    ':nombreConcurso'=>$obj->nombre,
                    ':descripcion'=>$obj->descripcion,
                    ':estatus'=>$obj->estatus));
                 
            $clave=$this->conexion->lastInsertId();
            return $clave;
		} catch (Exception $e){
            echo $e;
			return $clave;
		}finally{
            Conexion::desconectar();
        }
	}
}