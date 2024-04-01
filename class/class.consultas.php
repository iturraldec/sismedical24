<?php
session_start();
require_once("classconexion.php");

class conectorDB extends Db
{
	public function __construct()
    {
        parent::__construct();
    } 	
	
	public function EjecutarSentencia($consulta, $valores = array()){  //funcion principal, ejecuta todas las consultas
		$resultado = false;
		
		if($statement = $this->dbh->prepare($consulta)){  //prepara la consulta
			if(preg_match_all("/(:\w+)/", $consulta, $campo, PREG_PATTERN_ORDER)){ //tomo los nombres de los campos iniciados con :xxxxx
				$campo = array_pop($campo); //inserto en un arreglo
				foreach($campo as $parametro){
					$statement->bindValue($parametro, $valores[substr($parametro,1)]);
				}
			}
			try {
				if (!$statement->execute()) { //si no se ejecuta la consulta...
					print_r($statement->errorInfo()); //imprimir errores
					return false;
				}
				$resultado = $statement->fetchAll(PDO::FETCH_ASSOC); //si es una consulta que devuelve valores los guarda en un arreglo.
				$statement->closeCursor();
			}
			catch(PDOException $e){
				echo "Error de ejecución: \n";
				print_r($e->getMessage());
			}	
		}
		return $resultado;
		$this->dbh = null; //cerramos la conexión
	} /// Termina funcion consultarBD
}/// Termina clase conectorDB

class Json
{
	private $json;

	################################ BUSQUEDA DE CIE10 ################################
	public function BuscaCie10($filtro){
		$consulta = "SELECT CONCAT(codcie, ': ', nombrecie) AS label, idcie, codcie, nombrecie FROM cie10 WHERE codcie LIKE '%".$filtro."%' or nombrecie LIKE '%".$filtro."%' ORDER BY codcie ASC LIMIT 0,10";
		$conexion = new conectorDB();
		$this->json = $conexion->EjecutarSentencia($consulta);
		return $this->json;
	}
	################################ BUSQUEDA DE CIE10 ################################

	################################ BUSQUEDA DE PACIENTES ################################
	public function BuscaPacientes($filtro){
		$consulta = "SELECT 
		CONCAT(if(pacientes.documpaciente='0','DOCUMENTO',documentos.documento), ' ',cedpaciente, ' : ',pnompaciente, ' ',if(snompaciente='','',snompaciente), ' ',papepaciente, ' ',if(sapepaciente='','',sapepaciente)) as label, 
		codpaciente, 
		numerohistoria, 
		cedpaciente,
		gruposapaciente,
		/*pnompaciente
		snompaciente,
		papepaciente,
		sapepaciente,*/
		CONCAT(pnompaciente, ' ',if(snompaciente='','',snompaciente)) AS nompaciente,
		CONCAT(papepaciente, ' ',if(sapepaciente='','',sapepaciente)) AS apepaciente
		FROM pacientes LEFT JOIN documentos ON pacientes.documpaciente = documentos.coddocumento 
		WHERE CONCAT(pacientes.cedpaciente, ' ',pacientes.pnompaciente, ' ',if(pacientes.snompaciente='','',pacientes.snompaciente), ' ',pacientes.papepaciente, ' ',if(pacientes.sapepaciente='','',pacientes.sapepaciente)) 
		LIKE '%".$filtro."%' LIMIT 0,10";
		$conexion = new conectorDB;
		$this->json = $conexion->EjecutarSentencia($consulta);
		return $this->json;
	}
	################################ BUSQUEDA DE PACIENTES ################################

	################################ BUSQUEDA DE MEDICOS ################################
	public function BuscaMedicos($filtro){

    if ($_SESSION["acceso"]=="administradorG") {

    $consulta = "SELECT CONCAT(medicos.cedmedico, ' : ',medicos.nommedico) as label, medicos.codmedico FROM medicos INNER JOIN accesosxsucursales ON medicos.codmedico = accesosxsucursales.codusuario WHERE CONCAT(medicos.cedmedico, ' ',medicos.nommedico) LIKE '%".$filtro."%'  LIMIT 0,10";
        $conexion = new conectorDB;
		$this->json = $conexion->EjecutarSentencia($consulta);
		return $this->json;

	} else {

		$consulta = "SELECT CONCAT(medicos.cedmedico, ' : ',medicos.nommedico) as label, medicos.codmedico FROM medicos INNER JOIN accesosxsucursales ON medicos.codmedico = accesosxsucursales.codusuario WHERE CONCAT(medicos.cedmedico, ' ',medicos.nommedico) LIKE '%".$filtro."%' AND accesosxsucursales.codsucursal= '".strip_tags($_SESSION["codsucursal"])."' LIMIT 0,10";
		$conexion = new conectorDB;
		$this->json = $conexion->EjecutarSentencia($consulta);
		return $this->json;
	    }
	}
	################################ BUSQUEDA DE MEDICOS ################################

}/// TERMINA CLASE  ///
?>