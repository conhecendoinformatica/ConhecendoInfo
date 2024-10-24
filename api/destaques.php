<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Destaques</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <script>
        function passar(ndiv,n){
            let imagens = document.querySelectorAll('.img'+ndiv);
            let next = (n+1)%imagens.length;
            imagens[n].setAttribute("style","animation-duration: 1s;animation-name: tira;opacity:0%;");
            for(let i = 0; i < imagens.length; i++){
                if(i == next){
                    imagens[i].setAttribute("style","animation-duration: 1s;animation-name: coloca;opacity:100%;");
                }
                else if(i!=n){
                    imagens[i].setAttribute("style","opacity:0%;");
                }
            }
            document.querySelector('.voltar-carrossel-'+ndiv).setAttribute("onclick","voltar("+ndiv+","+next+")");
            document.querySelector('.passar-carrossel-'+ndiv).setAttribute("onclick","passar("+ndiv+","+next+")");
        }
        function voltar(ndiv,n){
            let imagens = document.querySelectorAll('.img'+ndiv);
            let previous = (n+imagens.length-1)%imagens.length;
            imagens[n].setAttribute("style","animation-duration: 1s;animation-name: tira;opacity:0%;");
            for(let i = 0; i < imagens.length; i++){
                if(i == previous){
                    imagens[i].setAttribute("style","animation-duration: 1s;animation-name: coloca;opacity:100%;");
                }
                else if(i!=n){
                    imagens[i].setAttribute("style","opacity:0%;");
                }
            }
            document.querySelector('.voltar-carrossel-'+ndiv).setAttribute("onclick","voltar("+ndiv+","+previous+")");
            document.querySelector('.passar-carrossel-'+ndiv).setAttribute("onclick","passar("+ndiv+","+previous+")");
        }

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
    <a href="https://conhecendo-info.vercel.app/api/index.php"><img src="https://conhecendo-info.vercel.app/api/img/logo.png" alt="Logo" class="logo"></a>
    <div class="banner-outros">
        <div class="titulo-banner-div">
            <span class="subtitulo-banner">Sucesso e Prestígio</span>
            <span class="fonte-destaque titulo-banner">Destaques</span>
        </div>
    </div>
    <div id="links-index">
        <div class="link-outros link-0">
        <span class="voltar-link" id="0" onclick ="movLink('voltar')"><</span>
        <span class="passar-link" id="0" onclick ="movLink('passar')">></span>
            <div class="icone-link">
                <img src="https://conhecendo-info.vercel.app/api/img/projetos.png" alt="Projetos">
            </div>
            <a class="link-texto-outros" href="projetos.php">Projetos</a>
        </div>
        <div class="link-outros link-1">
        <span class="voltar-link" id="0" onclick ="movLink('voltar')"><</span>
        <span class="passar-link" id="0" onclick ="movLink('passar')">></span>
            <div class="icone-link">
                <img src="https://conhecendo-info.vercel.app/api/img/docentes.png" alt="Docentes">
            </div>
            <a class="link-texto-outros" href="https://conhecendo-info.vercel.app/api/docentes.php">Docentes Área Técnica</a>
        </div>
        <div class="link-outros link-2">
        <span class="voltar-link" id="0" onclick ="movLink('voltar')"><</span>
        <span class="passar-link" id="0" onclick ="movLink('passar')">></span>
            <div class="icone-link">
                <img src="https://conhecendo-info.vercel.app/api/img/destaques.png" alt="Destaques">
            </div>
            <a class="link-texto-outros" href="https://conhecendo-info.vercel.app/api/destaques.php">Destaques</a>
        </div>
        <div class="link-outros link-3">
        <span class="voltar-link" id="0" onclick ="movLink('voltar')"><</span>
        <span class="passar-link" id="0" onclick ="movLink('passar')">></span>
            <div class="icone-link">
                <img src="https://conhecendo-info.vercel.app/api/img/disciplinas.png" alt="Disciplinas">
            </div>
           <a class="link-texto-outros" href="disciplinas.php">Disciplinas Técnicas</a>
        </div>
    </div>
    <?php 
    $conexao = mysqli_connect("localhost", "root", "", "conhecendoinformatica");
    $query = "SELECT count(*) as quantidade FROM destaques";
    $result = mysqli_query($conexao,$query);
    $linha = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $npaginas = ceil(intval($linha['quantidade'])/5);
    if(isset($_POST['pagina'])){
        $pagina = $_POST['pagina'];
    }
    else{
        $pagina = 0;
    }
    $query = "SELECT * FROM destaques LIMIT 5 OFFSET ".($pagina*5);
    $result = mysqli_query($conexao,$query);
    $c = 0;
    while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)){
    ?>
    <div class="destaque destaque-<?php if($c%2 == 0){ echo '0';}else{ echo '1';}?>">
        <?php 
            if($c%2 == 0){
        ?>
            <div class="carrossel">
                <span class="voltar-carrossel voltar-carrossel-<?=$c?>" onclick="voltar(<?=$c?>,0)"><</span>
                <span class="passar-carrossel passar-carrossel-<?=$c?>" onclick="passar(<?=$c?>,0)">></span>
                <?php 
                    $query = "SELECT arquivos.endereco as endereco FROM arquivos JOIN destaque_arquivo ON arquivos.id = destaque_arquivo.arquivo WHERE destaque_arquivo.destaque = ".$linha['id'];
                    $resultado = mysqli_query($conexao,$query);
                    $i = 0;
                    while($arquivo = mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
                ?>
                <img src="https://conhecendo-info.vercel.app/api/uploads/<?=$arquivo['endereco']?>" id="img<?=$c?><?=$i?>" class="img<?=$c?> destaque-foto"<?php if($i==0){echo "style='opacity:100%;'";}else{echo "style='opacity:0%;'";}?>>
                <?php 
                        $i++;
                    }
                ?>
            </div>
        <?php 
            }
        ?>
        <div class="destaque-texto">
            <span class="destaque-titulo"><?=$linha['titulo']?></span>
            <span class="destaque-descricao"><?=$linha['descricao']?></span>
        </div>
        <?php 
            if(!($c%2 == 0)){
        ?>
            <div class="carrossel">
                <span class="voltar-carrossel voltar-carrossel-<?=$c?>" onclick="voltar(<?=$c?>,0)"><</span>
                <span class="passar-carrossel passar-carrossel-<?=$c?>" onclick="passar(<?=$c?>,0)">></span>
                <?php 
                    $query = "SELECT arquivos.endereco as endereco FROM arquivos JOIN destaque_arquivo ON arquivos.id = destaque_arquivo.arquivo WHERE destaque_arquivo.destaque = ".$linha['id'];
                    $resultado = mysqli_query($conexao,$query);
                    $i = 0;
                    while($arquivo = mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
                ?>
                <img src="uploads/<?=$arquivo['endereco']?>" id="img<?=$c?><?=$i?>" class="img<?=$c?> destaque-foto"<?php if($i==0){echo "style='opacity:100%;'";}else{echo "style='opacity:0%;'";}?>>
                <?php 
                        $i++;
                    }
                ?>
            </div>
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
        <form action="https://conhecendo-info.vercel.app/api/destaques.php" method="post">
            <button class="seta-paginas-btt" value="<?php echo $pagina-3?>" name="pagina" type="submit"><<</button>
        </form>
        <?php
            }
            if($pagina>0){
        ?>
        <form action="https://conhecendo-info.vercel.app/api/destaques.php" method="post">
            <button class="seta-paginas-btt" value="<?php echo $pagina-1?>" name="pagina" type="submit"><</button>
        </form>
        <?php
            }
        ?>
        <form action="https://conhecendo-info.vercel.app/api/destaques.php" method="post">
            <button class="numero-paginas-btt" value="<?php echo $pagina?>" name="pagina" type="submit"><?php echo $pagina+1?></button>
        </form>
        <?php 
            if($npaginas-$pagina>1){
        ?>
        <form action="https://conhecendo-info.vercel.app/api/destaques.php" method="post">
            <button class="seta-paginas-btt" value="<?php echo $pagina+1?>" name="pagina" type="submit">></button>
        </form>
        <?php
            }
            if($npaginas-$pagina>3){
        ?>
        <form action="https://conhecendo-info.vercel.app/api/destaques.php" method="post">
            <button class="seta-paginas-btt" value="<?php echo $pagina+3?>" name="pagina" type="submit">>></button>
        </form>
        <?php
            }
        ?>
    </div>
    <footer id="rodape">
        <img src="https://conhecendo-info.vercel.app/api/img/logo_ifrs.png" alt="">
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