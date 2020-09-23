<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Login de Usuário</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="estilos/estilo.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <style>
            div#corpo {
                width: 270px;
                font-size: 13pt;
            }

            td {
                padding: 6px;
            }
        </style>
    </head>
    <body>
        <?php
            require_once "includes/banco.php";
            require_once "includes/login.php";
            require_once "includes/funcoes.php";
        ?>
        <div id="corpo">
            <?php
                $u = $_POST['usuario'] ?? null;
                $s = $_POST['senha'] ?? null;

                if (is_null($u) || is_null($s)) {
                    require_once "user-login-form.php";
                } else {
                    $q = "SELECT usuario, nome, senha, tipo FROM usuarios WHERE usuario = '$u' LIMIT 1";
                    $busca = $banco->query($q);
                    if (!$busca) {
                        echo msg_erro("Falha ao acessar o banco!");
                    } elseif($busca->num_rows > 0) {
                        $reg = $busca->fetch_object();
                        if (testarhash($s, $reg->senha)) {
                            echo msg_sucesso('logado com sucesso');
                            $_SESSION['user'] = $reg->usuario;
                            $_SESSION['nome'] = $reg->nome;
                            $_SESSION['tipo'] = $reg->tipo;
                        } else {
                            echo msg_erro("Senha Inválida");
                        }
                    } else {
                        echo msg_erro('Usuário não existe');
                    }
                }
                echo voltar();
            ?>
        </div>
        <?php require_once "rodape.php"; ?>
    </body>
</html>