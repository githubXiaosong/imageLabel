
FROM imagine10255/centos6-lnmp-php56:latest

ADD . /home/website/default/


ENTRYPOINT 	echo "daemon off;" >> /home/config/nginx/nginx.conf &&
			cp default.conf /home/config/nginx/sites-enabled/ &&
			chmod 777 -R storage/ &&
			chmod 777 -R bootstrap/ 


