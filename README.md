# Ngirimin

## Setting up back-end

1. Clone project ini
2. `composer install` (pada root project)

## Endpoints

### Barang

1. `GET /api/barang` -> mendapatkan daftar barang suatu user
2. `POST /api/barang/add` -> menambah barang baru
3. `GET /api/barang/:id` -> mendapatkan barang dengan id tertentu
4. `POST /api/barang/:id/edit` -> mengedit barang

### Pengiriman

1. `GET /api/pengiriman` -> mendapatkan daftar pengiriman suatu user
2. `POST /api/pengiriman/add` -> menambah pengiriman baru
3. `GET /api/pengiriman/:id` -> mendapatkan pengiriman dengan id tertentu
3. `GET /api/pengiriman/:id/print` -> mencetak label (?)
3. `GET /api/pengiriman/:id/toggle/:code` -> mengubah status pengiriman id tertentu dengan kode tertentu (0-5)

### User

1. `GET /api/user` -> mendapatkan detail user yang sedang login
2. `POST /api/user/edit` -> mengedit user
