#!/bin/bash

EXT="pdo_mysql"
PHP_VERSION="8.3"
PHP_CONF_DIR="/etc/php/$PHP_VERSION/cli"
EXT_PATH=$(find /usr/lib/php/ -name ${EXT}.so 2>/dev/null)

echo "🔍 Scanning for $EXT in PHP $PHP_VERSION config files..."

echo -e "\n📁 Config Files Where '$EXT' is Declared:"
grep -i "$EXT" "$PHP_CONF_DIR/php.ini" "$PHP_CONF_DIR/conf.d/"*.ini 2>/dev/null || echo "❌ Not declared."

echo -e "\n📦 Checking .so file for $EXT:"
if [[ -n "$EXT_PATH" ]]; then
    echo "✅ Found: $EXT_PATH"
else
    echo "❌ $EXT.so not found in /usr/lib/php — probably not installed"
fi
