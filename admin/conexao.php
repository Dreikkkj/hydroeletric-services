<?php

$host = "127.0.0.1";
$user = "dev";
$pass = "123";
$banco = "db_hydro";

$conn = mysqli_connect(
	$host,
	$user,
	$pass,
	$banco
);
if(!$conn) {
	die("Erro na conexão!");
}
?>