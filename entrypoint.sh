#!/bin/bash
# Export environment variables from /proc/1/environ to /etc/environment
while IFS= read -r line; do
    echo "$line" >> /etc/environment
done < /proc/1/environ
exec "$@"
