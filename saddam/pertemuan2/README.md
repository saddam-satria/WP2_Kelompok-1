# Pertemuan 3 Pengenalan Model

## Struktur Folder View

```
app/Views/layouts -> merupakan layout templating, dimana parent file html berada
app/Views/biodata.php -> merupakan tampilan yang berisikan biodata
app/Views/example.php -> merupakan tampilan yang berisikan hasil dari penjumlahan
```

## Struktur Folder Controllers

```
app/Controllers/Biodata.php method index -> merupakan controller yang mengatur tampilan biodata
app/Controllers/Biodata.php method matematika -> merupakan controller yang mengatur request data menuju ke view penjumlahan
```

## Struktur Folder Routes

```
app/Config/Routes.php -> merupakan file yang mengatur url (endpoint)

pada file app/Config/Routes.php terdapat tambahan URL yaitu biodata dan matematika

Penjelesan:
    - Biodata {BASE_URL}/biodata
    Untuk menampilkan biodata
    - Matematika {BASE_URL}/matematika/arg1/arg2
    Untuk menampilkan hasil penjumlahan, pada endpoint matematika terdapat 2 argument

```

#### Note

- codeigniter yang digunakan adalah versi 4, untuk modul adalah versi 3

### Indonesian Version
