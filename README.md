# cakephp3-base64-email
CakePHP3 extension to encode the message body with Base64.

# Requirements

- CakePHP 3.1.x

# Installation

```
composer require oh-sky/cakephp3-base64-email
```

# Example

```
<?php
namespace App\Shell;

use Cake\Console\Shell;
use OhSky\Cakephp3Base64Email;

class MailShell extends Shell
{

    public function main()
    {
        $email = new Cakephp3Base64Email();
        $mail = $email->from('from@example.com')
                      ->to('to@example.com')
                      ->subject('subject')
                      ->send('Hello');
    }
}
```

# Test

```
git clone git@github.com:oh-sky/cakephp3-base64-email.git cakephp3-base64-email
cd cakephp3-base64-email
composer install --dev
./vendor/bin/phpunit --bootstrap vendor/autoload.php tests
```
