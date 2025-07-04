@echo off
echo Starting Library Management Cron Job - %date% %time%
cd /d "C:\xampp\htdocs\Library-managment-with-PHP-OOP"
"C:\xampp\php\php.exe" -f "Crone.php" >> "cron_log.txt" 2>&1
echo Cron job completed - %date% %time%
pause