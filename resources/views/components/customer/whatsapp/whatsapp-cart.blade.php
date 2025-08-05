
{{-- function Cart to WA (otw)--}}

<div id="wa-cart-popup" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 transition-opacity duration-300">
  <div class="bg-white p-6 rounded shadow-xl max-w-xl w-full transform scale-95 transition-transform duration-300">
    <h2 class="text-xl font-bold mb-4">Konfirmasi Keranjang</h2>
    <div id="wa-cart-detail" class="text-sm mb-6 space-y-2 max-h-80 overflow-y-auto"></div>
    <div class="flex justify-end gap-4">
      <button id="wa-cart-cancel-btn" class="px-4 py-2 bg-gray-300 rounded">Batal</button>
      <button id="wa-cart-order-btn" class="px-4 py-2 bg-green-600 text-white rounded">Order Semua via WA</button>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const cartButton = document.getElementById('btn-wa-cart');//Panggil script dengan menambahkan btn-wa-cart pada class button order
    const popup = document.getElementById('wa-cart-popup');
    const detailContainer = document.getElementById('wa-cart-detail');
    const orderBtn = document.getElementById('wa-cart-order-btn');
    const cancelBtn = document.getElementById('wa-cart-cancel-btn');

    cartButton?.addEventListener('click', function () {
        const items = document.querySelectorAll('.cart-item'); // setiap produk di keranjang harus punya class ini
        let waMessage = "Halo! Saya ingin memesan produk berikut:\n\n";
        let htmlDetail = "";

        items.forEach((item, index) => {
            const nama = item.getAttribute('data-nama') || '-';
            const kategori = item.getAttribute('data-kategori') || '-';
            const harga = item.getAttribute('data-harga') || '-';
            const jumlah = item.getAttribute('data-jumlah') || '1';

            waMessage += `📦 *${nama}*\n🏷️ Kategori: ${kategori}\n💰 Harga: ${harga}\n🛒 Jumlah: ${jumlah}\n\n`;

            htmlDetail += `
                <div class="border p-2 rounded">
                    <strong>Produk ${index + 1}</strong><br>
                    Nama: ${nama}<br>
                    Kategori: ${kategori}<br>
                    Harga: ${harga}<br>
                    Jumlah: ${jumlah}
                </div>
            `;
        });

        orderBtn.dataset.waText = waMessage;
        detailContainer.innerHTML = htmlDetail;

        popup.classList.remove('hidden');
    });

    orderBtn.addEventListener('click', () => {
        const pesan = orderBtn.dataset.waText;
        const encoded = encodeURIComponent(pesan);
        const url = `https://wa.me/6282245824434?text=${encoded}`;
        window.open(url, '_blank');
    });

    cancelBtn.addEventListener('click', () => {
        popup.classList.add('hidden');
    });
});
</script>