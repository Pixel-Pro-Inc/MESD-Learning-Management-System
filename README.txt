                                 .-..-.
   _____                         | || |
  /____/-.---_  .---.  .---.  .-.| || | .---.
  | |  _   _  |/  _  \/  _  \/  _  || |/  __ \
  * | | | | | || |_| || |_| || |_| || || |___/
    |_| |_| |_|\_____/\_____/\_____||_|\_____)

Moodle - the world's open source learning platform

Moodle <https://moodle.org> is a learning platform designed to provide
educators, administrators and learners with a single robust, secure and
integrated system to create personalised learning environments.

You can download Moodle <https://download.moodle.org> and run it on your own
web server, ask one of our Moodle Partners <https://moodle.com/partners/> to
assist you, or have a MoodleCloud site <https://moodle.com/cloud/> set up for
you.

Moodle is widely used around the world by universities, schools, companies and
all manner of organisations and individuals.

Moodle is provided freely as open source software, under the GNU General Public
License <https://moodledev.io/general/license>.

Moodle is written in PHP and JavaScript and uses an SQL database for storing
the data.

See <https://docs.moodle.org> for details of Moodle's many features.

 ###Moodle Install Steps
- sudo apt update
- sudo apt install apache2 mariadb-server php php-mysql libapache2-mod-php php-gd php-xmlrpc php-mbstring php-soap php-intl php-zip php-curl php-xml
- git clone -b MOODLE_403_STABLE git://git.moodle.org/moodle.git
- sudo mv moodle /var/www/html/
- sudo mysql -u root -p (Any Password Will Do)
- CREATE DATABASE moodle DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
- CREATE USER 'moodleuser'@'localhost' IDENTIFIED BY 'your_password';
- GRANT ALL PRIVILEGES ON moodle.* TO 'moodleuser'@'localhost';
- FLUSH PRIVILEGES;
- EXIT;
- sudo apt-get install git
- sudo mkdir /var/moodledata
- sudo chmod 0777 /var/moodledata
- sudo chmod -R 755 /var/www
- sudo chown -R www-data:www-data /var/www

Follow instructions from this link:
https://chat.openai.com/share/f938d468-6b82-473f-a3f5-02e78b20af9e
