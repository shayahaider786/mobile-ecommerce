@props(['categoryName' => 'Accessories'])

<div class="bg-white rounded-xl shadow-sm hover:shadow-lg transition group relative overflow-hidden border border-slate-100 flex flex-col h-full">
    <div class="relative h-48 md:h-64 bg-slate-100 overflow-hidden">
        <!-- Dummy Image -->
        <img src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?q=80&w=600&auto=format&fit=crop" 
             alt="Product" 
             class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
        
        <!-- Category Badge (Optional) -->
        <div class="absolute top-2 left-2 bg-white/80 backdrop-blur text-[10px] font-bold px-2 py-1 rounded text-slate-700">
            {{ $categoryName }}
        </div>
    </div>
    <div class="p-4 flex flex-col flex-grow">
        <h3 class="text-sm md:text-base font-bold text-slate-900 mb-1 truncate">Sample Product</h3>
        <p class="text-teal-600 font-bold mb-4">Rs. 1,999</p>
        
        <div class="mt-auto">
            <button class="w-full bg-slate-900 text-white py-2 rounded text-sm hover:bg-teal-600 transition flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                Add to Cart
            </button>
        </div>
    </div>
</div>