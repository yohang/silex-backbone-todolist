Silex + TwigJS + Backbone.js test
==================================

This project is a simple Todo list based on Silex, twig, and backbone.js

To run it, just install the dependencies and create the db :

```sh

 $ composer install
 $ sqlite3 app.db < sql/schema.sql
 $ ./bin/console fixtures:load
 $ ./bin/console server:run

```
