<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vídeo do Roblox</title>

  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-900 flex flex-col justify-center items-center h-screen">
  <h1 class="text-3xl font-bold text-white mt-8 mb-12">Assista ao vídeo para entender como se cadastrar</h1>

  <div class="max-w-md bg-gray-800 rounded-lg shadow-lg overflow-hidden">
    <div class="px-4 py-6">
      <h2 class="text-xl font-bold text-white mb-4">Vídeo de ajuda</h2>
      <p class="text-gray-300 mb-4">Clique no botão abaixo para assistir ao vídeo.</p>
      <button id="openModalBtn" class="bg-blue-700 hover:bg-blue-900 text-white font-bold py-3 px-6 rounded-lg w-full">Assistir vídeo</button>
    </div>
  </div>

  <div id="videoModal" class="modal hidden fixed inset-0 flex justify-center items-center bg-black bg-opacity-70">
    <div class="modal-content bg-gray-800 p-8 rounded-lg shadow-lg">
      <span id="closeBtn" class="close absolute top-4 right-4 text-white text-2xl cursor-pointer">&times;</span>

      <video id="modalVideo" class="w-full" controls>
        <source src="imagens/ajuda.mp4" type="video/mp4">
        Seu navegador não suporta vídeos HTML5.
      </video>
    </div>
  </div>

  <script>
    const openModalBtn = document.getElementById('openModalBtn');
    const modal = document.getElementById('videoModal');
    const closeBtn = document.getElementById('closeBtn');

    openModalBtn.addEventListener('click', function() {
      modal.classList.remove('hidden');
    });

    closeBtn.addEventListener('click', function() {
      modal.classList.add('hidden');
    });

    window.addEventListener('click', function(event) {
      if (event.target === modal) {
        modal.classList.add('hidden');
      }
    });
  </script>
</body>

</html>
