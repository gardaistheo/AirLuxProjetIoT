FROM debian:12

RUN apt-get update &&  apt-get install -y \
lsof \
curl \
autossh \
supervisor \
nginx

