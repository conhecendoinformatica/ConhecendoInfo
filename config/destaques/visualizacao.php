<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Destaque Visualizar</title>
</head>
<body>
    <?php
        $conexao = mysqli_connect("localhost", "root", "", "conhecendoinformatica");
        if (isset($_POST['cadastro'])) {
            $nome = $_POST['titulo'];
            $descricao = $_POST['descricao'];
            $ano = $_POST['ano'];

            $query = "INSERT INTO destaques (titulo, descricao, ano) VALUES ('$nome', '$descricao', '$ano')";
            mysqli_query($conexao, $query);

        }

        if(isset($_POST["id_remover"])) {
            $destaque_removida = $_POST["id_remover"];
            $query_remover = "DELETE FROM destaques WHERE id = $destaque_removida";
            mysqli_query($conexao,$query_remover);
        }
        
        $query = "SELECT * FROM destaques";
        $resultado = mysqli_query($conexao, $query);

        while($linha = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
            echo 'Título: '.$linha['titulo'].'<br>desc: '.$linha['descricao'].'<br>ano: '.$linha['ano'].'<br> ';
            
    ?>
    <form action="visualizacao.php" method="post">
        <button type="submit" name="id_remover" value="<?=$linha['id']?>">deletar</button>
    </form>

    <?php 
    }
    ?>
   
</body>
</html>