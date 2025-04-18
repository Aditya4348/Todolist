<div class="max-w-2xl mx-auto mt-10 bg-gray-800 p-6 rounded-xl shadow-md">
    <h2 class="text-2xl font-semibold text-white mb-4">Update Task</h2>

    @if (session()->has('message'))
        <div class="mb-4 p-4 bg-green-500 text-white rounded-md">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="updateTask" class="space-y-6">
        <!-- Deskripsi -->
        <div>
            <label for="deskripsi" class="block text-lg font-medium text-gray-300">Deskripsi</label>
            <textarea wire:model.defer="deskripsi" id="deskripsi" rows="4"
                class="w-full p-4 border border-gray-700 rounded-lg mt-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-gray-700 text-white placeholder-gray-400"></textarea>
            @error('deskripsi') 
                <span class="text-red-500 text-sm">{{ $message }}</span> 
            @enderror
        </div>

        <!-- Tanggal -->
        <div>
            <label for="tanggal" class="block text-lg font-medium text-gray-300">Tanggal</label>
            <input type="date" wire:model.defer="task_date" id="tanggal"
                class="w-full p-4 border border-gray-700 rounded-lg mt-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-gray-700 text-white">
            @error('tanggal') 
                <span class="text-red-500 text-sm">{{ $message }}</span> 
            @enderror
        </div>

        <!-- Prioritas -->
        <div>
            <label for="prioritas" class="block text-lg font-medium text-gray-300">Prioritas</label>
            <select wire:model.defer="prioritas" id="prioritas"
                class="w-full p-4 border border-gray-700 rounded-lg mt-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-gray-700 text-white">
                <option value="">-- Pilih Prioritas --</option>
                <option value="Tinggi">Tinggi</option>
                <option value="Sedang">Sedang</option>
                <option value="Rendah">Rendah</option>
            </select>
            @error('prioritas') 
                <span class="text-red-500 text-sm">{{ $message }}</span> 
            @enderror
        </div>

        <!-- Tombol Submit -->
        <div class="flex justify-end">
            <button type="submit"
                class="px-6 py-3 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition shadow-lg">
                Update Task
            </button>
        </div>
    </form>
</div>
