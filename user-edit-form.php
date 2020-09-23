<?php
    $q = "SELECT usuario, nome, senha, tipo FROM usuarios WHERE usuario = '" . $_SESSION['user'] . "'";
    $busca = $banco->query($q);
    $reg = $busca->fetch_object();
?>
<h1>Alteração de dados</h1>
<form action="user-edit.php" method="post">
    <table>
        <tr>
            <td> Usuário
            <td> <input type="text" name="usuario" id="usuario" size="10" maxlength="10" value="<?= $reg->usuario; ?>" readonly>
        <tr>
            <td> Nome
            <td> <input type="text" name="nome" id="nome" size="10" maxlength="30" value="<?= $reg->nome; ?>">
        <tr>
            <td> Tipo
            <td> <input type="text" name="tipo" id="tipo" readonly value="<?= $reg->tipo; ?>">
        <tr> 
            <td> Senha
            <td> <input type="password" name="senha1" id="senha1" size="10" maxlength="10">
        <td>
            <td> Confirme a senha
            <td> <input type="password" name="senha2" id="senha2" size="10" maxlength="10">
        <tr>
            <td> <button type="submit">Salvar</button>
    </table>
</form>