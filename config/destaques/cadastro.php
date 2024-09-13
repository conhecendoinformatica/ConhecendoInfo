<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Destaque Cadastro</title>
</head>
<body>
    <script>
        function adicionarFile(){
            var nfiles = document.querySelector("#nfiles");
            var files = document.querySelector("#files");
            files.innerHTML += `
                <br>
                <input type="file" name="file${nfiles.value}" id="file${nfiles.value}">
            `;
            document.querySelector("#nfiles").value = (Number(nfiles.value) + 1) + "";
        }
    </script>
    <form action="visualizacao.php" method="post" enctype="multipart/form-data">
        <label for="titulo_destaque">Titulo:</label>
        <input name="titulo" type="text" id="titulo_destaque"><br>
        <label for="ano_destaque">Ano:</label>
        <input name="ano" type="number"><br>
        <label for="descricao_destaque">Descrição:</label>
        <textarea name="descricao" id="descricao_destaque"></textarea>
        <div id="files">
            <label for="file">Imagens/Vídeos:</label>
            <input type="hidden" name="nfiles" id="nfiles" value="1">
            <input type="file" name="file0" id="file0">
        </div>
        <div onclick="adicionarFile()">+</div>
        <button type="submit" name="cadastro">Cadastrar</button>
    </form>
</body>
</html>