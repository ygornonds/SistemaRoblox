<?php
session_start();
require 'conexao.php';

$sqlGeneroMaisJogos = "SELECT id_genero, nome, total_jogos FROM genero_mais_jogos LIMIT 1";
$resultadoGeneroMaisJogos = $conn->prepare($sqlGeneroMaisJogos);
$resultadoGeneroMaisJogos->execute();
$generoMaisJogos = $resultadoGeneroMaisJogos->fetch(PDO::FETCH_ASSOC);

// Consulta para obter todos os gêneros
$sqlGeneros = "SELECT id_genero, nome FROM generos";
$stmtGeneros = $conn->prepare($sqlGeneros);
$stmtGeneros->execute();
$generos = $stmtGeneros->fetchAll(PDO::FETCH_ASSOC);

$sqlJogosGenero = "SELECT nome, descricao FROM jogos WHERE id_genero = :id_genero";
$resultadoJogosGenero = $conn->prepare($sqlJogosGenero);
$resultadoJogosGenero->execute([':id_genero' => $generoMaisJogos['id_genero']]);
$jogosGenero = $resultadoJogosGenero->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gênero com Mais Jogos</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-900 text-white">
    <nav class="bg-gray-800 border-gray-200 dark:bg-gray-900 dark:border-gray-700">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="index.php" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="imagens/logo.png" class="h-8" alt="roblox" />
                <span id="logo-text"
                    class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">RobloxGeniusHub</span>
            </a>
            <button data-collapse-toggle="navbar-default" type="button"
                class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                aria-controls="navbar-default" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
            <div class="hidden w-full md:flex md:w-auto" id="navbar-default">
                <ul
                    class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-gray-800 dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                    <li>
                        <a href="genero_com_mais_jogos.php"
                            class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white md:dark:text-blue-500"
                            aria-current="page">Gênero com Mais Jogos</a>
                    </li>
                    <li class="relative" x-data="{ open: false }">
                        <button @click="open = !open"
                            class="block py-2 px-3 text-gray-200 rounded hover:bg-gray-600 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Gêneros
                            🡻</button>
                        <div x-show="open" @click.away="open = false"
                            class="absolute right-0 mt-2 w-44 bg-white divide-y divide-gray-100 rounded-lg shadow-lg z-10">
                            <?php foreach ($generos as $genero) { ?>
                                <a href="genero.php?id=<?php echo $genero['id_genero']; ?>"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"><?php echo $genero['nome']; ?></a>
                            <?php } ?>
                        </div>
                    </li>
                    <li>
                        <a id="signOutLink" href="verify/logout.php"
                            class="block py-2 px-3 text-white bg-red-700 rounded md:bg-transparent md:text-red-700 md:p-0 dark:text-white md:dark:text-red-500"
                            aria-current="page">Sair da conta</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mx-auto mt-10">
        <h1 class="text-3xl font-bold mb-4">Gênero com Mais Jogos</h1>
        <?php if ($generoMaisJogos): ?>
            <div class="bg-gray-800 p-4 rounded-lg mb-6">
                <h2 class="text-2xl font-semibold"><?php echo ($generoMaisJogos['nome']); ?>
                    (<?php echo $generoMaisJogos['total_jogos']; ?> jogos)</h2>
            </div>
            <div class="bg-gray-800 p-4 rounded-lg">
                <h3 class="text-xl font-semibold mb-4">Jogos:</h3>
                <ul class="list-disc pl-6">
                    <?php foreach ($jogosGenero as $jogo): ?>
                        <li>
                            <strong><?php echo ($jogo['nome']); ?>:</strong>
                            <?php echo ($jogo['descricao']); ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php else: ?>
            <p>Nenhum jogo encontrado.</p>
        <?php endif; ?>
    </div>
    <script>
        document.querySelector('button[data-collapse-toggle="navbar-default"]').addEventListener('click', function () {
            var navbar = document.getElementById('navbar-default');
            if (navbar.classList.contains('hidden')) {
                navbar.classList.remove('hidden');
            } else {
                navbar.classList.add('hidden');
            }
        });
    </script>
</body>

</html>