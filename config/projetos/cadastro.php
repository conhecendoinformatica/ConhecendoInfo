<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
</head>
<body>
    <?php 
        $conexao = mysqli_connect("localhost","root","","conhecendoinformatica");
    ?>
    <script>
        function mostrarDisciplina() {
            var select_tipo = document.querySelector('#tipo_projetos').value;
            var div_disciplina = document.querySelector('#select_projetos');
            if(select_tipo == 'disciplina') {
                div_disciplina.style = "display:block";
            }
            else{
                div_disciplina.style = "display:none";
            }
        }

        function adicionarDesenvolvedor(){
            var div_desenvolvedores = document.querySelector("#pesquisa_desenvolvedor");
            if(tof){
                div_desenvolvedores.style = "display:block";
            }
            else{
                div_desenvolvedores.style = "display:none";
            }
            tof = !tof;
        }

        function pesquisaDesenvolvedores(){
            var alunos = document.querySelectorAll(".aluno");
            var desenvolvedor = document.querySelector("#pesquisa").value.replaceAll("á","a").replaceAll("ã","a").replaceAll("â","a").replaceAll("à","a").replaceAll("é","e").replaceAll("ê","e").replaceAll("í","i").replaceAll("ô","o").replaceAll("ó","o").replaceAll("õ","o").replaceAll("ú","u").toLowerCase().trim();
            for(var aluno of alunos){
                var nome = aluno.innerHTML.replaceAll("á","a").replaceAll("ã","a").replaceAll("â","a").replaceAll("à","a").replaceAll("é","e").replaceAll("ê","e").replaceAll("í","i").replaceAll("ô","o").replaceAll("ó","o").replaceAll("õ","o").replaceAll("ú","u").toLowerCase().trim();
                if(nome.indexOf(desenvolvedor)==-1 || desenvolvedores.includes(nome)){
                    aluno.style = "display:none";
                }
                else{
                    aluno.style = "display:block";
                }
            }
        }
        
        function preencheDesenvolvedor(id){
            var input = document.querySelector("#pesquisa");
            var aluno = document.querySelector("#id"+id);
            input.value = aluno.innerHTML;
            pesquisaDesenvolvedores();
        }

        function adicionaDesenvolvedor(){
            var alunos = document.querySelectorAll(".aluno");
            var desenvolvedor = document.querySelector("#pesquisa").value.trim();
            for(var aluno of alunos){
                console.log(aluno.style);
                if(aluno.style.cssText == "" || aluno.style.cssText == "display: block;"){
                    desenvolvedor = aluno.innerHTML;
                    break;
                }
            }
            desenvolvedores.push(desenvolvedor);
            document.querySelector("#desenvolvedores").innerHTML += `
                <div id="${desenvolvedor}" onclick="removeDesenvolvedor('${desenvolvedor}')">${desenvolvedor} X</div>
            `;
            document.querySelector("#pesquisa").value = "";
            document.querySelector("#post").value = desenvolvedores.join(";");
            pesquisaDesenvolvedores();
        }

        function removeDesenvolvedor(nome){
            desenvolvedores.splice(desenvolvedores.indexOf(nome),1);
            document.querySelector("#"+nome).remove();
            document.querySelector("#post").value = desenvolvedores.join(";");
            pesquisaDesenvolvedores();
        }
        var tof = true;
        var desenvolvedores = [];
    </script>
    <form action="visualizacao.php" method="post">
        <label for="nome_projetos">Nome:</label>
        <input type="text" id="nome_projetos" name="nome"><br>
        <label for="descricao_projetos">Descrição:</label>
        <textarea name="descricao" id="descricao_projetos"></textarea><br>
        <label for="tipo_projetos">Tipo de Projeto:</label>
        <select name="tipo" id="tipo_projetos" onchange="mostrarDisciplina()">
            <option value="pessoal">Pessoal</option>
            <option value="disciplina">Disciplina</option>
        </select><br>
        <div id="select_projetos" style="display: none;">
            <label for="disciplina_projetos">Disciplina:</label>
            <select name="disciplina" id="disciplina_projetos">
                <?php 
                    $query = "SELECT * FROM disciplinas";
                    $tabela = mysqli_query($conexao,$query);
                    while($linha = mysqli_fetch_array($tabela, MYSQLI_ASSOC)){
                ?>
                    <option value="<?=$linha['id']?>"><?=$linha['nome']?></option>
                <?php
                    }
                ?>
            </select>
        </div>
        <label for="desenvolvedor_projeto">Desenvolvedor:</label>
        <div id="desenvolvedores"></div>
        <div onclick="adicionarDesenvolvedor()">+</div>
        <input type="hidden" name="desenvolvedores" id="post">
        <br>
        <label for="ano_projetos">Ano:</label>
        <input type="number" name="ano" id="ano_projetos"><br>
        <label for="ano_escolar_projetos">Ano escolar:</label>
        <select name="ano_escolar" id="ano_escolar_projetos">
            <option value="1">1º ano</option>
            <option value="2">2º ano</option>
            <option value="3">3º ano</option>
            <option value="4">4º ano</option>
        </select>
        <br>
        <button type="submit" name="cadastro">Cadastrar</button>
    </form>
    <div id="pesquisa_desenvolvedor" style="display: none;">
        <input type="text" id="pesquisa" oninput="pesquisaDesenvolvedores()">
        <button onclick="adicionaDesenvolvedor()">Adicionar</button>
        <br>
        <div>
            <?php 
                $query = "SELECT * FROM membros WHERE cargo = 'aluno' ORDER BY nome ASC";
                $tabela = mysqli_query($conexao,$query);
                while($linha = mysqli_fetch_array($tabela, MYSQLI_ASSOC)){
            ?>
                <div class="aluno" id="id<?=$linha['id']?>" onclick="preencheDesenvolvedor('<?=$linha['id']?>');"><?=$linha['nome']?></div>
            <?php
                }
            ?>
            
        </div>
    </div>
</body>
</html>