directorio="/zafiro"

echo "Actualizando base de datos de paquetes"
apt-get update
echo "Instalando paquetes necesarios..."
apt-get install ddclient openvpn host whois iputils-tracepath php5 php5-mysql dhcp3-server mysql-server apache2 rrdtool iproute php5-cli libtime-modules-perl librrds-perl mrtg mrtgutils rcconf nmap iptraf php5-gd bzip2 iftop pptpd apmd acpid python-mysqldb squid

echo "Creando usuario zafiro. Introduzca la password de root del servidor MySQL"
mysql -u root -p -e "create user zafiro@localhost identified by 'j483nd8-34/23f--ds'; create database zafiro; grant all privileges on zafiro.* to zafiro@localhost"

echo "Recuperando backup de la base de datos"
mysql -u zafiro -pj483nd8-34/23f--ds zafiro < $directorio/instalador/zafiro.sql

echo "Instalando software"
rm -Rf /var/www
ln -s $directorio/www /var/www

#echo "Creando bases de datos de informacion del servidor"
#$directorio/instalador/creabases.sh

#echo "Modificando el PHP"
#echo "session.auto_start = 1" >> /etc/php5/apache2/php.ini
#echo "output_buffering = On" >> /etc/php5/apache2/php.ini
#echo "Listen 2801" > /etc/apache2/ports.conf

echo "Reiniciando servicios"
/etc/init.d/cron restart
/etc/init.d/apache2 restart

