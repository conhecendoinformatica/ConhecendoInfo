<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projetos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php 
        $conexao = mysqli_connect("localhost", "root", "", "conhecendoinformatica");
        if(isset($_POST['id_votos'])){
            $id = explode("-",$_POST['id_votos'])[0];
            $tof = explode("-",$_POST['id_votos'])[1];
            if($tof == 'true'){
                $query = "UPDATE projetos SET projetos.votos = projetos.votos + 1 WHERE id = $id";
            }
            else{
                $query = "UPDATE projetos SET projetos.votos = projetos.votos - 1 WHERE id = $id";
            }
            mysqli_query($conexao,$query);
        }
    ?>
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
        function dislike(id,cor) {
            const canvas = document.getElementById("canvas"+id);
            if (canvas.getContext) {
                const ctx = canvas.getContext("2d");
                ctx.fillStyle = cor;
	            ctx.fillRect(0, 0, canvas.width, canvas.height);
                ctx.beginPath();
                ctx.fillStyle = 'rgb(255,0,0)';
                ctx.moveTo(25,17);
                ctx.bezierCurveTo(20,5,5,5,5,20);
                ctx.bezierCurveTo(5,30,20,45,25,45);
                ctx.bezierCurveTo(30,45,45,30,45,20);
                ctx.bezierCurveTo(45,5,30,5,25,17);
                ctx.stroke();
            }
        }
        function like(id,cor){
            const canvas = document.getElementById("canvas"+id);
            if (canvas.getContext) {
                const ctx = canvas.getContext("2d");
                ctx.fillStyle = cor;
	            ctx.fillRect(0, 0, canvas.width, canvas.height);
                ctx.beginPath();
                ctx.fillStyle = 'rgb(255,0,0)';
                ctx.moveTo(25,17);
                ctx.bezierCurveTo(20,5,5,5,5,20);
                ctx.bezierCurveTo(5,30,20,45,25,45);
                ctx.bezierCurveTo(30,45,45,30,45,20);
                ctx.bezierCurveTo(45,5,30,5,25,17);
                ctx.fillStyle = "black"
                ctx.fill();
            }
        }
        function guardaLocalStorage(id){
            let button = document.querySelector("#button-"+id);
            
            if(localStorage.getItem("projeto-"+id)=="true"){
                localStorage.setItem("projeto-"+id,"false");
                button.value = id+"-false";
            }
            else{
                localStorage.setItem("projeto-"+id,"true");
                button.value = id+"-true";
            }
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
    <a href="index.php"><img src="img/logo.png" alt="Logo" class="logo"></a>
    <div class="banner-outros">
        <div class="titulo-banner-div">
            <span class="subtitulo-banner">Criatividade e tecnologia</span>
            <span class="fonte-destaque titulo-banner">Projetos</span>
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
    </div>
    <?php 
    $query = "SELECT count(*) as quantidade FROM projetos";
    $result = mysqli_query($conexao,$query);
    $linha = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $npaginas = ceil(intval($linha['quantidade'])/5);
    if(isset($_POST['pagina'])){
        $pagina = $_POST['pagina'];
    }
    else{
        $pagina = 0;
    }
    unset($_POST);
    $query = "SELECT * FROM projetos LIMIT 5 OFFSET ".($pagina*5);
    $result = mysqli_query($conexao,$query);
    $c = 0;
    while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)){
    ?>
    <div class="projeto projeto-<?php if($c%2 == 0){ echo '0';}else{ echo '1';}?>" id="projeto-<?=$linha['id']?>">
        <?php 
            if($c%2 == 0){
        ?>
            <div class="carrossel">
                <span class="voltar-carrossel voltar-carrossel-<?=$c?>" onclick="voltar(<?=$c?>,0)"><</span>
                <span class="passar-carrossel passar-carrossel-<?=$c?>" onclick="passar(<?=$c?>,0)">></span>
                <?php 
                    $query = "SELECT arquivos.endereco as endereco FROM arquivos JOIN projeto_arquivo ON arquivos.id = projeto_arquivo.arquivo WHERE projeto_arquivo.projeto = ".$linha['id'];
                    $resultado = mysqli_query($conexao,$query);
                    $i = 0;
                    while($arquivo = mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
                ?>
                <img src="uploads/<?=$arquivo['endereco']?>" id="img<?=$c?><?=$i?>" class="img<?=$c?> projeto-foto"<?php if($i==0){echo "style='opacity:100%;'";}else{echo "style='opacity:0%;'";}?>>
                <?php 
                        $i++;
                    }
                ?>
            </div>
        <?php 
            }
        ?>
        <div class="projeto-texto">
            <span class="projeto-titulo"><?=$linha['nome']?></span>
            <span class="destaque-descricao"><?=$linha['descricao']?></span>
            <span class="projeto-tipo">Feito como projeto <?=$linha['tipo']?></span>
            <?php 
                if($linha['tipo'] == "disciplinar"){
                    $query = "SELECT disciplinas.nome FROM disciplinas JOIN projeto_disciplina ON disciplinas.id = projeto_disciplina.disciplina WHERE projeto_disciplina.projeto = ".$linha['id'];
                    $resultado = mysqli_query($conexao,$query);
                    $disciplinas = mysqli_fetch_array($resultado, MYSQLI_ASSOC);
                    $disciplina = $disciplinas['nome'];
            ?>
            <span class="projeto-disciplina">Disciplina:<?=$disciplina?></span>
            <?php 
                }
            ?>
            <?php 
                $query = "SELECT count(*) as quantidade FROM membros JOIN projeto_membro ON membros.id = projeto_membro.membro WHERE projeto_membro.projeto = ".$linha['id'];
                $resultado = mysqli_query($conexao,$query);
                $quantidade1 = mysqli_fetch_array($resultado, MYSQLI_ASSOC);
                $quantidade2 = $quantidade1['quantidade'];
                $query = "SELECT membros.nome as nome FROM membros JOIN projeto_membro ON membros.id = projeto_membro.membro WHERE projeto_membro.projeto = ".$linha['id'];
                $resultado = mysqli_query($conexao,$query);
                if($quantidade2==1){
                    $membro = mysqli_fetch_array($resultado, MYSQLI_ASSOC);
            ?>
            <span class="projeto-desenvolvedores">Desenvolvedor: <?=$membro['nome']?>
            <?php 
                }else{
            ?>
            <span class="projeto-desenvolvedores">Desenvolvedores:
            <?php 
                    $j = 1;
                    while($membro = mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
                        if($j == $quantidade2-1){
            ?>
                    <?=$membro['nome']?> e
            <?php 
                        }
                        else if($j == $quantidade2){
            ?>
                    <?=$membro['nome']?>
            <?php 
                        }
                        else{
            ?>
                    <?=$membro['nome']?>,
            <?php   
                        }
                    $j++;
                    }
                }
            ?>
            </span>
            <span class="projeto-ano">Ano: <?=$linha['ano_escolar']?>º ano/<?=$linha['ano']?></span>
            <?php 
                if($linha['link']!=''){
            ?>
            <a href="<?=$linha['link']?>">Clique aqui para acessar o projeto</a>
            <?php
                }
            ?>
            <form action="update.php" method="post" id="curtida">
                <input type="hidden" name="pagina" value="<?=$pagina?>">
                <button type="submit" class="coracao-<?php if($c%2 == 0){ echo '0';}else{ echo '1';}?>" onclick="guardaLocalStorage(<?=$linha['id']?>)" name="id_votos" id="button-<?=$linha['id']?>">
                    <canvas id="canvas<?=$linha['id']?>" width="50" height="50"></canvas>
                </button>
                <span><?=$linha['votos']?></span>
            </form>
            <script>
                if(localStorage.getItem("projeto-<?=$linha['id']?>") == "true"){
                    like(<?=$linha['id']?>,"<?php if($c%2 == 0){ echo '#EEEEEE';}else{ echo '#98C1D9';}?>");
                }
                else{
                    dislike(<?=$linha['id']?>,"<?php if($c%2 == 0){ echo '#EEEEEE';}else{ echo '#98C1D9';}?>");
                }
            </script>
        </div>
        <?php 
            if(!($c%2 == 0)){
        ?>
            <div class="carrossel">
                <span class="voltar-carrossel voltar-carrossel-<?=$c?>" onclick="voltar(<?=$c?>,0)"><</span>
                <span class="passar-carrossel passar-carrossel-<?=$c?>" onclick="passar(<?=$c?>,0)">></span>
                <?php 
                    $query = "SELECT arquivos.endereco as endereco FROM arquivos JOIN projeto_arquivo ON arquivos.id = projeto_arquivo.arquivo WHERE projeto_arquivo.projeto = ".$linha['id'];
                    $resultado = mysqli_query($conexao,$query);
                    $i = 0;
                    while($arquivo = mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
                ?>
                <img src="uploads/<?=$arquivo['endereco']?>" id="img<?=$c?><?=$i?>" class="img<?=$c?> projeto-foto"<?php if($i==0){echo "style='opacity:100%;'";}else{echo "style='opacity:0%;'";}?>>
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
        <form action="projetos.php" method="post">
            <button class="seta-paginas-btt" value="<?php echo $pagina-3?>" name="pagina" type="submit"><<</button>
        </form>
        <?php
            }
            if($pagina>0){
        ?>
        <form action="projetos.php" method="post">
            <button class="seta-paginas-btt" value="<?php echo $pagina-1?>" name="pagina" type="submit"><</button>
        </form>
        <?php
            }
        ?>
        <form action="projetos.php" method="post">
            <button class="numero-paginas-btt" value="<?php echo $pagina?>" name="pagina" type="submit"><?php echo $pagina+1?></button>
        </form>
        <?php 
            if($npaginas-$pagina>1){
        ?>
        <form action="projetos.php" method="post">
            <button class="seta-paginas-btt" value="<?php echo $pagina+1?>" name="pagina" type="submit">></button>
        </form>
        <?php
            }
            if($npaginas-$pagina>3){
        ?>
        <form action="projetos.php" method="post">
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
        
    </script>
</body>
</html>