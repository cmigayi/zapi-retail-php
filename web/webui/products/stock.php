<?php
include_once "../templates/header.inc";

$json = file_get_contents('https://jsonplaceholder.typicode.com/todos/1');
$data = json_decode($json, true);
var_dump($data);

echo count($data[0]);

echo "
	<h2>Products stock</h2>
";

include_once "../templates/footer.inc";