<?php
session_start();
require 'conexao.php';

if (!isset($_SESSION['id'])) {
  header('location: login.php');
  exit;
}

$sqlGeneros = "SELECT id_genero, nome FROM generos";
$resultadoGeneros = $conn->prepare($sqlGeneros);
$resultadoGeneros->execute();
$generos = $resultadoGeneros->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT jogos.id, jogos.nome, jogos.descricao, jogos.id_genero, generos.nome AS genero_nome 
        FROM jogos 
        JOIN generos ON jogos.id_genero = generos.id_genero";

$resultado = $conn->prepare($sql);
$resultado->execute();
$jogos = $resultado->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>

</head>

<body class="bg-gray-900 text-white">

<nav class="bg-gray-800 border-gray-200 dark:bg-gray-900 dark:border-gray-700">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="imagens/logo.png" class="h-8" alt="roblox" />
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
                        <?php foreach ($generos as $genero) { ?>
                            <a href="genero.php?id=<?php echo $genero['id_genero']; ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"><?php echo $genero['nome']; ?></a>
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

  <div id="confirmModal"
    class="fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-gray-700 p-8 rounded-lg">
      <p class="mb-4">Tem certeza que deseja sair?</p>
      <div class="flex justify-between">
        <button id="cancelBtn" class="px-4 py-2 bg-gray-500 hover:bg-gray-400 rounded">Cancelar</button>
        <a href="verify/logout.php" class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded">Sair</a>
      </div>
    </div>
  </div>

  <div class="container mx-auto mt-10 px-4">
    <div class="md:flex md:justify-between md:items-center">
      <h1 class="text-2xl font-bold mb-4">Seja bem-vindo, <?php echo $_SESSION['nome']; ?></h1>
      <div class="md:flex md:items-center md:justify-end">
        <a href="#"
          class="btn bg-transparent hover:bg-blue-600 text-blue-600 hover:text-white font-semibold py-2 px-4 border border-blue-600 hover:border-transparent rounded ml-4"
          onclick="openAddModal()">Adicionar Jogo</a>
      </div>
    </div>
    <?php if (isset($_GET['sucesso']) && $_GET['sucesso'] == 'ok') { ?>
    <div class="bg-green-500 text-white font-bold py-2 px-4 rounded mb-4">
      Jogo cadastrado com sucesso!
    </div>
  <?php } ?>
    <?php if (isset($_GET['delete']) && $_GET['delete'] == 'ok') { ?>
      <div class="bg-red-500 text-white font-bold py-2 px-4 rounded">Jogo deletado com sucesso!</div>
    <?php }
    ; ?>
    <div id="addModal" class="fixed z-10 inset-0 overflow-y-auto hidden " aria-labelledby="modal-title" role="dialog"
      aria-modal="true">
      <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-800 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div
          class="inline-block align-bottom bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
          <div class="bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <form class="space-y-4 md:space-y-6" action="verify/cadastraJogos.php" method="POST" data-parsley-validate>
              <div>
                <label for="nome" class="block mb-2 text-sm font-medium text-primary-900 dark:text-white">Nome <span
                    class="text-red-500">*</span></label>
                <input type="text" name="nome" id="nome"
                  class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                  placeholder="Nome" required>
              </div>
              <div>
                <label for="genero" class="block mb-2 text-sm font-medium text-primary-900 dark:text-white">Gênero <span
                    class="text-red-500">*</span></label>
                <select name="genero" id="genero"
                  class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                  required>
                  <option value="">Selecione o Gênero</option>
                  <?php foreach ($generos as $genero) { ?>
                    <option value="<?php echo $genero['id_genero']; ?>"><?php echo $genero['nome']; ?></option>
                  <?php } ?>
                </select>
              </div>
              <div>
                <label for="descricao" class="block mb-2 text-sm font-medium text-primary-900 dark:text-white">Descrição
                  <span class="text-red-500">*</span></label>
                <textarea name="descricao" id="descricao" rows="4"
                  class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                  placeholder="Descrição" required></textarea>
              </div>
              <button type="submit" name="submit"
                class="w-full text-white bg-gray-700 hover:bg-gray-600 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Adicionar
                Jogo</button>
              <button type="button" onclick="closeAddModal()"
                class="w-full text-gray-700 bg-white border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mt-2">Cancelar</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="mt-10">
      <h2 class="text-2xl font-bold mb-4">Jogos</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach ($jogos as $jogo) { ?>
          <div class="bg-gray-800 p-6 rounded-lg shadow-lg hover:shadow-xl transition duration-300">
            <h3 class="text-2xl font-bold mb-2"><?= $jogo['nome']; ?></h3>
            <p class="text-gray-400 mb-4"><?= $jogo['descricao']; ?></p>
            <span
              class="block bg-blue-500 text-white py-1 px-2 rounded-full text-xs font-semibold uppercase"><?= $jogo['genero_nome']; ?></span>
            <a href="verify/delete.php?id=<?= $jogo['id']; ?>&nome=<?= $jogo['nome']; ?>"
              class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded inline-block mt-4">Deletar</a>
            <a href="verify/atualizarform.php?id=<?php echo $jogo['id'] ?>"
              onclick="openUpdateModal(<?= $jogo['id']; ?>, '<?= $jogo['nome']; ?>', <?= $jogo['id_genero']; ?>, '<?= $jogo['descricao']; ?>')"
              class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded inline-block mt-4">Atualizar</a>
          </div>
        <?php } ?>

      </div>




      <script>
        function openAddModal() {
          document.getElementById("addModal").classList.remove("hidden");
        }

        function closeAddModal() {
          document.getElementById("addModal").classList.add("hidden");
        }

        const signOutLink = document.getElementById('signOutLink');
        const confirmModal = document.getElementById('confirmModal');
        const cancelBtn = document.getElementById('cancelBtn');

        signOutLink.addEventListener('click', function (event) {
          event.preventDefault();
          confirmModal.classList.remove('hidden');
        });

        cancelBtn.addEventListener('click', function () {
          confirmModal.classList.add('hidden');
        });

      </script>
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