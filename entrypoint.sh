#!/bin/bash
# printenv | grep -v "no_proxy" >> /etc/environment
printenv | sed 's/^\(.*\)$/export \1/g' | grep -E "^export MOODLE" > /etc/lms_env.sh