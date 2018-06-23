Vagrant.configure("2") do |config|
    config.vm.box = "archlinux/archlinux"
    config.vm.hostname = "rental.vm"
    config.vm.network "private_network", ip: "192.168.50.50"
    config.vm.network "forwarded_port", guest: 8000, host: 8000

    config.vm.provider "virtualbox" do |vb|
        vb.memory = "2048"
    end

    config.vm.provision "shell", privileged: false, inline: <<-SHELL
        source /home/vagrant/.profile
        echo -e "\e[34mSet PROJECT_DIR"

        if [ -z $(grep "~/.profile" ~/.bash_profile) ]
        then
            echo "[[ -f ~/.profile ]] && . ~/.profile" >> ~/.bash_profile
        fi

        if [ -z $PROJECT_DIR ]
        then
            echo -e "\e[38;5;11mCreate PROJECT_DIR var"
            echo "export PROJECT_DIR=/vagrant" >> ~/.profile
        fi

        if [ -L "/home/vagrant/RentalEmber" ]
        then
            echo -e "\e[34mRentalEmber link exist"
        else
            ln -s /vagrant/RentalEmber /home/vagrant
        fi

        if [ -L "/home/vagrant/RentalDjango" ]
        then
            echo -e "\e[34mRentalDjango link exist"
        else
            ln -s /vagrant/RentalDjango /home/vagrant
        fi
    SHELL

    config.vm.provision "shell", privileged: true, path: "bootstrap/update.sh"
    config.vm.provision "shell", privileged: false, path: "bootstrap/np_update.sh"

    config.vm.provision "shell", privileged: false, path: "bootstrap/git.sh"

    config.vm.provision "shell", privileged: true, path: "bootstrap/nginx/root.sh"

    config.vm.provision "shell", privileged: true, path: "bootstrap/virtualenv/root.sh"
    config.vm.provision "shell", privileged: false, path: "bootstrap/virtualenv/np.sh"

    config.vm.provision "shell", privileged: false, path: "bootstrap/django/np.sh"

    config.vm.provision "shell", privileged: true, path: "bootstrap/ember/root.sh"
    config.vm.provision "shell", privileged: false, path: "bootstrap/ember/np.sh"

    config.vm.provision "shell", privileged: false, path: "bootstrap/run.sh", run: "always"
end
