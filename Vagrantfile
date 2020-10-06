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

    # You need to indicate the list of security groups your VM should
    # be in. Each security group will be of the form "sg-...", and
    # they should be comma-separated (if you use more than one) within
    # square brackets.
    #
    aws.security_groups = ["sg-04873481591035c2d", "sg-086ed48d05be9c28f"]

    aws.access_key_id="ASIA3KENNYYNMRI74VNY"
    aws_secret_access_key="zho93uelYOyJsziI3vX99adBw230M83heot79MDD"
    aws_session_token="FwoGZXIvYXdzEMz//////////wEaDG2Sy7OB7kJU8GvvsCLLAfBFvbcXfu5t0cMaa/1RhxJWN4zxLHFUGGqFW7a53/ivZDmbifFmnd9g5FBgU3xe/Llri3Jq4gau0VmiIIW8DuJPWqhPE1TvxeUSILUT2T9bdUsi/sWdbN+383asIyOBXkhXw5blleKmFI7xpnxtwgne2mcFO4ks8bBR5uMGY9cmnYPpnPDi102uO6copBnxps5kSP7ac0o92rDMx0pknTWlEnmkX0Jpdrsx64I/cnHmAnfaOeQdrJr7kgYstxaWmJF/u66bPXCkvt4oKIG37/sFMi0fkGBQPSACRUM7z4/DgwzNvY7XGgTGTWrM/KeAfRsqGelWHYzGFPJfEtT/Q+c="

    aws.keypair_name = "349assign2.pem"

    aws.instance_type = "t2.micro"

    # Search criteria = us-east + ___ + ___
    aws.ami = "ami-0f40c8f97004632f9"

    override.ssh.username = "ubuntu"
    override.ssh.private_key_path = "~/.ssh/349assign2.pem"

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

  config.vm.define "webserver2" do |webserver2|
    webserver2.vm.hostname = "webserver2"
    #webserver2.vm.network "forwarded_port", guest: 80, host: 8081, host_ip: "127.0.0.1"
    #webserver2.vm.network "private_network", ip: "192.168.33.12"
    #webserver2.vm.synced_folder ".", "/vagrant", owner: "vagrant", group: "vagrant", mount_options: ["dmode=775,fmode=777"]


    webserver2.vm.provision "shell", inline: <<-SHELL
      apt-get update
      apt-get install -y apache2 php libapache2-mod-php php-mysql awscli
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
