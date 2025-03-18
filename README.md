# Usando a aplicação
Projeto criado para entrevista tecnica de vaga backend developer PHP
Criado para ser usado com Laravel Homestead(https://laravel.com/docs/12.x/homestead), siga a documentação para configurar seu homestead.
Features do homestead necessarias:
- Postgressql
- ZSH (Opcional)
- WebDriver (Opcional)

Ao configurar sua maquina virtual homestead, não esquecer de apontar o caminho da raiz do vagrant para a pasta de seu projeto, exemplo de homestead.yaml para utilizar:
```yaml
---
ip: "192.168.56.56"
memory: 2048
cpus: 2
provider: virtualbox
name: "laraTeste"
authorize: ~/.ssh/id_rsa.pub

keys:
  - ~/.ssh/id_rsa

folders:
  - map: ~/Codes/LaraCrud
    to: /home/vagrant/code

sites:
  - map: homestead.test
    to: /home/vagrant/code/public

databases:
  - homestead

features:
  - mariadb: false
  - postgresql: true
  - ohmyzsh: true
  - webdriver: true

services:
  - enabled:
      - "postgresql"

ports:
   - send: 54320 # PostgreSQL
     to: 5432
```
---
Necessaria atualização da maquina virtual para que o nodejs funcione para que o vite tenha efeito, seguir os comandos do bash abaixo um a um para garantir a replicação
```bash
# para atualizar a maquina virtual, aceitar os prompts no default para não desconfigurar o finetune do homestead
sudo apt full-upgrade -y
# instalar o vite e buildar para garantir o uso do CSS
npm run install && npm run build # para ativar o vite
# atualizar as denpendencias do laravel
composer update
# aplicar as migrações dos modelos
php artisan migrate
# para criar a chave da aplicação
php artisan key:generate
```
Ao criar o primeiro usuario, para alterar as vagas ou os usuarios, ele precisa ser criado através do comando
```bash
php artisan make:admnin admin@example.com --name="Super Admin" --password="strongPassword123"
```
Não esquecer de popular o banco com os dados das factories de vagas
```bash
php artisan db:seed
```
