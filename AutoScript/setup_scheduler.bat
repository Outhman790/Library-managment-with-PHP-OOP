@echo off
echo Setting up Library Management Cron Job in Windows Task Scheduler...

REM Create a scheduled task that runs every 30 minutes
schtasks /create /tn "Library Management Cron Job" /tr "C:\xampp\htdocs\Library-managment-with-PHP-OOP\AutoScript\shellscript.vbs" /sc minute /mo 30 /f

echo.
echo Task created successfully!
echo The cron job will now run every 30 minutes automatically.
echo.
echo To check the task status, run: schtasks /query /tn "Library Management Cron Job"
echo To delete the task, run: schtasks /delete /tn "Library Management Cron Job" /f
echo.
pause 