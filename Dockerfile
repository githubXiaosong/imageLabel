FROM imagine10255/centos6-lnmp-php56:latest

#WORKDIR /home/config/nginx/sites-enabled/
#RUN rm -rf default.conf
#COPY default.conf default.conf

WORKDIR /home/website/default/
COPY . imageLabel

#RUN echo "daemon off;" >> /home/config/nginx/nginx.conf



