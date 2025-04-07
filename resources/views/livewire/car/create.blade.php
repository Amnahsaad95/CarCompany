<div class="flex-grow overflow-auto container mx-auto px-4 py-8">
    
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Add New Car</h1>
            
        </div>
		@if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        <form wire:submit.prevent="save" class="bg-white rounded-xl shadow-md overflow-hidden p-6">
            <!-- Car Images Edit -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold mb-4">Car Images</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @foreach([0, 1, 2] as $index)
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-4">
                        @if(isset($car_Image[$index]))
                            <img src="{{ $car_Image[$index]->temporaryUrl() }}" 
                                 alt="Preview" 
                                 class="w-full h-48 object-cover mb-3 rounded hover:scale-105 transition-transform">
                        
						
                        @endif
                        
                        <input type="file" wire:model.live="car_Image.{{ $index }}" 
                               class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        @error('car_Image.'.$index) <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Car Details Edit -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <h2 class="text-xl font-semibold mb-4">Basic Information</h2>
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Car Brand</label>
                        <input type="text" wire:model="Brand" class="w-full p-2 border rounded">
                        @error('Brand') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Description</label>
                        <textarea wire:model="car_Description" class="w-full p-2 border rounded h-32"></textarea>
                        @error('car_Description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
						<div class="mb-4">
                            <label class="block text-gray-700 mb-2">City</label>
                            <input type="text" step="0.01" wire:model="city" class="w-full p-2 border rounded">
                            @error('city') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
						<div class="mb-4">
                            <label class="block text-gray-700 mb-2">Country</label>
                            <input type="text" step="0.01" wire:model="country" class="w-full p-2 border rounded">
                            @error('country') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        
                    </div>
                </div>

                <div>
                    <h2 class="text-xl font-semibold mb-4">Features</h2>
                    <div class="grid grid-cols-2 gap-4">
						<div class="mb-4">
                            <label class="block text-gray-700 mb-2">Model </label>
                            <input type="text" wire:model="car_Model" class="w-full p-2 border rounded">
                            @error('car_Model') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 mb-2">Year </label>
                            <input type="number" wire:model="car_Year" class="w-full p-2 border rounded">
                            @error('car_Year') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 mb-2">Price</label>
                            <input type="number" step="0.01" wire:model="car_Price" class="w-full p-2 border rounded">
                            @error('car_Price') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 mb-2">Available </label>
							<label class="relative inline-flex items-center cursor-pointer">
								<input type="checkbox" wire:model="isSold" class="sr-only peer" @checked(!$isSold)>
								<div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-red-500 transition-all"></div>
								<div class="absolute left-1 top-1 bg-white w-4 h-4 rounded-full peer-checked:translate-x-full transition-all"></div>
							</label>
							
                            @error('isSold') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 mb-2">Color </label>
                            <input type="color" wire:model="color" class="w-full p-2 h-10 border rounded">
                            @error('color') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        
                    </div>
                </div>
            </div>

            <div class="flex justify-end space-x-4">
                
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                    Save Changes
                </button>
            </div>
        </form>
 

</div>
