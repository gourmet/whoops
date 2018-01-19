[![Build Status](https://travis-ci.org/gourmet/whoops.png?branch=master)](https://travis-ci.org/gourmet/whoops) [![Coverage Status](https://coveralls.io/repos/gourmet/whoops/badge.png?branch=master)](https://coveralls.io/r/gourmet/whoops?branch=master) [![Total Downloads](https://poser.pugx.org/gourmet/whoops/d/total.png)](https://packagist.org/packages/gourmet/whoops) [![Latest Stable Version](https://poser.pugx.org/gourmet/whoops/v/stable.png)](https://packagist.org/packages/gourmet/whoops)

# Whoops

Built to seamlessly integrate [Whoops] with [CakePHP 3].

**DEPRECATED** Use **[dereuromark/cakephp-whoops](https://github.com/dereuromark/cakephp-whoops) package** instead.


## Install

Using [Composer]:

```
composer require gourmet/whoops:~1.0
```

As this plugin only offers a Whoops handler for CakePHP, there is no need to
enable it per se. You only need to configure that handler instead of Cake's own
`ErrorHandler` by replacing the following line in `bootstrap.php`:

```php
(new ErrorHandler(Configure::read('Error')))->register();
```

with the Whoops handler:

```php
(new \Gourmet\Whoops\Error\WhoopsHandler(Configure::read('Error')))->register();
```

That's it!


## Editor
Opening the file via click in the editor is supported for most major IDEs.

Set your config as
```php
	'Whoops' => [
		'editor' => true,
	],
```
To enable it.

If you are using a VM, e.g. CakeBox, you will also need the path mapping:
```php
		'userBasePath' => 'C:\wamp\www\cakebox\Apps\my-app.local',
		'serverBasePath' => '/home/vagrant/Apps/my-app.local',
```

## License

Copyright (c)2015, Jad Bitar and licensed under [The MIT License][mit].

[CakePHP 3]:http://cakephp.org
[Composer]:http://getcomposer.org
[mit]:http://www.opensource.org/licenses/mit-license.php
[Whoops]:http://filp.github.io/whoops/
