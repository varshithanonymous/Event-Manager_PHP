<div class="min-h-screen flex items-center justify-center bg-dark-900 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-dark-800 p-10 rounded-3xl border border-white/10 shadow-2xl">
        <div class="text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-brand-500/20 text-brand-500 mb-6">
                <i data-lucide="user-plus" class="w-8 h-8"></i>
            </div>
            <h2 class="text-3xl font-bold text-white mb-2">Complete Your Profile</h2>
            <p class="text-gray-400">Just a few more details to get you started.</p>
        </div>

        <form class="mt-8 space-y-6" action="<?php echo BASE_URL; ?>profile/complete" method="POST">
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-400 mb-2">Full Name</label>
                    <input type="text" name="name" required value="<?php echo htmlspecialchars($_SESSION['user_name'] ?? ''); ?>" class="w-full px-4 py-3 bg-dark-700 rounded-xl border border-white/5 text-white focus:ring-2 focus:ring-brand-500 outline-none transition" placeholder="John Doe">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-400 mb-2">Email Address</label>
                    <input type="email" name="email" required class="w-full px-4 py-3 bg-dark-700 rounded-xl border border-white/5 text-white focus:ring-2 focus:ring-brand-500 outline-none transition" placeholder="john@example.com">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-400 mb-2">Location</label>
                    <input type="text" name="location" required class="w-full px-4 py-3 bg-dark-700 rounded-xl border border-white/5 text-white focus:ring-2 focus:ring-brand-500 outline-none transition" placeholder="New York, USA">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-400 mb-2">Preferred Event Categories</label>
                    <div class="grid grid-cols-2 gap-2">
                        <?php 
                        $categories = ['Tech', 'Music', 'Art', 'Nightlife', 'Business', 'Sports'];
                        foreach($categories as $cat): 
                        ?>
                        <label class="flex items-center gap-2 p-3 bg-dark-700 rounded-xl border border-white/5 cursor-pointer hover:border-brand-500/50 transition">
                            <input type="checkbox" name="interests[]" value="<?php echo $cat; ?>" class="w-4 h-4 rounded border-gray-300 text-brand-600 focus:ring-brand-500">
                            <span class="text-sm text-gray-300"><?php echo $cat; ?></span>
                        </label>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <button type="submit" class="group relative w-full flex justify-center py-4 px-4 border border-transparent text-sm font-bold rounded-xl text-white bg-brand-600 hover:bg-brand-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500 transition transform hover:scale-[1.02] shadow-lg shadow-brand-500/20">
                Save & Continue
            </button>
        </form>
    </div>
</div>
