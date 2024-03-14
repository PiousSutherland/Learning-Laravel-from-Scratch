# Lesson summaries

---

## 1: An Animated Introduction to MVC
Learnt: Basic structure to MVC.
Using the routes/web.php file, you will 
> Route::get('/path/here', [GenericController::class, 'methodCalled']);
This will call a ***Controller*** where all necessary database interactions will be specified.
The 'rules' for the interaction are defined by the ***Model***.
The ***Controller*** will then pass all necessary data to the ***View*** for the user to see.

----

## 1. Initial Environment Setup and Composer
### 3 prerequisites: editor, terminal and tools needed for project (MySQL, PHP, Composer etc.)
Laravel documentation was mentioned, but mostly focused on Mac desktops: [Brew](https://brew.sh) and [Sail](https://laravel.com/docs/10.x#sail-on-macos).
[Docker](https://www.docker.com/products/docker-desktop/) was mentioned as well.
[Composer](https://getcomposer.org) was installed + composer.phar installed globally. (On Windows, run:
> where composer.phar
and it should show, even if you are in your C:\Users\{user} home directory)
> composer create-project laravel/laravel app-name
to start new project.
> php artisan serve
in you project directory to host locally.

----

## 1. The Laravel Installer Tool
> composer global require laravel/installer
To allow you to run
> laravel new app-name
You have to add the following to to your PATH variable:
> __~/.composer/vendor/bin/laravel__ 
(use the full path name)
On Windows: Win key->search 'cpanel'->enter->search 'system variables'->edit->Advanced->Environment variables->PATH->edit
Add the directory there and save without changing anything else

----

## 1. Why do We Use Tools?
> ...we learn tools because they help us accomplish something or they help us solve a particular problem you have.
The problem for this lecture series is creating a functional blog

## 1.