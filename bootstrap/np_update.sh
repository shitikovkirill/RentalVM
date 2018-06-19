cd /tmp
sudo pacman -S --needed base-devel git wget yajl --noconfirm
git clone https://aur.archlinux.org/package-query.git
cd package-query
makepkg -si --noconfirm

cd /tmp
git clone https://aur.archlinux.org/yaourt.git
cd yaourt/
makepkg -si --noconfirm

yaourt -Syyu --noconfirm