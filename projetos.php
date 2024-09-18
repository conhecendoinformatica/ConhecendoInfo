<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Docentes</title>
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
    </script>
    <img src="img/logo.png" alt="Logo" class="logo">
    <div class="banner-index">
        <div class="titulo-banner-div">
            <span class="subtitulo-banner">Criatividade e tecnologia</span>
            <span class="fonte-destaque titulo-banner">Projetos</span>
        </div>
    </div>
    <?php 
    $conexao = mysqli_connect("localhost", "root", "", "conhecendoinformatica");
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
    $query = "SELECT * FROM projetos LIMIT 5 OFFSET ".($pagina*5);
    $result = mysqli_query($conexao,$query);
    $c = 0;
    while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)){
    ?>
    <div class="projeto projeto-<?php if($c%2 == 0){ echo '0';}else{ echo '1';}?>">
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
                    $query = "SELECT arquivos.endereco as endereco FROM arquivos JOIN projeto_arquivo ON arquivos.id = projeto_arquivo.arquivo WHERE projeto_arquivo.projeto = ".$linha['id'];
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
            <span class="projeto-ano">Ano:<?=$linha['ano_escolar']?>º ano/<?=$linha['ano']?></span>
            
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
</body>
</html>