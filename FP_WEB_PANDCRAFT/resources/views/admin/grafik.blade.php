<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Grafik Penjualan - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-4xl mx-auto mb-4">
        <a href="{{ url('/admin/dashboard') }}" 
           class="inline-flex items-center gap-2 bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition duration-300">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Dashboard
        </a>
    </div>

    <div class="max-w-4xl mx-auto bg-white p-6 rounded-xl shadow-md">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Statistik Produk Terjual</h2>
        
        <canvas id="grafikProduk" height="100"></canvas>
    </div>

    <script>
        const ctx = document.getElementById('grafikProduk').getContext('2d');
        const grafik = new Chart(ctx, {
            type: 'bar', // Bisa diganti 'pie' atau 'line'
            data: {
                labels: [
                    @foreach($data as $item)
                        "{{ $item->nama_produk }}",
                    @endforeach
                ],
                datasets: [{
                    label: 'Jumlah Terjual',
                    data: [
                        @foreach($data as $item)
                            {{ $item->total_terjual }},
                        @endforeach
                    ],
                    backgroundColor: '#2e7d32',
                    borderColor: '#1b4332',
                    borderWidth: 1
                }]
            },
            options: {
                scales: { y: { beginAtZero: true } }
            }
        });
    </script>


</body>
</html>