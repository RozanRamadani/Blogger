@echo off
REM Start Redis Server for Laravel Project
echo Starting Redis Server...
start /B "Redis Server" "C:\laragon\bin\redis\redis-x64-5.0.14.1\redis-server.exe"
timeout /t 2 /nobreak > nul
echo.
echo Checking Redis status...
netstat -an | findstr "6379" > nul
if %errorlevel% equ 0 (
    echo [SUCCESS] Redis is running on port 6379
    echo.
    echo Testing Laravel connection...
    php artisan tinker --execute="try { Cache::store('redis')->put('test', 'OK', 10); echo 'Redis connection: ' . Cache::store('redis')->get('test'); } catch (\Exception $e) { echo 'Error: ' . $e->getMessage(); }"
) else (
    echo [ERROR] Redis failed to start
)
echo.
pause
