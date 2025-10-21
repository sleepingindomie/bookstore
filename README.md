<div align="center">

# 📚 Bookstore Application

### A comprehensive bookstore management system with Laravel 12

[![PHP Version](https://img.shields.io/badge/PHP-8.3%2B-777BB4?style=flat-square&logo=php)](https://www.php.net/)
[![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=flat-square&logo=laravel)](https://laravel.com)
[![MySQL](https://img.shields.io/badge/MySQL-5.7%2B-4479A1?style=flat-square&logo=mysql&logoColor=white)](https://www.mysql.com/)

[Features](#-features) • [Installation](#-installation) • [API Documentation](#-api-documentation)

---

### 🌐 Language / Bahasa
**[English](#english-version)** | **[Indonesian](#versi-indonesia)**

---

</div>

<a name="english-version"></a>
## 🇬🇧 English Version

### 📋 Table of Contents
- [About](#about)
- [Key Features](#-features)
- [Tech Stack](#-tech-stack)
- [System Requirements](#-system-requirements)
- [Installation Guide](#-installation)
- [Database Structure](#-database-structure)
- [Usage Guide](#-usage-guide)
- [API Documentation](#-api-documentation)
- [Contributing](#-contributing)

---

### About

A full-stack bookstore management system built with Laravel 12 featuring a responsive web interface and RESTful API. The application manages **100,000 books**, **1,000 authors**, **3,000 categories**, and **500,000 ratings** with optimized performance.

---

### ✨ Features

<details>
<summary><b>🖥️ Web Interface</b> (Click to expand)</summary>

- **📖 Book Listings**
  - Browse 100,000 books with advanced search
  - Filter by title or author name
  - Adjustable pagination (10-100 items per page)
  - Sort by average rating

- **🏆 Author Rankings**
  - View top 10 authors based on high ratings (> 5)
  - Dynamic ranking with vote counts
  - Visual ranking badges for top 3

- **⭐ Rating System**
  - Submit ratings from 1 (poor) to 10 (excellent)
  - AJAX-powered author/book selection
  - Real-time rating labels
  - Form validation

- **📱 Responsive Design**
  - Mobile-first approach
  - Optimized for phones, tablets, and desktops
  - Touch-friendly interfaces
  - Card-based layout on mobile

- **🎨 Interactive UI**
  - Smooth animations and transitions
  - Hover effects
  - Loading indicators
  - Modern color scheme (Navy + Mint/Sage)

</details>

<details>
<summary><b>🔌 REST API</b> (Click to expand)</summary>

- **Books API**
  - List all books with pagination
  - Search books by title/author
  - Get specific book details

- **Authors API**
  - List all authors
  - Get top 10 famous authors
  - Get author details
  - Get books by specific author

- **Ratings API**
  - List all ratings
  - Submit new ratings
  - Get books by author ID

- **📚 Interactive Documentation**
  - Full API documentation with Scribe
  - Try-it-out feature
  - OpenAPI/Swagger specification
  - Postman collection export

</details>

---

### 🛠️ Tech Stack

| Category | Technology |
|----------|-----------|
| **Framework** | Laravel 12.x |
| **Language** | PHP 8.3+ |
| **Database** | MySQL 5.7+ / MariaDB 10.3+ |
| **Frontend** | Tailwind CSS (CDN) |
| **API Docs** | Scribe |
| **Fake Data** | FakerPHP |

---

### 💻 System Requirements

- ✅ PHP >= 8.3
- ✅ Composer
- ✅ MySQL >= 5.7 or MariaDB >= 10.3
- ✅ Git
- ⚡ 2GB RAM minimum (for seeding)
- 💾 500MB free disk space

---

### 🚀 Installation

<details open>
<summary><b>Step-by-Step Guide</b></summary>

#### 1️⃣ Clone Repository

```bash
git clone https://github.com/yourusername/bookstore.git
cd bookstore
```

#### 2️⃣ Install Dependencies

```bash
composer install
```

#### 3️⃣ Environment Setup

```bash
cp .env.example .env
```

Edit `.env` file:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bookstore
DB_USERNAME=root
DB_PASSWORD=your_password

APP_URL=http://localhost:8000
```

#### 4️⃣ Generate Application Key

```bash
php artisan key:generate
```

#### 5️⃣ Create Database

```sql
CREATE DATABASE bookstore CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

#### 6️⃣ Migrate & Seed Database

> ⚠️ **Note**: This process takes 3-5 minutes

```bash
php artisan migrate:fresh --seed
```

**Progress output:**
```
✓ 1000 Authors seeded
✓ 3000 Categories seeded
✓ 100,000 Books seeded
⏳ Inserting ratings batch: 5000/500000
⏳ Inserting ratings batch: 10000/500000
...
✓ 500,000 Ratings inserted
✓ Books average rating updated
✓ Authors total high ratings updated
```

#### 7️⃣ Start Development Server

```bash
php artisan serve
```

🌐 Visit: `http://localhost:8000`

</details>

---

### 🗄️ Database Structure

<details>
<summary><b>View Schema</b></summary>

```
┌─────────────────────────────────────┐
│ authors (1,000 records)             │
├─────────────────────────────────────┤
│ • id                                │
│ • name                              │
│ • total_high_ratings (denormalized) │
│ • timestamps                        │
└─────────────────────────────────────┘
           │
           │ 1:N
           ▼
┌─────────────────────────────────────┐
│ books (100,000 records)             │
├─────────────────────────────────────┤
│ • id                                │
│ • author_id (FK)                    │
│ • category_id (FK)                  │
│ • title                             │
│ • average_rating (denormalized)     │
│ • voter_count (denormalized)        │
│ • timestamps                        │
└─────────────────────────────────────┘
           │
           │ 1:N
           ▼
┌─────────────────────────────────────┐
│ ratings (500,000 records)           │
├─────────────────────────────────────┤
│ • id                                │
│ • book_id (FK)                      │
│ • rating (1-10)                     │
│ • timestamps                        │
│ • INDEX(book_id, rating)            │
└─────────────────────────────────────┘

┌─────────────────────────────────────┐
│ categories (3,000 records)          │
├─────────────────────────────────────┤
│ • id                                │
│ • name                              │
│ • timestamps                        │
└─────────────────────────────────────┘
```

</details>

---

### 📖 Usage Guide

<details>
<summary><b>Web Interface Features</b></summary>

#### 📚 Browse Books
1. Navigate to homepage
2. Use search bar to filter by title/author
3. Adjust items per page (10-100)
4. Navigate using pagination

#### 🏆 View Top Authors
1. Click "Top 10 Most Famous Author" in menu
2. View rankings based on high ratings (> 5)
3. See vote counts for each author

#### ⭐ Submit Ratings
1. Click "Insert Rating" in menu
2. Select author from dropdown
3. Select book (auto-loaded via AJAX)
4. Choose rating 1-10
5. Submit form

</details>

---

### 🔌 API Documentation

<details>
<summary><b>Access API Docs</b></summary>

**Interactive Documentation:**
🌐 `http://localhost:8000/docs`

**Available Formats:**
- 📄 HTML (interactive)
- 📋 OpenAPI/Swagger YAML
- 📮 Postman Collection JSON

</details>

<details>
<summary><b>API Endpoints</b></summary>

#### Books

| Method | Endpoint | Description |
|--------|----------|-------------|
| `GET` | `/api/books` | List all books |
| `GET` | `/api/books/{id}` | Get specific book |

**Query Parameters:**
- `page` - Page number
- `per_page` - Items per page (10-100)
- `q` - Search query (title/author)

#### Authors

| Method | Endpoint | Description |
|--------|----------|-------------|
| `GET` | `/api/authors` | List all authors |
| `GET` | `/api/authors/top` | Top 10 authors |
| `GET` | `/api/authors/{id}` | Get specific author |
| `GET` | `/api/authors/{id}/books` | Books by author |

#### Ratings

| Method | Endpoint | Description |
|--------|----------|-------------|
| `GET` | `/api/ratings` | List all ratings |
| `POST` | `/api/ratings` | Submit rating |

</details>

<details>
<summary><b>Example API Calls</b></summary>

**Get Books (Paginated)**
```bash
curl http://localhost:8000/api/books?per_page=10&page=1
```

**Search Books**
```bash
curl http://localhost:8000/api/books?q=Harry
```

**Get Top Authors**
```bash
curl http://localhost:8000/api/authors/top
```

**Submit Rating**
```bash
curl -X POST http://localhost:8000/api/ratings \
  -H "Content-Type: application/json" \
  -d '{"book_id": 1, "rating": 9}'
```

</details>

---

### 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

---

### 🙏 Credits

Built with:
- [Laravel](https://laravel.com) - PHP Framework
- [Tailwind CSS](https://tailwindcss.com) - CSS Framework
- [FakerPHP](https://fakerphp.github.io) - Fake Data Generator
- [Scribe](https://scribe.knuckles.wtf) - API Documentation

---
---

<a name="versi-indonesia"></a>
## 🇮🇩 Versi Indonesia

### 📋 Daftar Isi
- [Tentang Aplikasi](#tentang-aplikasi)
- [Fitur Utama](#-fitur-utama)
- [Teknologi](#-teknologi-yang-digunakan)
- [Kebutuhan Sistem](#-kebutuhan-sistem)
- [Panduan Instalasi](#-panduan-instalasi)
- [Struktur Database](#-struktur-database)
- [Panduan Penggunaan](#-panduan-penggunaan)
- [Dokumentasi API](#-dokumentasi-api)
- [Kontribusi](#-kontribusi)

---

### Tentang Aplikasi

Sistem manajemen toko buku lengkap yang dibangun dengan Laravel 12 yang menampilkan antarmuka web responsif dan RESTful API. Aplikasi ini mengelola **100.000 buku**, **1.000 penulis**, **3.000 kategori**, dan **500.000 rating** dengan performa yang optimal.

---

### ✨ Fitur Utama

<details>
<summary><b>🖥️ Antarmuka Web</b> (Klik untuk membuka)</summary>

- **📖 Daftar Buku**
  - Jelajahi 100.000 buku dengan pencarian canggih
  - Filter berdasarkan judul atau nama penulis
  - Pagination yang dapat disesuaikan (10-100 item per halaman)
  - Urutkan berdasarkan rating rata-rata

- **🏆 Peringkat Penulis**
  - Lihat 10 penulis teratas berdasarkan rating tinggi (> 5)
  - Peringkat dinamis dengan jumlah voting
  - Badge visual untuk 3 teratas

- **⭐ Sistem Rating**
  - Kirim rating dari 1 (buruk) hingga 10 (sempurna)
  - Pemilihan penulis/buku berbasis AJAX
  - Label rating real-time
  - Validasi formulir

- **📱 Desain Responsif**
  - Pendekatan mobile-first
  - Dioptimalkan untuk ponsel, tablet, dan desktop
  - Antarmuka touch-friendly
  - Layout berbasis card di mobile

- **🎨 UI Interaktif**
  - Animasi dan transisi yang halus
  - Efek hover
  - Indikator loading
  - Skema warna modern (Navy + Mint/Sage)

</details>

<details>
<summary><b>🔌 REST API</b> (Klik untuk membuka)</summary>

- **Books API**
  - Daftar semua buku dengan pagination
  - Cari buku berdasarkan judul/penulis
  - Detail buku spesifik

- **Authors API**
  - Daftar semua penulis
  - Top 10 penulis terkenal
  - Detail penulis
  - Buku berdasarkan penulis tertentu

- **Ratings API**
  - Daftar semua rating
  - Kirim rating baru
  - Buku berdasarkan ID penulis

- **📚 Dokumentasi Interaktif**
  - Dokumentasi API lengkap dengan Scribe
  - Fitur try-it-out
  - Spesifikasi OpenAPI/Swagger
  - Export koleksi Postman

</details>

---

### 🛠️ Teknologi yang Digunakan

| Kategori | Teknologi |
|----------|-----------|
| **Framework** | Laravel 12.x |
| **Bahasa** | PHP 8.3+ |
| **Database** | MySQL 5.7+ / MariaDB 10.3+ |
| **Frontend** | Tailwind CSS (CDN) |
| **API Docs** | Scribe |
| **Data Palsu** | FakerPHP |

---

### 💻 Kebutuhan Sistem

- ✅ PHP >= 8.3
- ✅ Composer
- ✅ MySQL >= 5.7 atau MariaDB >= 10.3
- ✅ Git
- ⚡ RAM minimal 2GB (untuk seeding)
- 💾 Ruang disk 500MB

---

### 🚀 Panduan Instalasi

<details open>
<summary><b>Langkah demi Langkah</b></summary>

#### 1️⃣ Clone Repository

```bash
git clone https://github.com/yourusername/bookstore.git
cd bookstore
```

#### 2️⃣ Install Dependencies

```bash
composer install
```

#### 3️⃣ Konfigurasi Environment

```bash
cp .env.example .env
```

Edit file `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bookstore
DB_USERNAME=root
DB_PASSWORD=password_anda

APP_URL=http://localhost:8000
```

#### 4️⃣ Generate Application Key

```bash
php artisan key:generate
```

#### 5️⃣ Buat Database

```sql
CREATE DATABASE bookstore CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

#### 6️⃣ Migrasi & Seed Database

> ⚠️ **Catatan**: Proses ini memakan waktu 3-5 menit

```bash
php artisan migrate:fresh --seed
```

**Output progress:**
```
✓ 1000 Penulis di-seed
✓ 3000 Kategori di-seed
✓ 100.000 Buku di-seed
⏳ Memasukkan batch rating: 5000/500000
⏳ Memasukkan batch rating: 10000/500000
...
✓ 500.000 Rating dimasukkan
✓ Rating rata-rata buku diperbarui
✓ Total rating tinggi penulis diperbarui
```

#### 7️⃣ Jalankan Development Server

```bash
php artisan serve
```

🌐 Kunjungi: `http://localhost:8000`

</details>

---

### 🗄️ Struktur Database

<details>
<summary><b>Lihat Skema</b></summary>

```
┌─────────────────────────────────────┐
│ authors (1.000 record)              │
├─────────────────────────────────────┤
│ • id                                │
│ • name                              │
│ • total_high_ratings (denormalisasi)│
│ • timestamps                        │
└─────────────────────────────────────┘
           │
           │ 1:N
           ▼
┌─────────────────────────────────────┐
│ books (100.000 record)              │
├─────────────────────────────────────┤
│ • id                                │
│ • author_id (FK)                    │
│ • category_id (FK)                  │
│ • title                             │
│ • average_rating (denormalisasi)    │
│ • voter_count (denormalisasi)       │
│ • timestamps                        │
└─────────────────────────────────────┘
           │
           │ 1:N
           ▼
┌─────────────────────────────────────┐
│ ratings (500.000 record)            │
├─────────────────────────────────────┤
│ • id                                │
│ • book_id (FK)                      │
│ • rating (1-10)                     │
│ • timestamps                        │
│ • INDEX(book_id, rating)            │
└─────────────────────────────────────┘

┌─────────────────────────────────────┐
│ categories (3.000 record)           │
├─────────────────────────────────────┤
│ • id                                │
│ • name                              │
│ • timestamps                        │
└─────────────────────────────────────┘
```

</details>

---

### 📖 Panduan Penggunaan

<details>
<summary><b>Fitur Antarmuka Web</b></summary>

#### 📚 Jelajahi Buku
1. Buka halaman utama
2. Gunakan search bar untuk filter berdasarkan judul/penulis
3. Sesuaikan item per halaman (10-100)
4. Navigasi menggunakan pagination

#### 🏆 Lihat Top Penulis
1. Klik "Top 10 Most Famous Author" di menu
2. Lihat peringkat berdasarkan rating tinggi (> 5)
3. Lihat jumlah vote untuk setiap penulis

#### ⭐ Kirim Rating
1. Klik "Insert Rating" di menu
2. Pilih penulis dari dropdown
3. Pilih buku (auto-load via AJAX)
4. Pilih rating 1-10
5. Submit form

</details>

---

### 🔌 Dokumentasi API

<details>
<summary><b>Akses Dokumentasi API</b></summary>

**Dokumentasi Interaktif:**
🌐 `http://localhost:8000/docs`

**Format yang Tersedia:**
- 📄 HTML (interaktif)
- 📋 OpenAPI/Swagger YAML
- 📮 Postman Collection JSON

</details>

<details>
<summary><b>Endpoint API</b></summary>

#### Books

| Method | Endpoint | Deskripsi |
|--------|----------|-----------|
| `GET` | `/api/books` | Daftar semua buku |
| `GET` | `/api/books/{id}` | Detail buku spesifik |

**Query Parameters:**
- `page` - Nomor halaman
- `per_page` - Item per halaman (10-100)
- `q` - Query pencarian (judul/penulis)

#### Authors

| Method | Endpoint | Deskripsi |
|--------|----------|-----------|
| `GET` | `/api/authors` | Daftar semua penulis |
| `GET` | `/api/authors/top` | Top 10 penulis |
| `GET` | `/api/authors/{id}` | Detail penulis |
| `GET` | `/api/authors/{id}/books` | Buku berdasarkan penulis |

#### Ratings

| Method | Endpoint | Deskripsi |
|--------|----------|-----------|
| `GET` | `/api/ratings` | Daftar semua rating |
| `POST` | `/api/ratings` | Kirim rating |

</details>

<details>
<summary><b>Contoh Pemanggilan API</b></summary>

**Ambil Buku (Dengan Pagination)**
```bash
curl http://localhost:8000/api/books?per_page=10&page=1
```

**Cari Buku**
```bash
curl http://localhost:8000/api/books?q=Harry
```

**Ambil Top Penulis**
```bash
curl http://localhost:8000/api/authors/top
```

**Kirim Rating**
```bash
curl -X POST http://localhost:8000/api/ratings \
  -H "Content-Type: application/json" \
  -d '{"book_id": 1, "rating": 9}'
```

</details>

---

### 🤝 Kontribusi

Kontribusi sangat diterima! Silakan submit Pull Request.

---

### 🙏 Kredit

Dibangun dengan:
- [Laravel](https://laravel.com) - PHP Framework
- [Tailwind CSS](https://tailwindcss.com) - CSS Framework
- [FakerPHP](https://fakerphp.github.io) - Generator Data Palsu
- [Scribe](https://scribe.knuckles.wtf) - Dokumentasi API

---

<div align="center">

**Made with ❤️ using Laravel**

[⬆ Back to Top](#-bookstore-application)

</div>
