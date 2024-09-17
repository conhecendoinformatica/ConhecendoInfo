<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Docentes</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <img src="img/logo.png" alt="Logo" class="logo">
    <div class="banner-index">
        <div class="titulo-banner-div">
            <span class="subtitulo-banner">Estudo e Aprendizado</span>
            <span class="fonte-destaque titulo-banner">Disciplinas Técnicas</span>
        </div>
    </div>
    <?php 
    $conexao = mysqli_connect("localhost", "root", "", "conhecendoinformatica");
    $query = "SELECT ano FROM disciplinas GROUP BY ano";
    $result = mysqli_query($conexao,$query);
    while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)){
    ?>
    <div class="ano-disciplinas ano-disciplinas-<?php if(intval($linha['ano'])%2 == 0){ echo '1';}else{ echo '0';}?>">
        <span class="titulo-ano"><?=$linha['ano']?>º Ano</span>
        <div class="disciplinas">
            <?php 
            $conexao = mysqli_connect("localhost", "root", "", "conhecendoinformatica");
            $query = "SELECT nome, descricao FROM disciplinas WHERE ano = ".$linha['ano'];
            $resultado = mysqli_query($conexao,$query);
            while($disciplina = mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
            ?>
            <div class="disciplina-div">
                <div class="linha-disciplina"></div>
                <div class="info-disciplina">
                    <span class="titulo-disciplina"><?=$disciplina['nome']?></span>
                    <span class="descricao-disciplina"><?=$disciplina['descricao']?></span>
                </div>
            </div>
            <?php 
            }
            ?>
        </div>
    </div>
    <?php 
    }
    ?>
</body>
</html>