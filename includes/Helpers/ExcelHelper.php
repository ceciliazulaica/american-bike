<?php
	/**
	 * Helper para la generacion de archivos excel
	 * 
	 * Desarrollado para voysis.com
	 */

	App::import('Vendors/Excel','PHPExcel.php');
	
	//extends PHPExcel
	Class ExcelHelper {

		/**
		 * Instancia única
		 * Singleton
		 */
		static private $instance = null;

		static private $PHPExel = null;

		static private $header 	= array();

		static private $rows 		= array();

		static private $options 	= array();
		/**
		 * Contructor privado 
		 */
		private function __construct(){}

		/**
		 * Devuelve la instancia de objeto
		 */
		public function getInstance()
		{
			if(!is_object(self::$instance)){
				self::$instance = new ExcelHelper();
				self::$PHPExel = new PHPExcel();
				self::setDefaultConfiguration();
			}
			return self::$instance;
		}

		private function setDefaultConfiguration()
		{
			self::set('type','Excel5');
			self::set('ext','xls');
			self::set('filename',TIME() . '.xls');
		}

		public function set($key,$value)
		{
			self::$options[$key] = $value;
		}

		/**
		 * Extencion para setear propiedades al archivo xls
		 * @param String $name  Nombre del valor [Creator|ModifiedBy|Title|Subject|Description|Keywords|Category]
		 * @param String $value valor de la propiedad
		 * @return  PHPExel
		 */
		public function setProperties($name,$value)
		{
			return self::$PHPExel->getProperties->set{$name}($value);
		}

		public function basicTemplate($aResulset, $_header = false)
		{
			// Obtener los headers de un array asociativo
			if(!$_header)
				$headers = array_keys($aResulset[0]);
			else
				$headers = $_header;

			$chr = 64;
			$row = $hrow = 1;
			$startCell = 1;

			// Crear el header
			self::$PHPExel->setActiveSheetIndex(0);
			foreach($headers AS $i => $value)
			{
				self::$PHPExel->getActiveSheet()->setCellValue(chr(($startCell + $i) + $chr).$row, $value);
			}
			// Incrementa 1 para volvar el rowset
			$row++;

			// Volvar los contenidos
			foreach($aResulset AS $aRow)
			{
				foreach($headers AS $i => $value)
				{
					$index = chr(($startCell + $i) + $chr).$row;
					$align = self::getAlign($aRow[$value]);
					self::$PHPExel->getActiveSheet()->setCellValue($index, $aRow[$value]);
					self::$PHPExel->getActiveSheet()->getStyle($index)->getAlignment()->setHorizontal($align);
					self::$PHPExel->getActiveSheet()->getStyle($index)->getAlignment()->setVertical('center');
					self::$PHPExel->getActiveSheet()->getColumnDimension(chr(($startCell + $i) + $chr))->setAutoSize(true);
					self::$PHPExel->getActiveSheet()->getStyle($index)->applyFromArray(
					array(
						'borders' => array(
							'outline'     => array(
			 					'style' => PHPExcel_Style_Border::BORDER_THIN,
			 					'color' => array('argb' => 'FFdcdfe1')
			 				),

						),
						'fill' => array(
				 			'type'       => PHPExcel_Style_Fill::FILL_SOLID,
				 			'startcolor' => array(
				 				'argb' => ($row % 2 == 1) ? 'FFf0f4f7' : 'FFFFFFFF'
				 			)
				 		)
					));

				}
				self::$PHPExel->getActiveSheet()->getRowDimension($row)->setRowHeight(25);
				$row++;
			}

			// Estilo para el header
			$offset = chr($startCell + $chr) . $hrow . ':' . chr(count($headers) + $chr) . $hrow;
			self::$PHPExel->getActiveSheet()->setAutoFilter($offset);
			self::$PHPExel->getActiveSheet()->getStyle($offset)->getAlignment()->setHorizontal('center');
			self::$PHPExel->getActiveSheet()->getStyle($offset)->getAlignment()->setVertical('center');
			self::$PHPExel->getActiveSheet()->getRowDimension($hrow)->setRowHeight(36);
			self::$PHPExel->getActiveSheet()->getStyle($offset)->applyFromArray(
					array(
						'font'    => array(
							'bold'      => true,
							'color'		=> array(
								'argb' => 'FFFFFFFF'
							)
						),
						'borders' => array(
							'bottom'     => array(
			 					'style' => PHPExcel_Style_Border::BORDER_THIN
			 				)
						),
						'fill' => array(
				 			'type'       => PHPExcel_Style_Fill::FILL_SOLID,
				 			'startcolor' => array(
				 				'argb' => 'FF228ADA'
				 			)
				 		)
					)
			);




			// Redirect output to a client’s web browser (Excel5)
			$ext 		= self::$options['ext'];
			$format		= self::$options['type'];
			$file_name 	= self::$options['filename'];

			self::$PHPExel->getProperties()->setTitle(self::$options['titulo']);



			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="' . $file_name . '"');
			header('Cache-Control: max-age=0');

			$objWriter = PHPExcel_IOFactory::createWriter(self::$PHPExel, $format);
			$objWriter->save('php://output');
			exit;
		}

		/**
		 * Devuelve la alineacion segun el contenido del texto
		 *
		 * Es probable que esto este mas al pedo que oreja de zordo, pero uno nunca sabe
		 * existen clientes que son muy especificos cuando muestran algun reporte, por ejemplo
		 * que los numeros se alinien a la derecha, las fechas a la izquierda, los nombres a 
		 * la izquierda, etc, etc, para esos caso se pueden aplicar reglas con expresiones regulares
		 * segun el contenido del texto, por ahora solo va a devolver si un campo es numerico alineancion derecha
		 * sino izquierda
		 * 		
		 * @param mixed $data contenido de la celda
		 * @return string [left|center|right]
		 */
		private function getAlign($data)
		{	
			$sCompare = trim($data);

			// Númerico
			if(preg_match('/^[0-9]+$/',$sCompare))
				return 'right';


			return 'left';
		}

	}
?>