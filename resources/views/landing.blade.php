<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Todolist - Selesaikan Tugasmu dengan Mudah</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
</head>
<body class="bg-white text-gray-800 font-sans">

    {{-- HERO SECTION --}}
    <section class="min-h-screen flex flex-col justify-center items-center text-center px-4 bg-gradient-to-br from-blue-500 to-indigo-600 text-white">
        <h1 class="text-4xl md:text-6xl font-bold leading-tight mb-4">Kelola Tugasmu<br>Dengan Lebih Cerdas</h1>
        <p class="text-lg md:text-xl mb-8 max-w-xl">Todolist sederhana namun powerful untuk bantu kamu tetap produktif setiap hari.</p>
        <a href="{{route('dashboard')}}" class="bg-white text-blue-600 font-semibold px-6 py-3 rounded-full shadow hover:bg-gray-100 transition">Mulai Sekarang</a>
    </section>

    {{-- FITUR SECTION --}}
    <section class="py-16 bg-gray-100">
        <div class="max-w-6xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-12">Fitur Utama</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white rounded-xl shadow p-6">
                    <div class="text-indigo-600 text-4xl mb-4">📝</div>
                    <h3 class="font-bold text-xl mb-2">Tambah & Kelola Tugas</h3>
                    <p class="text-gray-600">Tambahkan tugas baru dengan cepat, edit atau hapus tugas sesuai kebutuhanmu.</p>
                </div>
                <div class="bg-white rounded-xl shadow p-6">
                    <div class="text-indigo-600 text-4xl mb-4">✅</div>
                    <h3 class="font-bold text-xl mb-2">Checklist Real-time</h3>
                    <p class="text-gray-600">Tandai tugas yang sudah selesai tanpa perlu refresh halaman — berkat Livewire.</p>
                </div>
                <div class="bg-white rounded-xl shadow p-6">
                    <div class="text-indigo-600 text-4xl mb-4">🎨</div>
                    <h3 class="font-bold text-xl mb-2">Tampilan Modern</h3>
                    <p class="text-gray-600">Nikmati antarmuka yang bersih, responsif, dan mudah digunakan berkat desain modern dengan Tailwind CSS.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA SECTION --}}
    <section class="py-16 bg-indigo-600 text-white text-center">
        <h2 class="text-3xl font-bold mb-4">Siap Menjadi Lebih Produktif?</h2>
        <p class="mb-6">Mulai gunakan todolist kami secara gratis dan rasakan perbedaannya!</p>
    </section>

    {{-- FOOTER --}}
    <footer class="py-6 bg-gray-800 text-center text-white text-sm">
        &copy; {{ date('Y') }} Todolist App. Dibuat dengan ❤️ oleh Aditya.
    </footer>

</body>
</html>
