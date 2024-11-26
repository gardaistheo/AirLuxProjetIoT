FROM debian:12

USER root

RUN apt-get update &&  apt-get install -y  \
lsof \
sudo \
curl \
autossh \
supervisor \
nginx \
systemctl \
net-tools

# Créer le répertoire pour les logs de Supervisor
RUN mkdir -p /var/log/supervisor

COPY ./conf/nginx.conf /etc/supervisor/conf.d/nginx.conf


