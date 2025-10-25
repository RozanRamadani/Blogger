@echo off
REM Stop Redis Server
echo Stopping Redis Server...
taskkill /F /IM redis-server.exe > nul 2>&1
if %errorlevel% equ 0 (
    echo [SUCCESS] Redis server stopped
) else (
    echo [INFO] Redis server was not running
)
echo.
pause
