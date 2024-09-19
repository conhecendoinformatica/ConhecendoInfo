<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Docentes</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <a href="index.php"><img src="img/logo.png" alt="Logo" class="logo"></a>
    <div class="banner-outros">
        <div class="titulo-banner-div">
            <span class="subtitulo-banner">Conhecimento e excelência</span>
            <span class="fonte-destaque titulo-banner">Docentes Técnicos</span>
        </div>
    </div>
    <div id="links-index">
        <div class="link-outros">
            <div class="icone-link">
                <img src="img/projetos.png" alt="Projetos">
            </div>
            <a class="link-texto-outros" href="projetos.php">Projetos</a>
            </div>
            <div class="link-outros">
                <div class="icone-link">
                    <img src="img/docentes.png" alt="Docentes">
                </div>
            <a class="link-texto-outros" href="docentes.php">Docentes da Área Técnica</a>
            </div>
            <div class="link-outros">
                <div class="icone-link">
                    <img src="img/destaques.png" alt="Destaques">
                </div>
            <a class="link-texto-outros" href="destaques.php">Destaques</a>
            </div>
            <div class="link-outros">
                <div class="icone-link">
                    <img src="img/disciplinas.png" alt="Disciplinas">
                </div>
           <a class="link-texto-outros" href="disciplinas.php">Disciplinas Técnicas</a>
            </div>
        </div>
    <?php 
    $conexao = mysqli_connect("localhost", "root", "", "conhecendoinformatica");
    $query = "SELECT count(*) as quantidade FROM membros WHERE cargo = 'docente'";
    $result = mysqli_query($conexao,$query);
    $linha = mysqli_fetch_array($result, MYSQLI_ASSOC);
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
            <a class="link-rodape" href="https://ingresso.ifrs.edu.br/2024/editais/?_gl=1*970wd2*_ga*NjI3MDE5ODUzLjE3MjI4NzYwNDM.*_ga_HCJKMD2J4X*MTcyNjc2NDM5Mi4xMS4xLjE3MjY3NjQ0OTcuMC4wLjA.">Processo Seletivo</a>
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