DIR=`dirname $0`
cd $DIR
DIR=`pwd`
file="$DIR/data_import"

. $DIR/../../deploy.inc
. $DIR/../../base/mysql.inc

while true
        do
	if [ -f "$file" ]
	then
	    echo "$file found"

	    $DIR/../../stop_all.sh

	    echo "sp_web_update"
	    #db_execute 'use db_secret_search; call sp_web_update'
	    mysql -u root -pefield-tech -e "use db_secret_search; call sp_web_update;"

	    $DIR/../../start_all.sh

	    echo "Delete data_import file";
	    rm $DIR/data_import;
	#else
	    #echo "$file not found"
	fi
        sleep 5
done

