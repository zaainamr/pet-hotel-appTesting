@echo off
echo ==========================================
echo Creating Pet Hotel Testing Database
echo ==========================================
echo.

"D:\laragon\bin\mysql\mysql-8.4.3-winx64\bin\mysql.exe" -u root -e "CREATE DATABASE IF NOT EXISTS pet_hotel_testing CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

if %errorlevel% equ 0 (
    echo [SUCCESS] Database 'pet_hotel_testing' created successfully!
    echo.
    echo Existing Pet Hotel databases:
    "D:\laragon\bin\mysql\mysql-8.4.3-winx64\bin\mysql.exe" -u root -e "SHOW DATABASES LIKE 'pet_hotel%%';"
) else (
    echo [ERROR] Failed to create database!
    echo Please make sure MySQL service is running in Laragon.
)

echo.
echo Done!
