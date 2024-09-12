<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Docentes Cadastro</title>
</head>
<body>
    <form action="visualizacao.php" method="post" enctype="multipart/form-data">
        <label for="nome_docente">Nome:</label>
        <input name="nome" type="text"><br>
        <label for="descricao_docente">Descrição:</label>
        <textarea name="descricao" id="descricao_docente"></textarea>
        <label for="arquivos">Adicionar Foto de Perfil:</label>
        <input name="arquivo" id="arquivo_docente" type="file">
        <button type="submit" name="cadastro">Cadastrar</button>
    </form>
</body>
</html>