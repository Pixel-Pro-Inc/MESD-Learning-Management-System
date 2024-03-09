#!/bin/bash

# Copy the environment variables from proc/1/environ to a separate file
sudo cat /proc/1/environ > env_variables.sh

# Source the environment variables file
source ./env_variables.sh

# Export each variable individually
export MOODLE_DB_HOST
export MOODLE_DB_PORT

# Execute the Moodle cron job
/usr/bin/php /var/www/html/MESD-Learning-Management-System/admin/cli/cron.php >/var/log/cron_output.log