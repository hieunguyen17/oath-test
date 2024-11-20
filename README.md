# LOCAL ENVIRONMENT

The project's local environment built using Laravel Sail and Docker. It consists of the following parts:

- Laravel (11.26)
- PHP (8.3.12)
- MySQL (8.0)
- Mailpit

## I. Installation

### 1. Clone project

```
git clone git@github.com:hieunguyen17/oauth-test.git
cd oauth-test
cp .env.example .env
```
### 2. Set up environment configs
Please notice to set the .env file as below:
```
APP_PORT=8000

GOOGLE_CLIENT_ID=
GOOGLE_CLIENT_SECRET=
GOOGLE_REDIRECT_URI=

FACEBOOK_CLIENT_ID=
FACEBOOK_CLIENT_SECRET=
FACEBOOK_REDIRECT_URI=

APPLE_CLIENT_ID=
APPLE_CLIENT_SECRET=
APPLE_REDIRECT_URI=

TWITTER_CLIENT_ID=
TWITTER_CLIENT_SECRET=
TWITTER_REDIRECT_URI=

LINE_CLIENT_ID=
LINE_CLIENT_SECRET=
LINE_REDIRECT_URI=
```
### 3. Install PHP dependencies
Install PHP dependencies

```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php83-composer:latest \
    composer install --ignore-platform-reqs
```

### 4. Install Docker environment via Sail

Start the Docker containers
```
./vendor/bin/sail up -d
```
You can use `sail` command instead of `./vendor/bin/sail` by adding the following line to your `~/.bashrc` or `~/.zshrc` file:

```
alias sail='sh $([ -f sail ] && echo sail || echo vendor/bin/sail)'
```

### 5. Initialize other things

Create the database and seed data

```
./vendor/bin/sail artisan migrate
./vendor/bin/sail artisan db:seed
```
Generate app key
```
./vendor/bin/sail artisan key:generate
```

### 6. Install JS packages and build JS files
```
./vendor/bin/sail npm install
./vendor/bin/sail npm run build
```
Or
```
./vendor/bin/sail yarn install
./vendor/bin/sail yarn run build
```

## II. Run the project

Open your browser and access [http://localhost:8000](http://localhost:8000)

Check mail at [http://localhost:8025](http://localhost:8025)
