# Sistem Monitoring Gaji, Perbaikan Data, dan Payroll Cabang Dinas

Sistem web internal untuk mengelola proses **monitoring dokumen gaji PNS/PPPK, verifikasi data, pengajuan perbaikan, versioning dokumen, hingga payroll sekolah** dalam satu platform terpusat.

Aplikasi ini dirancang untuk menggantikan proses manual berbasis WhatsApp, file ZIP, dan spreadsheet menjadi workflow digital dengan **single source of truth**, pembatasan akses berbasis sekolah, notifikasi realtime, serta audit trail.

---

## Overview

Sistem mengelola seluruh siklus proses gaji dan payroll:

```text
Admin Cabdin
    │
    ├── Membuka Periode
    │
    ├── Upload ZIP Gaji PNS
    ├── Upload ZIP Gaji PPPK
    │
    ▼
Sistem Extract & Matching Otomatis
    │
    ▼
Dokumen Ter-assign ke Sekolah
    │
    ▼
Operator Sekolah
    │
    ├── Verifikasi PNS
    ├── Verifikasi PPPK
    │
    ├── FIX
    │
    └── Ajukan Perbaikan
            │
            ▼
       Admin Cabdin
            │
            └── Upload Revisi
                    │
                    ▼
              Operator Verifikasi Ulang
                    │
                    ▼
             PNS + PPPK = FIX
                    │
                    ▼
              PAYROLL REQUIRED
                    │
                    ├── Download Template
                    ├── Upload Payroll
                    │
                    ▼
              Admin Review
                    │
             ┌──────┴──────┐
             ▼             ▼
          APPROVED       REVISION
```

---

## Tujuan

Sistem dibangun untuk:

* Menghilangkan distribusi dokumen gaji melalui WhatsApp.
* Menghilangkan proses extract ZIP secara manual oleh operator.
* Memastikan operator hanya dapat mengakses dokumen sekolahnya sendiri.
* Memusatkan proses pengajuan dan penyelesaian perbaikan data.
* Menyimpan seluruh versi dokumen tanpa overwrite.
* Menghasilkan rekap status gaji secara otomatis.
* Mengaktifkan status payroll secara otomatis setelah PNS dan PPPK FIX.
* Menyediakan template payroll resmi.
* Menyediakan upload dan versioning file payroll.
* Memungkinkan Admin Cabdin memantau seluruh sekolah dari satu dashboard.
* Mencatat aktivitas penting melalui audit trail.

---

## Tech Stack

| Layer              | Technology                     |
| ------------------ | ------------------------------ |
| Backend            | Laravel 11                     |
| Frontend           | Vue 3                          |
| SPA Adapter        | Inertia.js                     |
| CSS                | Tailwind CSS                   |
| Database           | MySQL 8                        |
| Authentication     | Laravel Session Authentication |
| Realtime           | Laravel Echo + Reverb          |
| Queue              | Laravel Queue                  |
| Excel Processing   | Laravel Excel / PhpSpreadsheet |
| Archive Processing | ZIP                            |
| Storage            | Private Storage                |
| Deployment         | VPS / Proxmox Internal         |
| Protocol           | HTTPS                          |

### Mengapa Laravel + Inertia + Vue?

Aplikasi menggunakan Inertia.js sehingga Laravel tetap menangani routing, middleware, session, authorization, policy, dan business logic tanpa perlu membangun REST API terpisah.

Vue 3 digunakan untuk kebutuhan UI interaktif seperti:

* Modal.
* File viewer.
* Drag & drop upload.
* Status indicator.
* Notification bell.
* Realtime update.
* Transisi halaman.
* Dashboard interaktif.

---

# Role & Access Control

## Super Admin

Memiliki akses pengelolaan sistem secara keseluruhan:

* User management.
* Master sekolah.
* Alias sekolah.
* Periode gaji.
* Template payroll.
* Backup.
* Audit log.
* Konfigurasi sistem.

## Admin Cabang Dinas

