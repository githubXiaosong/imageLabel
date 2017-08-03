
FROM imagine10255/centos6-lnmp-php56:latest

ADD . /home/website/default/

RUN echo "daemon off;" >> /home/config/nginx/nginx.conf
RUN cp default.conf /home/config/nginx/sites-enabled/

#RUN chmod 777 -R storage/
#RUN chmod 777 -R bootstrap/


