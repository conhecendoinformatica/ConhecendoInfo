<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Docentes</title>
    <link rel="stylesheet" href="../css/style.css">
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
            <span class="subtitulo-banner">Conhecimento e excelência</span>
            <span class="fonte-destaque titulo-banner">Docentes da Área Técnica</span>
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
    $conexao = pg_connect("host=postgres://default:************@ep-icy-mountain-a4z390r0.us-east-1.aws.neon.tech:5432/verceldb?sslmode=require dbname=verceldb user=default password=92DyqdeouPBl");;
    $query = "SELECT count(*) as quantidade FROM membros WHERE cargo = 'docente'";
    $result = pg_query($conexao,$query);
    $linha = pg_fetch_array($result, PGSQL_ASSOC);
    $npaginas = ceil(intval($linha['quantidade'])/5);
    if(isset($_POST['pagina'])){
        $pagina = $_POST['pagina'];
    }
    else{
        $pagina = 0;
    }
    $query = "SELECT membros.nome as nome, membros.descricao as descricao, arquivos.endereco as endereco FROM membros JOIN membro_arquivo ON membro_arquivo.membro = membros.id JOIN arquivos ON membro_arquivo.arquivo = arquivos.id WHERE membros.cargo = 'docente' LIMIT 5 OFFSET ".($pagina*5);
    $result = mysqli_query($conexao,$query);
    $c = 0;
    while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)){
    ?>
    <div class="docente docente-<?php if($c%2 == 0){ echo '0';}else{ echo '1';}?>">
        <?php 
            if($c%2 == 0){
        ?>
        <img src="uploads/<?=$linha['endereco']?>" alt="Foto de Perfil" class="docente-foto">
        <?php 
            }
        ?>
        <div class="docente-texto">
            <span class="docente-titulo">Olá, meu nome é <?=$linha['nome']?></span>
            <span class="docente-descricao"><?=$linha['descricao']?></span>
        </div>
        <?php 
            if(!($c%2 == 0)){
        ?>
        <img src="uploads/<?=$linha['endereco']?>" alt="Foto de Perfil" class="docente-foto">
        <?php
        }
        ?>
    </div>
    <?php 
        $c++;
    }
    ?>
    <div class="paginacao">
        <?php 
            if($pagina>3){
        ?>
        <form action="docentes.php" method="post">
            <button class="seta-paginas-btt" value="<?php echo $pagina-3?>" name="pagina" type="submit"><<</button>
        </form>
        <?php
            }
            if($pagina>0){
        ?>
        <form action="docentes.php" method="post">
            <button class="seta-paginas-btt" value="<?php echo $pagina-1?>" name="pagina" type="submit"><</button>
        </form>
        <?php
            }
        ?>
        <form action="docentes.php" method="post">
            <button class="numero-paginas-btt" value="<?php echo $pagina?>" name="pagina" type="submit"><?php echo $pagina+1?></button>
        </form>
        <?php 
            if($npaginas-$pagina>1){
        ?>
        <form action="docentes.php" method="post">
            <button class="seta-paginas-btt" value="<?php echo $pagina+1?>" name="pagina" type="submit">></button>
        </form>
        <?php
            }
            if($npaginas-$pagina>3){
        ?>
        <form action="docentes.php" method="post">
            <button class="seta-paginas-btt" value="<?php echo $pagina+3?>" name="pagina" type="submit">>></button>
        </form>
        <?php
            }
        ?>
    </div>
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
    <script>
        function draw() {
        const canvas = document.getElementById("canvas");
        if (canvas.getContext) {
        const ctx = canvas.getContext("2d");

        // Cubic curves example
        ctx.beginPath();
        ctx.fillStyle = 'rgb(255,0,0)';
            ctx.moveTo(25,10);
            ctx.bezierCurveTo(25,0,0,0,0,10);
            // ctx.moveTo(25, 13.33);
            // ctx.bezierCurveTo(25, 12.33, 23.33, 8.33, 16.67, 8.33);
            // ctx.bezierCurveTo(6.67, 8.33, 6.67, 20.83, 6.67, 20.83);
            // ctx.bezierCurveTo(6.67, 26.67, 13.33, 34, 25, 40);
            // ctx.bezierCurveTo(36.67, 34, 43.33, 26.67, 43.33, 20.83);
            // ctx.bezierCurveTo(43.33, 20.83, 43.33, 8.33, 33.33, 8.33);
            // ctx.bezierCurveTo(28.33, 8.33, 25, 12.33, 25, 13.33);
        ctx.stroke();
        }
    }
    draw();
    </script>
</body>
</html>