Memiliki akses untuk:

* Membuat dan mengelola periode.
* Membuka dan menutup periode gaji.
* Upload ZIP PNS.
* Upload ZIP PPPK.
* Melihat seluruh sekolah.
* Melihat seluruh dokumen.
* Menangani permintaan perbaikan.
* Upload dokumen revisi.
* Melihat status FIX PNS dan PPPK.
* Melihat rekap payroll.
* Approve payroll.
* Meminta revisi payroll.
* Mengelola master sekolah dan alias.
* Mengelola template payroll.
* Melihat audit trail.

## Operator Sekolah

Operator hanya dapat mengakses data yang memiliki `school_id` yang sama dengan akun operator.

Fitur:

* Melihat dokumen PNS.
* Melihat dokumen PPPK.
* Preview dokumen Excel.
* Konfirmasi FIX.
* Mengajukan perbaikan.
* Menerima notifikasi revisi.
* Memverifikasi dokumen revisi.
* Download template payroll.
* Upload payroll.
* Melihat status payroll.

Contoh:

```text
operator.turen
role     = OPERATOR
school_id = SMAN 1 TUREN
```

Operator tersebut tidak dapat mengakses dokumen sekolah lain melalui:

* UI.
* URL manipulation.
* Request langsung.
* Query parameter.
* Endpoint internal.

Pembatasan diterapkan pada backend menggunakan **Policy dan query scoping**, bukan hanya menyembunyikan data di frontend.

---

# Workflow Gaji

## 1. Import ZIP

Admin Cabdin memilih:

```text
Periode : September 2026
Jenis   : PNS
File    : Gaji PNS September 2026.zip
```

atau:

```text
Periode : September 2026
Jenis   : PPPK
File    : Gaji PPPK September 2026.zip
```

File diproses menggunakan Queue sehingga proses extract dan pembacaan file tidak membekukan browser.

```text
Upload ZIP
    ↓
Validasi ZIP
    ↓
Simpan ke Private Storage
    ↓
Extract Background
    ↓
Scan File
    ↓
Matching Sekolah
    ↓
Create Salary Documents
    ↓
Create Salary Status
    ↓
Notification
    ↓
Import Summary
```

---

# School Matching Engine

Sistem mendukung berbagai variasi nama sekolah.

Contoh:

```text
SMAN 1 Turen
SMAN 1 TUREN
Sman 1 Turen
SMAN1 TUREN
SMA N 1 TUREN
Sman Turen
```

Urutan proses matching:

```text
1. Exact Filename Match
2. Normalized Filename
3. School Alias
4. Pattern Matching
5. Fuzzy Matching
6. Manual Confirmation
```

Fuzzy matching tidak otomatis dianggap valid.

File yang hanya memperoleh hasil fuzzy matching harus dikonfirmasi oleh Admin Cabdin melalui proses **Manual Matching**.

---

# Dashboard Operator

Dashboard operator bersifat **school-scoped**.

Contoh:

```text
SMAN 1 TUREN
September 2026

PNS
Dokumen tersedia
Status: MENUNGGU VERIFIKASI

PPPK
Dokumen tersedia
Status: MENUNGGU VERIFIKASI
```

Ketika kedua dokumen telah FIX:

```text
PAYROLL PERLU DIBUAT

PNS  : FIX
PPPK : FIX

[ Download Template ]
[ Upload Payroll ]
```

---

# Verifikasi Gaji

Operator dapat membuka dokumen Excel melalui file preview.

Jika dokumen benar:

```text
[ Konfirmasi Gaji FIX ]
```

Sistem mencatat:

```text
status
fixed_at
fixed_by
```

Jika terdapat kesalahan:

```text
[ Ajukan Perbaikan ]
```

Data yang dikirim:

```text
Jenis
Kategori
Catatan
Dokumen
```

Contoh kategori:

```text
Tunjangan Anak
Gaji Pokok
Potongan
Data Pribadi
Lainnya
```

