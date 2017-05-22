<?php
namespace samples;

class NotesController extends Controller
{
    public function indexAction()
    {
        // http://localhost/angular/libraries/route.php/src/notes
        // http://localhost/angular/libraries/route.php/src/notes/
        // http://localhost/angular/libraries/route.php/src/notes/?some=thing
        return "Notes - Notes Index Action found!";
    }

    public function addAction()
    {
        // src/notes/add
        // http://localhost/angular/libraries/route.php/src/notes/add
        return "Notes - Add action called";
    }

    public function deleteAction()
    {
        // src/notes/delete/7
        // http://localhost/angular/libraries/route.php/src/notes/delete/7
        return "Notes - Delete action called";
    }
}