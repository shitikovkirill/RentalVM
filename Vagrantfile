Vagrant.configure("2") do |config|
    config.vm.box = "terrywang/archlinux"
    config.vm.hostname = "rental.vm"
    config.vm.network "private_network", ip: "192.168.0.50"

    config.vm.provider "virtualbox" do |vb|
        vb.memory = "2048"
    end

    config.vm.provision "shell", privileged: false, inline: <<-SHELL
        echo -e "\e[34mSet PROJECT_DIR"
        echo "export PROJECT_DIR=/vagrant/"

        cd /home/vagrant
        ln -s /vagrant/RentalEmber .
        ln -s /vagrant/RentalDjango .
    SHELL

    config.vm.provision "shell", privileged: true, path: "bootstrap/update.sh"
    config.vm.provision "shell", privileged: false, path: "bootstrap/np_update.sh"

    config.vm.provision "shell", privileged: false, path: "bootstrap/git.sh"

    config.vm.provision "shell", privileged: true, path: "bootstrap/nginx/script.sh"
    config.vm.provision "shell", privileged: true, path: "bootstrap/virtualenv/script.sh"

    config.vm.provision "shell", privileged: true, path: "bootstrap/ember/script.sh"
    config.vm.provision "shell", privileged: false, path: "bootstrap/ember/np.sh"
end
