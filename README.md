###Temper@CasperCoding Challenge
This shows a Retention curve  for users (weekly cohorts) as the progressed through the Onboarding Flow for Temper.

#### NOTE
i. This is done using vanilla php (No existing framework) by writing a basic framework structure that allows for Dependency Injection and routing.

ii. It also relies on using exsiting packages by using composer to pull them in.

#### Requirements
1. Ensure you have PHP 7.1+ installed in your environment
2. Make sure you have composer install in your environment

####Start the app by running
1. Navigate into parent folder and run `composer install`
2. In the parent folder, run `php -S localhost:8885 -t public/`  or any other `localhost:port-of-your-choiice` to start the server 
3. You can now visit the url in your browser: `http://localhost:8885/` or `http://localhost:the-port-you-entered-above`
4. Click `Visit Dashboard` to see the chart.




####To run test
1. Edit `ENV_VARS.php` file and provide the `BASE_URL` you used to run your server: e.g `http://localhost:8885/`
2. In the root folder: run ``vendor/bin/phpunit``  