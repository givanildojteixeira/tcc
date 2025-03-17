<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## GIT
git init
git config --global user.email "givanildo@guarachevrolet.com.br"
git config --global user.name "givanildojteixeira"
git commit -m "first commit"


## Comandos para colocar no console para facilitar o uso
 
  //ativa o browser para acessar o sistema em http://localhost:8000
  php artisan serve   

  //faz a alteração automaticamente a cada salvamento
  npm run dev

  ## Comandos para criar novas tabelas CRUD
  php artisan make:model Cliente -mcr
  =>serão criados os arquivos:    INFO  Model [C:\Users\Givanildo\laravel\clientes\app\Models\Cliente.php] created successfully.
                                INFO  Migration [C:\Users\Givanildo\laravel\clientes\database\migrations/2025_03_13_113030_create_clientes_table.php] created successfully.  
                                INFO  Controller [C:\Users\Givanildo\laravel\clientes\app\Http\Controllers\ClienteController.php] created successfully.  
  => altere as tabelas e faça o relacionamento
  php artisan migrate



 ## Roteiro para manter código atualizado entre dois ambientes (casa e trabalho)
1. Configuração inicial (apenas uma vez)
No PC de casa e no PC do trabalho:
Clone o repositório remoto no seu computador (caso ainda não tenha feito isso):
git clone https://github.com/seu-usuario/seu-repositorio.git

Entre no diretório do repositório:
cd seu-repositorio

Confirme que o repositório remoto está configurado corretamente:
git remote -v
Se necessário, adicione o repositório remoto:
git remote add origin https://github.com/seu-usuario/seu-repositorio.git

2. Fluxo diário de trabalho
▶️ Programando em casa
Puxe as atualizações do repositório remoto antes de começar a programar:
git pull origin main
Isso garante que você esteja trabalhando com a versão mais recente do código.

Faça suas alterações no código 🎯

Adicione os arquivos modificados ao Git:
git add .
Isso adiciona todas as alterações ao controle de versão.

Faça um commit com uma mensagem descritiva:
git commit -m "Implementação da funcionalidade X"

Envie as mudanças para o repositório remoto:
git push origin main


## Dicas Extras
Se estiver trabalhando em uma nova funcionalidade, crie uma branch específica:
git checkout -b nova-feature

Depois, ao finalizar, mescle com a branch principal:
git checkout main
git merge nova-feature
git push origin main

Caso haja conflitos no git pull, resolva manualmente e continue o fluxo.

Use git status frequentemente para verificar o estado do repositório:
git status

