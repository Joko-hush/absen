# Absensi
Aplikasi absensi dengan fitur ambil gambar dan lokasi menggunakan CI3.

pada awalnya sistem autentikasi menggunakan email. tp saat ini email smtp sudah tidak didukung oleh google. maka sudah tidak digunakan lagi. jika masih ingin menggunakan email silahkan berlangganan ke email server provider. saat ini diaplikasi ini menggunakan verifikasi menggunakan whatsapp gateway. silahkan berlangganan ke wa provider untuk api nya. anda tinggal mengganti di wa model untuk setting api whatsaap-nya.

database bisa di import dari folder assets. ada file sql. untuk akun personalia menggunakan email pers@email.com pass: 654321

untuk mulai menggunakan, silahkan masukan daftar anggota resmi di master personil. bisa input satu persatu atau import ke database m_personil_pers. isi juga master jabatan dari mulai eselon, bidang, bagian atau unit, subunit, lalu jabatan. untuk jabatan pimpinan 
pada kapala/pimpinan harus di ceklis.

lalu sesuaikan jam kerja yang berlaku.
jangan lupa lakukan npm install ada beberapa yang pake npm depedency nya.
buat akun mapbox buat dapat token akses. jika sudah dapat masukkan ke controller personalia baris 731.



