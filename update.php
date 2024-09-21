<?php 
    $conexao = mysqli_connect("localhost", "root", "", "conhecendoinformatica");
    if(isset($_POST['id_votos'])){
        $id = explode("-",$_POST['id_votos'])[0];
        $tof = explode("-",$_POST['id_votos'])[1];
        if($tof == 'true'){
            $query = "UPDATE projetos SET projetos.votos = projetos.votos + 1 WHERE id = $id";
        }
        else{
            $query = "UPDATE projetos SET projetos.votos = projetos.votos - 1 WHERE id = $id";
        }
        mysqli_query($conexao,$query);
    }
?>
<form action="projetos.php#projeto-<?=$id?>" method="post" id="form">
    <input type="hidden" name="pagina" value="<?=$_POST['pagina']?>">
</form>
<script>
    document.querySelector("#form").submit();
</script>