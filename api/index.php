<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <script>
        function movLink(mov) {
            if(mov == 'passar') {
                var pos = document.querySelector('.passar-link').id;
                var prox_anterior = (parseInt(pos)+1)%4;
            } else if(mov == 'voltar') {
                var pos = document.querySelector('.voltar-link').id;
                var prox_anterior = (parseInt(pos)+3)%4;
            }
            for(j=0;j<4;j++) {
                if(j != prox_anterior) {
                    document.querySelector(".link-"+j).style.display = 'none';
                } else {
                    document.querySelector(".link-"+prox_anterior).style.display = 'flex';
                }
            }
            document.querySelector('.passar-link').id = prox_anterior;
            document.querySelector('.voltar-link').id = prox_anterior;
        }
    </script>
    <div>
        <a href="https://conhecendo-info.vercel.app/api/index.php"><img src="https://conhecendo-info.vercel.app/api/img/logo.png" alt="Logo" class="logo"></a>
        <div class="banner-index">
            <div class="titulo-banner-div">
                <span class="subtitulo-banner">Conhecendo o curso de</span>
                <span class="fonte-destaque titulo-banner">Informática para internet</span>
            </div>
        </div>
       
        <div id="links-index">
            <div class="link-index link-0">
                <span class="voltar-link" id="0" onclick ="movLink('voltar')"><</span>
                <span class="passar-link" id="0" onclick ="movLink('passar')">></span>
                <div class="icone-link">
                    <img src="https://conhecendo-info.vercel.app/api/img/projetos.png" alt="Projetos">
                </div>
                <span class="link-texto">Projetos</span>
                <span class="link-texto2">
                    Veja a produção científica do curso através de projetos dos estudantes
                </span>
                <form action="https://conhecendo-info.vercel.app/api/projetos.php">
                    <button class="botao-index" type="submit">Saiba mais</button>
                </form>
            </div>
            <!-- <span class="voltar-link voltar-link2" onclick ="voltarLink('link-1')"><</span>
            <span class="passar-link passar-link2" onclick ="passarLink('link-1')">></span> -->
            <div class="link-index link-1">
            <span class="voltar-link" id="0" onclick ="movLink('voltar')"><</span>
            <span class="passar-link" id="0" onclick ="movLink('passar')">></span>
            <div class="icone-link">
                    <img src="https://conhecendo-info.vercel.app/api/img/docentes.png" alt="Docentes">
                </div>
                <span class="link-texto">Docentes Área Técnica</span>
                <span class="link-texto2">
                    Conheça os profissionais que tornam esse curso possível
                </span>
                <form action="https://conhecendo-info.vercel.app/api/docentes.php">
                    <button class="botao-index" type="submit">Saiba mais</button>
                </form>
            </div>
            <div class="link-index link-2">
            <span class="voltar-link" id="0" onclick ="movLink('voltar')"><</span>
            <span class="passar-link" id="0" onclick ="movLink('passar')">></span>
                <div class="icone-link">
                    <img src="https://conhecendo-info.vercel.app/api/img/destaques.png" alt="Destaques">
                </div>
                <span class="link-texto">Destaques</span>
                <span class="link-texto2">
                    Veja os alunos de informática que se destacaram durante a sua trajetória no IFRS
                </span>
                <form action="https://conhecendo-info.vercel.app/api/destaques.php">
                    <button class="botao-index" type="submit">Saiba mais</button>
                </form>
            </div>
            <div class="link-index link-3">
            <span class="voltar-link" id="0" onclick ="movLink('voltar')"><</span>
            <span class="passar-link" id="0" onclick ="movLink('passar')">></span>
                <div class="icone-link">
                    <img src="https://conhecendo-info.vercel.app/api/img/disciplinas.png" alt="Disciplinas">
                </div>
                <span class="link-texto">Disciplinas Técnicas</span>
                <span class="link-texto2">
                    Descubra tudo que você vai aprender ao decorrer destes quatro anos
                </span>
                <form action="https://conhecendo-info.vercel.app/api/disciplinas.php">
                    <button class="botao-index" type="submit">Saiba mais</button>
                </form>
            </div>
        </div>

    </div>
    <div id="definicao-info-div">
        <div id="definicao-info-pergunta">
            <span class="definicao-info-pergunta1">Mas o que é</span>
            <span class="definicao-info-pergunta2">Informática para Internet ?</span>
        </div>
        <div id="definicao-info-resposta">
            <span id="definicao-info-resposta1">
                Informática para Internet é um dos cursos técnicos integrados que o IFRS - Campus Rio Grande oferece. Com ele, os estudantes aprendem tudo que é necessário para ser um desenvolvedor web, incluindo desde o design e a parte estética do site até o que acontece por trás. O aluno de Informática também aprende noções de computação e como funciona o processo de criação de uma aplicação.
            </span>
        </div>
    </div>

    <div id="areas-info">
        <span id="areas-titulo">Um Técnico em Informática para Internet pode trabalhar em várias áreas</span>
        <div id="areas-info-div">
            <div class="area">
                <div class="linha"></div>
                <div class="area-2">
                    <span class="titulo-area">Frontend</span>
                    <span>
                        De forma geral, o Frontend compreende a parte visual de sites e aplicações. Ou seja, a área das páginas em que as pessoas podem interagir. Isso significa que o Front-end se relaciona com as partes dos sites que mais se aproximam da pessoa usuária.
                    </span>
                </div>
            </div>
            <div class="area">
                <div class="linha"></div>
                <div class="area-2">
                    <span class="titulo-area">Backend</span>
                    <span>
                        O Backend é a área que lida com os bastidores das funcionalidades do website, definindo a estrutura de banco de dados e os códigos relacionados a funcionalidade, como a segurança, administração de dados e arquitetura do servidor.
                    </span>
                </div>
                
            </div>
            <div class="area">
                <div class="linha"></div>
                <div class="area-2">
                    <span class="titulo-area">Engenharia de Software</span>
                    <span>
                        O engenheiro de software atua no projeto e desenvolvimento de sistemas, aplicativos e programas. Trabalha na criação do conjunto de instruções lógicas, que irá orientar o desenvolvedor a criar um produto, identificando potenciais falhas e aprimorando a performace.
                </div>
            </div>
        </div>
    </div>

    <div class="info-add">
        <span class="titulo-info-add">Informações Adicionais</span>
        <div class="div-texto-info-add">
            <div class="linha-info-add"></div> 
            <div class="texto-info-add">
                O curso Técnico em Informática para Internet, <span class="bold-info-add">integrado ao Ensino Médio</span>, é uma excelente oportunidade para quem deseja ingressar na área de tecnologia desde cedo. Com um total de <span class="bold-info-add">3.493 horas</span> distribuídas ao longo de <span class="bold-info-add">quatro anos</span>, o curso tem uma estrutura anual e <span class="bold-info-add">regime integral</span>, com aulas nos períodos da manhã e tarde. Voltado para estudantes que já concluíram o Ensino Fundamental, o ingresso é feito por meio de um <span class="bold-info-add">teste classificatório</span>, o que garante uma seleção justa e baseada no desempenho dos 30 candidatos.
            </div>
        </div>
    </div>
    </div>
    <footer id="rodape">
        <img src="https://conhecendo-info.vercel.app/api/img/logo_ifrs.png" alt="">
        <div class="informacao-rodape">
            <span class="titulo-rodape">Comunicação</span>
            <div class="informacoes-rodape">
                <a class="link-rodape" href="https://ifrs.edu.br/riogrande/">Acesse o site do IFRS</a>
                <a class="link-rodape" href="https://ingresso.ifrs.edu.br/2025/">Processo Seletivo</a>
                <span>conhecendoinformaticaIFRS@gmail.com</span>
            </div>
        </div>
        <div class="informacao-rodape">
            <span class="titulo-rodape">Redes Sociais</span>
            <div class="informacoes-rodape">
                <span>@informaticaifrsrg</span>
            </div>
        </div>
    </footer>
</body>
</html>