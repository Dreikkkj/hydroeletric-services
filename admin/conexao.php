<?php

$host = "localhost";
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