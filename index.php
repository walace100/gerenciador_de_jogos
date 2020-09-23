<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Listagem de Jogos</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="estilos/estilo.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    </head>
    <body>
        <?php
            require_once "includes/banco.php";
            require_once "includes/login.php";
            require_once "includes/funcoes.php";
            $ordem = $_GET['o'] ?? "n";
            $chave = $_GET['c'] ?? "";
        ?>
        <div id="corpo">
            <?php include_once "topo.php"; ?>
            <h1>Escolha seu jogo</h1>
            <form action="index.php" method="GET" id="busca">
                Ordenar:
                <a href="index.php?o=n&c=<?= $chave; ?>">Nome</a> | 
                <a href="index.php?o=p&c=<?= $chave; ?>">Produtora</a> | 
                <a href="index.php?o=n1&c=<?= $chave; ?>">Nota Alta</a> | 
                <a href="index.php?o=n2&c=<?= $chave; ?>">Nota Baixa</a> |
                <a href="index.php">Mostrar Todos</a> |
                Buscar:
                <input type="text" name="c" size="10" maxlength="40">
                <button>OK</button>
            </form>
            <table class="listagem">
                <?php
                    $q = "SELECT j.cod, j.nome, g.genero, j.capa, p.produtora FROM jogos AS j INNER JOIN generos AS g ON j.genero = g.cod INNER JOIN produtoras AS p ON j.produtora = p.cod ";

                    if (!empty($chave)) {
                        $q .= "WHERE j.nome LIKE '%$chave%' OR p.produtora LIKE '%$chave%' OR g.genero LIKE '%$chave%' ";
                    }

                    switch ($ordem) {
                        case "p":
                            $q .= "ORDER BY p.produtora";
                            break;
                        case "n1":
                            $q .= "ORDER BY j.nota DESC";
                            break;
                        case "n2":
                            $q .= "ORDER BY j.nota ASC";
                            break;
                        default:
                            $q .= "ORDER BY j.nome";
                            break;
                    }

                    $busca = $banco->query($q);
                    if (!$busca) {
                        echo "<tr><td> Infelizmente a busca deu errado" . $banco->error;
                    } elseif ($busca->num_rows === 0) {
                        echo "<tr><td> Nenhum registro encontrado";
                    } else {
                        while ($reg = $busca->fetch_object()) {
                            echo "
                            <tr>
                                <td> <img class='mini' src='" . thumb($reg->capa) . "'>
                                <td>  <a href='detalhes.php?cod=$reg->cod'> $reg->nome </a>
                                <br> ($reg->genero) $reg->produtora
                            ";
                            if (is_admin()) {
                                echo "<td><i class='material-icons'>add_circle</i>";
                                echo "<i class='material-icons'>edit</i>";
                                echo "<i class='material-icons'>delete</i>";
                            } elseif (is_editor()) {
                                echo "<td><i class='material-icons'>edit</i>";
                            }
                        }
                    }
                ?>
            </table>
        </div>
        <?php include_once "rodape.php" ?>
    </body>
</html>
