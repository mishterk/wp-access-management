# How to use

## `RedirectAfterLogout`

Allows you to set where the user will end up after they log out. Basic use:

```php
// set redirect url on instantiation
$redirect = new \AccessManagement\RedirectAfterLogout('http://example.com/');
$redirect->init();
```

Slightly less basic use:

```php
$redirect = new \AccessManagement\RedirectAfterLogout('http://example.com/');
$redirect->set_redirect_url( 'http://example.com' );
$redirect->set_priority(1);
$redirect->init();
```

In the odd case you need to disable it:

```php
$redirect->disable();
```

