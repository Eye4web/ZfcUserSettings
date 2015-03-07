Eye4webZfcUserSettings
=======

Introduction
------------
This adds user settings to ZfcUser.
Examples of user settings could be:
* Does the user want newsletter
* Favourite color
* Show profile picture
* Whatever you want

Note: This module does not give the user the functionality to edit his/her settings. You have to add that functionality yourself.
The reason for this is that a setting could be a input, radio, checkbox, select, etc. So instead of taking all this into account and creating some crazy code, you have to do it yourself.

Installation
------------
#### With composer

1. Add this project composer.json:

    ```json
    "require": {
        "eye4web/zfc-user-settings": "dev-master"
    }
    ```

2. Now tell composer to download the module by running the command:

    ```bash
    $ php composer.phar update
    ```

3. Enable it in your `application.config.php` file.

    ```php
    <?php
    return array(
        'modules' => array(
            // ...
            'Eye4web\ZfcUser\Settings'
        ),
        // ...
    );
    ```

4. Create database schema(see data folder for dumps)


Usage
------------
First of all you have to create your settings. You do this by inserting a row into the settings table in your database.
Be sure to make the `id` something which is easy to read, for example `allow_email`.

There are a controller plugin and a viewhelper, both named `ZfcUserSetting`. Both takes two arguments, the setting id and an optional user object.
If no user is supplied it will use the currently logged in user.

Now all you have to do is call `$this->ZfcUserSetting('allow_email')` and you will get the user setting value.
