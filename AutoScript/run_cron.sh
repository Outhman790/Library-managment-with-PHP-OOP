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