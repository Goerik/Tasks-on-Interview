<?php

/**
 * Функция выводит выводит имена файлов из каталога по заданному критерию 
 *
 * <code>
 * require_once 'find.php';
 * 
 * getDataFiles();
 * </code>
 *
 * @author Albert Umerov <albert@veryware.org>
 */
function getDataFiles() {
	$files = array();
	$iterator = new DirectoryIterator("./datafiles/");
	
	foreach ($iterator as $fileinfo) {
	    if ($fileinfo->isFile()) {
	        $files[] = $fileinfo->getFilename();
	    }
	}

	$filteredFiles = preg_grep("/^[A-Za-z0-9]*\.ixt$/", $files);
	sort($filteredFiles);

	foreach($filteredFiles as $file) {
		echo $file . "\n";
	}

}

?>