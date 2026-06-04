<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Semua Pesanan - PandCraft</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'], serif: ['Playfair Display', 'serif'] },
                    colors: { brand: { light: '#fefce8', DEFAULT: '#2e7d32', dark: '#1b4332' } }
                }
            }
        }
    </script>
</head>

<body class="font-sans bg-brand-light bg-[url('/images/ok.jpeg')] bg-cover bg-fixed bg-center min-h-screen text-gray-800 flex flex-col">
    
   <nav class="bg-white/95 backdrop-blur-sm border-b border-gray-100 px-8 py-4">
    <div class="max-w-7xl mx-auto flex justify-between items-center">
        <div class="flex items-center gap-4">
            <h1 class="text-2xl font-serif font-bold text-gray-800">PandCraft<span class="text-green-700">.</span></h1>
            <span class="text-gray-400 text-sm border-l pl-4 border-gray-300">ADMIN PANEL</span>
        </div>
        
        <div class="flex items-center gap-3 relative">
            <div class="relative inline-block text-left">
                <button id="exportToggle" type="button" onclick="toggleExportMenu()"
                    class="bg-green-700 hover:bg-green-800 text-white px-5 py-2 rounded-lg text-sm font-medium transition shadow-md flex items-center gap-2">
                    <i class="fa-solid fa-file-export"></i> Ekspor <i class="fa-solid fa-chevron-down text-xs"></i>
                </button>
                <div id="exportMenu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-xl border border-gray-200 z-50">
                    <button type="button" onclick="exportTableToExcel('tabelPesanan', 'Daftar_Pesanan_PandCraft')"
                        class="w-full text-left px-4 py-3 hover:bg-green-50 transition text-sm text-gray-700 flex items-center gap-3">
                        <i class="fa-solid fa-file-excel text-green-700"></i> Excel
                    </button>
                    <button type="button" onclick="exportTableToPdf('tabelPesanan', 'Daftar_Pesanan_PandCraft')"
                        class="w-full text-left px-4 py-3 hover:bg-green-50 transition text-sm text-gray-700 flex items-center gap-3">
                        <i class="fa-solid fa-file-pdf text-red-600"></i> PDF
                    </button>
                </div>
            </div>
            <a href="{{ url('admin/dashboard') }}" class="bg-white border border-gray-200 text-gray-600 px-5 py-2 rounded-lg text-sm font-medium hover:bg-gray-50 transition flex items-center">
                <i class="fa-solid fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>
    </div>
</nav>

    <main class="flex-1 p-6">
        <div class="max-w-7xl mx-auto mt-6">
            <div class="flex items-center mb-8">
                <div class="bg-green-700 text-white p-3 rounded-xl shadow-md shadow-green-200 mr-4">
                    <i class="fa-solid fa-clipboard-list text-xl"></i>
                </div>
                <div>
                    <h2 class="text-3xl font-serif font-bold text-green-900 mb-1">Daftar Semua Pesanan</h2>
                    <p class="text-sm text-gray-500">Berikut adalah daftar lengkap seluruh transaksi yang masuk.</p>
                </div>
            </div>

            <div class="bg-white/95 backdrop-blur-sm rounded-3xl shadow-xl border border-green-50 overflow-hidden">
                <div class="overflow-x-auto">
                    <table id="tabelPesanan" class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-green-50/80 text-brand-dark font-medium border-b border-green-100">
                                <th class="px-6 py-5">ID Pesanan</th>
                                <th class="px-6 py-5">Pembeli</th>
                                <th class="px-6 py-5">Produk yang Dibeli</th>
                                <th class="px-6 py-5">Total Harga</th>
                                <th class="px-6 py-5 text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($pesanan as $id => $items)
                            <tr class="hover:bg-green-50/40 transition duration-200">
                                <td class="px-6 py-4 font-bold text-green-800">#{{ $id }}</td>
                                <td class="px-6 py-4 text-gray-700">{{ $items->first()->nama_pembeli }}</td>
                                <td class="px-6 py-4">
                                    <ul class="list-none p-0 text-sm text-gray-600">
                                        @foreach($items as $item)
                                            <li class="py-1">
                                                <span class="bg-gray-100 px-2 py-0.5 rounded text-xs text-gray-700">{{ $item->jumlah }}x</span> 
                                                {{ $item->nama_produk }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="px-6 py-4 font-bold text-brand">
                                    Rp {{ number_format($items->first()->total_harga, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-bold uppercase tracking-wide">
                                        {{ $items->first()->status_pesanan }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
            </div>
            <div class="p-6 text-center text-gray-400 text-sm border-t border-gray-50">
                    &copy; 2026 PandCraft. Hak Cipta Dilindungi.
                </div>
        </div>
    </main>
</body>
</html>

<script>
function toggleExportMenu() {
    var menu = document.getElementById('exportMenu');
    menu.classList.toggle('hidden');
}

document.addEventListener('click', function(event) {
    var exportMenu = document.getElementById('exportMenu');
    var exportToggle = document.getElementById('exportToggle');
    if (!exportMenu.contains(event.target) && !exportToggle.contains(event.target)) {
        exportMenu.classList.add('hidden');
    }
});

function exportTableToExcel(tableID, filename = '') {
    var table = document.getElementById(tableID);
    var tableHTML = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">'
        + '<head><meta charset="UTF-8"></head><body>'
        + table.outerHTML
        + '</body></html>';
    var filenameWithExtension = (filename ? filename : 'data') + '.xls';
    var blob = new Blob(['\ufeff', tableHTML], { type: 'application/vnd.ms-excel;charset=utf-8;' });
    var downloadLink = document.createElement('a');

    if (navigator.msSaveOrOpenBlob) {
        navigator.msSaveOrOpenBlob(blob, filenameWithExtension);
    } else {
        downloadLink.href = window.URL.createObjectURL(blob);
        downloadLink.download = filenameWithExtension;
        document.body.appendChild(downloadLink);
        downloadLink.click();
        document.body.removeChild(downloadLink);
    }
}

function exportTableToPdf(tableID, filename = '') {
    var doc = new window.jspdf.jsPDF('landscape', 'pt', 'a4');
    var table = document.getElementById(tableID);
    var headers = [];
    var data = [];

    var headerCells = table.querySelectorAll('thead th');
    headerCells.forEach(function(cell) {
        headers.push(cell.innerText.trim());
    });

    var rows = table.querySelectorAll('tbody tr');
    rows.forEach(function(row) {
        var rowData = [];
        row.querySelectorAll('td').forEach(function(cell) {
            var text = cell.innerText.trim().replace(/\r\n|\n|\r/g, ' ');
            rowData.push(text);
        });
        data.push(rowData);
    });

    doc.autoTable({
        head: [headers],
        body: data,
        startY: 40,
        theme: 'striped',
        headStyles: { fillColor: [46, 125, 50] },
        styles: { fontSize: 10, cellPadding: 6, halign: 'left' },
        margin: { left: 20, right: 20, top: 20 },
        tableWidth: 'auto',
    });

    doc.save((filename ? filename : 'data') + '.pdf');
}
</script>