<?php
if(isset($_GET['id'])){
    require '../conexao.php';
    $id = $_GET['id'];
    $nome = $_GET['nome']; 
    
    $sql = "DELETE FROM jogos WHERE id = :id";
    $resultado = $conn->prepare($sql);
    $resultado->bindValue(":id", $id, PDO::PARAM_INT);
    $resultado->execute();

    header("Location: ../index.php?nome_jogo=$nome&delete=ok");
    exit; 
}