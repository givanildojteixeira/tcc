<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

<h1 align="center"> Projeto Atendimento Vendas de Veículos </h1>

<p align="center">
<img loading="lazy" src="http://img.shields.io/static/v1?label=STATUS&message=EM%20DESENVOLVIMENTO&color=GREEN&style=for-the-badge"/>
</p>






## Instalação








## Comandos para colocar no console para facilitar o uso
 
  php artisan serve  [ ativa o browser para acessar o sistema em http://localhost:8000]

  npm run dev [faz a alteração automaticamente a cada salvamento]

## Comandos para criar novas tabelas CRUD
  
  php artisan make:model Cliente -mcr

  =>serão criados os arquivos:    INFO  Model [C:\Users\Givanildo\laravel\clientes\app\Models\Cliente.php] created successfully.
                                INFO  Migration [C:\Users\Givanildo\laravel\clientes\database\migrations/2025_03_13_113030_create_clientes_table.php] created successfully.  
                                INFO  Controller [C:\Users\Givanildo\laravel\clientes\app\Http\Controllers\ClienteController.php] created successfully.  

  => altere as tabelas e faça o relacionamento

  php artisan migrate



# GIT 🎯

## Roteiro para manter código atualizado entre dois ambientes (casa e trabalho)

▶️ 1. Configuração inicial (apenas uma vez)

No PC de casa e no PC do trabalho:

Clone o repositório remoto no seu computador (caso ainda não tenha feito isso):

git clone https://github.com/seu-usuario/seu-repositorio.git


▶️2. Fluxo diário de trabalho

 Puxe as atualizações do repositório remoto antes de começar a programar:

git pull origin main [Isso garante que você esteja trabalhando com a versão mais recente do código.]

Faça suas alterações no código 

Adicione os arquivos modificados ao Git:

git add .    [Isso adiciona todas as alterações ao controle de versão.]

Faça um commit com uma mensagem descritiva:
git commit -m "Implementação da funcionalidade X"

Envie as mudanças para o repositório remoto:
git push origin main


## Dicas Extras
Se estiver trabalhando em uma nova funcionalidade, crie uma branch específica:

git checkout -b nova-feature


Depois, ao finalizar, mescle com a branch principal:

** git checkout main

** git merge nova-feature

** git push origin main

Use git status frequentemente para verificar o estado do repositório:

** git status

