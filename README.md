# Statamic GA Dashboard Widget

Statamic GA Dashboard is a Statamic addon that adds a Google Analytics widget to your Statamic dashboard, letting site users/owners see how much traffic is coming to their site.

## How to Install

You can search for this addon in the `Tools > Addons` section of the Statamic control panel and click **install**, or run the following command from your project root:

``` bash
composer require vineyard/statamic-ga-dashboard
```

Publish the addon's config file:

``` bash
php artisan vendor:publish --provider="Vineyard\StatamicGaDashboard\ServiceProvider"
```

This addon relies on the Spatie Laravel Analytics package and you'll need to follow their excellent [instructions on obtaining credentials to communicate with Google Analytics](https://github.com/spatie/laravel-analytics?tab=readme-ov-file#how-to-obtain-the-credentials-to-communicate-with-google-analytics).

After folling the instructions to get GA credentials, you'll need to copy the credentails file to following place. This is a file you'll want to reference in your site's .gitignore to keep it from being committed to a Git repo.

``` bash
/storage/app/analytics/service-account-credentials.json
```

You'll also have a ANALYTICS_PROPERTY_ID listed in your .env file, siilar to this:

``` bash
ANALYTICS_PROPERTY_ID=##########
```

## How to Use


Add the GA Dashboard widget to a dashboard in Statamic by changing the Dashboard Widgets config in ```config/statamic/cp``` to include the ga_traffic widget.


``` php
/*
|--------------------------------------------------------------------------
| Dashboard Widgets
|--------------------------------------------------------------------------
|
| Here you may define any number of dashboard widgets. You're free to
| use the same widget multiple times in different configurations.
|
*/

'widgets' => [
    'getting_started',
    [
        'type' => 'ga_traffic',
    ]
],
```

You can change the number of days show on the widget's chart by changing the number of days in the addon's configuration file at ```config/statamic-ga-dashboard.php```.