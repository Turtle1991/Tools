#!/usr/bin/env bash
# 将此文件在命令行下引入的方式： . ./bash_method.sh
# mysql的bin路径; host user pwd

mysql='/usr/local/mysql/bin/mysql'
host=''
user=''
pwd=''

#功能：导入文件数据到数据库表中
#用法：load 数据文件 数据表 数据库
load() {
    if [ $# -ne 3 ]
	then
		echo "分隔符不同的load 用法: load 数据文件 数据表 数据库"
		return
	fi
    $mysql -h${host} -u${user} -p${pwd} -e "load data local infile '$1' ignore into table $2 fields terminated by 'turtle1991' lines terminated by 'wuhaigui'" $3
}

load2() {
    if [ $# -ne 3 ]
	then
		echo "用法: load 数据文件 数据表 数据库"
		return
	fi
    $mysql -h${host} -u${user} -p${pwd} -e "load data local infile '$1' ignore into table $2 fields terminated by '\t' lines terminated by '\n'" $3
}

#功能：导出数据到文件
#用法：dump 数据表 文件
dump(){
	if [ $# -ne 2 ]
	then
		echo "分隔符不同的dump 用法: dump 数据表 文件"
		return
	fi
   	$mysql -h${host} -u${user} -p${pwd} -e "use uchome;select * from $1 into outfile '$2' fields terminated by 'turtle1991' lines terminated by 'wuhaigui'"
}

dump2(){
	if [ $# -ne 2 ]
	then
		echo "用法: dump 数据表 文件"
		return
	fi
   	$mysql -h${host} -u${user} -p${pwd} -e "use uchome;select * from $1 into outfile '$2' fields terminated by '\t' lines terminated by '\n'"
}
