<?php
namespace office;

class NotesController extends OfficeController
{
    public function indexAction()
    {
        // http://routes.example.com:9090/office/notes
        // http://routes.example.com:9090/office/notes/
        // http://routes.example.com:9090/office/notes?some=thing
        return "Notes - Notes Index Action found! Do something!";
    }

    public function addAction()
    {
        // src/notes/add
        // http://routes.example.com:9090/office/notes/add
        return "Notes - Add action called";
    }

    public function deleteAction()
    {
        // src/notes/delete/7
        // http://routes.example.com:9090/office/notes/delete/8
        return "Notes - Delete action called";
    }
}