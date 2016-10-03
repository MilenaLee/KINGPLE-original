<?php
	$fileName = $_REQUEST[filename];
	$DownloadPath = "file/".$fileName;
	$DownFile = $fileName;

	Header("Content-Type : file/unknown");
	Header("Content-Disposition : attachment; filename = ". $DownFile);
	Header("Content-Length :".filesize("$DownloadPath"));
	Header("Content-Transfer-Encoding : binary");
	Header("Pragma : no-cache");
	Header("Expries : 0");

	flush();
	if($fp = fopen("$DownloadPath", "r"))
	{
		print fread($fp, filesize("DownloadPath"));
		while(!feof($fp)) 
		{ 
			print fgets($fp, 1024); 
		}
	}
	fclose($fp);

?>