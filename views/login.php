<div
    class="w-full max-w-4xl bg-white sm:border border-gray-200 rounded-2xl
           sm:shadow-lg overflow-hidden transition-all duration-300">

    <div class="grid grid-cols-1 md:grid-cols-2">

        <div class="hidden md:relative md:block">
            <img
                src="assets/img/background_login.png"
                alt="Login background"
                class="w-full h-full object-cover" />

            <div class="absolute inset-0 bg-gradient-to-br from-blue-600/80 to-blue-900/80"></div>

            <div class="absolute inset-0 flex flex-col justify-end p-8 text-white">
                <h3 class="text-2xl font-bold">EasyPayment</h3>
                <p class="text-sm text-blue-100 mt-1">
                    Kelola pembayaran sekolah dengan mudah dan aman
                </p>
            </div>
        </div>

        <div class="p-6 sm:p-10">
            <form class="space-y-6" method="POST" action="?page=login">

                <div class="flex flex-col gap-1">
                    <h5 class="text-2xl font-bold text-gray-900 tracking-tight">
                        Login ke akunmu
                    </h5>
                    <p class="text-sm text-gray-500">
                        Masuk untuk melanjutkan ke dashboard EasyPayment
                    </p>
                </div>

                <?php if (isset($error) && $error): ?>
                    <div class="p-4 text-sm text-red-800 rounded-lg bg-red-50 border border-red-200" role="alert">
                        <div class="flex items-center">
                            <svg class="flex-shrink-0 inline w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                            </svg>
                            <span class="font-medium"><?= htmlspecialchars($error) ?></span>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="space-y-1">
                    <label for="username" class="text-sm font-medium text-gray-700">
                        Username
                    </label>
                    <input
                        type="text"
                        name="username"
                        id="username"
                        placeholder="Masukkan username"
                        value="<?= isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '' ?>"
                        class="w-full rounded-lg border border-gray-300 bg-gray-50
                               px-4 py-3 text-gray-900 text-sm
                               focus:border-blue-600 focus:ring-4 focus:ring-blue-100
                               transition duration-200"
                        required />
                </div>

                <div class="space-y-1">
                    <label for="password" class="text-sm font-medium text-gray-700">
                        Password
                    </label>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        placeholder="••••••••"
                        class="w-full rounded-lg border border-gray-300 bg-gray-50
                               px-4 py-3 text-gray-900 text-sm
                               focus:border-blue-600 focus:ring-4 focus:ring-blue-100
                               transition duration-200"
                        required />
                </div>

                <button
                    type="submit"
                    class="w-full bg-blue-700 text-white font-medium
                           rounded-lg py-3 text-sm
                           hover:bg-blue-800 hover:shadow-md
                           active:scale-[0.98]
                           focus:outline-none focus:ring-4 focus:ring-blue-300
                           transition-all duration-200">
                    Masuk
                </button>

                <p class="text-sm text-gray-500 text-center">
                    Belum ada akun?
                    <a href="?page=register" class="text-blue-700 font-medium hover:underline">
                        Buat akun baru
                    </a>
                </p>
            </form>
        </div>

    </div>
</div>