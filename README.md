WeWork Meetupator
====================

The WeWork Members Network offers a powerful way of creating events that will take place in each WeWork building...
and guess what? At Meetup we create events!

With the WeWork Meetupator™ you are able to link a WeWork building to a Meetup account.
Every new event created on the WeWork Members Network will be published on Meetup as Meetup Event.

# Behind the scene

WeWork Meetupator™ is built on top of the following technologies:
- [Docker](https://www.docker.com/) (let you build and run the application anywhere)
- [Nginx](https://nginx.org/en/) (as web server)
- [Mysql](https://www.mysql.com/) (as database, store info related to WeWork buildings and Meetup groups)
- [PHP](http://www.php.net/) (as the main language)
- [Symfony](https://symfony.com/) (as PHP framework)
- [Webpack](https://webpack.js.org/) (as asset manager)
- [Twig](https://twig.symfony.com/) (as template engine)
- Coffee (a lot!)

# Setup

First time simply run:

```bash
./setup.sh start
```

Check what you can also do with:

```bash
./setup.sh help
```

WeWork Meetupator™ is built on top of _Docker_, after the first setup you can use `docker-composer` to manage your containers.

# Live in your browser

Add the following lines in your `/etc/hosts` file.

```
127.0.0.1 www.meetupator.dev
```