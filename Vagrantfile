# -*- mode: ruby -*-
# vi: set ft=ruby :

# All Vagrant configuration is done below. The "2" in Vagrant.configure
# configures the configuration version (we support older styles for
# backwards compatibility). Please don't change it unless you know what
# you're doing.
Vagrant.configure("2") do |config|

  #config.vm.box = "ubuntu/xenial64"
  config.vm.box = "dummy"

  config.vm.provider :aws do |aws, override|

    aws.region = "us-east-1"

    aws.access_key_id = "ASIA3KENNYYNO56ZBMVT"
    aws.secret_access_key = "NgALztA2nSn46m9aMvxVo5YsHXiqjYtNlYlrhrOw"
    aws.session_token = "FwoGZXIvYXdzEKT//////////wEaDH/DPLynEJnXvs/ezyLLARRZ7YNZCd8mvuPz6m+JQuKGZjmU7HRzUhd5k7COEFlqa0L/8xDslspKJZY4kjHOy1IVkOSb22IxN0mAx/iXoFbx+fOv9bYBXHKtKS0UiXbyvdZd0XAALy8FnhFMkUIzb6CsnzyMrFhUHyjKneI05GGzS5Qly1pHq7H3PJMXOG3/4kWQR6Zf1oDiP+vmk6CZA8700pkLzgrlJYpCOJFRCe+kEghw+hH5yi5qRQlnDsUbq2cVZiHxyjF3b0uRBkhAAmcaCiUsjFZxB0MrKP/I5vsFMi0Mpb/GfEaAcfrazpivWDdhXUdtUZYetIQu/ORXXDg/gTH5Ea7WcdwUxwvFWbQ="
    aws.keypair_name = "assign2"

    aws.ami = "ami-0f40c8f97004632f9"

    override.ssh.username = "ubuntu"
    override.ssh.private_key_path = "~/.ssh/assign2.pem"

  end

  config.vm.define "webserver" do |webserver|
    webserver.vm.hostname = "webserver"
    #webserver.vm.network "forwarded_port", guest: 80, host: 8080, host_ip: "127.0.0.1"
    #webserver.vm.network "private_network", ip: "192.168.33.10"
    #webserver.vm.synced_folder ".", "/vagrant", owner: "vagrant", group: "vagrant", mount_options: ["dmode=775,fmode=777"]

  #
  # config.vm.provider "virtualbox" do |vb|
  #   # Display the VirtualBox GUI when booting the machine
  #   vb.gui = true
  #
  #   # Customize the amount of memory on the VM:
  #   vb.memory = "1024"
  # end
  #

    webserver.vm.provision "shell", inline: <<-SHELL
      apt-get update
      apt-get install -y apache2 php libapache2-mod-php php-mysql

      cp /vagrant/test-website.conf /etc/apache2/sites-available/
      a2ensite test-website
      a2dissite 000-default
      service apache2 reload
    SHELL

  end

  config.vm.define "database" do |database|

    database.vm.hostname = "database"
    # database.vm.network "forwarded_port", guest: 80, host: 8080, host_ip: "127.0.0.1"
    #database.vm.network "private_network", ip: "192.168.33.11"
    #database.vm.synced_folder ".", "/vagrant", owner: "vagrant", group: "vagrant", mount_options: ["dmode=775,fmode=777"]

    database.vm.provision "shell", inline: <<-SHELL
      apt-get update
      export MYSQL_PWD='insecure_mysqlroot_pw'

      # If you run the `apt-get install mysql-server` command
      # manually, it will prompt you to enter a MySQL root
      # password. The next two lines set up answers to the questions
      # the package installer would otherwise ask ahead of it asking,
      # so our automated provisioning script does not get stopped by
      # the software package management system attempting to ask the
      # user for configuration information.
      echo "mysql-server mysql-server/root_password password $MYSQL_PWD" | debconf-set-selections
      echo "mysql-server mysql-server/root_password_again password $MYSQL_PWD" | debconf-set-selections

      # Install the MySQL database server.
      apt-get -y install mysql-server

      # Run some setup commands to get the database ready to use.
      # First create a database.
      echo "CREATE DATABASE fvision;" | mysql

      # Then create a database user "webuser" with the given password.
      echo "CREATE USER 'webuser'@'%' IDENTIFIED BY 'insecure_db_pw';" | mysql

      # Grant all permissions to the database user "webuser" regarding
      # the "fvision" database that we just created, above.
      echo "GRANT ALL PRIVILEGES ON fvision.* TO 'webuser'@'%'" | mysql

      # Set the MYSQL_PWD shell variable that the mysql command will
      # try to use as the database password ...
      export MYSQL_PWD='insecure_db_pw'
      cat /vagrant/database.sql | mysql -u webuser fvision
      sed -i'' -e '/bind-address/s/127.0.0.1/0.0.0.0/' /etc/mysql/mysql.conf.d/mysqld.cnf

      # We then restart the MySQL server to ensure that it picks up
      # our configuration changes.
      service mysql restart
    SHELL
  end

  config.vm.define "webserver2" do |webserver2|
    webserver2.vm.hostname = "webserver2"
    #webserver2.vm.network "forwarded_port", guest: 80, host: 8081, host_ip: "127.0.0.1"
    #webserver2.vm.network "private_network", ip: "192.168.33.12"
    #webserver2.vm.synced_folder ".", "/vagrant", owner: "vagrant", group: "vagrant", mount_options: ["dmode=775,fmode=777"]

    webserver2.vm.provision "shell", inline: <<-SHELL
      apt-get update
      apt-get install -y apache2 php libapache2-mod-php php-mysql
      cp /vagrant/test-website2.conf /etc/apache2/sites-available/
      # activate our website configuration ...
      a2ensite test-website2
      # ... and disable the default website provided with Apache
      a2dissite 000-default
      # Reload the webserver configuration, to pick up our changes
      service apache2 reload
    SHELL

  end

end
