user = root

mysql-create-db:
	cat make1.sql | mysql -u $(user) -p
	composer install
	php bin/console doctrine:schema:update --dump-sql
	php bin/console doctrine:schema:update --force
	cat make2.sql | mysql -u $(user) -p
