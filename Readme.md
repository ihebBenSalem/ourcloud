*******
#Installaion GUIDE
******

1.create new database (ourcloud is good one )
2.import the sql file from db/cloud.sql
3.copy and past  the cloud directory in /var/www/YOUR_DIRECTORY
4.Edit the file config/define.php with ur configuration (username,pass,host)
5.now http://localhost/YOUR_DIRECTORY

Note*:
This project is runnable on Linux os (windows is not supported)
-change the max_file_upload in /etc/phpmyadmin/config.inc.php,
-change  max_allowed_packet=500M under /etc/my.cnf
## Why did I start this project?