<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Disciplina Cadastro</title>
</head>
<body>
    <form action="visualizacao.php" method="post">
        <label for="nome_disciplina">Nome:</label>
        <input name="nome" type="text" id="nome_disciplina"><br>
        <label for="ano_disciplina">Ano:</label>
        <select name="ano" id="ano_disciplina">
            <option value="1">1º ano</option>
            <option value="2">2º ano</option>
            <option value="3">3º ano</option>
            <option value="4">4º ano</option>
        </select>
        <br>
        <label for="descricao_disciplina">Descrição:</label>
        <textarea name="descricao" id="descricao_disciplina"></textarea>
        <button type="submit" name="cadastro">Cadastrar</button>
    </form>
</body>
</html>