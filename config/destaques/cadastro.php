<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Destaque Cadastro</title>
</head>
<body>
    <form action="visualizacao.php" method="post">
        <label for="titulo_destaque">Titulo:</label>
        <input name="titulo" type="text" id="titulo_destaque"><br>
        <label for="ano_destaque">Ano:</label>
        <input name="ano" type="number"><br>
        <label for="descricao_destaque">Descrição:</label>
        <textarea name="descricao" id="descricao_destaque"></textarea>
        <button type="submit" name="cadastro">Cadastrar</button>
    </form>
</body>
</html>