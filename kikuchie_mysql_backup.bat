cd "c:\xampp\db_backup"
mysqldump -uroot -ppassword  --routines --events --databases kikuchie > kikuchie_%date:~-2,2%.sql
