<div class="min-h-[calc(100vh-64px)] flex items-center justify-center relative overflow-hidden">
     <!-- Background Elements -->
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden -z-10">
        <div class="absolute top-[-10%] right-[-10%] w-96 h-96 bg-brand-600/20 rounded-full blur-3xl"></div>
        <div class="absolute bottom-[-10%] left-[-10%] w-96 h-96 bg-blue-600/20 rounded-full blur-3xl"></div>
    </div>

    <div class="w-full max-w-md bg-dark-800/50 backdrop-blur-xl border border-white/10 p-8 rounded-2xl shadow-2xl m-4">
        <div class="text-center mb-8">
            <div class="w-16 h-16 bg-dark-700/50 rounded-full flex items-center justify-center mx-auto mb-4 border border-white/5">
                <i data-lucide="lock" class="text-brand-500 w-8 h-8"></i>
            </div>
            <h1 class="text-3xl font-bold text-white mb-2">Verify it's you</h1>
            <p class="text-gray-400">We sent a code to <span class="text-white font-medium"><?php echo htmlspecialchars($phone); ?></span></p>
        </div>

        <?php if(isset($demo_otp)): ?>
            <div class="bg-brand-900/40 border border-brand-500/30 text-brand-200 p-4 rounded-xl mb-6 text-center">
                <p class="text-xs uppercase tracking-wider text-brand-400 font-bold mb-1">Developer Mode</p>
                <p>Your verification code is: <span class="text-white font-bold text-lg tracking-widest"><?php echo $demo_otp; ?></span></p>
            </div>
        <?php endif; ?>

        <?php if(isset($error)): ?>
            <div class="bg-red-500/10 border border-red-500/20 text-red-500 p-4 rounded-xl mb-6 text-sm text-center">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form action="<?php echo BASE_URL; ?>verify-otp" method="POST" class="space-y-6">
            <div>
                <label for="otp" class="block text-sm font-medium text-gray-400 mb-2 text-center">Enter 6-digit code</label>
                <input type="text" name="otp" id="otp" placeholder="000000" maxlength="6" required autofocus
                    class="block w-full text-center text-3xl tracking-[1em] font-mono py-4 bg-dark-900/50 border border-gray-700 rounded-xl text-white placeholder-gray-700 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-transparent transition">
            </div>

            <button type="submit" 
                class="w-full bg-white text-dark-900 font-bold py-3.5 rounded-xl shadow-lg hover:bg-gray-100 transition transform hover:scale-[1.02]">
                Verify & Login
            </button>
            
            <div class="text-center mt-6">
                <a href="<?php echo BASE_URL; ?>login" class="text-sm text-gray-400 hover:text-white transition">Wrong number?</a>
            </div>
        </form>
    </div>
</div>
