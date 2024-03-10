#!/bin/bash
# printenv | grep -v "no_proxy" >> /etc/environment
printenv | sed 's/^\(.*\)$/export \1/g' > /etc/lms_env.sh