#!/bin/bash

# Library Management Cron Job Setup for Linux/Ubuntu
# This script sets up automatic cleanup of expired reservations

echo "Setting up Library Management Cron Job for Linux/Ubuntu..."

# Get the current directory (project root)
PROJECT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
CRON_SCRIPT="$PROJECT_DIR/AutoScript/run_cron.sh"
CRON_LOG="$PROJECT_DIR/cron_log.txt"

# Create the cron execution script
cat > "$CRON_SCRIPT" << 'EOF'
#!/bin/bash

# Library Management Cron Job for Linux
PROJECT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
CRON_LOG="$PROJECT_DIR/cron_log.txt"

# Log execution start
echo "$(date): Starting Library Management Cron Job" >> "$CRON_LOG"

# Change to project directory
cd "$PROJECT_DIR"

# Run the PHP script and capture output
php Crone.php >> "$CRON_LOG" 2>&1

# Log execution end
echo "$(date): Cron job completed" >> "$CRON_LOG"
echo "----------------------------------------" >> "$CRON_LOG"
EOF

# Make the script executable
chmod +x "$CRON_SCRIPT"

# Create a temporary file for the cron job
TEMP_CRON=$(mktemp)

# Add the cron job to run every 30 minutes
echo "*/30 * * * * $CRON_SCRIPT" > "$TEMP_CRON"

# Install the cron job
crontab "$TEMP_CRON"

# Clean up temporary file
rm "$TEMP_CRON"

echo "✅ Cron job installed successfully!"
echo "📅 The job will run every 30 minutes"
echo "📝 Logs will be saved to: $CRON_LOG"
echo ""
echo "To check current cron jobs:"
echo "  crontab -l"
echo ""
echo "To remove the cron job:"
echo "  crontab -r"
echo ""
echo "To edit cron jobs manually:"
echo "  crontab -e"
echo ""
echo "To test the script manually:"
echo "  $CRON_SCRIPT" 