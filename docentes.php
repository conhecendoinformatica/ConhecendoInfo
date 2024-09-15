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
            <span class="subtitulo-banner">Conhecimento e excelência</span>
            <span class="fonte-destaque titulo-banner">Docentes Técnicos</span>
        </div>
    </div>
    <?php 
    $conexao = mysqli_connect("localhost", "root", "", "conhecendoinformatica");
    $query = "SELECT membros.nome as nome, membros.descricao as descricao, arquivos.endereco as endereco FROM membros JOIN membro_arquivo ON membro_arquivo.membro = membros.id JOIN arquivos ON membro_arquivo.arquivo = arquivos.id WHERE membros.cargo = 'docente'";
    $result = mysqli_query($conexao,$query);
    $c = 0;
    while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)){
    ?>
    <div class="docente docente-<?php if($c%2 == 0){ echo '0';}else{ echo '1';}?>">
        <img src="uploads/<?=$linha['endereco']?>" alt="Foto de Perfil" class="docente-foto">
        <div class="docente-texto">
            <span class="docente-titulo">Olá, meu nome é <?=$linha['nome']?></span>
            <span class="docente-descricao"><?=$linha['descricao']?></span>
        </div>
    </div>
    <?php 
        $c++;
    }
    ?>
</body>
</html>