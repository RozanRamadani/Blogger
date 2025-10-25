# 🚀 Redis Quick Reference

## Start/Stop Redis

```powershell
# Start (double-click file)
redis-start.bat

# Stop (double-click file)  
redis-stop.bat

# Check status (double-click file)
redis-status.bat
```

## Laravel Cache Commands

```bash
# Clear all cache
php artisan cache:clear

# Test Redis
php artisan tinker --execute="echo Cache::get('test') ?? 'empty'"

# Clear config after .env changes
php artisan config:clear
```

## Using Cache in Code

```php
// Simple cache
Cache::put('key', 'value', 3600);
$value = Cache::get('key');

// Cache with tags
Cache::tags(['posts'])->put('key', 'value', 3600);
Cache::tags(['posts'])->get('key');
Cache::tags(['posts'])->flush(); // Clear all 'posts' tagged cache

// Remember (cache if not exists)
$posts = Cache::tags(['posts'])->remember('recent', 3600, function () {
    return Post::latest()->take(10)->get();
});

// Forever cache
Cache::forever('key', 'value');
Cache::forget('key');

// Check existence
if (Cache::has('key')) {
    // ...
}
```

## Model Auto-Cache (Already Configured)

Post model automatically flushes cache on:
- Create
- Update  
- Delete

No manual cache clearing needed! 🎉

## Config Files

- **`.env`**: `CACHE_STORE=redis`
- **Redis**: `127.0.0.1:6379`
- **Client**: `predis` (pure PHP)

## Check Redis is Running

```powershell
netstat -an | findstr "6379"
```

If output shows `LISTENING`, Redis is running ✅

---
💡 **Tip**: Keep `redis-server.exe` running while developing for best performance!
