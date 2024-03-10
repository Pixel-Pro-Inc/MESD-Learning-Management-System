#!/bin/bash

# Load variables from .env file
#source .env

# Number of instances you want to create
NUM_INSTANCES=2

# Initial port number
START_PORT_WEB=8080
START_PORT_DB=3306
# Docker Compose file template
cat <<EOF > docker-compose.yml
version: "3.3"

services:
EOF

# Add the services you want to keep only once
cat <<EOF >> docker-compose.yml
  server:
    build:
      context: RedirectAPI
     # target: final
      dockerfile: Dockerfile
    environment:
      - DB_Connection_String=server=redirectdb;port=3306;user=root;password=Password;database=users;
      - IAM_DOMAIN=https://gateway-cus-acc.gov.bw/
      - SHA_SECRET=secret
    ports:
      - 5000:80
  redirectdb:
    image: redirect-api-db
    build:
      context: RedirectAPI/DbServer
      dockerfile: Dockerfile
    expose:
      - 3306
  reportingdashboard:
    build:
      context: ReportingDashboard/server
     # target: final
      dockerfile: Dockerfile
    environment:
      - SERVER_DEV_PORT=3000
      - DB_DEV_USER=admin
      - DB_DEV_PASSWORD=Password
      # - DB_DEV_HOST=db
      - DB_DEV_PORT=3306
      - IAM_DEV_DOMAIN=https://gateway-cus-acc.gov.bw/
      - NUM_DBS=$NUM_INSTANCES
    ports:
      - 3000:3000
EOF

# Loop to generate services for web and db instances
for ((i=0; i<NUM_INSTANCES; i++)); do
  PORT_WEB=$((START_PORT_WEB + i))
  PORT_DB=$((START_PORT_DB +i ))
  if [[ $i -eq 0 ]]; then
    cat <<EOF >> docker-compose.yml
  web:
    image: mesd-lms
    build:
      context: .
      dockerfile: Dockerfile
      network: host
    ports:
      - "$PORT_WEB:80"
    links:
      - db
    environment:
      - MOODLE_DB_HOST=db
      - MOODLE_DB_PORT=3306
      - SITE_PORT=$PORT_WEB
    entrypoint: ["/bin/bash", "/var/www/html/MESD-Learning-Management-System/entrypoint.sh"]
  db:
    image: mariadb:10.11.7
    environment:
      - MYSQL_ROOT_PASSWORD=Password
      - MYSQL_DATABASE=moodle
      - MYSQL_USER=admin
      - MYSQL_PASSWORD=Password
    volumes:
      - ./moodle-dump.sql:/docker-entrypoint-initdb.d/moodle-dump.sql
      - ./.data/db:/var/lib/mysql
    ports:
      - "$PORT_DB:3306"
EOF
  else
    cat <<EOF >> docker-compose.yml
  web$i:
    image: mesd-lms
    build:
      context: .
      dockerfile: Dockerfile
      network: host
    ports:
      - "$PORT_WEB:80"
    links:
      - db$i
    environment:
      - MOODLE_DB_HOST=db$i
      - MOODLE_DB_PORT=3306
      - SITE_PORT=$PORT_WEB
    entrypoint: ["/bin/bash", "/var/www/html/MESD-Learning-Management-System/entrypoint.sh"]
  db$i:
    image: mariadb:10.11.7
    environment:
      - MYSQL_ROOT_PASSWORD=Password
      - MYSQL_DATABASE=moodle
      - MYSQL_USER=admin
      - MYSQL_PASSWORD=Password
    volumes:
      - ./moodle-dump.sql:/docker-entrypoint-initdb.d/moodle-dump.sql
      - ./.data/db-$i:/var/lib/mysql
    ports:
      - "$PORT_DB:3306"
EOF
  fi
done
