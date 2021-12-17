#!/bin/bash

echo "Wait for mysql database start..." >> /dev/stdout
wait-for localhost:3306 -t 300 -- echo "MySQL ready!" >> /dev/stdout
mysql -uroot -p$MYSQL_ROOT_PASSWORD < mydb.sql
rm -rf async-seed.sh seed.sh