# Guest suite application test

After cloning the repository:

```
composer install && yarn install
```

To build css and js assets, run webpack:

```
yarn encore dev

//or using --watch to watch for file motifications
yarn encore dev --watch
```

To start the app locally:

```
symfony server:start
```



## Controllers

The app has a single controller `HomeController.php`which contains the public function **view**. A JSON file containing mock data is fetched and data arrays are sent to the template **Home/view.html.twig**.

 

## Test

To Unit test Util functions: 

```
php bin/phpunit tests/Util
```

