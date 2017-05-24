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


## Proudly made with

 * [PHPStorm](https://www.jetbrains.com/phpstorm/download/)
 * [Notepad++](https://notepad-plus-plus.org/)
