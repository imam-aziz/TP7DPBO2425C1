# 💻 TP7 DPBO - Imam Azizun Hakim - 2404420

## 🤝 Janji
"Saya Imam Azizun Hakim dengan NIM 2404420 mengerjakan Tugas Praktikum 7 dalam mata kuliah Desain Pemrograman Berorientasi Objek untuk keberkahan-Nya maka saya tidak akan melakukan kecurangan seperti yang telah di spesifikasikan. Aamiin."

## 🔀 Penjelasan Desain dan Flow Program

Aplikasi wIBu AniME COlLeCtiON dengan sistem CRUD (Create, Read, Update, Delete) sederhana untuk mengelola database koleksi anime, yang dibangun menggunakan PHP Native dengan prinsip OOP.

### Penjelasan Class

#### Diagram
![Diagram](Diagram.png)  

#### Class studio
<pre>
  ● id_studio (PK) <strong>berupa int sebagai Primary Key dari tabel studio</strong>
  ● nama_studio    <strong>berupa varchar sebagai nama dari sebuah studio</strong>
  ● asal_kota      <strong>berupa varchar sebagai asal kota dari sebuah studio</strong>
</pre>

#### Class anime
<pre>
  ● id_anime (PK)   <strong>berupa int sebagai Primary Key dari tabel anime</strong>
  ● nama_anime      <strong>berupa varchar sebagai nama dari sebuah anime</strong>
  ● genre           <strong>berupa varchar sebagai genre dari sebuah anime</strong>
  ● id_studio (FK)  <strong>berupa int sebagai Foreign Key dari tabel studio</strong>
                    <strong>yang berelasi dengan tabel anime (anime dinbuat oleh studio)</strong>
</pre>

#### Class character
<pre>
  ● id_character (PK)  <strong>berupa int sebagai Primary Key dari tabel character</strong>
  ● nama_character     <strong>berupa varchar sebagai nama dari sebuah character</strong>
  ● jenis_kelamin      <strong>berupa varchar sebagai jenis kelamin dari sebuah character</strong>
  ● voice_actor        <strong>berupa varchar sebagai voice actor dari sebuah character</strong>
  ● id_anime (FK)      <strong>berupa int sebagai Foreign Key dari tabel anime</strong>
                       <strong>berelasi dengan tabel character (character asal dari anime)</strong>
</pre>

● Relasi utamanya adalah studio -> anime -> character.

### Pennjealasan File Utama

#### config/db.php (Class Database):
<pre>
● Bertanggung jawab untuk membuat koneksi ke database MySQL (db_wibu)
● Menggunakan PDO (PHP Data Objects).
● Menyediakan objek koneksi ($conn) untuk semua class Model.
</pre>

#### class/Studio.php (Class Studio):
<pre>
● Bertindak sebagai Model untuk tabel studio.
● Memiliki method CRUD: create(), readAll(), readSingle(), update(), delete().
● Semua method menggunakan Prepared Statement.
</pre>

#### class/Anime.php (Class Anime):
<pre>
● Bertindak sebagai Model untuk tabel anime.
● Memiliki method CRUD yang sama, dan menangani input/output untuk FK id_studio.
● Semua method menggunakan Prepared Statement.
</pre>

#### class/Character.php (Class Character):
<pre>
● Bertindak sebagai Model untuk tabel character.
● Memiliki method CRUD yang sama, dan menangani input/output untuk FK id_anime.
● Semua method menggunakan Prepared Statement.
</pre>

#### index.php (Controller & Router):
<pre>
● Satu-satunya titik masuk (Front Controller) aplikasi.
● Bagian atas file berisi logika Controller (menangani POST/GET untuk aksi CRUD).
● Bagian bawah file (HTML) berisi logika Router (meng-include file 'view' yang tepat).
</pre>

#### view/ (File2 View):
<pre>
● Berisi file PHP/HTML untuk tampilan (UI).
● Bertugas menampilkan data dari Model dan menyediakan form untuk input.
● Contoh: view/studios.php, view/animes.php, view/edit_anime.php.
</pre>

### Flow Program
<pre>
● User membuka Web
● Tampilan akan menampilkan isi data dari database            READ
● Terdapat pilihan dalam Navbar (studio, anime, character)  
● Jika User Mengedit maka Tampilan edit akan muncul           UPDATE
● Jika User Menghapus data maka data akan terhapus            DELETE
● Jika User ke bawah page ada field untuk menambah data       CREATE
</pre>

### Connect Database
<pre>
● Pada Tugas Praktikum kali ini, aplikasi terhubung ke database MySQL bernama db_wibu.
● Koneksi diatur oleh class/Database.php menggunakan PDO.
● Seluruh proses CRUD (Create, Read, Update, Delete) yang ada di setiap class Model 
  (Studio.php, Anime.php, Character.php) tersambung dan berinteraksi dengan database.
● File data struktur dan dummy data wibu.sql terdapat pada repository ini.
</pre>

## 📋 Requirements
<pre>
● 3 Entitas (Tabel): studio, anime, character. ✅
● Minimal 1 Relasi (FK): anime.id_studio -> studio DAN character.id_anime -> anime. ✅
● Prepared Statement: Seluruh query di semua class menggunakan prepare(), bindParam(), dan execute(). ✅
● Tidak Ada Query Mentah: Tidak ada penggunaan PDO::query(). ✅
● Full CRUD: Setiap (Studio, Anime, Character) memiliki fitur Create, Read, Update, dan Delete. ✅
● Logika & Alur OOP: Alur program sudah memisahkan dengan jelas antara Logic (Controller di index.php),
  Data Access (Model di class/), dan Presentation (View di view/). ✅
</pre>

## 📸 Dokumentasi

Berikut adalah Dokumentasi berupa Screenshot saat program dijalankan di Browser Chrome dengan XAMPP dan PHPLiveServer

### Tampilan Awal
![01](Dokumentasi/01.png)

### Tampilan List Data (READ)
![02](Dokumentasi/02.png)
![03](Dokumentasi/03.png)
![04](Dokumentasi/04.png)

### Insert Data (CREATE)
![05](Dokumentasi/05.png)
![06](Dokumentasi/06.png)
![07](Dokumentasi/07.png)
● data setelah di insert
![08](Dokumentasi/08.png)
![09](Dokumentasi/09.png)
![10](Dokumentasi/10.png)

### Edit Data (UPDATE)
![11](Dokumentasi/11.png)
![12](Dokumentasi/12.png)
![13](Dokumentasi/13.png)
● data setelah di edit
![14](Dokumentasi/14.png)
![15](Dokumentasi/15.png)
![16](Dokumentasi/16.png)

### Delete Data (Delete)
![17](Dokumentasi/17.png)
![18](Dokumentasi/18.png)
![19](Dokumentasi/19.png)
● data setelah di delete
![20](Dokumentasi/20.png)
![21](Dokumentasi/21.png)
![22](Dokumentasi/22.png)
