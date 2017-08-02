#test build
FROM imagine10255/centos6-lnmp-php56:latest

RUN mkdir /app -p

WORKDIR /app

COPY . /app



