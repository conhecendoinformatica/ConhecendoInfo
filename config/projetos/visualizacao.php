<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projeto Visualizar</title>
</head>
<body>
    <?php 
        $targetDir = "../../uploads/";
        $conexao = mysqli_connect("localhost", "root", '', "conhecendoinformatica");
        if(isset($_POST['cadastro'])){
            $nome = $_POST['nome'];
            $descricao = $_POST['descricao'];
            $tipo = $_POST['tipo'];
            $ano = $_POST['ano'];
            $ano_escolar = $_POST['ano_escolar'];
            $link = $_POST['link'];
            $nfiles = intval($_POST['nfiles']);
            $desenvolvedores = explode(';',$_POST['desenvolvedores']);
            $query = "INSERT INTO projetos(nome,descricao,tipo,ano,ano_escolar,link) VALUES ('$nome','$descricao','$tipo',$ano,$ano_escolar,'$link');";
            mysqli_query($conexao,$query);
            $query = "SELECT id FROM projetos ORDER BY 1 desc LIMIT 1";
            $result = mysqli_query($conexao,$query); 
            $linha = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $id = $linha['id'];
            for($i = 0; $i < $nfiles; $i++){
                if (!empty($_FILES['file'.$i]['name'])) {
                    $fileName = basename($_FILES['file'.$i]["name"]);
                
                    $fileNameModified = date("YmdHis").$fileName;
            
                    $targetFilePath = $targetDir . $fileName ; 
                    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION); 
                    $targetFilePath = $targetDir.$fileNameModified; 
                    
                    // permite formatos de imagens abaixo
                    $allowTypes = array('jpg','png','jpeg','gif','mp4','mov','avi','webm'); 
                    if(in_array($fileType, $allowTypes)){ 
                        // Upload file to server 
                        if(move_uploaded_file($_FILES['file'.$i]["tmp_name"], $targetFilePath)){ 
                            // Insert image file name into database 
                                $query = "INSERT INTO arquivos(endereco) VALUES ('$fileNameModified')";
                                mysqli_query($conexao,$query);
                                $query = "SELECT id FROM arquivos ORDER BY 1 desc LIMIT 1";
                                $result = mysqli_query($conexao,$query); 
                                $linha = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                $id2 = $linha['id'];
                                $query = "INSERT INTO projeto_arquivo(projeto,arquivo) VALUES ('$id','$id2')";
                                mysqli_query($conexao,$query);
                            
                        }
                    }
        
                }
            }
            for($i = 0; $i < count($desenvolvedores); $i++){
                $query = "SELECT count(*) as linhas FROM membros WHERE nome = '".$desenvolvedores[$i]."' and cargo = 'aluno'";
                $result = mysqli_query($conexao,$query);
                $result2 = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $query = "SELECT id FROM membros WHERE nome = '".$desenvolvedores[$i]."' and cargo = 'aluno'";
                $result = mysqli_query($conexao,$query);
                if($result2['linhas']==0){
                    $query = "INSERT INTO membros(nome,cargo) VALUES ('".$desenvolvedores[$i]."','aluno');";
                    mysqli_query($conexao,$query);
                    $query = "SELECT id FROM membros ORDER BY 1 desc LIMIT 1";
                    $result = mysqli_query($conexao,$query);
                    $linha = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    $id2 = $linha['id'];
                }
                else{
                    $linha = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    $id2 = $linha['id'];
                }
                $query = "INSERT INTO projeto_membro(projeto,membro) VALUES ($id,$id2);";
                mysqli_query($conexao,$query);
            }
            if($tipo == "disciplina"){
                $disciplina = $_POST['disciplina'];
                $query = "INSERT INTO projeto_disciplina(projeto,disciplina) VALUES ($id,$disciplina);";
                mysqli_query($conexao,$query);
            }     
        }

        if(isset($_POST['id_remover'])){
            $projeto_removido = $_POST["id_remover"];
            $query_remover = "DELETE FROM projeto_arquivo WHERE projeto = $projeto_removido";
            mysqli_query($conexao,$query_remover);
            $query_remover = "DELETE FROM projeto_membro WHERE projeto = $projeto_removido";
            mysqli_query($conexao,$query_remover);
            $query_remover = "DELETE FROM projeto_disciplina WHERE projeto = $projeto_removido";
            mysqli_query($conexao,$query_remover);
            $query_remover = "DELETE FROM projetos WHERE id = $projeto_removido";
            mysqli_query($conexao,$query_remover);
        }

        $query = "SELECT * FROM projetos;";
        $projetos = mysqli_query($conexao,$query);
        while($linha = mysqli_fetch_array($projetos, MYSQLI_ASSOC)) {
            $query = "SELECT membros.id as id, membros.nome as nome FROM membros JOIN projeto_membro ON membros.id = projeto_membro.membro WHERE projeto_membro.projeto = ".$linha['id'].";";
            $desenvolvedores = mysqli_query($conexao,$query);
            $query = "SELECT count(*) as linhas FROM membros JOIN projeto_membro ON membros.id = projeto_membro.membro WHERE projeto_membro.projeto = ".$linha['id'].";";
            $result = mysqli_query($conexao,$query);
            $quantidade = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $query = "SELECT arquivos.id as id, arquivos.endereco as endereco FROM arquivos JOIN projeto_arquivo ON arquivos.id = projeto_arquivo.arquivo WHERE projeto_arquivo.projeto = ".$linha['id'].";";
            $arquivos = mysqli_query($conexao,$query);
            if($linha['tipo'] == 'disciplina'){
                $query = "SELECT disciplinas.id as id, disciplinas.nome as nome FROM arquivos JOIN projeto_disciplina ON disciplinas.id = projeto_disciplina.disciplina WHERE projeto_disciplina.projeto = ".$linha['id'].";";
                $resultado = mysqli_query($conexao,$query);
                $disciplina = mysqli_fetch_array($resultado, MYSQLI_ASSOC);
            }
    ?>
    Nome:<?=$linha['nome']?> <br>
    Descrição:<?=$linha['descricao']?> <br>
    Tipo:<?=ucfirst($linha['tipo'])?> <br>
    <?php 
            if(isset($disciplina)){
    ?>
    Disciplina: <?=$disciplina?> <br>
    <?php 
            }
    ?>
    Ano: <?=$linha['ano']?> <br>
    Ano escolar: <?=$linha['ano_escolar']?>º Ano <br>
    <?php 
            if($quantidade['linhas']==1){
                $desenvolvedor = mysqli_fetch_array($desenvolvedores, MYSQLI_ASSOC);
    ?>
    Desenvolvedor: <?=$desenvolvedor['nome']?>
    <?php 
            }
            else{
    ?>
    Desenvolvedores: 
    <?php 
                while($desenvolvedor = mysqli_fetch_array($desenvolvedores, MYSQLI_ASSOC)){
    ?>
    <?=$desenvolvedor['nome']?>,
    <?php 
                }
    ?>
    <br>
    <?php
            }
            if($linha['link']!=""){
    ?>
    Link:<?=$linha['link']?> <br>
    <?php 
            }
    ?>
    Arquivos: <br>
    <?php 
            while($arquivo = mysqli_fetch_array($arquivos, MYSQLI_ASSOC)){
    ?>
    <img src="../../uploads/<?=$arquivo['endereco']?>" width="100">
    <?php 
            }
    ?>
    <br>
    <form action="visualizacao.php" method="post">
        <button type="submit" name="id_remover" value="<?=$linha['id']?>">Deletar</button>
    </form>
    <?php 
        }
    ?>
    <br>
    <br>
</body>
</html>