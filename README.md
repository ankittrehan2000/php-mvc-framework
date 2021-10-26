# php-mvc-framework

A barebones MVC framework created using PHP in order to learn its concepts. It uses composer to manage
third party library imports.

To start the php server:
`php -S localhost:8080`

Notes while creating the project:

Composer - dependency manager
Autoloading property defines which namespace to set and which folder it is in
Instead of . notation there is -> for accessing objects

`$_SERVER` is an array containing information such as headers, paths, and script locations.

include_once is used to just dump the entire code in the current file and so that code has access to parent
variables 

`filter_var` checks if the constant passed in as the second argument is a valid representation of the first
