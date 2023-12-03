<?php
//importa la clase conexión y el modelo para usarlos
require_once 'conexion.php'; 
require_once '../modelos/usuario.php'; 

class DAOUsuario
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

			$sentenciaSQL = $this->conexion->prepare("SELECT * FROM Usuario");
			$sentenciaSQL->execute();
            $resultado = $sentenciaSQL->fetchAll(PDO::FETCH_OBJ);
			foreach($resultado as $fila)
			{
				$obj = new Usuario();
                $obj->id = $fila->id_Usuario;
	            $obj->usuario = $fila->usuario;
				$obj->institucion = $fila->institucion;
				$obj->nombre = $fila->nombre;
				$obj->tipo = $fila->tipo;
                $obj->contrasenia = $fila->contrasenia;
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
    
    public function obtenerUno($id_Usuario)
	{
		try
		{ 
            $this->conectar();
			$obj = null; 
			$sentenciaSQL = $this->conexion->prepare("SELECT id_Usuario,usuario,contrasenia FROM Usuarios WHERE id_Usuario=?"); 
            $sentenciaSQL->execute([$id_Usuario]);
			$fila=$sentenciaSQL->fetch(PDO::FETCH_OBJ);
            $obj = new Usuario();
            
            $obj->id_Usuario = $fila->id_Usuario;
	        $obj->usuario = $fila->usuario;
            $obj->contrasenia = $fila->contrasenia;
           
            return $obj;
		}
		catch(Exception $e){
            return null;
		}finally{
            Conexion::desconectar();
        }
	}

	public function eliminar($id_Usuario)
	{
		try 
		{
			$this->conectar();
            
            $sentenciaSQL = $this->conexion->prepare("DELETE FROM Usuario WHERE id_Usuario = ?");			          
			$resultado=$sentenciaSQL->execute(array($id_Usuario));
			return $resultado;
		} catch (PDOException $e) 
		{

			return false;	
		}finally{
            Conexion::desconectar();
        }

		
        
	}

	public function editar(Usuario $obj)
	{
		try 
		{
			$sql = "UPDATE Usuario
                    SET
                    usuario = ?,
                    contrasenia = sha2(?,224)
                    WHERE id_Usuario = ?;";

            $this->conectar();
            
            $sentenciaSQL = $this->conexion->prepare($sql);
			$sentenciaSQL->execute(
				array($obj->usuario,
                      $obj->contrasenia,
					  $obj->id_Usuario)
					);
            return true;
		} catch (PDOException $e){
			return false;
		}finally{
            Conexion::desconectar();
        }
	}

    public function agregar(Usuario $obj)
	{
        $clave=0;
		try 
		{
			$this->conectar();
            $sql = "INSERT INTO Usuario(nombre,institucion,usuario,contrasenia,tipo)
                VALUES
                (:nombre,
				:institucion,
				:usuario,
                sha2(:contrasenia,224),
				:tipo);";        
            $this->conexion->prepare($sql)
                 ->execute(array(
                    ':usuario'=>$obj->usuario,
					':nombre'=>$obj->nombre,
					':tipo'=>$obj->tipo,
					':institucion'=>$obj->institucion,
                 ':contrasenia'=>$obj->contrasenia));
                 
            $clave=$this->conexion->lastInsertId();
			
            return $clave;

		} catch (Exception $e){
			return $clave;

		}finally{
            Conexion::desconectar();
        }
	}
}