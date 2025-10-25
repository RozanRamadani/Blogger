@echo off
REM Check Redis Server Status
echo Checking Redis Server Status...
echo.
netstat -an | findstr "6379" > nul
if %errorlevel% equ 0 (
    echo [RUNNING] Redis is running on port 6379
    echo.
    echo Testing connection...
    php artisan tinker --execute="try { Cache::store('redis')->put('status_check', date('Y-m-d H:i:s'), 10); echo 'Connection: OK (' . Cache::store('redis')->get('status_check') . ')'; echo PHP_EOL . 'Cache Tags: ' . (Cache::tags(['test'])->put('t', '1', 10) ? 'Supported' : 'Not Supported'); } catch (\Exception $e) { echo 'Error: ' . $e->getMessage(); }"
) else (
    echo [STOPPED] Redis is not running
    echo.
    echo Run 'redis-start.bat' to start Redis
)
echo.
pause
