<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10" x-data="eventPage()">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        
        <!-- Left Column: Content -->
        <div class="lg:col-span-2 space-y-10">
            <!-- Hero -->
            <div class="relative h-[400px] rounded-3xl overflow-hidden shadow-2xl">
                <img src="<?php echo $event['image_url'] ?? 'https://via.placeholder.com/1200x800'; ?>" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-dark-900 via-transparent to-transparent"></div>
                <div class="absolute bottom-8 left-8">
                    <span class="px-3 py-1 bg-brand-500 text-white text-xs font-bold rounded-full mb-4 inline-block"><?php echo htmlspecialchars($event['category']); ?></span>
                    <h1 class="text-4xl md:text-5xl font-bold text-white"><?php echo htmlspecialchars($event['title']); ?></h1>
                </div>
            </div>

            <!-- Description -->
            <div class="bg-dark-800/50 rounded-3xl p-8 border border-white/5">
                <h2 class="text-2xl font-bold text-white mb-6">About this event</h2>
                <div class="text-gray-300 leading-relaxed space-y-4">
                    <?php echo nl2br(htmlspecialchars($event['description'])); ?>
                </div>
            </div>

            <!-- Location Info -->
            <div class="bg-dark-800/50 rounded-3xl p-8 border border-white/5">
                <h2 class="text-2xl font-bold text-white mb-4">Location</h2>
                <div class="flex items-center gap-4 bg-dark-900/50 p-6 rounded-2xl border border-gray-800">
                    <div class="w-12 h-12 bg-brand-500/10 rounded-xl flex items-center justify-center flex-shrink-0">
                        <i data-lucide="map-pin" class="text-brand-500 w-6 h-6"></i>
                    </div>
                    <div>
                        <p class="text-white font-semibold text-lg"><?php echo htmlspecialchars($event['location_name']); ?></p>
                        <p class="text-gray-500 text-xs mt-1 uppercase tracking-widest">Physical Venue</p>
                    </div>
                </div>
            </div>

            <!-- Chat Community -->
            <div class="bg-dark-800/50 rounded-3xl border border-white/5 overflow-hidden">
                <div class="p-6 border-b border-gray-700 flex items-center justify-between">
                    <h2 class="text-xl font-bold text-white flex items-center gap-3">
                        <i data-lucide="message-square" class="text-brand-500"></i> Event Community
                    </h2>
                    <span class="text-xs text-brand-400 animate-pulse">Live</span>
                </div>
                <!-- Chat Window -->
                <div class="h-80 overflow-y-auto p-6 space-y-4 custom-scrollbar" id="chat-window">
                    <template x-for="msg in messages">
                        <div class="flex flex-col" :class="msg.user === 'You' ? 'items-end' : 'items-start'">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="text-xs font-bold text-gray-500" x-text="msg.user"></span>
                                <span class="text-[10px] text-gray-600" x-text="msg.time"></span>
                            </div>
                            <div class="px-4 py-2 rounded-2xl max-w-[80%]" 
                                :class="msg.user === 'You' ? 'bg-brand-600 text-white rounded-tr-none' : 'bg-dark-700 text-gray-200 rounded-tl-none'">
                                <p class="text-sm" x-text="msg.content"></p>
                            </div>
                        </div>
                    </template>
                </div>
                <!-- Chat Input -->
                <div class="p-4 bg-dark-900/50 border-t border-gray-700">
                    <div class="flex gap-2">
                        <input type="text" x-model="newMessage" @keyup.enter="sendMessage()" placeholder="Say something..." 
                            class="flex-grow bg-dark-700 border border-gray-600 rounded-xl px-4 py-2 text-white text-sm focus:outline-none focus:ring-1 focus:ring-brand-500">
                        <button @click="sendMessage()" class="p-2 bg-brand-600 text-white rounded-xl hover:bg-brand-500 transition">
                            <i data-lucide="send" class="w-5 h-5"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: RSVP & Logic -->
        <div class="space-y-6">
            <div class="bg-dark-800 rounded-3xl p-8 border border-brand-500/20 shadow-2xl sticky top-24">
                <div class="mb-6">
                    <p class="text-brand-400 font-bold uppercase tracking-widest text-xs mb-1">Date & Time</p>
                    <p class="text-white text-lg font-semibold"><?php echo date('l, M j, Y', strtotime($event['start_time'])); ?></p>
                    <p class="text-gray-400 text-sm"><?php echo date('g:i A', strtotime($event['start_time'])); ?></p>
                </div>

                <hr class="border-gray-700 mb-6">

                <!-- Tiers -->
                <div class="space-y-4 mb-8">
                    <p class="text-gray-400 font-bold uppercase tracking-widest text-xs">Ticket Options</p>
                    <div class="p-4 bg-dark-900/50 rounded-2xl border border-gray-700 cursor-pointer hover:border-brand-500 transition active-tier">
                        <div class="flex justify-between items-center mb-1">
                            <span class="text-white font-bold">General Admission</span>
                            <span class="text-brand-400 font-bold">Free</span>
                        </div>
                        <p class="text-xs text-gray-500 italic">Limited spots. Requires host approval.</p>
                    </div>
                    <div class="p-4 bg-dark-900/50 rounded-2xl border border-gray-700 cursor-pointer hover:border-brand-500 transition">
                        <div class="flex justify-between items-center mb-1">
                            <span class="text-white font-bold">VIP Backstage</span>
                            <span class="text-white font-bold">$49.00</span>
                        </div>
                        <p class="text-xs text-gray-500">Includes meet & greet + drinks.</p>
                    </div>
                </div>

                <!-- RSVP Form/Button -->
                <div x-show="!rsvpSubmitted">
                    <button @click="submitRSVP()" 
                        class="w-full bg-brand-600 hover:bg-brand-500 text-white font-bold py-4 rounded-2xl shadow-lg shadow-brand-500/20 transition transform hover:scale-[1.02] mb-4">
                        Request to Join
                    </button>
                    <p class="text-center text-[10px] text-gray-500 px-4">
                        By requesting, you agree to the host's rules. This event requires **manual approval** by the organizer.
                    </p>
                </div>

                <div x-show="rsvpSubmitted" class="text-center py-6 bg-brand-900/20 rounded-2xl border border-brand-500/30">
                    <i data-lucide="clock" class="text-brand-500 w-10 h-10 mx-auto mb-3"></i>
                    <h4 class="text-white font-bold mb-1">Request Pending</h4>
                    <p class="text-gray-400 text-xs">The organizer will review your request soon.</p>
                </div>
            </div>

            <!-- Organizer Info -->
            <div class="bg-dark-800 rounded-3xl p-6 border border-white/5">
                <div class="flex items-center gap-4">
                    <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($event['organizer_name'] ?? 'Organizer'); ?>&background=random" class="w-12 h-12 rounded-full">
                    <div>
                        <p class="text-xs text-gray-500 mb-0.5">Hosted by</p>
                        <p class="text-white font-bold"><?php echo htmlspecialchars($event['organizer_name'] ?? 'Event Organizer'); ?></p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
