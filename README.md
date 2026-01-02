# Test DISKOMINFO - Denis Setiawan

## Installation

Bukan Terminal dan Jalankan 

```bash
clone https://github.com/denizsetyawan/test-diskominfo-bantul
```

## SOAL 1
Stack untuk scrapping
- Node JS (18)
- My SQL

```python
masuk ke folder scrapping
di file scrap-pokemon.js nanti atur config db di bagian new Sequelize line 6

# jika sudah masuk terminal dan jalankan
node scrap-pokemon.js
```
nanti akan muncul folder images, serta isinya, dan db nya akan terisi otomatis

## SOAL 2
Stack untuk menampilkan data
- Laravel 7
- My SQL

folder images setelah scrap selesai pindah ke folder /blog/public/storage
jika belum ada folder storage buat dulu.

setelah itu jalankan laravel dengan cara masuk ke folder /blog di terminal dan jalankan 

```bash
php artisan serve
```

jika sudah berjalan, masuk ke http://127.0.0.1:8000/pokemons di browser
