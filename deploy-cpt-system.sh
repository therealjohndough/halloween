#!/bin/bash

# Deploy Skyworld CPT System to Live Server
# This script uploads the standalone CPT system and runs it

echo "🚀 Deploying Skyworld CPT System to Live Server"
echo "==============================================="

# Configuration
SERVER="ssh.johnd508.sg-host.com"
KEY_FILE="skyworld_key"
REMOTE_PATH="/home/vol14_1/epizy.com/epiz_34184668/htdocs"
LOCAL_FILES=(
    "skyworld-cpt-system.php"
    "skyworld-data-importer.php"
    "install-skyworld-cpts.sh"
    "SKYWORLD-CPT-README.md"
)

# Check if SSH key exists
if [ ! -f "$KEY_FILE" ]; then
    echo "❌ SSH key not found: $KEY_FILE"
    echo "Please make sure the SSH key is in the current directory"
    exit 1
fi

echo "📁 Uploading CPT system files..."

# Upload files to server
for file in "${LOCAL_FILES[@]}"; do
    if [ -f "$file" ]; then
        echo "  📤 Uploading $file..."
        scp -i "$KEY_FILE" "$file" "vol14_1@$SERVER:$REMOTE_PATH/"
        
        if [ $? -eq 0 ]; then
            echo "  ✅ $file uploaded successfully"
        else
            echo "  ❌ Failed to upload $file"
        fi
    else
        echo "  ⚠️  $file not found, skipping"
    fi
done

echo ""
echo "🔧 Running CPT system installation on server..."

# Run the CPT system via SSH
ssh -i "$KEY_FILE" "vol14_1@$SERVER" << 'EOF'
cd /home/vol14_1/epizy.com/epiz_34184668/htdocs

echo "📍 Current directory: $(pwd)"
echo "📋 Available files:"
ls -la skyworld-cpt-system.php skyworld-data-importer.php 2>/dev/null || echo "CPT files not found"

echo ""
echo "🔧 Installing CPT system..."

# Check if WordPress and WP-CLI are available
if [ -f wp-config.php ]; then
    echo "✅ WordPress installation found"
    
    # Try to run with WP-CLI if available
    if command -v wp &> /dev/null; then
        echo "✅ WP-CLI found, running installation..."
        wp eval-file skyworld-cpt-system.php
    else
        echo "⚠️  WP-CLI not available on this server"
        echo "📝 Manual installation required:"
        echo ""
        echo "1. Go to WordPress Admin > Plugins > Plugin Editor"
        echo "2. Create a new PHP file with the content of skyworld-cpt-system.php"
        echo "3. Or ask your hosting provider to install WP-CLI"
        echo ""
        echo "Files are now available in your WordPress root directory:"
        echo "  • skyworld-cpt-system.php - Main CPT system"
        echo "  • skyworld-data-importer.php - Data import tool"
        echo "  • SKYWORLD-CPT-README.md - Full documentation"
    fi
else
    echo "❌ WordPress not found in current directory"
    echo "Files uploaded but WordPress path may be different"
fi

EOF

echo ""
echo "🎯 Deployment Summary:"
echo "  Files uploaded to live server"
echo "  CPT system ready for installation"
echo ""
echo "📋 Next Steps:"
echo "1. If WP-CLI worked, your CPTs should be restored"
echo "2. If not, check WordPress Admin > Strains and Products"
echo "3. Manual installation instructions in SKYWORLD-CPT-README.md"
echo ""
echo "🌐 Check your live site: https://skyworld.epizy.com/wp-admin/"