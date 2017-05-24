<?php
namespace office;

/**
 * Pacakged controller
 *
 * Class OfficeController
 * @package office
 */
abstract class OfficeController
{
    abstract public function indexAction();
    abstract public function addAction();
    abstract public function editAction();
    abstract public function deleteAction();
}