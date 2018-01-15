#!/bin/bash
/usr/bin/mysql --database monitor -e'delete from logs where TIMESTAMPDIFF(DAY,`time`,NOW()) > 7;'