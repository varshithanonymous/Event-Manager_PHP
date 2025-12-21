<?php
// Demo Data if DB is empty for First Run Visualization
if (empty($events)) {
    $events = [
        [
            'id' => 1,
            'title' => 'Neon Nights: Rooftop Party',
            'start_time' => date('Y-m-d H:i:s', strtotime('+2 days 20:00')),
            'location_name' => 'Skyline Lounge, NYC',
            'image_url' => 'https://images.unsplash.com/photo-1545128485-c400e7702796?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
            'category' => 'Nightlife'
        ],
        [
            'id' => 2,
            'title' => 'Tech Innovators Summit',
            'start_time' => date('Y-m-d H:i:s', strtotime('+5 days 09:00')),
            'location_name' => 'Convention Center',
            'image_url' => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
            'category' => 'Tech'
        ],
        [
            'id' => 3,
            'title' => 'Urban Art Workshop',
            'start_time' => date('Y-m-d H:i:s', strtotime('+1 week 14:00')),
            'location_name' => 'The Loft Studio',
            'image_url' => 'https://images.unsplash.com/photo-1460661419201-fd4cecdf8a8b?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
            'category' => 'Art'
        ]
    ];
}
?>

<!-- Hero Section -->
<div class="relative w-full h-[600px] flex items-center justify-center overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-t from-dark-900 via-dark-900/40 to-transparent z-10"></div>
    <!-- Video Background (simulated with image for now) -->
    <img src="https://images.unsplash.com/photo-1492684223066-81342ee5ff30?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80" class="absolute inset-0 w-full h-full object-cover opacity-60">
    
    <div class="relative z-20 text-center px-4 max-w-4xl mx-auto">
        <span class="inline-block py-1 px-3 rounded-full bg-brand-500/20 border border-brand-500/40 text-brand-300 text-sm font-semibold mb-6 backdrop-blur-md">
            New: Personalized Event Feed
        </span>
        <h1 class="text-5xl md:text-7xl font-bold text-white mb-6 leading-tight tracking-tight">
            Discover <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-400 to-purple-400">Unforgettable</span> Experiences
        </h1>
        <p class="text-xl text-gray-200 mb-10 max-w-2xl mx-auto font-light">
            Join the community. Find events that match your vibe, from underground parties to tech meetups.
        </p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="<?php echo BASE_URL; ?>explore" class="px-8 py-4 bg-white text-dark-900 font-bold rounded-full hover:bg-gray-100 transition transform hover:scale-105 shadow-xl shadow-white/10">Browse Events</a>
            <a href="<?php echo BASE_URL; ?>events/create" class="px-8 py-4 bg-transparent border border-white/20 text-white font-semibold rounded-full hover:bg-white/10 transition backdrop-blur-sm">Host an Event</a>
        </div>
    </div>
</div>

<!-- For You Section -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="flex items-center justify-between mb-8">
        <h2 class="text-2xl font-bold text-white flex items-center gap-2">
            <i data-lucide="sparkles" class="text-brand-500"></i> For You
        </h2>
        <a href="<?php echo BASE_URL; ?>explore" class="text-brand-400 hover:text-brand-300 text-sm font-medium">View all &rarr;</a>
    </div>

    <!-- Event Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php foreach($events as $event): ?>
        <a href="<?php echo BASE_URL; ?>event/<?php echo $event['id']; ?>" class="group block bg-dark-800 rounded-3xl overflow-hidden border border-gray-800 hover:border-gray-600 transition-all duration-300 hover:shadow-2xl hover:shadow-brand-900/20 hover:-translate-y-2">
            <div class="relative h-64 overflow-hidden">
                <img src="<?php echo $event['image_url'] ?? 'https://via.placeholder.com/800x600'; ?>" alt="<?php echo htmlspecialchars($event['title']); ?>" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                <div class="absolute top-4 right-4 bg-black/60 backdrop-blur-md text-white text-xs font-bold px-3 py-1 rounded-full border border-white/10">
                    <?php echo htmlspecialchars($event['category']); ?>
                </div>
                <div class="absolute inset-0 bg-gradient-to-t from-dark-900 via-transparent to-transparent opacity-80"></div>
            </div>
            
            <div class="p-6 relative">
                <div class="flex items-start justify-between mb-2">
                    <p class="text-brand-400 text-sm font-semibold uppercase tracking-wider">
                        <?php echo date('M d, D', strtotime($event['start_time'])); ?>
                    </p>
                    <p class="text-gray-500 text-sm">
                        <?php echo date('g:i A', strtotime($event['start_time'])); ?>
                    </p>
                </div>
                
                <h3 class="text-xl font-bold text-white mb-2 leading-snug group-hover:text-brand-300 transition">
                    <?php echo htmlspecialchars($event['title']); ?>
                </h3>
                
                <p class="text-gray-400 text-sm mb-4 line-clamp-2">
                    <?php echo htmlspecialchars($event['location_name']); ?>
                </p>
                
                <div class="flex items-center gap-2 text-sm text-gray-500">
                    <div class="flex -space-x-2">
                        <img class="w-6 h-6 rounded-full border border-dark-800" src="https://ui-avatars.com/api/?name=A" alt="">
                        <img class="w-6 h-6 rounded-full border border-dark-800" src="https://ui-avatars.com/api/?name=B" alt="">
                        <img class="w-6 h-6 rounded-full border border-dark-800" src="https://ui-avatars.com/api/?name=C" alt="">
                    </div>
                    <span>+ 24 going</span>
                </div>
            </div>
        </a>
        <?php endforeach; ?>
    </div>
</div>

<!-- Categories -->
<div class="bg-dark-800/50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold text-white mb-8 text-center">Browse by Category</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
            <?php 
                $categories = [
                    ['icon' => 'music', 'label' => 'Music', 'color' => 'bg-pink-500'],
                    ['icon' => 'code', 'label' => 'Tech', 'color' => 'bg-blue-500'],
                    ['icon' => 'palette', 'label' => 'Arts', 'color' => 'bg-yellow-500'],
                    ['icon' => 'utensils', 'label' => 'Food', 'color' => 'bg-green-500'],
                    ['icon' => 'users', 'label' => 'Social', 'color' => 'bg-purple-500'],
                    ['icon' => 'briefcase', 'label' => 'Business', 'color' => 'bg-indigo-500'],
                ];
            ?>
            <?php foreach($categories as $cat): ?>
            <a href="<?php echo BASE_URL; ?>explore?cat=<?php echo $cat['label']; ?>" class="flex flex-col items-center justify-center p-6 bg-dark-700 rounded-2xl border border-white/5 hover:bg-dark-600 hover:border-white/10 transition group cursor-pointer">
                <div class="w-12 h-12 rounded-xl <?php echo $cat['color']; ?>/20 text-<?php echo explode('-', $cat['color'])[1]; ?>-400 flex items-center justify-center mb-3 group-hover:scale-110 transition duration-300">
                    <i data-lucide="<?php echo $cat['icon']; ?>" class="w-6 h-6"></i>
                </div>
                <span class="text-gray-300 font-medium group-hover:text-white"><?php echo $cat['label']; ?></span>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>
