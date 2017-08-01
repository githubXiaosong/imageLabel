
FROM imagine10255/centos6-lnmp-php56:latest

MAINTAINER XiaoSong

#修改nginx默认配置文件
ADD default.conf /home/config/nginx/sites-enabled/default.conf

# 配置默认放置 App 的目录
#RUN mkdir -p /app && rm -rf /var/www/html && ln -s /app /var/www/html
COPY imageLabel /home/website/default/
WORKDIR /home/website/default/imageLabel

RUN chmod 777 -R bootstrap
RUN chmod 777 -R storage

EXPOSE 80