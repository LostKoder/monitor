#!/usr/bin/env bash

files=$(mysql --database monitor -e' select config_file from tor_proxies where enabled = 0;'  | tail -n +2)

for file in ${files}
do
    kill -9 $(ps aux | grep ${file} | grep -v grep | sed -r 's/ +/\t/g' | cut -f2)
    tor -f ${file} &
    mysql --database monitor -e"update tor_proxies set enabled = 1 where config_file='${file}'"
done
