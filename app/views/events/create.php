<div class="max-w-3xl mx-auto px-4 py-20" x-data="createEventWizard()">
    
    <!-- Header/Stepper -->
    <div class="mb-12">
        <h1 class="text-3xl font-bold text-white mb-6">Host a new experience</h1>
        <div class="flex items-center gap-4">
            <template x-for="i in [1, 2, 3]">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold transition"
                        :class="step >= i ? 'bg-brand-500 text-white shadow-lg shadow-brand-500/30' : 'bg-dark-800 text-gray-600'">
                        <span x-text="i"></span>
                    </div>
                    <div x-show="i < 3" class="w-12 h-0.5 bg-dark-800">
                        <div class="h-full bg-brand-500 transition-all duration-500" :style="'width: ' + (step > i ? '100%' : '0%')"></div>
                    </div>
                </div>
            </template>
        </div>
    </div>

    <!-- Step 1: Basic Info -->
    <div x-show="step === 1" x-transition.opacity class="space-y-8">
        <div class="bg-dark-800/50 p-8 rounded-3xl border border-white/5 space-y-6">
            <div>
                <label class="block text-sm font-medium text-gray-400 mb-2">Event Title</label>
                <input type="text" x-model="formData.title" placeholder="e.g. Summer Solstice Party" 
                    class="w-full bg-dark-900 border border-gray-700 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-brand-500 outline-none transition text-lg font-semibold">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-400 mb-2">Category</label>
                <select x-model="formData.category" class="w-full bg-dark-900 border border-gray-700 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-brand-500 outline-none appearance-none">
                    <option value="Social">Social</option>
                    <option value="Tech">Tech</option>
                    <option value="Music">Music</option>
                    <option value="Art">Art</option>
                    <option value="Food">Food</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-400 mb-2">Cover Image</label>
                <div class="flex gap-4 items-center">
                    <div class="w-32 h-20 bg-dark-900 rounded-xl border border-dashed border-gray-700 flex items-center justify-center overflow-hidden">
                        <template x-if="formData.image">
                            <img :src="formData.image" class="w-full h-full object-cover">
                        </template>
                        <template x-if="!formData.image">
                            <i data-lucide="image" class="text-gray-700"></i>
                        </template>
                    </div>
                    <div class="space-y-2">
                        <button @click="generateAIImage()" class="text-xs flex items-center gap-2 bg-purple-600/20 text-purple-400 px-4 py-2 rounded-lg border border-purple-500/30 hover:bg-purple-600/30 transition">
                            <i data-lucide="wand-2" class="w-4 h-4"></i> Generate with AI
                        </button>
                        <p class="text-[10px] text-gray-500">Pick a prompt to create a unique poster</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Step 2: Location & Time -->
    <div x-show="step === 2" x-transition.opacity class="space-y-8">
        <div class="bg-dark-800/50 p-8 rounded-3xl border border-white/5 space-y-6">
             <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Date</label>
                    <input type="date" x-model="formData.date" class="w-full bg-dark-900 border border-gray-700 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-brand-500 outline-none transition">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Time</label>
                    <input type="time" x-model="formData.time" class="w-full bg-dark-900 border border-gray-700 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-brand-500 outline-none transition">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-400 mb-2">Venue Name</label>
                <input type="text" x-model="formData.location_name" placeholder="e.g. Central Park, Main Stage" 
                    class="w-full bg-dark-900 border border-gray-700 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-brand-500 outline-none transition">
            </div>
        </div>
    </div>

    <!-- Step 3: Logistics & Tiers -->
    <div x-show="step === 3" x-transition.opacity class="space-y-8">
        <div class="bg-dark-800/50 p-8 rounded-3xl border border-white/5 space-y-6">
            <div class="flex items-center justify-between">
                <h3 class="font-bold text-white text-lg">Ticket Tiers</h3>
                <button @click="addTier()" class="text-xs bg-brand-600 text-white px-3 py-1.5 rounded-lg flex items-center gap-1">
                    <i data-lucide="plus" class="w-3 h-3"></i> Add Tier
                </button>
            </div>
            
            <template x-for="(tier, index) in formData.tiers" :key="index">
                <div class="p-4 bg-dark-900 rounded-2xl border border-gray-800 relative">
                    <button @click="removeTier(index)" class="absolute top-2 right-2 text-gray-600 hover:text-red-500">
                        <i data-lucide="x-circle" class="w-4 h-4"></i>
                    </button>
                    <div class="grid grid-cols-2 gap-3">
                        <input type="text" x-model="tier.name" placeholder="Tier Name (e.g. VIP)" class="bg-transparent border-b border-gray-700 text-sm text-white focus:border-brand-500 outline-none py-1">
                        <input type="text" x-model="tier.price" placeholder="Price ($)" class="bg-transparent border-b border-gray-700 text-sm text-white focus:border-brand-500 outline-none py-1">
                    </div>
                </div>
            </template>

            <hr class="border-gray-800">

            <div class="flex items-center justify-between">
                <div>
                   <h3 class="font-bold text-white mb-1">Approval Only</h3>
                   <p class="text-xs text-gray-500">Guests must be approved before they can join</p>
                </div>
                <button @click="formData.approval = !formData.approval" 
                    class="w-12 h-6 rounded-full transition relative p-1"
                    :class="formData.approval ? 'bg-brand-500' : 'bg-dark-700'">
                    <div class="w-4 h-4 bg-white rounded-full transition-transform" :class="formData.approval ? 'translate-x-6' : 'translate-x-0'"></div>
                </button>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-400 mb-2">Custom Questions</label>
                <div class="text-xs text-gray-500 mb-2">Collect info like dietary requirements or T-shirt size.</div>
                <input type="text" x-model="formData.question" placeholder="Add a question..." 
                    class="w-full bg-dark-900 border border-gray-700 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-brand-500 outline-none text-sm">
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <div class="mt-12 flex justify-between">
        <button x-show="step > 1" @click="step--" class="px-8 py-3 text-gray-400 hover:text-white transition font-medium">Back</button>
        <div x-show="step === 1"></div> <!-- Filler -->
        
        <button x-show="step < 3" @click="nextStep()" class="px-12 py-3 bg-brand-500 text-white rounded-xl font-bold shadow-lg shadow-brand-500/20 hover:scale-[1.05] transition">Next Step</button>
        <button x-show="step === 3" @click="submitEvent()" class="px-12 py-3 bg-white text-dark-900 rounded-xl font-bold shadow-lg hover:scale-[1.05] transition">Publish Event</button>
    </div>

