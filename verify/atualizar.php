<?php
require '../conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $genero = $_POST['genero'];
    $descricao = $_POST['descricao'];

    $sql = "UPDATE jogos SET nome = ?, id_genero = ?, descricao = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt->execute([$nome, $genero, $descricao, $id])) {
        header('Location: ../index.php');
    } else {
        echo "Erro ao atualizar o jogo.";
    }
}

