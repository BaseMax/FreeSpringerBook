<?php
$data=file_get_contents("input.txt");
preg_match_all('/http:\/\/([^\n]+)/i', $data, $matches);
$matches=$matches[0];
print_r($matches);
file_put_contents("links.txt", "");
foreach($matches as $matche) {
	file_put_contents("links.txt", $matche."\n", FILE_APPEND);
}
foreach($matches as $matche) {
	$res=file_get_contents($matche);
	if($res && $res!="") {
		preg_match('/<a href="(\/content\/pdf\/([^\"]+))\"/i', $res, $pdf);
		preg_match('/<title>([^\|]+)/i', $res, $h1);
		$h1=$h1[1];
		$pdf="https://link.springer.com".$pdf[1];
		print "## ".$h1."\n";
		print $pdf."\n";
		print "Read more: " . $matche."\n";
		print "\n";
	}
}
