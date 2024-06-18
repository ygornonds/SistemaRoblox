<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>



    <section class="bg-cover bg-center h-screen"
        style="background-image: url('https://gizmodo.uol.com.br/wp-content/blogs.dir/8/files/2024/03/roblox.png');">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <a href="#" class="flex items-center mb-6 text-2xl font-bold text-white dark:text-white">
                <img class="w-8 h-8 mr-2" src="imagens/logo.png" alt="logo">
                RobloxGeniusHub
            </a>
            <div
                class="w-full bg-gray-800 rounded-lg shadow  md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 ">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-white md:text-2xl dark:text-white">
                        Entre na sua conta
                    </h1>
                    <form class="space-y-4 md:space-y-6" action="verify/logar.php" method="POST" data-parsley-validate>
    <?php
    if (isset($_GET['success']) && $_GET['success'] == 'ok'){
        ?>
        <p class="text-green-500 font-bold mb-2">Usuário cadastrado com sucesso!</p>
        <?php
    };
    ?>
    <?php
    if (isset($_GET['error']) && $_GET['error'] == '1'){
        ?>
        <p class="text-red-500 font-bold mb-2">Usuário ou senha incorretos. Tente novamente.</p>
        <?php
    };
    ?>
    <div>
        <label for="login" class="block mb-2 text-sm font-medium text-white dark:text-white">
            Usuário <span class="text-red-500">*</span>
        </label>
        <input type="text" name="login" id="login"
            class="input-field bg-gray-700 border border-gray-600 text-white sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-900 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-300 dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder="Usuário" required />
    </div>
    <div class="mb-2 relative">
        <label for="senha" class="block mb-2 text-sm font-medium text-white">
            Senha <span class="text-red-500">*</span>
        </label>
        <input type="password" name="senha" id="senha" placeholder="••••••••"
            class="bg-gray-700 border border-gray-600 text-white sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-900 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            required>
        <button type="button" id="mostrarSenha"
            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-600 dark:text-white focus:outline-none">
            <i id="olhoIcon" class="bi bi-eye-slash text-gray-300" style="vertical-align: middle;"></i>
        </button>
    </div>

    <div class="flex items-center justify-between">
        <a href="Ajuda.php"
            class="text-sm font-medium text-primary-600 hover:underline text-primary-500 text-white">Precisa
            de ajuda?</a>
    </div>
    <button type="submit" name="submit"
        class="w-full text-white bg-gray-500 hover:bg-gray-600 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Entrar</button>
    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
       Não tem conta? <a href="formCadastro.php"
            class="font-bold text-white hover:underline dark:text-primary-500">Cadastre-se!</a>
    </p>
</form>

                </div>
            </div>
        </div>
    </section>


    <script>
        document.getElementById('mostrarSenha').addEventListener('click', function () {
            var senhaInput = document.getElementById('senha');
            var olhoIcon = document.getElementById('olhoIcon');

            if (senhaInput.type === 'password') {
                senhaInput.type = 'text';
                olhoIcon.className = 'bi bi-eye';
            } else {
                senhaInput.type = 'password';
                olhoIcon.className = 'bi bi-eye-slash';
            }
        });
    </script>
    <script src="node_modules/jquery/dist/jquery.js"></script>
    <script src="node_modules/parsleyjs/dist/parsley.js"></script>
    <link rel="stylesheet" href="node_modules/parsleyjs/src/parsley.css">
    <script src="node_modules/parsleyjs/dist/i18n/pt-br.js"></script>
</body>

</html>