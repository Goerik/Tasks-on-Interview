<?php
	require_once 'csvItem.php';
	require_once 'config.php';

	$files = csvItem::getCsvList(CSV_FOLDER);

?>
<html>
	<head>
		<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.3.0/pure-min.css">
	</head>
<body>
<div align="center">
	<div id="table_div">
		<table class="pure-table pure-table-bordered">
			<thead>
				<tr><th>Filename (click to view details)</th></tr>
			</thead>
			<tbody>
				<?foreach($files as $file):?>			
				<tr><td><a href="result.html?filename=<?=$file?>"><?=$file?></a></td></tr>
				<?endforeach;?>
			</tbody>
		</table>
	</div>
</div>
</body>
</html>