<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Docentes Visualizar</title>
</head>
<body>
    <?php
        $targetDir = "../../uploads/";
        $conexao = mysqli_connect("localhost", "root", '', "conhecendoinformatica");
        if (isset($_POST['cadastro']) && !empty($_FILES['arquivo']['name'])) {
            $fileName = basename($_FILES["arquivo"]["name"]);
        
            $fileNameModified = date("YmdHis").$fileName;
    
            $targetFilePath = $targetDir . $fileName ; 
            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION); 
            $targetFilePath = $targetDir.$fileNameModified; 
            
            // permite formatos de imagens abaixo
            $allowTypes = array('jpg','png','jpeg','gif','mp4','mov','avi','webm'); 
            if(in_array($fileType, $allowTypes)){ 
                // Upload file to server 
                if(move_uploaded_file($_FILES['arquivo']["tmp_name"], $targetFilePath)){ 
                    // Insert image file name into database 
                    
                        $nome = $_POST['nome'];
                        $descricao = $_POST['descricao'];
                        $query = "INSERT INTO membros(nome,descricao,cargo) VALUES ('$nome','$descricao','docente');";
                        mysqli_query($conexao,$query);
                        $query = "INSERT INTO arquivos(endereco) VALUES ('$fileNameModified')";
                        mysqli_query($conexao,$query);
                        $query = "SELECT id FROM membros ORDER BY 1 desc LIMIT 1";
                        $result = mysqli_query($conexao,$query); 
                        $linha = mysqli_fetch_array($result, MYSQLI_ASSOC);
                        $id = $linha['id'];
                        $query = "SELECT id FROM arquivos ORDER BY 1 desc LIMIT 1";
                        $result = mysqli_query($conexao,$query); 
                        $linha = mysqli_fetch_array($result, MYSQLI_ASSOC);
                        $id2 = $linha['id'];
                        $query = "INSERT INTO membro_arquivo(membro,arquivo) VALUES ('$id','$id2')";
                        mysqli_query($conexao,$query);
                    
                }
            }

        }

        if(isset($_POST["id_remover"])) {
            $docente_removida = $_POST["id_remover"];
            $query_remover = "DELETE FROM membro_arquivo WHERE membro = $docente_removida";
            mysqli_query($conexao,$query_remover);
            $query_remover = "DELETE FROM membros WHERE id = $docente_removida";
            mysqli_query($conexao,$query_remover);
        }
        
        $query = "SELECT * FROM membros WHERE cargo = 'docente'";
        $resultado = mysqli_query($conexao, $query);
        while($linha = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
            $query = "SELECT endereco FROM arquivos JOIN membro_arquivo ON arquivos.id = membro_arquivo.arquivo WHERE membro = ".$linha['id'];
            $result = mysqli_query($conexao, $query);
            $linha2 = mysqli_fetch_array($result, MYSQLI_ASSOC);
            echo 'Nome: '.$linha['nome'].'<br>desc: '.$linha['descricao']."<img src='../../uploads/".$linha2['endereco']."'>";
            
    ?>
    <form action="visualizacao.php" method="post">
        <button type="submit" name="id_remover" value="<?=$linha['id']?>">deletar</button>
    </form>

    <?php 
    }
    ?>
   
</body>
</html>