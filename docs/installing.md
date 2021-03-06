# Installing

### All-in-one Installation

If you're looking for an easy way to get started with installing Office Forge on your own server, take a look at [our installation process](https://github.com/noahheck/office-forge-install) which can install and configure your Office Forge server with ease. Check out the project for more details!

### Setting up your own server

We build and distribute Office Forge on top of the Laravel application framework. In order to install and run the application, you should have a server set up with:

- PHP (version 7.2 or later)
- MySQL (version 5.7 or later)
- HTTP server capable of processing php (e.g., Apache, Nginx)

You can follow [this tutorial from Digital Ocean](https://www.digitalocean.com/community/tutorials/how-to-install-linux-apache-mysql-php-lamp-stack-on-ubuntu-20-04) to configure an installation of Ubuntu 20.04 with the needed technologies.

In addition, you'll need to have:

- Composer - available from [getcomposer.org](getcomposer.org)
- git

In order to deliver the application to your staff, you'll also need to have the server be accessible by them. If delivered over the Internet, this might include paid hosting with a managed IP service, including DNS.

### Clone the application to the web server

Navigate to the root of your web servers files and using `git`, clone the repository to your web server:

```
git clone git@github.com:noahheck/office-forge
```

This will clone the application to a folder called "office-forge" in your current working directory.

Configure the document root of your web server to the `public` directory of the cloned repository.

Change your working directory to the directory you cloned the application into:

```bash
cd office-forge
```

Using `composer`, install the project's dependencies:

```bash
/path/to/composer install
``` 

Make a copy of the `.env.example` file:

```bash 
cp .env.example .env
``` 

Generate a unique application key for your Office Forge installation:

```bash
php ./artisan key:generate
```

Using your text editor (e.g., nano, emacs, vim), edit the new `.env` file to configure your environment. In particular, make sure to set appropriate values for:

- `APP_URL` - the url your staff will use to access the application (e.g., demo.officeforge.net)
- `DB_DATABASE` - the name of your database
- `DB_USERNAME` - username for your database user
- `DB_PASSWORD` - password for your database user

After the configuration has been completed, execute the application's database migrations:

```bash
php ./artisan migrate
``` 

The rest of the server installation process is performed via a setup wizard accessible through the web browser. Generate a setup auth key and provide it to the wizard to complete the setup:

```bash
php ./artisan of:generate-setup-key
```

### Updating

Following the Office Forge release schedule, you'll periodically need to update the application code for your installation of Office Forge. To do this, navigate to the root of your project and update the code using `git`:

```bash
git pull
```

Then, execute any new database migrations:

```bash
php ./artisan migrate
```

