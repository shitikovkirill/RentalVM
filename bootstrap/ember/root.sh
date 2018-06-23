#!/bin/bash

echo "fs.inotify.max_user_watches = 100000" > /etc/sysctl.d/watchman.conf