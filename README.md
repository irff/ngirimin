# Ngirimin

## Setting up back-end

1. Clone project ini
2. `composer install` (pada root project)
3. Buat database `ngirimin`
4. `php novice migrate --seed` (pada root project)

## Endpoints

### Barang

1. `GET /api/barang` -> mendapatkan daftar barang suatu user.
2. `POST /api/barang/add` -> menambah barang baru. Accepts: `{"id_user": int, "nama": string, "stok": int}`
3. `GET /api/barang/:id` -> mendapatkan barang dengan id tertentu
4. `POST /api/barang/:id/edit` -> mengedit barang Accepts: `{"nama": string, "stok": int}`

### Pengiriman

1. `GET /api/pengiriman` -> mendapatkan daftar pengiriman suatu user
2. `POST /api/pengiriman/add` -> menambah pengiriman baru
3. `GET /api/pengiriman/:id` -> mendapatkan pengiriman dengan id tertentu
4. `GET /api/pengiriman/:id/print` -> mencetak label (?)
5. `GET /api/pengiriman/:id/toggle/:code` -> mengubah status pengiriman id tertentu dengan kode tertentu (0-5)

#### Status pengiriman

- 0 -> Baru dipesan
- 1 -> Sudah dibayar
- 2 -> Sudah dikemas
- 3 -> Sudah dikirim
- 4 -> Sudah diterima

### User

1. `GET /api/user` -> mendapatkan detail user yang sedang login
2. `POST /api/user/edit` -> mengedit user