---

# Status Gaji

Status internal:

```text
WAITING_DOCUMENT
WAITING_VERIFICATION
NEEDS_REVISION
WAITING_REVERIFICATION
FIX
```

Label pada UI:

| Database                 | UI                        |
| ------------------------ | ------------------------- |
| `WAITING_DOCUMENT`       | Menunggu Dokumen          |
| `WAITING_VERIFICATION`   | Menunggu Verifikasi       |
| `NEEDS_REVISION`         | Perlu Perbaikan           |
| `WAITING_REVERIFICATION` | Menunggu Verifikasi Ulang |
| `FIX`                    | FIX                       |

---

# Document Versioning

Dokumen tidak pernah di-overwrite.

Contoh:

```text
SMAN 1 TUREN
PNS
September 2026

v1  Waiting Verification
v2  Revision Requested
v3  FIX
```

Setiap versi memiliki file dan metadata tersendiri sehingga histori dokumen tetap tersedia.

---

# Workflow Perbaikan

```text
Operator
    │
    └── Ajukan Perbaikan
            │
            ▼
Admin Cabdin Notification
            │
            ▼
Admin melihat:
- Catatan operator
- Dokumen sebelumnya
- Kategori perbaikan
            │
            ▼
Admin upload file revisi
            │
            ▼
Document Version Baru
            │
            ▼
Operator Notification
            │
            ▼
Verifikasi Ulang
            │
       ┌────┴────┐
       ▼         ▼
      FIX     Revisi Lagi
```

Seluruh siklus revisi tersimpan di database.

---

# Payroll

Payroll otomatis menjadi `REQUIRED` ketika:

```text
PNS  = FIX
PPPK = FIX
```

Status payroll:

```text
REQUIRED
UPLOADED
APPROVED
REVISION
```

Workflow:

```text
PNS + PPPK FIX
      ↓
PAYROLL REQUIRED
      ↓
Download Template
      ↓
Operator Mengisi Template
      ↓
Upload Payroll
      ↓
Admin Review
      ↓
   ┌──┴────┐
   ▼       ▼
APPROVED  REVISION
```

---

# Payroll Versioning

File payroll juga menggunakan versioning.

Contoh:

```text
SMAN 1 TUREN
September 2026

v1 Uploaded
v2 Revision
v3 Approved
```

File lama tidak dihapus dan tidak ditimpa.

---

# Dashboard Admin Cabdin

Admin memiliki rekap seluruh sekolah.

Contoh:

```text
Payroll — September 2026

Sudah Upload : 18
Belum Upload : 5

Approved     : 14
Menunggu Review : 4
Revision     : 4
```

Filter:

```text
Semua
Approved
Menunggu Review
Revisi
Belum Upload
```

Rekap gaji juga tersedia:

```text
FIX PNS
BELUM FIX PNS

FIX PPPK
BELUM FIX PPPK

REKAP PAYROLL
```

Urutan sekolah selalu mengikuti Master Sekolah.

---

# Notification System

Realtime notification menggunakan:

```text
Laravel Echo
        +
Laravel Reverb
        +
Vue Reactivity
```

Trigger notifikasi:

| Event                 | Penerima     |
| --------------------- | ------------ |
| Dokumen gaji tersedia | Operator     |
| Permintaan perbaikan  | Admin Cabdin |
| File revisi tersedia  | Operator     |
| PNS + PPPK FIX        | Operator     |
| Payroll uploaded      | Admin Cabdin |
| Payroll revision      | Operator     |
| Payroll approved      | Operator     |

Notifikasi tersimpan dalam database sehingga tetap tersedia setelah user kembali login.

---

# Database

Struktur utama:

### users

```text
id
name
email
password
role
school_id
created_at
updated_at
```

### schools

```text
id
school_code
official_name
school_type
is_active
created_at
updated_at
```

### school_aliases

```text
id
school_id
alias
```

### salary_periods

```text
id
month
year
label
status
```

### salary_imports

