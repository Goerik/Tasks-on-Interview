<?php

/**
 * Экземпляр этого класса заргужает данные из CSV файла
 *
 * <code>
 * require_once 'csvItem.php';
 * 
 * $folder = "/var/www/test2/csv";
 * $files = csvItem::getCsvList($folder);
 * $item = new csvItem($folder . "/" . $files[0]);
 * echo $item->getGoogleChartJson();
 * </code>
 *
 * @author Albert Umerov <albert@veryware.org>
 */
class csvItem {

	/**
     * Массив с подневной статистикой по скачанным и загруженным файлам
     *
     * @var array 
     */
	private $dailyStat = array(); 

	/**
     * Массив с пофайловой статистикой загруженных файлов
     *
     * @var array 
     */	
	private $fileStatByDay = array();  

	/**
     * Конструктор класса 
     */
	function __construct($csvFileName) {
		$dailyStat = array();
		$this->prepareCsv($csvFileName);
	}

	/**
     * Считывает переданный файл и заполняет массивы $dailyStat и $fileStatByDay на основе переданного csv-файла 
     */
	private function prepareCsv ($csvFileName) {
		if (($handle = fopen($csvFileName, "r")) !== FALSE) {
	    	while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
	    		
	    		$day = explode(" ", $data[0])[0];
	    		$type = $data[1];
	    		$filename = $data[2];
	    		
	    		$this->dailyStat[$day][$type] = isset($this->dailyStat[$day][$type]) ? $this->dailyStat[$day][$type] + 1 : 1;
	    		if ($type == "file_download") {
	    			$this->fileStatByDay[$day][$filename] = isset($this->fileStatByDay[$day][$filename]) ? $this->fileStatByDay[$day][$filename] + 1 :  1;
	    		}
		    }
		    fclose($handle);
			krsort($this->dailyStat);
		}
	}

	/**
     * Возвращает данные из загруженного csv-файла в JSON-формате, понятном Google Charts 
     * https://developers.google.com/chart/interactive/docs/php_example
     */
	function getGoogleChartJson() {
	    $rows = array();
	    foreach ($this->dailyStat as $key => $value) {
	    	$rows[] = array('c' => array(array('v' => $key), 
	    								array('v' => $value["file_upload"]), 
	    								array('v' => $value["file_download"]),
	    								array('v' => array_search(max($this->fileStatByDay[$key]), $this->fileStatByDay[$key])),
	    								));
	    }
		
		$data = array(
		        'cols' => array(
		                array('id' => '', 'label' => 'Day', 'type' => 'string'),
		                array('id' => '', 'label' => 'file_upload', 'type' => 'number'),
		                array('id' => '', 'label' => 'file_download', 'type' => 'number'),
		                array('id' => '', 'role' => 'tooltip', 'type' => 'string')
		        ),
		        'rows' => $rows
		);
		
		return json_encode($data);
	}

	/**
     * Статичный метод для получения списка имен csv-файлов в переданном каталоге
     */
	public static function getCsvList ($folder) {
        $files = array();
        $iterator = new DirectoryIterator($folder);
        
        foreach ($iterator as $fileinfo) {
            if ($fileinfo->isFile()) {
                $files[] = $fileinfo->getFilename();
            }
        }

        $filteredFiles = preg_grep("/^.*\.csv$/", $files);
        sort($filteredFiles);

		return $filteredFiles;
	}

}


?>