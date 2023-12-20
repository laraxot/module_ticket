---
title: Modulo Ticket
description: Modulo Ticket
extends: _layouts.documentation
section: content
id: 1
parent_id: 0
---

# Modulo Ticket {#modulo-ticket}


The laraxot/module_ticket is a Laravel module that provides a ticket system for a Laravel-based application. It allows users to create, view, and manage tickets, as well as assign them to specific users and track their progress.

To install the module_ticket module, you can use Composer by running the following command:

Copy code
composer require laraxot/module_ticket
After installing the module, you will need to register it in your Laravel application by adding it to the providers array in the config/app.php file:

Copy code
'providers' => [
    ...
    Laraxot\ModuleTicket\ModuleTicketServiceProvider::class,
    ...
],
You can then publish the module's assets and configuration files using the following Artisan command:

Copy code
php artisan module:publish laraxot/module_ticket
This will create a config/module_ticket.php configuration file where you can customize the module's settings.

To access the module's routes, you will need to add the following line to the $middleware array in the app/Http/Kernel.php file:

Copy code
protected $middleware = [
    ...
    \Laraxot\ModuleTicket\Middleware\ModuleTicket::class,
    ...
];
You can then access the ticket system by visiting the /tickets route in your Laravel application. This route will provide a list of all the tickets in the system, as well as options to create new tickets, view and update existing ones, and assign them to specific users.

The module_ticket module provides a number of customizable features, including the ability to define custom ticket statuses and priorities, as well as customize the email notifications that are sent when a ticket is created, updated, or assigned to a user.

To use these features, you can refer to the config/module_ticket.php configuration file and the module's source code on GitHub.

Overall, the laraxot/module_ticket module provides a simple and easy-to-use ticket system for Laravel-


