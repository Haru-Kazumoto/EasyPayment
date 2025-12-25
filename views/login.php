<div
    class="w-full max-w-4xl bg-white sm:border border-gray-200 rounded-2xl
           sm:shadow-lg overflow-hidden transition-all duration-300">

    <div class="grid grid-cols-1 md:grid-cols-2">

        <!-- LEFT: IMAGE -->
        <div class="hidden md:relative md:block">
            <img
                src="assets/img/background_login.png"
                alt="Login background"
                class="w-full h-full object-cover" />

            <!-- overlay -->
            <div class="absolute inset-0 bg-gradient-to-br from-blue-600/80 to-blue-900/80"></div>

            <!-- branding -->
            <div class="absolute inset-0 flex flex-col justify-end p-8 text-white">
                <h3 class="text-2xl font-bold">EasyPayment</h3>
                <p class="text-sm text-blue-100 mt-1">
                    Kelola pembayaran sekolah dengan mudah dan aman
                </p>
                
                <span><?= $username ?></span>
                <span><?= $password ?></span>
            </div>
        </div>

        <div class="p-6 sm:p-10">
            <!-- RIGHT: FORM -->
            <form class="space-y-6" action="#">

                <!-- Header -->
                <div class="flex flex-col gap-1">
                    <h5 class="text-2xl font-bold text-gray-900 tracking-tight">
                        Login ke akunmu
                    </h5>
                    <p class="text-sm text-gray-500">
                        Masuk untuk melanjutkan ke dashboard EasyPayment
                    </p>
                </div>

                <!-- Username -->
                <div class="space-y-1">
                    <label for="username" class="text-sm font-medium text-gray-700">
                        Nomor telepon
                    </label>
                    <input
                        type="text"
                        name="username"
                        id="username"
                        placeholder="081234567890"
                        class="w-full rounded-lg border border-gray-300 bg-gray-50
                               px-4 py-3 text-gray-900 text-sm
                               focus:border-blue-600 focus:ring-4 focus:ring-blue-100
                               transition duration-200"
                        required />
                </div>

                <!-- Password -->
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

                <!-- Button -->
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

                <!-- Footer -->
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
