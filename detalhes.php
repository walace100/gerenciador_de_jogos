<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Titulo da Página</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="estilos/estilo.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    </head>
    <body>
        <?php
            require_once "includes/banco.php";
            require_once "includes/login.php";
            require_once "includes/funcoes.php";
        ?>
            
        <div id="corpo">
            <?php include_once "topo.php"; ?>
            <?php
                $c = $_GET['cod'] ?? 0;
                $busca = $banco->query("SELECT * FROM jogos WHERE cod = $c");
            ?>
            <h1>Detalhes do jogo</h1>
            <table class='detalhes'>
            <?php
                if (!$busca) {
                    echo "<tr><td>busca falhou! " . $banco->error;
                } elseif ($busca->num_rows == 1) {
                    $reg = $busca->fetch_object();
                    echo "<tr><td rowspan='3'><img src='" . thumb($reg->capa) . "' class='full'>";
                    echo "<td> <h2>$reg->nome</h2>";
                    echo "Nota: " . number_format($reg->nota, 1) . "/10.0 ";
                    if (is_admin()) {
                        echo "<i class='material-icons'>add_circle</i>";
                        echo "<i class='material-icons'>edit</i>";
                        echo "<i class='material-icons'>delete</i>";
                    } elseif (is_editor()) {
                        echo "<i class='material-icons'>edit</i>";
                    }
                    echo "<tr><td> $reg->descricao";
                } else {
                    echo "<tr><td>nenhum registro encontrado!";
                }
            ?>
            </table>
            <?= voltar(); ?>
        </div>
        <?php include_once "rodape.php" ?>
    </body>
</html>