</div>

<script>
function createEventWizard() {
    return {
        step: 1,
        map: null,
        marker: null,
        formData: {
            title: '',
            category: 'Social',
            image: '',
            date: '',
            time: '',
            location_name: '',
            lat: 40.7128,
            lng: -74.0060,
            tiers: [{name: 'General Admission', price: 'Free'}],
            approval: true,
            question: ''
        },

        init() {
            lucide.createIcons();
        },

        nextStep() {
            this.step++;
        },

        generateAIImage() {
            // Simulated AI Generation using local tool logic
            this.formData.image = 'https://images.unsplash.com/photo-1533174072545-7a4b6ad7a6c3?auto=format&fit=crop&w=800&q=80';
            alert("Rich AI Image Generated based on Title!");
        },

        addTier() {
            this.formData.tiers.push({name: '', price: ''});
            setTimeout(() => lucide.createIcons(), 10);
        },

        removeTier(index) {
            this.formData.tiers.splice(index, 1);
        },

        submitEvent() {
            const formData = new FormData();
            formData.append('title', this.formData.title);
            formData.append('category', this.formData.category);
            formData.append('image', this.formData.image);
            formData.append('date', this.formData.date);
            formData.append('time', this.formData.time);
            formData.append('location_name', this.formData.location_name);
            formData.append('latitude', this.formData.lat);
            formData.append('longitude', this.formData.lng);
            formData.append('description', 'Join us for ' + this.formData.title + '! A ' + this.formData.category + ' event.');

            fetch('<?php echo BASE_URL; ?>events/create', {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if(data.status === 'success') {
                    alert("Event Published Successfully!");
                    window.location.href = data.redirect;
                } else {
                    alert("Error: " + data.message);
                }
            })
            .catch(err => {
                console.error(err);
                alert("Something went wrong. Please try again.");
            });
        }
    }
}
</script>
