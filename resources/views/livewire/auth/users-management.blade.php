<div class="flex-grow overflow-auto container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">User Management</h1>
    
    <!-- Search and Add New Car Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <div class="relative w-full md:w-64">
            <input type="text" wire:model.live.debounce.150ms="search" placeholder="Search cars..." 
                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
        </div>
		
    </div>
    
    <!-- Sorting Controls -->
    <div class="flex flex-wrap items-center gap-4 mb-4">
        <div class="flex items-center gap-2">
            <label for="sort-by" class="text-sm font-medium text-gray-700">Sort by:</label>
            <select wire:model.live="sortBy" class="border border-gray-300 rounded-md px-3 py-1 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
                <option value="name">Name</option>
                <option value="email">Email</option>
                <option value="created_at">Date</option>
            </select>
        </div>
        <div class="flex items-center gap-2">
            <label for="sort-order" class="text-sm font-medium text-gray-700">Order:</label>
            <select wire:model.live="sortDirection" class="border border-gray-300 rounded-md px-3 py-1 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
                <option value="asc">Ascending</option>
                <option value="desc">Descending</option>
            </select>
        </div>
    </div>
    
    <!-- Cars Table -->
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
						
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" wire:click="sortBy('name')">
                            Name
                            @if($sortBy === 'name')
                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ml-1"></i>
                            @else
                                <i class="fas fa-sort ml-1"></i>
                            @endif
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" wire:click="sortBy('email')">
                            Email
                            @if($sortBy === 'email')
                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ml-1"></i>
                            @else
                                <i class="fas fa-sort ml-1"></i>
                            @endif
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Phone
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">City</th>
                        
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Country</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($users as $user)
                        <tr>
							<td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
										@isset($user->profile_Image)
											<img src="{{ asset('storage/'.$user->profile_Image ) }}" alt="User Profile" class="h-10 w-10 rounded-full object-cover">
										@else
											<img src="{{ asset('storage/profile/default-profile.jpg' ) }}" alt="User Profile" class="h-10 w-10 rounded-full object-cover">
										@endisset
									</div>
                                </div>
                            </td>
							<td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $user->email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $user->phone}}</div>
                            </td>
                            
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $user->city }}</div>
                            </td>
							<td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $user->country }}</div>
                            </td>
							
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button wire:click="openViewModal({{ $user->user_Id }})" class="text-blue-600 hover:text-blue-900 mr-3">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button wire:click="delete({{ $user->user_Id }})" wire:confirm="return confirm('Are you sure?')" class="text-red-600 hover:text-red-900">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-4 text-center text-sm text-gray-500">
                                No cars found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Pagination -->
    <div class="flex items-center justify-between mt-6">
        <div class="text-sm text-gray-700">
            Showing <span class="font-medium">{{ $users->firstItem() }}</span> to <span class="font-medium">{{ $users->lastItem() }}</span> of <span class="font-medium">{{ $users->total() }}</span> results
        </div>
        <div class="flex space-x-2">
            {{ $users->links() }}
        </div>
    </div>

	
    <!-- View Car Modal -->
	<div x-data="{ isViewModalOpen: @entangle('isViewModalOpen') }">	    
	    <div x-show="isViewModalOpen" x-cloak class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-1/2 lg:w-1/3 shadow-lg rounded-md bg-white">
		<div class="relative top-20 mx-auto p-5 border w-11/12 md:w-1/2 lg:w-1/3 shadow-lg rounded-md bg-white">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-800">User Detail</h3>
                <button wire:click="closeModal" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="grid grid-cols-1 gap-4 mb-4">
                <div class="flex justify-center mb-4">
					@isset($viewUser->profile_Image)
						<img src="{{ asset('storage/'.$viewUser->profile_Image ) }}" alt="User Profile" class="h-40 w-full object-cover rounded-md">
					@else
						<img src="{{ asset('storage/profile/default-profile.jpg' ) }}" alt="User Profile" class="h-40 w-full object-cover rounded-md">
					@endisset
                    
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Name</p>
                        <p class="text-sm text-gray-900">{{ $viewUser->name ?? '' }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Email</p>
                        <p class="text-sm text-gray-900">{{ $viewUser->email ?? '' }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Phone</p>
                        <p class="text-sm text-gray-900">{{ $viewUser->phone ?? '' }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">City</p>
                        <p class="text-sm text-gray-900">{{ $viewUser->city ?? '' }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Country</p>
                        <p class="text-sm text-gray-900">{{ $viewUser->country ?? '' }}</p>
                    </div>
                </div>
            </div>
            <button wire:click="closeModal" wire:loading.attr="disabled">
                Close
            </button>
	</div>
	</div>	
		</div>	
	</div>	
</div>

