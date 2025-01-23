
# Mazer Navbar Template + Auth + Role & Permission


## Tech Stack

Livewire, Bootstrap 5, Alpine JS, Jquery, Font Awesome

## setup

```bash
  git clone https://github.com/aldmf26/mazer-navbar.git
  cd mazer-navbar
  cp .env.example .env
  php artisan key:generate
```
buka file .env ubah :

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```
## Installation & Run
```bash
  composer install
  npm install
  php artisan optimize:clear
  php artisan migrate --seed
  npm run dev
```
