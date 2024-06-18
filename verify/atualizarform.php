<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: ../login.php');
    exit;
}

require '../conexao.php';
$id = $_GET['id'];
$sql = "SELECT * FROM jogos WHERE id = :id";
$resultado = $conn->prepare($sql);
$resultado->bindValue(":id" , $id);
$resultado->execute();
$jogos = $resultado->fetch(PDO::FETCH_ASSOC);

$sqlGeneros = "SELECT * FROM generos";
$stmtGeneros = $conn->prepare($sqlGeneros);
$stmtGeneros->execute();
$generos = $stmtGeneros->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-900 text-white">
<nav class="bg-gray-800 border-gray-200 dark:bg-gray-900 dark:border-gray-700">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="../index.php" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="../imagens/logo.png" class="h-8" alt="roblox" />
            <span id="logo-text" class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">RobloxGeniusHub</span>
        </a>
        <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
            </svg>
        </button>
        <div class="hidden w-full md:flex md:w-auto" id="navbar-default">
            <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-gray-800 dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                <li>
                    <a href="genero_com_mais_jogos.php" class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white md:dark:text-blue-500" aria-current="page">Gênero com Mais Jogos</a>
                </li>
                <li class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="block py-2 px-3 text-gray-200 rounded hover:bg-gray-600 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Gêneros 🡻</button>
                    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-44 bg-white divide-y divide-gray-100 rounded-lg shadow-lg z-10">
                        <?php foreach ($generos as $genero_option) { ?>
                            <a href="genero.php?id=<?php echo $genero_option['id_genero']; ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"><?php echo $genero_option['nome']; ?></a>
                        <?php } ?>
                    </div>
                </li>
                <li>
                    <a id="signOutLink" href="verify/logout.php" class="block py-2 px-3 text-white bg-red-700 rounded md:bg-transparent md:text-red-700 md:p-0 dark:text-white md:dark:text-red-500" aria-current="page">Sair da conta</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container mx-auto mt-10 p-6 bg-gray-800 rounded-lg shadow-lg max-w-md">
    <form action="atualizar.php" method="POST" data-parsley-validate>
        <input type="hidden" name="id" value="<?php echo $jogos['id']?>">
        <div class="space-y-4 md:space-y-6">
            <div>
                <label for="nome" class="block mb-2 text-sm font-medium text-white">Nome <span class="text-red-500">*</span></label>
                <input type="text" name="nome" id="nome" class="bg-gray-700 border border-gray-600 text-gray-300 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Nome" value="<?php echo $jogos['nome']?>" required>
            </div>
            <div>
                <label for="genero" class="block mb-2 text-sm font-medium text-white">Gênero <span class="text-red-500">*</span></label>
                <select name="genero" id="genero" class="bg-gray-700 border border-gray-600 text-gray-300 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                    <option value="">Selecione o Gênero</option>
                    <?php foreach ($generos as $genero_option) { 
                        if ($genero_option["id_genero"] == $jogos["id_genero"]) {
                            echo "<option value='" . $genero_option["id_genero"] . "' selected>" . $genero_option["nome"] . "</option>";
                        } else {
                            echo "<option value='" . $genero_option["id_genero"] . "'>" . $genero_option["nome"] . "</option>";
                        }
                    } ?>
                </select>
            </div>
            <div>
                <label for="descricao" class="block mb-2 text-sm font-medium text-white">Descrição <span class="text-red-500">*</span></label>
                <textarea name="descricao" id="descricao" rows="4" class="bg-gray-700 border border-gray-600 text-gray-300 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Descrição" required><?php echo $jogos['descricao']?></textarea>
            </div>
            <button type="submit" name="submit" class="w-full text-white bg-blue-600 hover:bg-blue-500 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Atualizar Jogo</button>
        </div>
    </form>
</div>
<footer class="bg-gray-800 p-4 text-center text-sm text-gray-500 mt-10">
  &copy; 2023 Direitos reservados a Ygor
</footer>

    <script src="../node_modules/jquery/dist/jquery.js"></script>
    <script src="../node_modules/parsleyjs/dist/parsley.js"></script>
    <link rel="../stylesheet" href="node_modules/parsleyjs/src/parsley.css">
    <script src="../node_modules/parsleyjs/dist/i18n/pt-br.js"></script>
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
