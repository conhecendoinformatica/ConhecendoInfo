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
            <span class="subtitulo-banner">Sucesso e Prestígio</span>
            <span class="fonte-destaque titulo-banner">Docentes Técnicos</span>
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
    $query = "SELECT * as descricao FROM destaques LIMIT 5 OFFSET ".($pagina*5);
    $result = mysqli_query($conexao,$query);
    $c = 0;
    while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)){
    ?>
    <div class="destaque destaque-<?php if($c%2 == 0){ echo '0';}else{ echo '1';}?>">
        <?php 
            if($c%2 == 0){
        ?>
            <div class="carrossel">
                <?php 
                    $query = "SELECT arquivos.endereco as endereco FROM arquivos JOIN destaque_arquivo ON arquivos.id = destaque_arquivo.arquivo WHERE destaque_arquivo.destaque = ".$linha['id'];
                    $resultado = mysqli_query($conexao,$query);
                    $i = 0;
                    while($arquivo = mysqli_fetch_array($arquivo, MYSQLI_ASSOC)){
                ?>
                <img src="uploads/<?=$arquivo['endereco']?>" id="img<?=$c?><?=$i?>" class="img<?=$c?>">
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
        <form action="destaques.php" method="post">
            <button value="<?php echo $pagina-3?>" type="submit"><<</button>
        </form>
        <?php
            }
            if($pagina>0){
        ?>
        <form action="destaques.php" method="post">
            <button value="<?php echo $pagina-1?>" type="submit"><</button>
        </form>
        <?php
            }
        ?>
        <form action="destaques.php" method="post">
            <button value="<?php echo $pagina?>" type="submit"><?php echo $pagina+1?></button>
        </form>
        <?php 
            if($npaginas-$pagina>1){
        ?>
        <form action="destaques.php" method="post">
            <button value="<?php echo $pagina+1?>" type="submit">></button>
        </form>
        <?php
            }
            if($npaginas-$pagina>3){
        ?>
        <form action="destaques.php" method="post">
            <button value="<?php echo $pagina+3?>" type="submit">>></button>
        </form>
        <?php
            }
        ?>
    </div>
</body>
</html>