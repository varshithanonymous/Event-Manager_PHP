<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="mb-10 text-center">
        <h1 class="text-4xl font-bold text-white mb-3">Explore Events</h1>
        <p class="text-gray-400">Discover what's happening in the community</p>
    </div>

    <!-- Search & Filter Bar -->
    <div class="flex flex-col md:flex-row gap-4 mb-10">
        <div class="relative flex-grow">
            <i data-lucide="search" class="absolute left-4 top-3.5 text-gray-500 w-5 h-5"></i>
            <input type="text" placeholder="Search experiences, cities, or vibes..." 
                class="w-full bg-dark-800 border border-gray-700 rounded-2xl py-3.5 pl-12 pr-4 text-white focus:ring-2 focus:ring-brand-500 outline-none transition shadow-inner">
        </div>
        <div class="flex gap-2 overflow-x-auto pb-2 scrollbar-hide md:pb-0">
            <button class="px-6 py-2 bg-brand-500 text-white text-sm font-bold rounded-full whitespace-nowrap shadow-lg shadow-brand-500/20">All</button>
            <button class="px-6 py-2 bg-dark-800 text-gray-400 text-sm font-bold rounded-full hover:bg-dark-700 whitespace-nowrap transition border border-gray-700">Tech</button>
            <button class="px-6 py-2 bg-dark-800 text-gray-400 text-sm font-bold rounded-full hover:bg-dark-700 whitespace-nowrap transition border border-gray-700">Music</button>
            <button class="px-6 py-2 bg-dark-800 text-gray-400 text-sm font-bold rounded-full hover:bg-dark-700 whitespace-nowrap transition border border-gray-700">Social</button>
        </div>
    </div>

    <!-- Event Grid -->
    <?php if(empty($events)): ?>
        <div class="text-center py-20 bg-dark-800/30 rounded-3xl border border-dashed border-gray-700">
            <div class="w-16 h-16 bg-dark-700 rounded-full flex items-center justify-center mx-auto mb-4">
                <i data-lucide="calendar-x" class="text-gray-500 w-8 h-8"></i>
            </div>
            <h3 class="text-xl font-bold text-white mb-2">No events found</h3>
            <p class="text-gray-500">Try adjusting your filters or search terms</p>
        </div>
    <?php else: ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            <?php foreach($events as $event): ?>
                <a href="<?php echo BASE_URL; ?>event/<?php echo $event['id']; ?>" class="group bg-dark-800 rounded-3xl overflow-hidden border border-gray-800 hover:border-brand-500/50 transition-all duration-300 hover:shadow-2xl hover:shadow-brand-900/20 hover:-translate-y-1">
                    <div class="relative h-48">
                        <img src="<?php echo $event['image_url'] ?: 'https://via.placeholder.com/600x400'; ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute top-3 left-3 px-2 py-1 bg-black/60 backdrop-blur-md rounded-lg text-[10px] font-bold text-white uppercase tracking-wider border border-white/10">
                            <?php echo htmlspecialchars($event['category']); ?>
                        </div>
                    </div>
                    <div class="p-5">
                        <h3 class="text-lg font-bold text-white mb-2 line-clamp-1 group-hover:text-brand-300 transition"><?php echo htmlspecialchars($event['title']); ?></h3>
                        <div class="space-y-2">
                            <p class="flex items-center gap-2 text-xs text-brand-400 font-bold">
                                <i data-lucide="calendar" class="w-3.5 h-3.5"></i>
                                <?php echo date('M d, D', strtotime($event['start_time'])); ?> • <?php echo date('g:i A', strtotime($event['start_time'])); ?>
                            </p>
                            <p class="flex items-center gap-2 text-xs text-gray-500 truncate">
                                <i data-lucide="map-pin" class="w-3.5 h-3.5"></i>
                                <?php echo htmlspecialchars($event['location_name']); ?>
                            </p>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>


<style>
    /* Custom Leaflet Popup Styles */
    .leaflet-popup-content-wrapper {
        background: white;
        border-radius: 1rem;
        padding: 0;
        overflow: hidden;
    }
    .leaflet-popup-content {
        margin: 0;
    }
</style>
