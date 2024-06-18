<?php
if(isset($_POST['submit'])){
    if(isset($_POST['nome']) && !empty($_POST['nome']) &&
       isset($_POST['genero']) && !empty($_POST['genero']) &&
       isset($_POST['descricao']) && !empty($_POST['descricao'])){
    
        require '../conexao.php';
        $nome = $_POST['nome'];
        $genero = $_POST['genero'];
        $descricao = $_POST['descricao'];
        $sql = "INSERT INTO jogos(nome, id_genero, descricao) VALUES (:nome, :genero, :descricao)";
        $resultado = $conn->prepare($sql);
        $resultado->bindValue(":nome", $nome);
        $resultado->bindValue(":genero", $genero);
        $resultado->bindValue(":descricao", $descricao);
        $resultado->execute();

        header("Location: ../index.php?nome_jogo=$nome&sucesso=ok");

        exit(); 
    }
}
