<div>
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold">Contacts List</h2>
        <button class="bg-blue-500 text-white px-4 py-2 rounded" @click="$wire.call('openModal')">Add Contact</button>
    </div>

    <table class="min-w-full bg-white">
        <thead>
                <tr>
                    <th class="py-2 px-4 bg-gray-200">Name</th>
                    <th class="py-2 px-4 bg-gray-200">Email</th>
                    <th class="py-2 px-4 bg-gray-200">Phone</th>
                    <th class="py-2 px-4 bg-gray-200">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($contacts as $contact)
                    <tr>
                        <td class="border px-4 py-2">{{ $contact->name }}</td>
                        <td class="border px-4 py-2">{{ $contact->email }}</td>
                        <td class="border px-4 py-2">{{ $contact->phone }}</td>
                        <td class="border px-4 py-2">
                            <button class="bg-yellow-500 text-white px-2 py-1 rounded" @click="$wire.call('openModal', {{ $contact->id }})">Edit</button>
                            <button class="bg-red-500 text-white px-2 py-1 rounded" @click="$wire.call('delete', {{ $contact->id }})">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    <!-- Modal -->
    <div x-data="{ showModal: @entangle('showModal') }">
        <div x-show="showModal" class="fixed z-10 inset-0 overflow-y-auto">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>
                <!-- Modal panel -->
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <h3 class="flex justify-center text-lg leading-6 font-medium text-gray-900" >{{ $contactId ? 'Edit Contact' : 'Add New Contact' }}</h3>
                        <div class="mt-2">
                            <input type="text" wire:model="name" placeholder="Name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            @error('name') <span class="text-red-500">{{ $message }}</span> @enderror

                            <input type="email" wire:model="email" placeholder="Email" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            @error('email') <span class="text-red-500">{{ $message }}</span> @enderror

                            <input type="text" wire:model="phone" placeholder="Phone" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            @error('phone') <span class="text-red-500">{{ $message }}</span> @enderror

                            <input type="text" wire:model="user_id" placeholder="User ID" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            @error('user_id') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-500 text-base font-medium text-white hover:bg-blue-700 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm" wire:click="saveContact">{{ $contactId ? 'Update' : 'Save' }}</button>
                        <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:w-auto sm:text-sm" @click="showModal = false">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
</div>
