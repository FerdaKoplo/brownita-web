<div id="wa-popup" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
  <div class="bg-white p-6 rounded shadow-xl max-w-md w-full">
    <h2 class="text-xl font-bold mb-4">Konfirmasi Pesanan</h2>
    <div id="wa-detail" class="text-sm mb-6 space-y-1"></div>
    <div class="flex justify-end gap-4">
      <button id="wa-cancel-btn" class="px-4 py-2 bg-gray-300 rounded">Batal</button>
      <button id="wa-order-btn" class="px-4 py-2 bg-green-600 text-white rounded">Order via WA</button>
    </div>
  </div>
</div>

{{-- Order One Product --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const buttons = document.querySelectorAll('.btn-wa');//Panggil script dengan menambahkan btn-wa pada class button order
        const popup = document.getElementById('wa-popup');
        const detail = document.getElementById('wa-detail');
        const orderBtn = document.getElementById('wa-order-btn');
        const cancelBtn = document.getElementById('wa-cancel-btn');

        buttons.forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();

                const nama = button.getAttribute('data-wa-nama') || '-';
                const kategori = button.getAttribute('data-wa-kategori') || '-';
                const harga = button.getAttribute('data-wa-harga') || '-';
                const deskripsi = button.getAttribute('data-wa-deskripsi') || '-';

                detail.innerHTML = `
                    <strong>Nama Produk:</strong> ${nama}<br>
                    <strong>Kategori:</strong> ${kategori}<br>
                    <strong>Harga:</strong> ${harga}<br>
                    <strong>Deskripsi:</strong> ${deskripsi}
                `;

                orderBtn.dataset.waText = `Halo! Saya ingin memesan:\n\n` +
                    `📦 *${nama}*\n` +
                    `🏷️ Kategori: ${kategori}\n` +
                    `💰 Harga: ${harga}\n` +
                    `📝 Deskripsi:\n${deskripsi}`;

                popup.classList.remove('hidden');
            });
        });

        orderBtn.addEventListener('click', () => {
            const pesan = orderBtn.dataset.waText;
            const encoded = encodeURIComponent(pesan);
            const url = `https://wa.me/6282245824434?text=${encoded}`; // Ganti nomor WA
            window.open(url, '_blank');
        });

        cancelBtn.addEventListener('click', () => {
            popup.classList.add('hidden');
        });
    });
</script>