```text
id
period_id
type
zip_filename
zip_path
uploaded_by
uploaded_at
status
```

### salary_documents

```text
id
import_id
school_id
type
filename
file_path
version
is_current
uploaded_by
created_at
```

### salary_statuses

```text
id
period_id
school_id
type
status
current_document_id
fixed_at
fixed_by
```

### revision_requests

```text
id
period_id
school_id
type
salary_document_id
category
description
status
created_by
resolved_at
resolved_by
```

### payroll_templates

```text
id
name
type
version
file_path
is_active
created_by
created_at
```

### payrolls

```text
id
period_id
school_id
status
current_file_id
required_at
uploaded_at
approved_at
approved_by
```

### payroll_files

```text
id
payroll_id
filename
file_path
version
uploaded_by
uploaded_at
```

### payroll_reviews

```text
id
payroll_id
status
notes
reviewed_by
reviewed_at
```

### notifications

```text
id
user_id
type
title
message
related_type
related_id
read_at
created_at
```

### audit_logs

```text
id
user_id
action
entity_type
entity_id
old_value
new_value
metadata
created_at
```

---

# Security

Dokumen gaji dan payroll disimpan di **private storage**.

File tidak dapat diakses hanya dengan mengetahui URL atau nama file.

Akses file dilakukan melalui controller yang memvalidasi:

```text
Authentication
      ↓
Authorization
      ↓
Policy
      ↓
School Scope
      ↓
File Stream
```

Keamanan aplikasi mencakup:

* Private file storage.
* Laravel Policy.
* Query scoping berdasarkan `school_id`.
* Role-based authorization.
* MIME validation.
* Extension validation.
* File size validation.
* ZIP validation.
* Path traversal protection.
* Zip bomb protection.
* Sanitasi nama file.
* Password hashing.
* Session authentication.
* Audit logging.
* HTTPS.

ZIP tidak pernah diekstrak ke direktori public.

---

# Queue Processing

Proses berat dijalankan menggunakan Laravel Queue:

```text
ZIP Upload
    ↓
Queue Job
    ↓
Extract
    ↓
Read Excel
    ↓
School Matching
    ↓
Create Documents
    ↓
Update Status
    ↓
Send Notifications
```

Tujuannya agar proses import file besar tidak menyebabkan request HTTP timeout atau browser Admin berhenti merespons.

---

# MVP

Fitur utama MVP:

```text
LOGIN
  ↓
MASTER SEKOLAH
  ↓
PERIODE
  ↓
IMPORT ZIP PNS & PPPK
  ↓
EXTRACT & MATCHING
  ↓
DASHBOARD OPERATOR
  ↓
VERIFIKASI
  ├── FIX
  └── AJUKAN PERBAIKAN
          ↓
       REVISI
          ↓
   VERIFIKASI ULANG
          ↓
    PNS + PPPK FIX
          ↓
   PAYROLL REQUIRED
          ↓
 DOWNLOAD TEMPLATE
          ↓
   UPLOAD PAYROLL
          ↓
    ADMIN REVIEW
       ├── APPROVED
       └── REVISION
```

---

# Roadmap

## V2

* Validasi otomatis isi Excel.
* Deteksi anomali tunjangan.
* Deteksi anomali potongan.
* Auto-generate payroll dari data gaji FIX.
* Email notification.
* WhatsApp Business API resmi.
* Deadline management.
* Reminder otomatis.
* Perbandingan antarperiode.
* Statistik bulanan.

## V3

Automasi penuh dari:

```text
ZIP Masuk
    ↓
Extract
    ↓
Matching
    ↓
Verification
    ↓
Revision
    ↓
FIX
    ↓
Payroll
    ↓
Review
```

dengan interaksi operator seminimal mungkin.

---

# Acceptance Criteria

## Gaji

