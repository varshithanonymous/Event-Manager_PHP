<div class="min-h-[calc(100vh-64px)] flex items-center justify-center relative overflow-hidden">
    <!-- Background Elements -->
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden -z-10">
        <div class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-brand-600/20 rounded-full blur-3xl"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-96 h-96 bg-purple-600/20 rounded-full blur-3xl"></div>
    </div>

    <div class="w-full max-w-md bg-dark-800/50 backdrop-blur-xl border border-white/10 p-8 rounded-2xl shadow-2xl m-4">
        <div class="text-center mb-8">
            <div class="w-16 h-16 bg-gradient-to-tr from-brand-500 to-purple-500 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg shadow-brand-500/20">
                <i data-lucide="smartphone" class="text-white w-8 h-8"></i>
            </div>
            <h1 class="text-3xl font-bold text-white mb-2">Welcome Back</h1>
            <p class="text-gray-400">Enter your phone number to continue</p>
        </div>

        <?php if(isset($error)): ?>
            <div class="bg-red-500/10 border border-red-500/20 text-red-500 p-4 rounded-xl mb-6 text-sm text-center">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form action="<?php echo BASE_URL; ?>login" method="POST" class="space-y-6">
            <div>
                <label for="phone" class="block text-sm font-medium text-gray-400 mb-2">Phone Number</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i data-lucide="phone" class="text-gray-500 w-5 h-5"></i>
                    </div>
                    <input type="tel" name="phone" id="phone" placeholder="+1 (555) 000-0000" required
                        class="block w-full pl-12 pr-4 py-3 bg-dark-900/50 border border-gray-700 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-transparent transition">
                </div>
            </div>

            <button type="submit" 
                class="w-full bg-gradient-to-r from-brand-600 to-brand-500 hover:from-brand-500 hover:to-brand-400 text-white font-bold py-3.5 rounded-xl shadow-lg shadow-brand-500/20 transition transform hover:scale-[1.02]">
                Send Code
            </button>
            
            <p class="text-center text-xs text-gray-500 mt-6">
                By continuing, you agree to our Terms of Service and Privacy Policy.
            </p>
        </form>
    </div>
</div>
