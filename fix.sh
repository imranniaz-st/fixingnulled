#!/bin/bash

PHP_VERSION="8.3"
INI_PATH="/etc/php/$PHP_VERSION/cli/php.ini"

# Optional: Detect fpm or apache2 if needed
[ -f "/etc/php/$PHP_VERSION/fpm/php.ini" ] && INI_PATH_FPM="/etc/php/$PHP_VERSION/fpm/php.ini"

echo "🔧 Updating PHP settings in: $INI_PATH"

# Backup
sudo cp "$INI_PATH" "$INI_PATH.bak"

# Update values in CLI php.ini
sudo sed -i 's/^upload_max_filesize.*/upload_max_filesize = 500M/' "$INI_PATH"
sudo sed -i 's/^max_execution_time.*/max_execution_time = 5000/' "$INI_PATH"
sudo sed -i 's/^max_input_time.*/max_input_time = 5000/' "$INI_PATH"
sudo sed -i 's/^memory_limit.*/memory_limit = 500M/' "$INI_PATH"

# If FPM exists, also apply there
if [ -n "$INI_PATH_FPM" ]; then
  echo "🔧 Also updating PHP-FPM: $INI_PATH_FPM"
  sudo cp "$INI_PATH_FPM" "$INI_PATH_FPM.bak"
  sudo sed -i 's/^upload_max_filesize.*/upload_max_filesize = 500M/' "$INI_PATH_FPM"
  sudo sed -i 's/^max_execution_time.*/max_execution_time = 5000/' "$INI_PATH_FPM"
  sudo sed -i 's/^max_input_time.*/max_input_time = 5000/' "$INI_PATH_FPM"
  sudo sed -i 's/^memory_limit.*/memory_limit = 500M/' "$INI_PATH_FPM"
fi

echo "✅ Done. Values updated."
echo "📁 Backup created: $INI_PATH.bak"

# Optional: restart services if needed
if [ -n "$INI_PATH_FPM" ]; then
  echo "🔄 Restarting PHP-FPM..."
  sudo service php$PHP_VERSION-fpm restart
fi