function eventPage() {
    return {
        messages: [],
        newMessage: '',
        rsvpSubmitted: false,
        
        init() {
            // Initial Mock Messages
            this.fetchMessages();
            // Start Polling
            setInterval(() => this.fetchMessages(), 5000);
        },

        fetchMessages() {
        fetch(`<?php echo BASE_URL; ?>event/<?php echo $event['id']; ?>/chat`)
            .then(res => res.json())
            .then(data => {
                if(data.status === 'success') {
                    // Update list only if new messages
                    if(this.messages.length === 0) {
                        this.messages = data.messages;
                    }
                }
            });
        },

        sendMessage() {
            if(this.newMessage.trim() === '') return;
            
            this.messages.push({
                user: 'You',
                content: this.newMessage,
                time: new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })
            });
            this.newMessage = '';
            
            // Scroll to bottom
            setTimeout(() => {
                const win = document.getElementById('chat-window');
                win.scrollTop = win.scrollHeight;
            }, 100);
        },

        submitRSVP() {
            // logic would go to a controller
            this.rsvpSubmitted = true;
            lucide.createIcons();
        }
    }
}
</script>

<style>
.custom-scrollbar::-webkit-scrollbar { width: 4px; }
.custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
.custom-scrollbar::-webkit-scrollbar-thumb { background: #334155; border-radius: 10px; }
.active-tier {
    border-color: #14b8a6 !important;
    background: rgba(20, 184, 166, 0.05);
}
</style>
