<?php
//importa la clase conexión y el modelo para usarlos
require_once 'conexion.php'; 
require_once '../modelos/equipo.php'; 
require_once '../modelos/concurso.php'; 

class DAOEquipo
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
    
    public function obtenerConcursos(){
        try
		{
            $this->conectar();
            
			$lista = array();
			$sentenciaSQL = $this->conexion->prepare("SELECT id_Concurso, nombreConcurso from concurso where estatus = true;");

			$sentenciaSQL->execute();
            $resultado = $sentenciaSQL->fetchAll(PDO::FETCH_OBJ);
			foreach($resultado as $fila)
			{
				$obj = new concurso();
                $obj->id = $fila->id_Concurso;
	            $obj->nombre = $fila->nombreConcurso;
                echo $obj->id;
                $lista[] = $obj;
			}
			return $lista;
		}
		catch(PDOException $e){
            echo $e;
			return null;
		}finally{
            Conexion::desconectar();
        }
    }

	public function obtenerTodos()
	{
		try
		{
            $this->conectar();
            
			$lista = array();
			$sentenciaSQL = $this->conexion->prepare("SELECT E.id_Equipo, E.nombreEquipo, H.institucion, C.nombreConcurso, E.estatus  from Equipo E 
            join Usuario h on h.id_Usuario like E.coach join concurso c on c.id_Concurso like E.concurso where C.estatus=true and h.id_Usuario like ?;");

			$sentenciaSQL->execute([$_SESSION["usuario"]]);
            $resultado = $sentenciaSQL->fetchAll(PDO::FETCH_OBJ);
			foreach($resultado as $fila)
			{
				$obj = new equipo();
                $obj->id = $fila->id_Equipo;
	            $obj->nombreEquipo = $fila->nombreEquipo;
                $obj->institucion = $fila->institucion;
                $obj->concurso = $fila->nombreConcurso;
                $obj->estatus = $fila->estatus;
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

    public function obtenerTodosPorConcurso(Int $id_Concurso)
	{
		try
		{
            $this->conectar();
            
			$lista = array();
			$sentenciaSQL = $this->conexion->prepare("SELECT E.id_Equipo, E.nombreEquipo, H.institucion, C.nombreConcurso, H.nombre ,E.estatus  from Equipo E 
            join usuario h on h.id_Usuario like E.coach join concurso c on c.id_Concurso like E.concurso where C.id_Concurso=?;");

            $sentenciaSQL->execute([$id_Concurso]);
            $resultado = $sentenciaSQL->fetchAll(PDO::FETCH_OBJ);
			foreach($resultado as $fila)
			{
				$obj = new equipo();
                $obj->id = $fila->id_Equipo;
	            $obj->nombreEquipo = $fila->nombreEquipo;
                $obj->institucion = $fila->institucion;
                $obj->concurso = $fila->nombreConcurso;
                $obj->coach = $fila->nombre;
                $obj->estatus = $fila->estatus;
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
			$sentenciaSQL = $this->conexion->prepare("SELECT id_Equipo,nombreEquipo,estudiante1,estudiante2,estudiante3 FROM Equipo WHERE id_Equipo=?"); 
            $sentenciaSQL->execute([$id_Equipo]);
			$fila=$sentenciaSQL->fetch(PDO::FETCH_OBJ);
            $obj = new equipo();
            
            $obj->id = $fila->id_Equipo;
	        $obj->nombreEquipo = $fila->nombreEquipo;
            $obj->estudiante1 = $fila->estudiante1;
            $obj->estudiante2 = $fila->estudiante2;
            $obj->estudiante3 = $fila->estudiante3;
           
            echo $obj->id;
            return $obj;
		}
		catch(Exception $e){
            echo $e;
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

	public function editar(equipo $obj)
	{
		try 
		{
			$sql = "UPDATE Equipo
                    SET
                    nombreEquipo = ?,
                    estudiante1 = ?,
                    estudiante2 = ?,
                    estudiante3 = ?,
                    concurso = ?
                    WHERE id_Equipo = ?;";

            $this->conectar();
            
            $sentenciaSQL = $this->conexion->prepare($sql);
			$sentenciaSQL->execute(
				array($obj->nombreEquipo,
                $obj->estudiante1,
                $obj->estudiante2,
                $obj->estudiante3,
                $obj->concurso,
                $obj->id)
					);
            return true;
		} catch (PDOException $e){
			return false;
		}finally{
            Conexion::desconectar();
        }
	}

    public function ChangeEstatus(int $id)
	{
		try 
		{
			$sql = "UPDATE Equipo
                    SET
                    estatus = ?
                    WHERE id_Equipo = ?;";

            $this->conectar();
            
            $sentenciaSQL = $this->conexion->prepare($sql);
			$sentenciaSQL->execute(
				array(1,
                $id)
					);
            return true;
		} catch (PDOException $e){
			return false;
		}finally{
            Conexion::desconectar();
        }
	}

    public function agregar(equipo $obj,int $coach)
	{
        $clave=0;
		try 
		{
            $sql = "INSERT into Equipo(nombreEquipo,
                estudiante1,
                estudiante2,
                estudiante3,
                concurso,
                coach,
                estatus) values
                (:nombreEquipo,
                :estudiante1,
                :estudiante2,
                :estudiante3,
                :concurso,
                :coach,
                :estatus)";
                
            $this->conectar();
            $this->conexion->prepare($sql)
                 ->execute(array(
                    ':nombreEquipo'=>$obj->nombreEquipo,
                    ':estudiante1'=>$obj->estudiante1,
                    ':estudiante2'=>$obj->estudiante2,  
                    ':estudiante3'=>$obj->estudiante3,
                    ':concurso'=>$obj->concurso,
                    ':coach'=>$coach,
                    ':estatus'=>0));
                 
            $clave=$this->conexion->lastInsertId();
            return $clave;
		} catch (Exception $e){
            echo $e;
			return null;
		}finally{
            Conexion::desconectar();
        }
	}
}