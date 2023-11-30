<?php
//importa la clase conexión y el modelo para usarlos
require_once 'conexion.php'; 
require_once '../modelos/nombre.php'; 

class DAOnombre
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
			$sentenciaSQL = $this->conexion->prepare("SELECT id_Equipo,nombreEquipo,estudiante1,estudiante2,estudiante3,foto FROM Equipo");
			$sentenciaSQL->execute();
            $resultado = $sentenciaSQL->fetchAll(PDO::FETCH_OBJ);
			foreach($resultado as $fila)
			{
				$obj = new nombre();
                $obj->id_Equipo = $fila->id_Equipo;
	            $obj->nombreEquipo = $fila->nombreEquipo;
                $obj->estudiante1 = $fila->estudiante1;
                $obj->estudiante2 = $fila->estudiante2;
                $obj->estudiante3 = $fila->estudiante3;
                $obj->foto = $fila->foto;
                $lista[] = $obj;
			}
            
			return $lista;
		}
		catch(PDOException $e){
			return null;
		}finally{
            Conexion::desconectar();
        }
	}
    
    public function obtenerUno($id_Equipo)
	{
		try
		{ 
            $this->conectar();
			$obj = null; 
			$sentenciaSQL = $this->conexion->prepare("SELECT id_Equipo,nombreEquipo,estudiante1,estudiante2,estudiante3,foto FROM Equipo WHERE id_Equipo=?"); 
            $sentenciaSQL->execute([$id_Equipo]);
			$fila=$sentenciaSQL->fetch(PDO::FETCH_OBJ);
            $obj = new nombre();
            
            $obj->id_Equipo = $fila->id_Equipo;
	        $obj->nombreEquipo = $fila->nombreEquipo;
            $obj->estudiante1 = $fila->estudiante1;
            $obj->estudiante2 = $fila->estudiante2;
            $obj->estudiante3 = $fila->estudiante3;
            $obj->foto = $fila->foto;
           
            return $obj;
		}
		catch(Exception $e){
            return null;
		}finally{
            Conexion::desconectar();
        }
	}

	public function eliminar($id_Equipo)
	{
		try 
		{
			$this->conectar();
            
            $sentenciaSQL = $this->conexion->prepare("DELETE FROM Equipo WHERE id_Equipo = ?");			          
			$resultado=$sentenciaSQL->execute(array($id_Equipo));
			return $resultado;
		} catch (PDOException $e) 
		{

			return false;	
		}finally{
            Conexion::desconectar();
        }

		
        
	}

	public function editar(nombre $obj)
	{
		try 
		{
			$sql = "UPDATE Equipo
                    SET
                    nombreEquipo = ?,
                    estudiante1 = ?,
                    estudiante2 = ?,
                    estudiante3 = ?,
                    foto = ?,
                    WHERE id_Equipo = ?;";

            $this->conectar();
            
            $sentenciaSQL = $this->conexion->prepare($sql);
			$sentenciaSQL->execute(
				array($obj->nombreEquipo,
                $obj->estudiante1,
                $obj->estudiante2,
                $obj->estudiante3,
                $obj->foto,
                $obj->id_Equipo;)
					);
            return true;
		} catch (PDOException $e){
			return false;
		}finally{
            Conexion::desconectar();
        }
	}

    public function agregar(nombre $obj)
	{
        $clave=0;
		try 
		{
            $sql = "INSERT INTO Equipo
                (nombreEquipo,
                estudiante1,
                estudiante2,
                estudiante3,
                foto)
                VALUES
                (:nombreEquipo,
                :estudiante1,
                :estudiante2,
                :estudiante3,
                :foto;";
                
            $this->conectar();
            $this->conexion->prepare($sql)
                 ->execute(array(
                    ':nombreEquipo'=>$obj->nombreEquipo,
                    ':estudiante1'=>$obj->estudiante1,
                    ':estudiante2'=>$obj->estudiante2
                    ':estudiante3'=$obj->estudiante3,
                    ':foto'=$obj->foto,));
                 
            $clave=$this->conexion->lastInsertId();
            return $clave;
		} catch (Exception $e){
			return $clave;
		}finally{
            Conexion::desconectar();
        }
	}
}