# Niagahoster Test application Box Billing

### Run with Docker
<a href="https://www.docker.com/"><img align="right" src="https://www.docker.com/sites/default/files/d8/styles/role_icon/public/2019-07/horizontal-logo-monochromatic-white.png" alt="Docker logo" width="125"></a>

This guide assumes you already have [Docker](https://docs.docker.com/get-docker/) installed.

# BoxBilling on Docker - Step by Step

Here we will document everything required to run BoxBilling on Docker.
**TLDR**; Jump to **Running Prebuild Installation** section to get this docker run on your machine.

## Prerequisites

- Docker Desktop or Docker CLI with Docker Compose installed. Follow this [instructions](https://www.docker.com/get-started) to have Docker on your machine.
- An account on BoxBilling for acquiring product key and download application. Register one [here](https://www.boxbilling.com/login) if you don't have one already.

## Step by Step BoxBilling on Docker Creation

- Download [BoxBilling latest release](https://github.com/boxbilling/boxbilling/releases/) and while downloading get your license key [here](https://www.boxbilling.com/order)
- Make a folder named `boxbilling` and extract downloaded BoxBilling into public folder inside
- Copy `bb-config-sample.php` to `bb-config.php`
- Create `.env` file inside public folder and fill with
```
    DB_HOST=db
    DB_NAME=boxbilling
    DB_USER=root
    DB_PASS=123456
```
- Make `docker-files` folder on the project root, and add `nginx`, `php`, and `mysql` folders inside. These folders willl contains regular config files for Nginx, PHP, and mySQL. Some config files will be copied to docker image and other will be read anytime Docker Compose started up.
- Create `docker-compose.yml`, this is the server configuration file that will define containers and network configuration for our docker stack.
- Create Dockerfile` for PHP, Nginx, and Mysql image builder.

- Now run `docker compose up -d` and let docker build images and containers.
- Once containers up and ready go to (http://localhost/install/).
- On preparation tab, ensure if all prerequisites are labeled with green, check agree and press NEXT.
- On database tab enter all fields with all of our credetials above.
- On Administrator tab fill in all fields. For example, our installation values are:
```
    NAME : admin
    Email : admin@mail.com
    Password : 123456
```
- Installation are done and we should remove `/var/www/public/install` folder, change `/var/www/public/bb-config.php` to readonly (CHMOD 644), and setup cron job `*/5 * * * * php /var/www/public/bb-cron.php` on our webserver docker entrypoint.
- To check on installation go to `http://localhost/bb-admin/staff/login` for administrator login or to `http://localhost/` to enter client area.
