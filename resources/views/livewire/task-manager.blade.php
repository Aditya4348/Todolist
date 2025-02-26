<div class="container mx-auto p-6">
    <!-- Form untuk Menambahkan Task -->
    <div class="bg-white shadow-lg rounded-lg p-6 mb-6">
        <h2 class="text-2xl font-bold mb-4">Add New Task</h2>
        <div class="space-y-4">

            
            @if (session()->has('sukses'))
            <div x-data="{ show:true}" x-show="show" x-init="setTimeout(() => show = false,3000)"
                class="bg-green-500 text-white p-4 rounded-md mb-4 duration-300">
                {{ session('sukses') }}
            </div>
            @endif

            <div>
                <label for="deskripsi" class="block text-sm font-semibold text-gray-700">Task Description</label>
                <textarea id="deskripsi" name="deskripsi" wire:model='deskripsi' rows="3"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                    placeholder="Enter task description" required></textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="task_date" class="block text-sm font-semibold text-gray-700">Due Date</label>
                    <input type="date" id="task_date" wire:model='task_date' name="task_date"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                        required>
                </div>

                <div>
                    <label for="prioritas" class="block text-sm font-semibold text-gray-700">Task Status</label>
                    <select id="prioritas" wire:model='prioritas' name="prioritas"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                        required>
                        <option value="Tinggi">Tinggi</option>
                        <option value="Sedang">Sedang</option>
                        <option value="Rendah">Rendah</option>
                    </select>
                </div>
            </div>
            <div class="mt-4">
                <button wire:click='taskCreate'
                    class="w-full py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400">Add
                    Task</button>
            </div>
        </div>
    </div>

    <!-- Daftar Task yang Ada -->
    <div class="bg-white shadow-lg rounded-lg p-6">
        <h2 class="text-2xl font-bold mb-4">Task Details</h2>
        @foreach ( $task as $tugas )
        <div class="space-y-4">
            <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                <p class="text-gray-600">{{ $tugas->deskripsi }}</p>
                <div class="flex items-center justify-between mt-2">
                    <span class="text-gray-500 text-sm">{{$tugas->task_date}}</span>
                    <span class="text-sm text-green-500">{{$tugas->prioritas}}</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>