<div class="max-w-lg mx-auto p-6 bg-white shadow-md rounded-lg mt-10">
    <h1 class="text-3xl font-semibold text-center text-gray-800 mb-6">Todo List</h1>

    <!-- Pesan Flash -->
    @if (session()->has('pesan'))
    <div x-data="{ show:true}" x-show="show" x-init="setTimeout(() => show = false,3000)"
        class="bg-green-500 text-white p-4 rounded-md mb-4 duration-300">
        {{ session('pesan') }}
    </div>
    @endif

    <!-- Form Input -->
    <div class="space-y-4">
        <div>
            <label for="judul" class="block text-lg font-medium text-gray-700">Judul</label>
            <input type="text" id="judul" wire:model="judul"
                class="w-full p-3 border border-gray-300 rounded-md mt-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                placeholder="Masukkan judul todo">
            @error('judul')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="tanggal" class="block text-lg font-medium text-gray-700">Tanggal</label>
            <input type="date" id="tanggal" wire:model="tanggal"
                class="w-full p-3 border border-gray-300 rounded-md mt-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            @error('tanggal')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <button wire:click="create"
            class="w-full bg-blue-500 text-white py-3 rounded-md hover:bg-blue-600 transition duration-300">
            Simpan
        </button>
    </div>

    <!-- Todo List -->
    <div class="mt-8">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Daftar Todo</h2>
        <ul class="space-y-2">
            @foreach ($todolist as $todo)
            <li class="flex justify-between items-center p-3 border-b border-gray-200">
                <span class="text-lg font-medium text-gray-700">{{ $todo->judul }} -
                    {{ \Carbon\Carbon::parse($todo->tanggal)->format('d M Y') }}</span>
                <button wire:click="delete({{ $todo->id }})"
                    class="bg-red-500 text-white py-1 px-3 rounded-md hover:bg-red-600 transition duration-300">
                    Hapus
                </button>
                <button wire:click="show({{ $todo->id }})"
                    class="bg-blue-500 text-white py-1 px-3 rounded-md hover:bg-blue-600 transition duration-300">
                    Detail
                </button>
            </li>
            @endforeach
            @if (session()->has('pesanHapus'))
            <div x-data="{ show:true}" x-show="show" x-init="setTimeout(() => show = false,3000)"
                class="bg-green-500 text-white p-4 rounded-md mb-4 ">
                {{ session('pesanHapus') }}
            </div>
            @endif
        </ul>
    </div>
</div>