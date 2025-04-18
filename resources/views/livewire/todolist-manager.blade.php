<div class="max-w-full mx-auto p-6 bg-gradient-to-r from-gray-800 via-gray-900 to-black shadow-xl rounded-lg">
    <h1 class="text-3xl font-semibold text-center text-white mb-6">Todo List</h1>

    <!-- Pesan Flash -->
    @if (session()->has('pesan'))
    <div x-data="{ show:true}" x-show="show" x-init="setTimeout(() => show = false,3000)"
        class="bg-green-500 text-white p-4 rounded-md mb-4 duration-300">
        {{ session('pesan') }}
    </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Form untuk Menambah Todo List (Kiri) -->
        <div class="space-y-6 bg-gray-800 p-6 rounded-xl shadow-md">
            <h2 class="text-2xl font-semibold text-white mb-4">Tambah Todo List</h2>

            <div>
                <label for="judul" class="block text-lg font-medium text-gray-300">Judul</label>
                <input type="text" id="judul" wire:model="judul"
                    class="w-full p-4 border border-gray-700 rounded-lg mt-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-gray-700 text-white placeholder-gray-400">
                @error('judul')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="tanggal" class="block text-lg font-medium text-gray-300">Tanggal</label>
                <input type="date" id="tanggal" wire:model="tanggal"
                    class="w-full p-4 border border-gray-700 rounded-lg mt-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-gray-700 text-white">
                @error('tanggal')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <button wire:click="create"
                class="w-full bg-indigo-600 text-white py-3 rounded-md hover:bg-indigo-700 transition duration-300 shadow-lg">
                Simpan
            </button>
        </div>

        <!-- Form untuk Menambahkan Task (Kanan) -->
        <div class="space-y-6 bg-gray-800 p-6 rounded-xl shadow-md">
            <h2 class="text-2xl font-semibold text-white mb-4">Tambah Task</h2>

            <div>
                <label for="deskripsi" class="block text-lg font-medium text-gray-300">Deskripsi Task</label>
                <textarea id="deskripsi" wire:model="deskripsi" rows="3"
                    class="w-full p-4 border border-gray-700 rounded-lg mt-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-gray-700 text-white placeholder-gray-400"></textarea>
            </div>

            <div>
                <label for="task_date" class="block text-lg font-medium text-gray-300">Tanggal Task</label>
                <input type="date" id="task_date" wire:model="task_date"
                    class="w-full p-4 border border-gray-700 rounded-lg mt-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-gray-700 text-white">
            </div>

            <div>
                <label for="prioritas" class="block text-lg font-medium text-gray-300">Prioritas</label>
                <select wire:model="prioritas"
                    class="w-full p-4 border border-gray-700 rounded-lg mt-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-gray-700 text-white">
                    <option value="">Pilih Kesulitan</option>
                    <option value="Tinggi">Tinggi</option>
                    <option value="Sedang">Sedang</option>
                    <option value="Rendah">Rendah</option>
                </select>
            </div>

            <div>
                <label for="todolist_id" class="block text-lg font-medium text-gray-300">Todo List</label>
                <select wire:model="todolist_id"
                    class="w-full p-4 border border-gray-700 rounded-lg mt-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-gray-700 text-white">
                    <option value="">Pilih Todo List</option>
                    @foreach ($todolist as $todo)
                    <option value="{{ $todo['id'] }}">{{ $todo['judul'] }}</option>
                    @endforeach
                </select>
            </div>

            <button wire:click="taskCreate"
                class="w-full bg-indigo-600 text-white py-3 rounded-md hover:bg-indigo-700 transition duration-300 shadow-lg">
                Tambahkan Task
            </button>
        </div>
    </div>

    @if (session()->hasAny('pesanHapus'))
    <!-- Pesan Alert - Berhasil Menghapus -->
    <div x-data="{ show: true }" x-show="show" x-transition:leave="transition ease-in duration-300"
        x-init="setTimeout(() => show = false, 1000)"
        class="fixed bottom-5 right-5 bg-red-500 text-white p-4 rounded-lg shadow-lg flex items-center space-x-3">
        <!-- Icon Success -->
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 12l2 2l4-4m2 7l2 2m0 0l-2 2m2-2l-2-2" />
        </svg>

        <!-- Pesan -->
        <div class="flex-1">
            <strong class="block text-lg font-semibold">{{session('pesanHapus')}}</strong>
            <span class="block text-sm">Item berhasil dihapus dari daftar.</span>
        </div>

        <!-- Tombol Tutup -->
        <button @click="show = false" class="text-white hover:text-gray-300 focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
    @endif

    <!-- Pesan Flash -->
    @if (session()->has('messageError'))
    <div x-data="{ show:true}" x-show="show" x-init="setTimeout(() => show = false,3000)"
        class="bg-red-500 text-white p-4 rounded-md mb-4 duration-300">
        {{ session('messageError') }}
    </div>
    @endif

    @if (session()->has('messageSuccess'))
    <div x-data="{ show:true}" x-show="show" x-init="setTimeout(() => show = false,3000)"
        class="bg-green-500 text-white p-4 rounded-md mb-4 duration-300">
        {{ session('messageSuccess') }}
    </div>
    @endif

    <!-- Daftar Todo List dengan Form Edit dan Accordion untuk Task -->
    <div class="mt-12">
        <h2 class="text-2xl font-semibold text-white mb-4">Daftar Todo</h2>
        <ul class="space-y-6">
            @foreach ($todolist as $todo)
            <li class="bg-gray-900 p-4 rounded-lg shadow-md">
                <!-- Form Edit Todo -->
                <form wire:submit.prevent="update({{ $todo['id'] }})"
                    class="flex flex-col md:flex-row items-start md:items-center gap-4">
                    <div class="flex-1 w-full">
                        <label class="block text-sm text-gray-200 mb-1">Judul Tugas</label>
                        <input type="text" wire:model.defer="todolist.{{ $todo['id'] }}.judul"
                            class="w-full px-4 py-2 border border-gray-600 bg-gray-800 text-white rounded-lg focus:outline-none focus:ring focus:border-indigo-400"
                            placeholder="Judul tugas" >
                    </div>
                    <div>
                        <label class="block text-sm text-gray-200 mb-1">Tanggal</label>
                        <input type="date" wire:model.defer="todolist.{{ $todo['id'] }}.tanggal"
                            class="px-4 py-2 border border-gray-600 bg-gray-800 text-white rounded-lg focus:outline-none focus:ring focus:border-indigo-400">
                    </div>
                    <button type="submit"
                        class="self-start mt-4 md:mt-6 bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                        Simpan
                    </button>
                </form>

                <!-- Accordion Tasks -->
                <div x-data="{ open: false }" class="mt-4">
                    <button @click="open = !open"
                        class="w-full text-left p-3 bg-indigo-700 text-white font-medium flex justify-between items-center rounded hover:bg-indigo-600 transition">
                        <span>Lihat Daftar Tugas</span>
                        <svg x-bind:class="open ? 'transform rotate-180' : ''" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            class="w-5 h-5 transition-transform duration-300">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div x-show="open" x-transition class="mt-4 bg-gray-800 p-4 rounded-lg shadow space-y-4">
                        @foreach ($todo['tasks'] as $task)
                        <div
                            class="flex justify-between items-center p-3 border-b border-gray-700 bg-gray-700 rounded-md">
                            <div class="flex flex-col">
                                <span class="font-semibold text-white">{{ $task['deskripsi'] }}</span>
                                <span class="text-sm text-gray-400">{{ $task['prioritas'] }}</span>
                                <span class="text-xs text-gray-500">
                                    {{ \Carbon\Carbon::parse($task['task_date'])->format('d M Y') }}
                                </span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <span class="text-sm {{ $task['selesai'] ? 'text-green-400' : 'text-red-400' }}">
                                    {{ $task['selesai'] ? 'Selesai' : 'Belum Selesai' }}
                                </span>
                                <button wire:click="markComplete({{ $task['id'] }})"
                                    class="bg-green-500 text-white py-1 px-2 rounded-md hover:bg-green-600 text-xs">
                                    Selesai
                                </button>
                                <a href="{{route('update_task', $task['id'])}}" class="bg-blue-500 text-white py-1 px-2 rounded-md hover:bg-blue-600 text-xs">
                                    Update
                                </a>
                                <button wire:click="deleteTask({{ $task['id'] }})"
                                    class="bg-red-500 text-white py-1 px-2 rounded-md hover:bg-red-600 text-xs">
                                    Hapus
                                </button>
                            </div>
                        </div>
                        @endforeach

                        <!-- Tombol Hapus Todo -->
                        <button wire:click="delete({{ $todo['id'] }})"
                            class="w-full bg-red-600 text-white py-2 rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-400 transition duration-300 transform mt-4 flex items-center justify-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            <span class="text-sm font-medium">Hapus Todo</span>
                        </button>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>

</div>