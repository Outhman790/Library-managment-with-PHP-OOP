@echo off
echo Testing Library Management Cron Job...
echo.
echo Current time: %date% %time%
echo.

cd /d "C:\xampp\htdocs\Library-managment-with-PHP-OOP"

echo Running cron job...
"C:\xampp\php\php.exe" -f "Crone.php"

echo.
echo Cron job execution completed.
echo Check the output above for any errors.
echo.
pause 