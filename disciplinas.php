<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Disciplinas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <script>
        function movLink(mov) {
            if(mov == 'passar') {
                var pos = document.querySelector('.passar-link').id;
                var prox_anterior = (parseInt(pos)+1)%4;
            } else if(mov == 'voltar') {
                var pos = document.querySelector('.voltar-link').id;
                var prox_anterior = (parseInt(pos)+3)%4;
            }
            for(j=0;j<4;j++) {
                if(j != prox_anterior) {
                    document.querySelector(".link-"+j).style.display = 'none';
                } else {
                    document.querySelector(".link-"+prox_anterior).style.display = 'flex';
                }
            }
            document.querySelector('.passar-link').id = prox_anterior;
            document.querySelector('.voltar-link').id = prox_anterior;
        }   
    </script>
    <a href="index.php"><img src="img/logo.png" alt="Logo" class="logo"></a>
    <div class="banner-outros">
        <div class="titulo-banner-div">
            <span class="subtitulo-banner">Estudo e Aprendizado</span>
            <span class="fonte-destaque titulo-banner">Disciplinas Técnicas</span>
        </div>
    </div>
    <div id="links-index">
        <div class="link-outros link-0">
        <span class="voltar-link" id="0" onclick ="movLink('voltar')"><</span>
        <span class="passar-link" id="0" onclick ="movLink('passar')">></span>
            <div class="icone-link">
                <img src="img/projetos.png" alt="Projetos">
            </div>
            <a class="link-texto-outros" href="projetos.php">Projetos</a>
        </div>
        <div class="link-outros link-1">
        <span class="voltar-link" id="0" onclick ="movLink('voltar')"><</span>
        <span class="passar-link" id="0" onclick ="movLink('passar')">></span>
            <div class="icone-link">
                <img src="img/docentes.png" alt="Docentes">
            </div>
            <a class="link-texto-outros" href="docentes.php">Docentes Área Técnica</a>
        </div>
        <div class="link-outros link-2">
        <span class="voltar-link" id="0" onclick ="movLink('voltar')"><</span>
        <span class="passar-link" id="0" onclick ="movLink('passar')">></span>
            <div class="icone-link">
                <img src="img/destaques.png" alt="Destaques">
            </div>
            <a class="link-texto-outros" href="destaques.php">Destaques</a>
        </div>
        <div class="link-outros link-3">
        <span class="voltar-link" id="0" onclick ="movLink('voltar')"><</span>
        <span class="passar-link" id="0" onclick ="movLink('passar')">></span>
            <div class="icone-link">
                <img src="img/disciplinas.png" alt="Disciplinas">
            </div>
           <a class="link-texto-outros" href="disciplinas.php">Disciplinas Técnicas</a>
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
                    <br>
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
    <footer id="rodape">
        <img src="img/logo_ifrs.png" alt="">
        <div class="informacao-rodape">
            <span class="titulo-rodape">Comunicação</span>
            <div class="informacoes-rodape">
            <a class="link-rodape" href="https://ifrs.edu.br/riogrande/">Acesse o site do IFRS</a>
            <a class="link-rodape" href="https://ingresso.ifrs.edu.br/2025/">Processo Seletivo</a>
                <span>conhecendoinformaticaIFRS@gmail.com</span>
            </div>
        </div>
        <div class="informacao-rodape">
            <span class="titulo-rodape">Redes Sociais</span>
            <div class="informacoes-rodape">
                <span>@informaticaifrsrg</span>
            </div>
        </div>
    </footer>
</body>
</html>