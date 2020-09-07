# Orkidea StockControl 1.0 Beta

Sistema para Controle de Estoque

## Como instalar no Ubuntu 20.04 ou superior

```bash
# Adicione o repositório do WinuniX
wget -qO - "https://winunix.github.io/debian/public.key" | sudo apt-key add -
echo "deb https://winunix.github.io/debian focal main" | sudo tee /etc/apt/sources.list.d/winunix-focal.list
sudo apt update

# Instale o StockControl
sudo apt install orkidea-stockcontrol
```

## Script para instalação no Ubuntu 12.04 com proxy:

Substitua as linhas "http://usuario:senha@ipdoservidor:porta" pelas configurações do seu proxy.

```bash

#Instalacao com proxy
export http_proxy="http://usuario:senha@ipdoservidor:porta"
export https_proxy="https://usuario:senha@ipdoservidor:porta"
sudo -E add-apt-repository ppa:upubuntu-com/web
sudo apt-get update
sudo apt-get install xampp git gksu firefox
sudo git config --global http.proxy "http://usuario:senha@ipdoservidor:porta"

#Instalacao do Sistema de Estoque
cd /opt/lampp/
sudo chmod 775 -R htdocs
cd htdocs
sudo git clone http://github.com/ailtonbsj/stockcontrol
sudo /opt/lampp/lampp startmysql
sudo /opt/lampp/lampp startapache
cd stockcontrol
sudo /opt/lampp/bin/mysql -u root < db.sql

#Exibe painel XAMPP e sistema
pkill firefox
firefox http://localhost/stockcontrol &
gksu /opt/lampp/share/xampp-control-panel/xampp-control-panel &

### usuario padrao: admin
### senha padrao: admin

```

## Script para instalação no Ubuntu 12.04 sem proxy:

```bash

#Instalação sem proxy
sudo add-apt-repository ppa:upubuntu-com/web
sudo apt-get update
sudo apt-get install xampp git gksu firefox

#Instalacao do Sistema de Estoque
cd /opt/lampp/
sudo chmod 775 -R htdocs
cd htdocs
sudo git clone http://github.com/ailtonbsj/stockcontrol
sudo /opt/lampp/lampp startmysql
sudo /opt/lampp/lampp startapache
cd stockcontrol
sudo /opt/lampp/bin/mysql -u root < db.sql

#Exibe painel XAMPP e sistema
pkill firefox
firefox http://localhost/stockcontrol &
gksu /opt/lampp/share/xampp-control-panel/xampp-control-panel &

### usuario padrao: admin
### senha padrao: admin

```
