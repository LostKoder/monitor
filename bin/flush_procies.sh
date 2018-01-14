#!/usr/bin/env bash

files=$(mysql --database monitor -e' select config_file from tor_proxies;'  | tail -n 6)

for file in ${files}
do
    kill -9 $(ps aux | grep ${file} | grep -v grep | sed -r 's/ +/\t/g' | cut -f2)
    tor -f ${file} &
done
