#!/bin/bash

files=$(/usr/bin/mysql --database monitor -e' select config_file from tor_proxies where enabled = 0;'  | /usr/bin/tail -n +2)

for file in ${files}
do
    /bin/kill -9 $(/bin/ps aux | /bin/grep ${file} | /bin/grep -v grep | /bin/sed -r 's/ +/\t/g' | /usr/bin/cut -f2)
    /usr/sbin/tor -f ${file} &
    /usr/bin/mysql --database monitor -e"update tor_proxies set enabled = 1 where config_file='${file}'"
done
