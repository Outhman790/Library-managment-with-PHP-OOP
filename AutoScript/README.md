# Library Management Cron Job Setup

This folder contains scripts to automatically clean up expired reservations in the library management system for both Windows and Linux systems.

## Files Description:

### Windows Files:

- `runscript.bat` - Main execution script for Windows
- `shellscript.vbs` - VBS wrapper for Windows Task Scheduler
- `setup_scheduler.bat` - Windows Task Scheduler setup
- `test_cron.bat` - Manual test script for Windows

### Linux Files:

- `cron_setup.sh` - Linux/Ubuntu cron job setup script
- `run_cron.sh` - Linux cron execution script
- `test_cron_linux.sh` - Manual test script for Linux

## Setup Instructions:

### 🐧 Linux/Ubuntu Setup (Recommended for Production):

1. **Make scripts executable:**

   ```bash
   chmod +x AutoScript/*.sh
   ```

2. **Run the setup script:**

   ```bash
   ./AutoScript/cron_setup.sh
   ```

3. **Test the setup:**
   ```bash
   ./AutoScript/test_cron_linux.sh
   ```

### 🪟 Windows Setup (Development):

1. **Automatic Setup:**

   - Right-click on `setup_scheduler.bat` → "Run as Administrator"

2. **Manual Testing:**
   - Double-click `test_cron.bat`

### 🔧 Manual Cron Setup (Linux):

If you prefer to set up cron manually:

```bash
# Edit crontab
crontab -e

# Add this line to run every 30 minutes:
*/30 * * * * /path/to/your/project/AutoScript/run_cron.sh
```

## What the Cron Job Does:

1. **Finds Expired Reservations**: Looks for reservations where `Reservation_Expiration_Date < NOW()`
2. **Updates Collection Status**: Changes collection status from "Reserved" back to "Available"
3. **Deletes Expired Reservations**: Removes expired reservation records
4. **Logs Activity**: Records the number of processed reservations

## Troubleshooting:

### Linux Commands:

```bash
# Check cron jobs
crontab -l

# Remove all cron jobs
crontab -r

# Edit cron jobs
crontab -e

# Check cron service status
sudo systemctl status cron

# Start cron service
sudo systemctl start cron

# Enable cron service (auto-start)
sudo systemctl enable cron

# View logs
tail -f /path/to/project/cron_log.txt

# Check system logs
sudo tail -f /var/log/syslog | grep CRON
```

### Windows Commands:

```cmd
# Check task status
schtasks /query /tn "Library Management Cron Job"

# Delete task
schtasks /delete /tn "Library Management Cron Job" /f
```

### Common Issues:

#### Linux:

1. **PHP not found**: Install PHP with `sudo apt-get install php`
2. **Permission denied**: Make scripts executable with `chmod +x`
3. **Cron not running**: Check service status with `sudo systemctl status cron`
4. **Path issues**: Use absolute paths in cron jobs

#### Windows:

1. **Path Issues**: Ensure all paths match your actual project location
2. **Permissions**: Run setup as Administrator
3. **PHP Path**: Verify PHP is installed at `C:\xampp\php\php.exe`

## Deployment Checklist for Ubuntu:

1. ✅ Install PHP: `sudo apt-get install php php-mysql`
2. ✅ Make scripts executable: `chmod +x AutoScript/*.sh`
3. ✅ Run setup: `./AutoScript/cron_setup.sh`
4. ✅ Test manually: `./AutoScript/test_cron_linux.sh`
5. ✅ Verify cron job: `crontab -l`
6. ✅ Check logs: `tail -f cron_log.txt`

## Frequency Options:

- **Every 30 minutes**: `*/30 * * * *` (default)
- **Every hour**: `0 * * * *`
- **Every 15 minutes**: `*/15 * * * *`
- **Daily at 2 AM**: `0 2 * * *`

## Log Files:

- **Linux**: `cron_log.txt` in project root
- **Windows**: `cron_log.txt` in project root
- **System logs**: `/var/log/syslog` (Linux) or Event Viewer (Windows)
