#!/bin/bash

# Test script for Library Management Cron Job on Linux
echo "Testing Library Management Cron Job on Linux..."
echo "Current time: $(date)"
echo ""

# Get the project directory
PROJECT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
echo "Project directory: $PROJECT_DIR"
echo ""

# Change to project directory
cd "$PROJECT_DIR"

# Check if PHP is available
if ! command -v php &> /dev/null; then
    echo "❌ Error: PHP is not installed or not in PATH"
    echo "Please install PHP: sudo apt-get install php"
    exit 1
fi

echo "✅ PHP found: $(php --version | head -n1)"
echo ""

# Test the cron job
echo "Running cron job..."
php Crone.php

echo ""
echo "Cron job execution completed."
echo "Check the output above for any errors."
echo ""
echo "To view logs: tail -f cron_log.txt" 