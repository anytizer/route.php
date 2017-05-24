# route.php

Simple PHP/Apache routing

 * Intended to be of very small footprint.
 * Supports parsing in specific ways.
 * Drop in creation of APIs.
 * Wrapping output in an envelope with success status.
 * GET and POST data to be supplied extra.
 * Source code documented.

## URL Patterns:

 * http://routes.example.com:9090/
 * http://routes.example.com:9090/office/
 * http://routes.example.com:9090/office/notes
 * http://routes.example.com:9090/office/notes/add
 * http://routes.example.com:9090/office/notes/delete/7

## Parameters

    /Package/Controller/Method/Data

