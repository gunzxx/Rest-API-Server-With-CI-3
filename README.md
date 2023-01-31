<h1 align="center">
# Rest API Server With Code Igniter 3
</h1>


## Bagaimana persiapan projek ini ?

### PHP
Membutuhkan ```PHP >= 8.0```

### Database
- Buat database dengan nama restapi
- Lalu import file database yg bernama ```restapi.sql``` diatas
- Jangan lupa konfigurasi database di ``` application/config/database.php ```
- Selesai

## Bagaimana cara menggunakan dan testing API?

### Setup Keys/Token
- Silahkan buka ```application/config/rest.php```
- Lalu ganti ```$config['rest_key_name'] = 'gunz_key';``` sesuai keinginan anda
- Buka tabel ```keys``` di database, lalu masukkan key yang anda inginkan atau ganti nilai pada kolom ```key``` sesuai keinginan anda
- Token siap digunakan

### Setup Authorization
- Buka ```application/config/rest.php```
- Jika ingin menonaktifkan autorisasi/login , \n ganti ```$config['rest_auth'] = 'basic';``` ubah basic menjadi FALSE
- Untuk mengganti username dan password, ganti pada ```$config['rest_valid_logins'] = ['admin' => '123'];```

### Testing API
- Buka POSTMAN
- Masukkan url anda dan tambahkan ```api/mahasiswa``` , contoh : ```http://localhost/api/mahasiswa```
- Pada bagian params, masukkan token anda
- Untuk menggunakan method lain anda bisa mencobanya sendiri

Jangan lupa beri start ya ⭐⭐⭐
