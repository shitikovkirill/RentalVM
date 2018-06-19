Vagrant.configure("2") do |config|
    config.vm.box = "terrywang/archlinux"
    config.vm.hostname = "rental.vm"
    config.vm.network "private_network", ip: "192.168.0.50"
    config.vm.synced_folder ".", "/home/vagrant/RentalVM"

    config.vm.provider "virtualbox" do |vb|
        vb.memory = "2048"
    end

    config.vm.provision "shell", privileged: false, path: "bootstrap/git.sh"
    config.vm.provision "shell", privileged: true, path: "bootstrap/nginx/script.sh"
    config.vm.provision "shell", privileged: true, path: "bootstrap/virtualenv/script.sh"
    config.vm.provision "shell", privileged: true, path: "bootstrap/ember/script.sh"
end
