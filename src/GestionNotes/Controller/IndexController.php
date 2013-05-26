<?php
/**
 * Gestion des notes
 *
 * @copyright PTS2 Groupe 5
 * @license Redistribution interdite
 */
namespace GestionNotes\Controller;

use GestionNotes\Controller;
use GestionNotes\Model\User;
 
class IndexController extends Controller
{
    /**
     * Dit bonjour !
     */
    public function indexAction()
    {
        $model = User::fetchOneByCredentials('admin','secret');
        var_dump($model);
        return $this->renderPage('index');
    }
}