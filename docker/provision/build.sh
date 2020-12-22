#!/usr/bin/env bash

set -e

if [ -z "$(find /entrypoint.d -maxdepth 1 -type f  -name \"*.sh\" 2>/dev/null)" ]; then
    for file in /entrypoint.d/*.sh; do
    	chmod +x ${file} || true;
    done
fi

mkdir -p /var/cache/apt

exit 0
