# -*- mode: ruby -*-
# vi: set ft=ruby :

# Fixes error message - "undefined HashMap method 'except'"
# https://github.com/mitchellh/vagrant-aws/issues/566#issuecomment-580812210
class Hash
  def slice(*keep_keys)
    h = {}
    keep_keys.each { |key| h[key] = fetch(key) if has_key?(key) }
    h
  end unless Hash.method_defined?(:slice)
  def except(*less_keys)
    slice(*keys - less_keys)
  end unless Hash.method_defined?(:except)
end

# All Vagrant configuration is done below. The "2" in Vagrant.configure
# configures the configuration version (we support older styles for
# backwards compatibility). Please don't change it unless you know what
# you're doing.
Vagrant.configure("2") do |config|

  #config.vm.box = "ubuntu/xenial64"

  config.vm.box = "dummy"

  config.vm.provider :aws do |aws, override|

    aws.region = "us-east-1"

    # Override SMB synchronization
    overrirde.nfs.functional = false
    override.vm.allowed_synced_folder_types = :rsync

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
    webserver.vm.network "forwarded_port", guest: 80, host: 8080, host_ip: "127.0.0.1"
    #webserver.vm.network "private_network", ip: "192.168.33.10"
    #webserver.vm.synced_folder ".", "/vagrant", owner: "vagrant", group: "vagrant", mount_options: ["dmode=775,fmode=777"]

    webserver.vm.provision "shell", inline: <<-SHELL
      apt-get update
      apt-get install -y apache2 php libapache2-mod-php php-mysql

      cp /vagrant/test-website.conf /etc/apache2/sites-available/
      a2ensite test-website
      a2dissite 000-default
      service apache2 reload
    SHELL

  end

  ### database was here ###

  config.vm.define "webserver2" do |webserver2|
    webserver2.vm.hostname = "webserver2"
    webserver2.vm.network "forwarded_port", guest: 80, host: 8081, host_ip: "127.0.0.1"
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
