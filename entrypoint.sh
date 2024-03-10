#!/bin/bash
# Export environment variables to a file
printenv | grep -v "no_proxy" >> /etc/environment
exec "$@"
