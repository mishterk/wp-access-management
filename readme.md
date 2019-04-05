# How to use

<br>
<br>

## `RedirectAfterLogout`

Allows you to set where the user will end up after they log out. 

### Basic use:

```php
// set redirect url on instantiation
$redirect = new \AccessManagement\RedirectAfterLogout('http://example.com/');
$redirect->init();
```

### Slightly less basic use:

```php
$redirect = new \AccessManagement\RedirectAfterLogout('http://example.com/');
$redirect->set_redirect_url( 'http://example.com' );
$redirect->set_priority(1);
$redirect->init();
```

### In the odd case you need to disable it:

```php
$redirect->disable();
```

<br>
<br>

## `DisableAdminBar`

Allows you to disable the admin bar globally and set exclusions for particular users, roles, and capabilities. 

### To disable globally:

```php
$admin_bar = new \AccessManagement\DisableAdminBar();
$admin_bar->init();
```

### To disable for everyone except administrators:

```php
$admin_bar = new \AccessManagement\DisableAdminBar();
$admin_bar->show_for_role( 'administrator' );
$admin_bar->init();
```

### To disable for everyone except administrators and editors:

```php
$admin_bar = new \AccessManagement\DisableAdminBar();
$admin_bar->show_for_role( 'administrator' );
$admin_bar->show_for_role( 'editor' );
$admin_bar->init();
```

_…or…_

```php
$admin_bar = new \AccessManagement\DisableAdminBar();
$admin_bar->show_for_role( [ 'administrator', 'editor' ] );
$admin_bar->init();
```

### To disable for everyone except those with certain capabilities:

```php
$admin_bar = new \AccessManagement\DisableAdminBar();
$admin_bar->show_for_capability( 'manage_options' );
$admin_bar->show_for_capability( 'install_plugins' );
$admin_bar->init();
```

_…or…_

```php
$admin_bar = new \AccessManagement\DisableAdminBar();
$admin_bar->show_for_capability( [ 'install_plugins', 'manage_options' ] );
$admin_bar->init();
```

### To disable for everyone except specific user IDs:

```php
$admin_bar = new \AccessManagement\DisableAdminBar();
$admin_bar->show_for_user_id( 1 );
$admin_bar->show_for_user_id( 2 );
$admin_bar->init();
```

_…or…_

```php
$admin_bar = new \AccessManagement\DisableAdminBar();
$admin_bar->show_for_user_id( [1,2] );
$admin_bar->init();
```

### Combine any of the options as follows:

```php
$admin_bar = new \AccessManagement\DisableAdminBar();
$admin_bar->show_for_user_id( 1 );
$admin_bar->show_for_user_id( [2,3] );
$admin_bar->show_for_role( 'editor' );
$admin_bar->show_for_role( 'administrator' );
$admin_bar->show_for_role( [ 'author', 'contributor' ] );
$admin_bar->show_for_capability( 'manage_options' );
$admin_bar->show_for_capability( [ 'install_plugins', 'delete_posts' ] );
$admin_bar->init();
```