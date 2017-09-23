<?php
ini_set('max_execution_time', 21600); //300 seconds = 5 minutes
 error_reporting(0);
?>
<!doctype html>
<html>
<head>
	<title>
		</title>
		</head>
<body>


	<table>
<thead>
<td>Domain</td>
<td>Email</td>
</thead>
<tbody>

	<?php
// Include the library
include('simplehtmldom/simple_html_dom.php');
 //$domain= 'refurbishweb.com';

$list = false;

if(isset($_POST['domainlist'])){
    $list = $_POST['domainlist'];
 } 
 
$lists = explode("\n",$list);
 $lists = array_map('trim',$lists);
 foreach ($lists as $domain)
 {
if (!empty($domain)) {

 $a = "http://". $domain;
 //$b = "http://www.". $domain;
// $c = "https://" . $domain;
 //$d = "https://www." . $domain;
  //$urls = array ($a, $b, $c, $d);
 $url = $a;
 //$arrlength = count($urls);

/* for($x = 0; $x < $arrlength; $x++) {
    echo $urls[$x];
    echo "<br>";
} */
extractmail($url,$domain);
}
}


function extractmail($url, $domain)
{

	$html = file_get_html($url);

	$res = preg_match_all(
"/[a-z0-9]+[_a-z0-9.-]*[a-z0-9]+@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,4})/i",$html,$matches);
if ($res) {
foreach(array_unique($matches[0]) as $email) {
	echo "<tr>";
	echo "<td>". $domain . "</td>";
	echo "<td>" .$email . "</td>";
	echo "</tr>";
}
}
else {
	echo "<tr>";
	echo "<td>". $domain . "</td>";
	echo "<td> No emails found </td>";
	echo "</tr>";
}
}
?>
<tbody>
	</table>

<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
	<textarea name="domainlist" cols="50" rows="25"></textarea>
	<button type="submit">Send</button>
</form>

</body>
</html>
