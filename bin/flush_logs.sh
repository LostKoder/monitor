#!/bin/bash
/usr/bin/mysql --database monitor -e'delete from logs where UNIX_TIMESTAMP(DATE_SUB(NOW(), INTERVAL 8 day))'