* Admin dapat membuat periode.
* Admin dapat upload ZIP PNS.
* Admin dapat upload ZIP PPPK.
* Sistem melakukan extract secara otomatis.
* Sistem melakukan matching sekolah.
* File yang gagal matching dapat diproses secara manual.
* Operator hanya dapat melihat dokumen sekolahnya.
* Operator dapat melakukan FIX.
* Operator dapat mengajukan perbaikan.
* Admin dapat menerima dan memproses request perbaikan.
* Admin dapat upload revisi melalui sistem.
* Sistem menyimpan versioning dokumen.
* Operator dapat melakukan verifikasi ulang.
* Rekap FIX dan belum FIX dibuat otomatis.

## Payroll

* Payroll otomatis menjadi `REQUIRED` setelah PNS dan PPPK FIX.
* Operator dapat download template.
* Operator dapat upload payroll.
* Payroll menggunakan versioning.
* Admin dapat melihat sekolah yang sudah dan belum upload.
* Admin dapat approve payroll.
* Admin dapat meminta revisi.
* Operator menerima notifikasi revisi.
* Operator dapat upload ulang payroll.
* Semua histori payroll tetap tersimpan.

---

# Target Output

Contoh dashboard periode:

```text
September 2026

PNS
23 sekolah
19 FIX
4 belum FIX

PPPK
23 sekolah
17 FIX
6 belum FIX

PAYROLL
23 wajib
18 upload
14 approved
4 revisi
5 belum upload
```

Sistem menjadi **single source of truth** untuk proses gaji dan payroll Cabang Dinas.

Tidak ada lagi ketergantungan pada:

```text
WhatsApp
Spreadsheet pribadi
Catatan manual
File ZIP yang disimpan operator
Perhitungan rekap manual
```

Seluruh status, dokumen, revisi, payroll, notifikasi, dan histori aktivitas tersimpan dalam satu aplikasi.

---

# Project Structure

Struktur aplikasi mengikuti konvensi Laravel + Inertia + Vue:

```text
app/
├── Http/
│   ├── Controllers/
│   ├── Middleware/
│   └── Requests/
│
├── Models/
│
├── Policies/
│
├── Jobs/
│
├── Services/
│   └── SchoolMatcher.php
│
└── Notifications/

database/
├── migrations/
└── seeders/

resources/
├── js/
│   ├── Components/
│   ├── Layouts/
│   └── Pages/
│       ├── Dashboard/
│       ├── Schools/
│       ├── Periods/
│       ├── Imports/
│       ├── Salaries/
│       ├── Revisions/
│       └── Payroll/
│
└── css/

routes/
└── web.php

storage/
└── app/
    └── private/
```

---

# Local Development

Clone repository:

```bash
git clone <repository-url>
cd <project-directory>
```

Install PHP dependencies:

```bash
composer install
```

Install JavaScript dependencies:

```bash
npm install
```

Copy environment file:

```bash
cp .env.example .env
```

Generate application key:

```bash
php artisan key:generate
```

Configure database pada `.env`, kemudian jalankan migration:

```bash
php artisan migrate
```

Jalankan seeder:

```bash
php artisan db:seed
```

Build frontend:

```bash
npm run build
```

Untuk development:

```bash
npm run dev
```

Jalankan Laravel:

```bash
php artisan serve
```

Queue worker:

```bash
php artisan queue:work
```

Jika menggunakan Reverb:

```bash
php artisan reverb:start
```

---

# Production

Aplikasi ditujukan untuk deployment pada:

```text
VPS
Proxmox
Ubuntu Server
Internal Infrastructure
```

Production wajib menggunakan:

```text
HTTPS
Private Storage
Queue Worker
MySQL 8
PHP
Node.js untuk asset build
Laravel Reverb
```

Dokumen sensitif tidak boleh ditempatkan di:

```text
public/
```

---

# License

Project ini merupakan aplikasi internal untuk mendukung proses monitoring gaji dan payroll Cabang Dinas.

Penggunaan, distribusi, dan modifikasi mengikuti kebijakan organisasi dan repository tempat project ini dikelola.
