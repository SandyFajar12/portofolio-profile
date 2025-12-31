<!doctype html>
<html>
<head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"></head>
<body>
  <h3>Form via mailto (tanpa server)</h3>
  <form id="f">
    <label>Nama: <input name="nama" required></label><br>
    <label>Email: <input name="email" type="email"></label><br>
    <input type="hidden" id="tipe_hp" name="tipe_hp">
    <button type="submit">Kirim via Email</button>
  </form>

<script>
// isi tipe_hp sederhana (pakai UA)
document.getElementById('tipe_hp').value = ( /iphone/i.test(navigator.userAgent) ? 'Apple iPhone' :
  /samsung/i.test(navigator.userAgent) ? 'Samsung' :
  /xiaomi|redmi|poco/i.test(navigator.userAgent) ? 'Xiaomi' :
  /oppo/i.test(navigator.userAgent) ? 'Oppo' :
  /vivo/i.test(navigator.userAgent) ? 'Vivo' :
  /android/i.test(navigator.userAgent) ? 'Android (lainnya)' : 'Tidak diketahui') + " | " + navigator.userAgent;

document.getElementById('f').addEventListener('submit', function(e){
  e.preventDefault();
  const fd = new FormData(e.target);
  const nama = fd.get('nama') || '-';
  const email = fd.get('email') || '-';
  const tipe = fd.get('tipe_hp') || '-';

  // siapkan mailto ke penerima target (ganti alamat berikut)
  const to = 'penerima@domain.com';
  const subject = encodeURIComponent('Form baru dari ' + nama);
  const body = encodeURIComponent(
    `Nama: ${nama}\nEmail: ${email}\nTipe HP: ${tipe}\n\n(User-Agent): ${navigator.userAgent}`
  );

  // buka mail client user — dia harus klik Send di app email
  window.location.href = `mailto:${to}?subject=${subject}&body=${body}`;
});
</script>
</body>
</html>