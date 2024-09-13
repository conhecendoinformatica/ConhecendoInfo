<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Destaque Visualizar</title>
</head>
<body>
    <?php
        $targetDir = "../../uploads/";
        $conexao = mysqli_connect("localhost", "root", "", "conhecendoinformatica");
        if (isset($_POST['cadastro'])) {
            $nome = $_POST['titulo'];
            $descricao = $_POST['descricao'];
            $ano = $_POST['ano'];
            $nfiles = intval($_POST['nfiles']);
            $query = "INSERT INTO destaques (titulo, descricao, ano) VALUES ('$nome', '$descricao', '$ano')";
            mysqli_query($conexao, $query);

            $query = "SELECT id FROM destaques ORDER BY 1 desc LIMIT 1";
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
                                $query = "INSERT INTO destaque_arquivo(destaque,arquivo) VALUES ('$id','$id2')";
                                mysqli_query($conexao,$query);
                            
                        }
                    }
        
                }
            }
        }

        if(isset($_POST['id_remover'])){
            $destaque_removido = $_POST["id_remover"];
            $query_remover = "DELETE FROM destaque_arquivo WHERE destaque = $destaque_removido";
            mysqli_query($conexao,$query_remover);
            $query_remover = "DELETE FROM destaques WHERE id = $destaque_removido";
            mysqli_query($conexao,$query_remover);
        }
        
        $query = "SELECT * FROM destaques";
        $resultado = mysqli_query($conexao, $query);

        while($linha = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
            $query = "SELECT arquivos.id as id, arquivos.endereco as endereco FROM arquivos JOIN destaque_arquivo ON arquivos.id = destaque_arquivo.arquivo WHERE destaque_arquivo.destaque = ".$linha['id'].";";
            $arquivos = mysqli_query($conexao,$query);
            echo 'Título: '.$linha['titulo'].'<br>desc: '.$linha['descricao'].'<br>ano: '.$linha['ano'].'<br> ';
            
    ?>
    Arquivos: <br>
    <?php 
            while($arquivo = mysqli_fetch_array($arquivos, MYSQLI_ASSOC)){
    ?>
    <img src="../../uploads/<?=$arquivo['endereco']?>" width="100">
    <?php 
            }
    ?>
    <form action="visualizacao.php" method="post">
        <button type="submit" name="id_remover" value="<?=$linha['id']?>">deletar</button>
    </form>

    <?php 
    }
    ?>
   
</body>
</html>