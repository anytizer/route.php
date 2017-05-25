# route.php

Simple PHP/Apache routing

 * Intended to be of very small footprint.
 * Embeddable
 * Parsing in specific ways.
 * Drop in creation of new APIs.
 * Wrapping output in an envelope with success status.
 * GET and POST data supplied additionally
 * Source code documented.

## URL Patterns:

 * http://routes.example.com:9090/
 * http://routes.example.com:9090/office/
 * http://routes.example.com:9090/office/notes
 * http://routes.example.com:9090/office/notes/add
 * http://routes.example.com:9090/office/notes/delete/7

## URL Parameters

    /Package/Controller/Method/Data

Example

    /Office/NotesController/DeleteAction()/7


## Configurations

### hosts file

    127.0.0.1    routes.example.com


### httpd.conf (vhosts.conf)

    Listen 9090
    LimitInternalRecursion 5
    NameVirtualHost *:9090
    LogLevel debug
    <VirtualHost *:9090>
        DocumentRoot "/htdocs/com/example/routes/src/public_html"
        ServerName routes.example.com
    </VirtualHost>


## Proudly made with

 * [PHPStorm](https://www.jetbrains.com/phpstorm/download/)
 * [Notepad++](https://notepad-plus-plus.org/)
