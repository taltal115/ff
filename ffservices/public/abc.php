### Rackspace MySQL 4.1/5.0 Default/Kickstart Configuration File v1.1
###
### This is a base configuration file containing the most frequently used 
### settings with reasonably defined default values for configuring and 
### tuning MySQL. Note that these settings can likely be further tuned 
### in order to get optimum performance from MySQL based upon the database 
### configuration and hardware platform.
###
### While the settings provided are likely sufficient for most situations, an 
### exhaustive list of settings (with descriptions) can be found at:
### 
### For MySQL 4.1:
### http://dev.mysql.com/doc/refman/4.1/en/server-system-variables.html
### For MySQL 5.0:
### http://dev.mysql.com/doc/refman/5.0/en/server-system-variables.html
###
### Further configuration file examples (with and without comments) can be
### found in @@@mysql_server_docdir@@@.
###
### Take care to only add/remove/change a setting if you are comfortable
### doing so! For Rackspace customers, if you have any questions or concerns,
### please contact the MySQL Database Services Team. Be aware that some work
### performed by this team can involve additional billable fees.

[mysqld]

# __________________ 
#< General Settings >
# ------------------ 
#        \   ^__^
#         \  (oo)\_______
#            (__)\       )\/\
#                ||----w |
#                ||     ||

# Misc Settings
# -------------
datadir=/var/lib/mysql
tmpdir=/var/lib/mysqltmp
#tmpdir=/dev/shm
socket=/var/lib/mysql/mysql.sock
skip-locking
table_cache=4096
thread_cache_size=32
thread_concurrency=8
back_log=100
max_connect_errors=10000
open-files-limit=20000
interactive_timeout=600
wait_timeout=600
max_connections=1000

# Set this to change the way MySQL handles validation, data 
# conversion, etc. Be careful with this setting as it can
# cause unexpected results and horribly break some applications!
# Note, too, that it can be set per-session and can be hard set
# in stored procedures.
#sql_mode=TRADITIONAL

# Slow Query Log Settings
# -----------------------
log-slow-queries=/var/lib/mysqllogs/slow-log
long_query_time=2
#log-queries-not-using-indexes

# Global, Non Engine-Specific Buffers
# -----------------------------------
max_allowed_packet=16M
tmp_table_size=768M
max_heap_table_size=64M

# Generally, it is unwise to set the query cache to be 
# larger than 64-128M as this can decrease performance
# since the penalty for flushing the cache can become
# significant.
query_cache_size=128M
query_cache_limit=4M

# Per-Thread Buffers
# ------------------
sort_buffer_size=8M
read_buffer_size=2M
read_rnd_buffer_size=16M
join_buffer_size=8M
bulk_insert_buffer_size=64M
# __________________________ 
#< Engine Specific Settings >
# -------------------------- 
#        \   ^__^
#         \  (oo)\_______
#            (__)\       )\/\
#                ||----w |
#                ||     ||

# Set this to force MySQL to use a particular engine / table-type
# for new tables. This setting can still be overridden by specifying
# the engine explicitly in the CREATE TABLE statement.
#default-storage-engine=InnoDB

# MyISAM
# ------

# Not sure what to set this to?
# Try running a 'du -sch /var/lib/mysql/*/*.MYI'
# This will give you a good estiamte on the size of all the MyISAM indexes.
# (The buffer may not need to set that high, however)
key_buffer_size=256M

# This setting controls the size of the buffer that is allocated when 
# sorting MyISAM indexes during a REPAIR TABLE or when creating indexes 
# with CREATE INDEX or ALTER TABLE.
myisam_sort_buffer_size=12128
myisam_max_sort_file_size = 10G
myisam_max_extra_sort_file_size = 10G
myisam_repair_threads = 1
myisam_recover
# InnoDB
# ------
# Note: While most settings in MySQL can be set at run-time, InnoDB
# variables require restarting MySQL to apply.

default-storage-engine = InnoDB
innodb = FORCE
ignore-builtin-innodb
plugin-load = ha_innodb_plugin.so

# If the customer already has InnoDB tables and wants to change the 
# size of the InnoDB tablespace and InnoDB logs, then:
# 1. Run a full backup with mysqldump
# 2. Stop MySQL
# 3. Move current ibdata and ib_logfiles out of /var/lib/mysql
# 4. Uncomment the below innodb_data_file_path and innodb_log_file_size
# 5. Start MySQL (it will recreate new InnoDB files)
# 6. Restore data from backup
#innodb_data_file_path=ibdata1:2000M;ibdata2:10M:autoextend
innodb_data_file_path = ibdata1:1G;ibdata2:512M:autoextend
innodb_autoextend_increment=512

innodb_log_file_size=512M
innodb_log_buffer_size = 8M
innodb_log_files_in_group = 2

# InnoDB loves RAM. For customers using mostly InnoDB, consider setting
# this variable somewhat liberally. Do make sure the server is 64-bit, 
# however, if you plan on setting it above 1.5-2GB.
innodb_buffer_pool_size=16G

innodb_additional_mem_pool_size=20M
innodb_lock_wait_timeout=300
# innodb_file_per_table can be useful in certain cases
# but be aware that it does not scale well with a 
# large number of tables!
#innodb_file_per_table=1
# Somewhat equivalent to table_cache for InnoDB
# when using innodb_file_per_table.
#innodb_open_files=1024

# If you are not sure what to set this two, the
# following formula can offer up a rough idea:
# (number of cpus * number of disks * 2)
innodb_thread_concurrency=34

# _____________________________ 
#< Replication/Backup Settings >
# ----------------------------- 
#        \   ^__^
#         \  (oo)\_______
#            (__)\       )\/\
#                ||----w |
#                ||     ||

server-id=317821 #Generated from Rackspace server number

# It may be wise to include the server-name or an easy identifier
# to the server in these logs, such as 'log-bin=/var/lib/mysqllogs/db1-bin-log'
#log-bin=/var/lib/mysqllogs/bin-log
#log-bin-index=/var/lib/mysqllogs/bin-log.index
#relay-log=/var/lib/mysqllogs/relay-log
#relay-log-index=/var/lib/mysqllogs/relay-log.index

# MySQL 5.0+ Only
#expire_logs_days=14

# This is usually only needed when setting up chained replication.
#log-slave-updates

# Enable this to make replication more resilient against server 
# crashes and restarts, but can cause higher I/O on the server.
#sync_binlog=1

# MySQL 5.0+ Only
# Uncomment the following when enabling multi-master replication
# Do NOT uncomment these unless you know exactly what you are doing!
#auto_increment_increment=2
#auto_increment_offset=1

# _________________ 
#< Script Settings >
# ----------------- 
#        \   ^__^
#         \  (oo)\_______
#            (__)\       )\/\
#                ||----w |
#                ||     ||
# (You probably do not need to change these)

[mysql.server]
user=mysql
#basedir=/var/lib

[mysqld_safe]
log-error=/var/log/mysqld.log
pid-file=/var/run/mysqld/mysqld.pid
open-files-limit=65535

