<?php
	require_once 'csvItem.php';
	require_once 'config.php';

	if(isset($_GET['filename'])) {
        $filename = $_GET['filename'];
		$files = csvItem::getCsvList(CSV_FOLDER);

		if (in_array($filename, $files)) {
			$item = new csvItem(CSV_FOLDER . "/" . $filename );
			echo $item->getGoogleChartJson();
		}
    }
?>