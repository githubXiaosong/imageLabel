
FROM imagine10255/centos6-lnmp-php56:latest

WORKDIR /home/website/default/
ADD . .

ENTRYPOINT echo "daemon off;" >> /home/config/nginx/nginx.conf
ENTRYPOINT cp default.conf /home/config/nginx/sites-enabled/

ENTRYPOINT chmod 777 -R storage/
ENTRYPOINT chmod 777 -R bootstrap/


