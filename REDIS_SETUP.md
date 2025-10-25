# Redis Setup untuk Cache Tags

## Status Konfigurasi
✅ Predis client sudah terinstall  
✅ `.env` sudah dikonfigurasi untuk Redis  
✅ Post model sudah menggunakan cache tags  
❌ Redis server belum berjalan

## Cara Menjalankan Redis di Laragon

### Opsi 1: Install & Jalankan Redis di Laragon (RECOMMENDED)

1. **Download Redis untuk Windows:**
   - Kunjungi: https://github.com/microsoftarchive/redis/releases
   - Download: `Redis-x64-3.0.504.msi` (atau versi terbaru)
   - Install di lokasi default atau custom

2. **Atau gunakan Redis Portable:**
   - Download dari: https://github.com/tporadowski/redis/releases
   - Extract ke folder (misal: `C:\laragon\bin\redis`)
   - Jalankan `redis-server.exe`

3. **Start Redis Server:**
   ```powershell
   # Jika sudah install sebagai service:
   net start Redis
   
   # Atau jalankan manual:
   redis-server.exe
   ```

4. **Test Koneksi:**
   ```powershell
   php artisan tinker --execute="Cache::store('redis')->put('test', 'OK', 10); echo Cache::store('redis')->get('test');"
   ```

5. **Clear cache dan test:**
   ```powershell
   php artisan cache:clear
   php artisan config:clear
   ```

### Opsi 2: Gunakan Docker (Jika ada Docker Desktop)

```powershell
# Pull dan jalankan Redis di Docker
docker run -d -p 6379:6379 --name laravel-redis redis:alpine

# Test koneksi
php artisan tinker --execute="Cache::store('redis')->put('test', 'OK', 10); echo Cache::store('redis')->get('test');"
```

### Opsi 3: Kembali ke Database Cache (FALLBACK)

Jika tidak bisa setup Redis sekarang, kembalikan ke database cache:

1. **Update `.env`:**
   ```
   CACHE_STORE=database
   ```

2. **Kembalikan guard di Post model:**
   ```php
   protected static function booted(): void
   {
       static::created(function () {
           $store = Cache::getStore();
           if (is_object($store) && method_exists($store, 'tags')) {
               Cache::tags(['posts'])->flush();
           }
       });
       
       // ... sama untuk updated dan deleted
   }
   ```

## Verifikasi Redis Berjalan

### Test 1: Ping Redis
```powershell
# Jika redis-cli tersedia
redis-cli ping
# Should return: PONG
```

### Test 2: Test dari Laravel
```powershell
php artisan tinker --execute="echo Cache::store('redis')->get('test') ?? 'No data'; Cache::store('redis')->put('test', 'Works!', 60); echo ' -> ' . Cache::store('redis')->get('test');"
```

### Test 3: Test Cache Tags
```powershell
php artisan tinker --execute="Cache::tags(['posts'])->put('test', 'Tagged cache works!', 60); echo Cache::tags(['posts'])->get('test');"
```

## Keuntungan Redis untuk Cache

1. **Support Cache Tags** - Bisa flush cache berdasarkan tag
2. **Performa Tinggi** - In-memory storage, lebih cepat dari database
3. **Atomic Operations** - Thread-safe untuk concurrent requests
4. **TTL Otomatis** - Expired keys dibersihkan otomatis
5. **Skalabilitas** - Bisa untuk queue, session, dan cache sekaligus

## Konfigurasi yang Sudah Diterapkan

### File: `.env`
```
CACHE_STORE=redis
REDIS_CLIENT=predis
REDIS_HOST=127.0.0.1
REDIS_PORT=6379
```

### File: `app/Models/Post.php`
```php
protected static function booted(): void
{
    static::created(function () {
        Cache::tags(['posts'])->flush();
    });

    static::updated(function () {
        Cache::tags(['posts'])->flush();
    });

    static::deleted(function () {
        Cache::tags(['posts'])->flush();
    });
}
```

## Troubleshooting

### Error: "No connection could be made"
- Redis server belum berjalan
- Check dengan: `netstat -an | findstr "6379"`
- Start Redis service atau server

### Error: "Class Redis not found"
- Pastikan sudah install Predis: `composer require predis/predis`
- Pastikan `.env` menggunakan `REDIS_CLIENT=predis`

### Error: "This cache store does not support tagging"
- Pastikan `CACHE_STORE=redis` di `.env`
- Jangan gunakan `file` atau `database` store untuk tags

## Next Steps

Pilih salah satu:
1. ✅ Install Redis dan test koneksi
2. ✅ Gunakan Docker untuk Redis
3. ❌ Kembali ke database cache (temporary)

Setelah Redis berjalan, cache tags akan bekerja otomatis untuk:
- Auto-flush cache saat post dibuat/diupdate/dihapus
- Performa query lebih cepat dengan tagged cache
- Manajemen cache lebih baik dan granular
