<?php
include '../../config.php';

/**
 *
 */
class MySQL
{
	private $oConBD =null;

	public function __construct(){
		global $usuarioBD, $passBD, $ipBD, $nombreBD;
		$this->$usuarioBD = "$usuarioBD";
		$this->$passBD = "$passBD";
		$this->$ipBD = "$ipBD";
		$this->$nombreBD = "$nombreBD";
	}

	public function conBDPDO()
		{
			try{
				$this->oConBD = new PDO("mysq:host-" . $this->ipBD . ";dbname-" . $this->nombreBD, $this->usuarioBD, $this->passBD);
				echo "conexion exitosa..." . "\n";
				return true;
			} catch (PDOException $e){
				echo "Error al conectar a la base de datos: " . $e->getMessage() . "\n";
				return false;
			}
		}
		public function getVendidos(){
			$vendidos = 0;
			try {
				$strQuery = "SELECT SUM(telefono) as vendidos FROM t_persona";
				if ($this->conBDPDO()) {
					$pQuery = $this->oConBD->prepare($strQuery);
					$pQuery->excute();
					$vendidos = $pQuery->fetchColumn();
				}
			} catch (PDOException $e){
				echo "MySQL getVendidos: " . $e->getMessage() . "\n";
				return -1;
			}
			return $vendidos;
		}
		public function getAlmacen(){
			$almacen = 0;
			try {
				$strQuery = "SELECT SUM(id) as enAlmacen FROM t_persona";
				if ($this->conBDPDO()) {
					$pQuery = $this->oConBD->prepare($strQuery);
					$pQuery->excute();
					$almacen = $pQuery->fetchColumn();
				}
			} catch (PDOException $e){
				echo "MySQL getAlmacen: " . $e->getMessage() . "\n";
				return -1;
			}
				return almacen;
		}
		public function getIngresos(){
			$ingreso = 0;
			try {
				$strQuery = "SELECT SUM(precio) as ingresos FROM t_persona";
				if ($this->conBDPDO()) {
					$pQuery = $this->oConBD->prepare($strQuery);
					$pQuery->excute();
					$ingreso = $pQuery->fetchColumn();
				}
			} catch (PDOException $e){
				echo "MySQL getIngresos: " . $e->getMessage() . "\n";
				return -1;
			}
			return ingreso;
		}

		public function getDatosGraficos(){
			$jDatos ='';
			$rawdata= array();
			$i = 0;
			try {
				$strQuery = "SELECT sum(precio) as tPrecio, SUM(cantidad_vendido) as tVendidos
				,date_format(fecha_alta, '%Y-%m-%d')as fecha FROM t_persona GROUP BY DATE_FORMAT(fecha_alta,'%Y-%m-%d')";
				if ($this->conBDPDO()) {
					$pQuery = $this->oConBD->prepare($strQuery);
					$pQuery->execute();
					$pQuery->setFetchMode(PDO::FETCH_ASSOC);
					while ($producto = $pQuery->fetch()) {
						$oGrafica = new Grafica();
						$oGrafica->totalPrecio = $producto['tPrecio'];
						$oGrafica->totalvendidos = $producto['tVendidos'];
						$oGrafica->fechaVenta = $producto['fecha'];
						$rawdata[$i] = $oGrafica;
						$i++;
					}
					$jDatos = json_encode($rawdata);
				}
			} catch (PDOException $e) {
				echo "MySQL.getDatosGrafica: " . $e->getMessage() . "\n";
				return -1;
			}
			return $jDatos;
		}
}
/**
 *
 */
class Grafica
{
public function $totalvendidos=0;
public function $totalprecio=0;
public function $fechaventa=0;
}
?>
