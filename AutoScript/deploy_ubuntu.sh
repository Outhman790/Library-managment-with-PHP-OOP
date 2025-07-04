#!/bin/bash

# Ubuntu Deployment Script for Library Management System
# This script sets up the cron job 
set -e  # Exit on any error

echo "🚀 Ubuntu Cron Job Setup for Library Management System"
echo "=================================================="
echo ""

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Function to print colored output
print_status() {
    echo -e "${GREEN}✅ $1${NC}"
}

print_warning() {
    echo -e "${YELLOW}⚠️  $1${NC}"
}

print_error() {
    echo -e "${RED}❌ $1${NC}"
}

# Check if running as root
if [[ $EUID -eq 0 ]]; then
   print_error "This script should not be run as root. Please run as a regular user."
   exit 1
fi

# Get project directory
PROJECT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
echo "Project directory: $PROJECT_DIR"
echo ""

# Check if PHP is available
if ! command -v php &> /dev/null; then
    print_error "PHP is not installed or not in PATH"
    echo "Please install PHP first: sudo apt-get install php php-mysql php-cli"
    exit 1
fi

print_status "PHP found: $(php --version | head -n1)"

# Check if cron is available
if ! command -v crontab &> /dev/null; then
    print_error "Cron is not installed"
    echo "Please install cron first: sudo apt-get install cron"
    exit 1
fi

print_status "Cron found and available"

# Make scripts executable
print_status "Making scripts executable..."
chmod +x "$PROJECT_DIR/AutoScript"/*.sh

# Test PHP script
print_status "Testing PHP cron script..."
cd "$PROJECT_DIR"
if php Crone.php; then
    print_status "PHP script test successful"
else
    print_warning "PHP script test failed - this might be normal if no expired reservations exist"
fi

# Set up cron job
print_status "Setting up cron job..."
"$PROJECT_DIR/AutoScript/cron_setup.sh"

# Verify cron job installation
if crontab -l 2>/dev/null | grep -q "run_cron.sh"; then
    print_status "Cron job installed successfully"
else
    print_error "Cron job installation failed"
    exit 1
fi

# Create log file with proper permissions
touch "$PROJECT_DIR/cron_log.txt"
chmod 644 "$PROJECT_DIR/cron_log.txt"

# Test the complete setup
print_status "Testing complete setup..."
"$PROJECT_DIR/AutoScript/test_cron_linux.sh"

echo ""
echo "🎉 Cron job setup completed successfully!"
echo ""
echo "📋 Summary:"
echo "   • Cron job configured to run every 30 minutes"
echo "   • Log file created at: $PROJECT_DIR/cron_log.txt"
echo ""
echo "🔧 Useful commands:"
echo "   • View cron jobs: crontab -l"
echo "   • View logs: tail -f $PROJECT_DIR/cron_log.txt"
echo "   • Test manually: $PROJECT_DIR/AutoScript/test_cron_linux.sh"
echo "   • Remove cron job: crontab -r"
echo "   • Check cron service: sudo systemctl status cron"
echo ""
print_status "Cron job setup completed!" 