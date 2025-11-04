<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EduTrack - Login</title>
  @vite('resources/css/app.css')
</head>
<body class="antialiased bg-[#f8f5ff] text-gray-800 font-inter flex items-center justify-center min-h-screen">

  <div class="w-full max-w-md bg-white rounded-2xl shadow-md p-8 space-y-6 border border-gray-100 animate-fadeIn">
    <!-- Header -->
    <div class="text-center space-y-2">
      <h1 class="text-3xl font-bold text-purple-700">EduTrack</h1>
      <p class="text-sm text-gray-500">Masuk untuk mengelola dan memantau perkembangan siswa</p>
    </div>

    <!-- Form -->
    <form action="#" method="POST" class="space-y-5">
      <!-- ID Username -->
      <div>
        <label for="ID" class="block text-sm font-medium text-gray-700">ID Username</label>
        <input type="text" id="ID" name="username"
               class="w-full mt-1 px-4 py-2 border border-gray-200 rounded-md bg-purple-50 text-gray-800 text-sm focus:ring-2 focus:ring-purple-400 focus:outline-none"
               placeholder="Masukkan NIS atau NIP anda" required>
      </div>

      <!-- Password -->
      <div>
        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
        <div class="relative">
          <input type="password" id="password" name="password"
                 class="w-full mt-1 px-4 py-2 pr-12 border border-gray-200 rounded-md bg-purple-50 text-gray-800 text-sm focus:ring-2 focus:ring-purple-400 focus:outline-none"
                 placeholder="Masukkan password" required>
          <button type="button" onclick="togglePasswordVisibility()"
                  class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-500 hover:text-gray-700 focus:outline-none">
            <!-- Eye Show -->
            <svg id="eyeShow" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>
            <!-- Eye Hide -->
            <svg id="eyeHide" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21" />
            </svg>
          </button>
        </div>
      </div>

      <!-- Submit -->
      <button type="submit"
              class="w-full bg-purple-600 text-white font-medium py-2 rounded-md hover:bg-purple-700 transition duration-150">
        Masuk
      </button>

      <!-- Tombol Kembali -->
      <a href="/"
         class="block text-center w-full border border-purple-200 text-purple-700 font-medium py-2 rounded-md hover:bg-purple-50 transition duration-150">
        ← Kembali ke Beranda
      </a>
    </form>
  </div>

  <!-- Animasi FadeIn -->
  <style>
    @keyframes fadeIn {
      0% { opacity: 0; transform: translateY(10px); }
      100% { opacity: 1; transform: translateY(0); }
    }
    .animate-fadeIn {
      animation: fadeIn 0.8s ease-out forwards;
    }
  </style>

  <!-- Script Toggle Password -->
  <script>
    function togglePasswordVisibility() {
      const passwordInput = document.getElementById('password');
      const eyeShow = document.getElementById('eyeShow');
      const eyeHide = document.getElementById('eyeHide');
      
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeShow.classList.add('hidden');
        eyeHide.classList.remove('hidden');
      } else {
        passwordInput.type = 'password';
        eyeShow.classList.remove('hidden');
        eyeHide.classList.add('hidden');
      }
    }
  </script>

</body>
</html>
