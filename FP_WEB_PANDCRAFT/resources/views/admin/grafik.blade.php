<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grafik Penjualan - Admin Panel</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* Hanya memuat font, background ditangani oleh class Tailwind di tag body */
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body class="font-sans bg-brand-light bg-[url('/images/ok.jpeg')] bg-cover bg-fixed bg-center min-h-screen text-gray-800 flex flex-col items-center p-6 md:p-10">

    <div class="w-full max-w-5xl flex justify-end mb-6">
        <a href="{{ url('/admin/dashboard') }}" 
           class="inline-flex items-center gap-2 bg-white/90 backdrop-blur-sm hover:bg-white text-gray-700 font-medium px-5 py-2.5 rounded-full border border-gray-200 shadow-sm transition duration-200 text-sm">
            <i class="fa-solid fa-arrow-left text-gray-400"></i> Kembali ke Dashboard
        </a>
    </div>

    <div class="w-full max-w-5xl bg-white/95 backdrop-blur-xl p-8 md:p-10 rounded-3xl border border-white/60 shadow-2xl">
        
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-10 border-b border-gray-100 pb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Statistik Produk Terjual</h2>
                <p class="text-sm text-gray-500 mt-1.5">Data performa penjualan produk berdasarkan total kuantitas item yang berhasil terjual.</p>
            </div>
            <div class="self-start md:self-center">
                <span class="inline-flex items-center gap-2 bg-emerald-50 text-emerald-600 text-xs font-semibold px-4 py-2 rounded-full border border-emerald-100">
                    <span class="relative flex h-2 w-2">
                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                      <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                    </span>
                    Live Data
                </span>
            </div>
        </div>
        
        <div class="relative w-full h-[400px]">
            <canvas id="grafikProduk"></canvas>
        </div>
    </div>

    <script>
        const ctx = document.getElementById('grafikProduk').getContext('2d');
        
        // Efek gradasi warna
        const gradientBg = ctx.createLinearGradient(0, 0, 0, 400);
        gradientBg.addColorStop(0, 'rgba(52, 211, 153, 0.8)');
        gradientBg.addColorStop(1, 'rgba(52, 211, 153, 0.1)');

        const grafik = new Chart(ctx, {
            type: 'bar',
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
                    backgroundColor: gradientBg,
                    borderColor: '#10b981',
                    borderWidth: 2,
                    borderRadius: 8,             
                    borderSkipped: false,
                    barThickness: 'flex',
                    maxBarThickness: 60
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        align: 'end',
                        labels: {
                            boxWidth: 10,
                            boxHeight: 10,
                            usePointStyle: true,
                            pointStyle: 'circle',
                            font: {
                                size: 13,
                                family: "'Plus Jakarta Sans', sans-serif",
                                weight: '500'
                            },
                            color: '#64748b'
                        }
                    },
                    tooltip: {
                        backgroundColor: '#0f172a',
                        padding: 12,
                        titleFont: { size: 14, family: "'Plus Jakarta Sans', sans-serif", weight: '600' },
                        bodyFont: { size: 13, family: "'Plus Jakarta Sans', sans-serif" },
                        cornerRadius: 8,
                        boxPadding: 6,
                        displayColors: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#f1f5f9', 
                            drawBorder: false
                        },
                        ticks: {
                            color: '#94a3b8',
                            font: { size: 12, family: "'Plus Jakarta Sans', sans-serif" },
                            stepSize: 1
                        },
                        border: { display: false }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#64748b',
                            font: { size: 12, family: "'Plus Jakarta Sans', sans-serif", weight: '500' }
                        },
                        border: { display: false }
                    }
                }
            }
        });
    </script>

</body>
</html>