<?php

$banco = new mysqli('localhost', 'root', '', 'bd_games');

if ($banco->connect_errno) {
    echo '<p>Encontrei um erro ' . $banco->connect_error . '</p>';
    die();
}

$banco->query("SET NAMES 'utf-8'");
$banco->query("SET CHARACTER_SET_CONNECTION = 'utf-8'");
$banco->query("SET CHARACTER_SET_RESULTS = 'utf-8'");
function a(){
    
}