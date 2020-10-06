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

    # These options force synchronisation of files to the VM's
    # /vagrant directory using rsync, rather than using trying to use
    # SMB (which will not be available by default).
    override.nfs.functional = false
    override.vm.allowed_synced_folder_types = :rsync

    aws.keypair_name = "uskey1"
    override.ssh.private_key_path = "~/.ssh/uskey1.pem"

    aws.instance_type = "t2.micro"

    # You need to indicate the list of security groups your VM should
    # be in. Each security group will be of the form "sg-...", and
    # they should be comma-separated (if you use more than one) within
    # square brackets.
    #
    aws.security_groups = ["sg-035c5c73b7e0d6581", "sg-01bd2995202daa3ae"]

    aws.availability_zone = "us-east-1b"
    aws.subnet_id = "subnet-78b6cd35"

    #aws.access_key_id="AKIAJVQAJI7Q3DEHZXRQ"
    #aws.secret_access_key="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"


    # Search criteria = us-east + hvm
    aws.ami = "ami-0f40c8f97004632f9"

    override.ssh.username = "ubuntu"


  end

  config.vm.define "webserver" do |webserver|
    webserver.vm.hostname = "webserver"
    #webserver.vm.network "forwarded_port", guest: 80, host: 8080, host_ip: "127.0.0.1"
    #webserver.vm.network "private_network", ip: "192.168.33.10"
    #webserver.vm.synced_folder ".", "/vagrant", owner: "vagrant", group: "vagrant", mount_options: ["dmode=775,fmode=777"]

    webserver.vm.provision "shell", inline: <<-SHELL
      apt-get update
      apt-get install -y apache2 php libapache2-mod-php php-mysql awscli

      cp /vagrant/test-website.conf /etc/apache2/sites-available/
      a2ensite test-website
      a2dissite 000-default
      service apache2 reload
    SHELL

  end

  ### database was here ###

  #config.vm.define "webserver2" do |webserver2|
    #webserver2.vm.hostname = "webserver2"
    #webserver2.vm.network "forwarded_port", guest: 80, host: 8081, host_ip: "127.0.0.1"
    #webserver2.vm.network "private_network", ip: "192.168.33.12"
    #webserver2.vm.synced_folder ".", "/vagrant", owner: "vagrant", group: "vagrant", mount_options: ["dmode=775,fmode=777"]


    #webserver2.vm.provision "shell", inline: <<-SHELL
      #apt-get update
      #apt-get install -y apache2 php libapache2-mod-php php-mysql awscli
      #cp /vagrant/test-website2.conf /etc/apache2/sites-available/
      # activate our website configuration ...
      #a2ensite test-website2
      # ... and disable the default website provided with Apache
      #a2dissite 000-default
      # Reload the webserver configuration, to pick up our changes
      #service apache2 reload
    #SHELL

  #end

end
