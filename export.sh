#!/bin/bash
_os="`uname`"
_now=$(date +"%m_%d_%Y")
_file="data/mysql/data_$_now.sql"

# Export dump
EXPORT_COMMAND='exec mysqldump "$MYSQL_DATABASE" -uroot -p"$MYSQL_ROOT_PASSWORD"'
docker-compose exec database sh -c "$EXPORT_COMMAND" > $_file

if [[ $_os == "Darwin"* ]] ; then
  sed -i '.bak' 1,1d $_file
else
  sed -i 1,1d $_file # Removes the password warning from the file
fi
