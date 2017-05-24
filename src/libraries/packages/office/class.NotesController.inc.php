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

    public function listAction()
    {
        $notes = array(
            array("id" => 1, "name" => "One"),
            array("id" => 2, "name" => "Two"),
        );

        return $notes;
    }

    public function addAction()
    {
        // save to the database
        // return full row
        // src/notes/add
        // http://routes.example.com:9090/office/notes/add
        return $_POST;
        //return $_POST["data"];
        //return "Notes - Add action called";
    }

    public function editAction()
    {
        return $_POST;
    }

    public function editfailureAction()
    {
        return $_POST;
    }

    public function deleteAction()
    {
        // src/notes/delete/7
        // http://routes.example.com:9090/office/notes/delete/8
        return "Notes - Delete action called";
    }

    public function deletefailureAction()
    {
        // delete attempt (do exactly as delete successful)
        // failed

        $success = array(
            "success" => false,
        );

        return $success;
    }
}