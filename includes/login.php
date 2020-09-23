<?php

session_start();

if (!isset($_SESSION['user'])) {   
    $_SESSION['user'] = '';
    $_SESSION['nome'] = '';
    $_SESSION['tipo'] = '';
}


function gerarHash($senha) {
    $txt = cripto($senha);
    $hash = password_hash($txt, PASSWORD_DEFAULT);
    return $hash;
}

function testarhash($senha, $hash) {
    $senha1 = cripto($senha);
    $ok = password_verify($senha1, $hash);
    return $ok;
}

function cripto($senha) {
    $c = '';
    for($pos = 0; $pos < strlen($senha); $pos++) {
        $letra = ord($senha[$pos]) + 1;
        $c .= chr($letra);
    }
    return $c;
}

function logout() {
    unset($_SESSION['user']);
    unset($_SESSION['nome']);
    unset($_SESSION['tipo']);
}

function is_logado() {
    return !empty($_SESSION['user']);
}

function is_admin() {
    $t = $_SESSION['tipo'] ?? null;
    if (is_null($t)) {
        return false;
    } elseif ($t === 'admin') {
        return true;
    } else {
        return false;
    }
}

function is_editor() {
    $t = $_SESSION['tipo'] ?? null;
    if (is_null($t)) {
        return false;
    } elseif ($t === 'editor') {
        return true;
    } else {
        return false;
    }
}
