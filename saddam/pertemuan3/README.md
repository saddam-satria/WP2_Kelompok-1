# Pertemuan 3 Form Input

## Struktur Folder View

```
app/Views/layouts -> merupakan layout templating, dimana parent file html berada
app/Views/matakuliah -> merupakan folder tampilan form matakuliah dan table matakuliah
```

## Struktur Folder Controllers

```
app/Controllers/MatakuliahController.php -> merupakan controller yang mengatur request data menuju ke view
```

## Struktur Folder Routes

```
app/Config/Routes.php -> merupakan file yang mengatur url (endpoint)

pada file app/Config/Routes.php terdapat tambahan URL yaitu matakuliah/new dengan dua method yang berbeda POST & GET

Penjelesan:
    - GET {BASE_URL}/matakuliah/new
    Untuk menampilkan formulir pengisian mata kuliah
    - POST {BASE_URL}/matakuliah/new
    Untuk memasukan data yang diinput ke table

```

#### Note

- codeigniter yang digunakan adalah versi 4, untuk modul adalah versi 3

### Indonesian Version
