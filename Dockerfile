FROM ubuntu:16.04
RUN apt-get -qq update && \
    apt-get install -y apache2 && \
    apt-get clean
COPY index.html /var/www/html/
EXPOSE 80
CMD apachectl -D FOREGROUND
