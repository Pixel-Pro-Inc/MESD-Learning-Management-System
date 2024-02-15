FROM mariadb:latest

COPY init.sql /docker-entrypoint-initdb.d/init.sql
# Set root password
ENV MARIADB_ROOT_PASSWORD=Password

