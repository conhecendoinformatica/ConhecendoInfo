<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Disciplina Visualizar</title>
</head>
<body>
    <?php
        $conexao = mysqli_connect("localhost", "root", "", "conhecendoinformatica");
        if (isset($_POST['cadastro'])) {
            $nome = $_POST['nome'];
            $descricao = $_POST['descricao'];
            $ano = $_POST['ano'];

            $query = "INSERT INTO disciplinas (nome, descricao, ano) VALUES ('$nome', '$descricao', '$ano')";
            mysqli_query($conexao, $query);

        }

        if(isset($_POST["id_remover"])) {
            $disciplina_removida = $_POST["id_remover"];
            $query_remover = "DELETE FROM disciplinas WHERE id = $disciplina_removida";
            mysqli_query($conexao,$query_remover);
        }
        
        $query = "SELECT * FROM disciplinas";
        $resultado = mysqli_query($conexao, $query);

        while($linha = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
            echo 'Nome: '.$linha['nome'].'<br>desc: '.$linha['descricao'].'<br>ano: '.$linha['ano'].'<br> ';
            
    ?>
    <form action="visualizacao.php" method="post">
        <button type="submit" name="id_remover" value="<?=$linha['id']?>">deletar</button>
    </form>

    <?php 
    }
    ?>
   
</body>
</html>