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
			$sentenciaSQL = $this->conexion->prepare("SELECT id_Coach,nombre,correo,contrasenia,institucion FROM Coach");
			$sentenciaSQL->execute();
            $resultado = $sentenciaSQL->fetchAll(PDO::FETCH_OBJ);
			foreach($resultado as $fila)
			{
				$obj = new nombre();
                $obj->id_Coach = $fila->id_Coach;
	            $obj->nombre = $fila->nombre;
                $obj->correo = $fila->correo;
                $obj->contrasenia = $fila->contrasenia;
                $obj->institucion = $fila->institucion;
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
    
    public function obtenerUno($id_Coach)
	{
		try
		{ 
            $this->conectar();
			$obj = null; 
			$sentenciaSQL = $this->conexion->prepare("SELECT id_Coach,nombre,correo,contrasenia,institucion FROM Coach WHERE id_Coach=?"); 
            $sentenciaSQL->execute([$id_Coach]);
			$fila=$sentenciaSQL->fetch(PDO::FETCH_OBJ);
            $obj = new nombre();
            
            $obj->id_Coach = $fila->id_Coach;
	        $obj->nombre = $fila->nombre;
            $obj->correo = $fila->correo;
            $obj->contrasenia = $fila->contrasenia;
            $obj->institucion = $fila->institucion;
           
            return $obj;
		}
		catch(Exception $e){
            return null;
		}finally{
            Conexion::desconectar();
        }
	}

	public function eliminar($id_Coach)
	{
		try 
		{
			$this->conectar();
            
            $sentenciaSQL = $this->conexion->prepare("DELETE FROM Coach WHERE id_Coach = ?");			          
			$resultado=$sentenciaSQL->execute(array($id_Coach));
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
			$sql = "UPDATE Coach
                    SET
                    nombre = ?,
                    corre = ?,
                    contrasenia = sha2(?,224),
                    institucion = ?,
                    WHERE id_Coach = ?;";

            $this->conectar();
            
            $sentenciaSQL = $this->conexion->prepare($sql);
			$sentenciaSQL->execute(
				array($obj->nombre,
                $obj->correo,
                $obj->contrasenia,
                $obj->institucion,
                $obj->id_Coach;)
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
            $sql = "INSERT INTO Coach
                (nombre,
                correo,
                contrasenia,
                institucion)
                VALUES
                (:nombre,
                :correo,
                sha2(:contrasenia,224))
                :institucion;";
                
            $this->conectar();
            $this->conexion->prepare($sql)
                 ->execute(array(
                    ':nombre'=>$obj->nombre,
                    ':correo'=>$obj->correo,
                    ':contrasenia'=>$obj->contrasenia
                    ':institucion'=$obj->institucion));
                 
            $clave=$this->conexion->lastInsertId();
            return $clave;
		} catch (Exception $e){
			return $clave;
		}finally{
            Conexion::desconectar();
        }
	}
}