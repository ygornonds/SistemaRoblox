<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastre-se</title>

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
    <section class="bg-cover bg-center h-screen"
        style="background-image: url('https://gizmodo.uol.com.br/wp-content/blogs.dir/8/files/2024/03/roblox.png');">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <a href="#" class="flex items-center mb-6 text-2xl font-bold text-gray-900 dark:text-white">
                <img class="w-8 h-8 mr-2" src="imagens/logo.png" alt="logo">
                RobloxGeniusHub
            </a>
            <div
                class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1
                        class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Crie uma conta
                    </h1>
                    <form method="POST" action="verify/cadastra.php" class="space-y-4 md:space-y-6" data-parsley-validate>
    <div>
        <label for="login" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
            Usuário <span class="text-red-500">*</span>
        </label>
        <input type="text" name="login" id="login"
            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder="Usuário" required>
    </div>
    <div class="mb-2 relative">
        <label for="senha" class="block text-sm font-medium text-gray-900 dark:text-white">
            Senha <span class="text-red-500">*</span>
        </label>
        <div class="relative">
            <input type="password" name="senha" id="senha" placeholder="••••••••"
                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required>
            <button type="button" id="mostrarSenha"
                class="absolute inset-y-0 right-3 flex items-center text-gray-600 dark:text-white focus:outline-none">
                <i id="olhoIcon" class="bi bi-eye-slash"></i>
            </button>
        </div>
    </div>
    <div class="mb-2 relative">
        <label for="confirmar_senha" class="block text-sm font-medium text-gray-900 dark:text-white">
            Confirmar Senha <span class="text-red-500">*</span>
        </label>
        <div class="relative">
            <input type="password" name="confirmar_senha" id="confirmar_senha" placeholder="••••••••"
                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required>
            <button type="button" id="mostrarConfirmarSenha"
                class="absolute inset-y-0 right-3 flex items-center text-gray-600 dark:text-white focus:outline-none">
                <i id="olhoConfirmarIcon" class="bi bi-eye-slash"></i>
            </button>
        </div>
    </div>
    <div class="flex items-center justify-between">
        <a href="Ajuda.php"
            class="text-sm font-medium text-primary-600 hover:underline text-primary-500 text-white">Precisa
            de ajuda?</a>
    </div>
    <button type="submit" name="submit"
        class="w-full text-white bg-gray-500 hover:bg-gray-600 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Cadastrar-se</button>
    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
        Já tem uma conta? <a href="login.php"
            class="font-bold text-white hover:underline dark:text-primary-500">Entrar!</a>
    </p>
</form>

                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.tailwindcss.com"></script>
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

        document.getElementById('mostrarConfirmarSenha').addEventListener('click', function () {
            var confirmarSenhaInput = document.getElementById('confirmar_senha');
            var olhoConfirmarIcon = document.getElementById('olhoConfirmarIcon');

            if (confirmarSenhaInput.type === 'password') {
                confirmarSenhaInput.type = 'text';
                olhoConfirmarIcon.className = 'bi bi-eye';
            } else {
                confirmarSenhaInput.type = 'password';
                olhoConfirmarIcon.className = 'bi bi-eye-slash';
            }
        });

        document.querySelector('form').addEventListener('submit', function (e) {
            var senha = document.getElementById('senha').value;
            var confirmarSenha = document.getElementById('confirmar_senha').value;

            if (senha !== confirmarSenha) {
                e.preventDefault();
                alert('As senhas não coincidem!');
            }
        });
    </script>
    <script src="node_modules/jquery/dist/jquery.js"></script>
    <script src="node_modules/parsleyjs/dist/parsley.js"></script>
    <link rel="stylesheet" href="node_modules/parsleyjs/src/parsley.css">
    <script src="node_modules/parsleyjs/dist/i18n/pt-br.js"></script>
</body>

</html>
