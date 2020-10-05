FROM ubuntu:16.04
RUN apt-get -qq update && \
    apt-get install -y apache2 && \
    apt-get clean && \
    cp /vagrant/test-website.conf /etc/apache2/sites-available/ && \
    a2ensite test-website && \
    a2dissite 000-default && \
    service apache2 reload
COPY www/index.php /var/www/html/
EXPOSE 80
CMD apachectl -D FOREGROUND
