
FROM imagine10255/centos6-lnmp-php56:latest

WORKDIR /home/website/default/
ADD . .

RUN cp default.conf /home/config/nginx/sites-enabled/

RUN chmod 777 -R storage/
RUN chmod 777 -R bootstrap/

#RUN echo "daemon off;" >> /home/config/nginx/nginx.conf

