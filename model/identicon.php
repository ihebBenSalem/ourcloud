<?php
	# code...



function identicon_img($f){


$string=$f;


$b = 5;
$s = 400;
$n = ceil($b / 2);
$h = md5($string);
$hs = $b * $n;
$h = str_pad($h, $hs, $h);
$h_split = str_split($h);
$h = str_split($h);
sort($h);
$h = implode('', $h);
$c = substr($h, 0, 6);
$bs = $s / $b;
$image = imagecreate($s, $s);
$c = imagecolorallocate($image, hexdec(substr($c, 0, 2)), hexdec(substr($c, 2, 2)), hexdec(substr($c, 4, 2)));
$bg = imagecolorallocate($image, 255, 255, 255);
for ($i = 0; $i < $b; $i++) {
for ($j = 0; $j < $b; $j++) {
if ($i < $n) {
$px = hexdec($h_split[($i * 5) + $j]) % 2 == 0;
} else {
$px = hexdec($h_split[(($b - 1 - $i) * 5) + $j]) % 2 == 0;
}
$px_color = $bg;
if ($px) {
$px_color = $c;
}
imagefilledrectangle($image, $i * $bs, $j * $bs, ($i + 1) * $bs, ($j + 1) * $bs, $px_color);
}
}


header( "Content-type: image/png" );
imagepng( $image );
echo imagepng( $image );
}






?>




