
FROM imagine10255/centos6-lnmp-php56:latest

ADD default.conf /home/config/nginx/sites-enabled/default.conf

WORKDIR /home/website/default/
ADD . .

RUN echo "daemon off;" >> /home/config/nginx/nginx.conf



