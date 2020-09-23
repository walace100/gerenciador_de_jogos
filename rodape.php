<footer>
    <?php
        echo "<p> Acessado por ". $_SERVER['REMOTE_ADDR'] . " em " . date("d/m/Y") . " </p>";
        echo "Desenvolvido por Walace Paz &copy; " . date("Y");
        $banco->close();
    ?>
</footer>