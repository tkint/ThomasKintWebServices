<?php
/**
 * Created by PhpStorm.
 * User: tkint
 * Date: 02/08/2017
 * Time: 22:10
 */

namespace dao;

use PDO;
use model\Link;

/**
 * Class LinkDAO
 * @package dao
 */
class LinkDAO
{
    /**
     * @var PDO
     */
    private $pdo;

    /**
     * BookDAO constructor.
     */
    public function __construct()
    {
        $this->pdo = Connection::getInstance()->getPdo();
    }

    /**
     * @return array
     */
    public function getLinks()
    {
        $links = array();
        $req = $this->pdo->prepare(
            'SELECT id_link, id_page, name, target, icon, fa
                      FROM link'
        );
        $req->execute();

        $link = null;
        while ($link = $req->fetchObject(Link::class)) {
            $links[] = $link;
        }

        $req->closeCursor();

        return $links;
    }

    /**
     * @param $id_link
     * @return Link
     */
    public function getLinkById($id_link)
    {
        $link = new Link();

        $req = $this->pdo->prepare(
            'SELECT id_link, id_page, name, target, icon, fa
                      FROM link 
                      WHERE id_link = :id_link'
        );
        $req->bindParam(':id_link', $id_link, PDO::PARAM_INT);
        $req->execute();

        if (($a = $req->fetchObject(Link::class)) !== false) {
            $link = $a;
        }

        $req->closeCursor();

        return $link;
    }

    /**
     * @param $id_link
     * @return Link
     */
    public function getLinkByIdPage($id_page)
    {
        $link = new Link();

        $req = $this->pdo->prepare(
            'SELECT id_link, id_page, name, target, icon, fa
                      FROM link 
                      WHERE id_page = :id_page'
        );
        $req->bindParam(':id_page', $id_page, PDO::PARAM_INT);
        $req->execute();

        if (($a = $req->fetchObject(Link::class)) !== false) {
            $link = $a;
        }

        $req->closeCursor();

        return $link;
    }

    public function getFirstLink()
    {
        $link = new Link();

        $req = $this->pdo->prepare(
            'SELECT id_link, id_page, name, target, icon, fa
                      FROM link 
                      WHERE id_link = (SELECT MIN(id_link) FROM link)');
        $req->execute();

        if (($a = $req->fetchObject(Link::class)) !== false) {
            $link = $a;
        }

        $req->closeCursor();

        return $link;
    }

    public function getLastLink()
    {
        $link = new Link();

        $req = $this->pdo->prepare(
            'SELECT id_link, id_page, name, target, icon, fa
                      FROM link 
                      WHERE id_link = (SELECT MAX(id_link) FROM link)');
        $req->execute();

        if (($a = $req->fetchObject(Link::class)) !== false) {
            $link = $a;
        }

        $req->closeCursor();

        return $link;
    }

    /**
     * @param Link $link
     * @return Link
     */
    public function createLink(Link $link)
    {
        $req = $this->pdo->prepare(
            'INSERT INTO link (id_page, name, target, icon, fa) 
                      VALUES (:id_page, :name, :target, :icon, :fa)'
        );
        $req->bindParam(':id_page', $link->id_page, PDO::PARAM_INT);
        $req->bindParam(':name', $link->name, PDO::PARAM_STR);
        $req->bindParam(':target', $link->target, PDO::PARAM_STR);
        $req->bindParam(':icon', $link->icon, PDO::PARAM_STR);
        $req->bindParam(':fa', $link->fa, PDO::PARAM_STR);
        $req->execute();

        $link->setIdLink($this->pdo->lastInsertId());

        return $link;
    }

    public function updateLink(Link $link)
    {
        if ($link->id_link != null) {
            $req = $this->pdo->prepare(
                'UPDATE link SET 
                          id_page = :id_page,
                          name = :name,
                          target = :target,
                          icon = :password,
                          fa = :fa
                          WHERE id_link = :id_link'
            );
            $req->bindParam(':id_link', $link->id_link, PDO::PARAM_INT);
            $req->bindParam(':id_page', $link->id_page, PDO::PARAM_INT);
            $req->bindParam(':name', $link->name, PDO::PARAM_STR);
            $req->bindParam(':target', $link->target, PDO::PARAM_STR);
            $req->bindParam(':icon', $link->icon, PDO::PARAM_STR);
            $req->bindParam(':fa', $link->fa, PDO::PARAM_STR);
            $req->execute();
        }
        return $link;
    }

    public function deleteLink($id_link)
    {
        $req = $this->pdo->prepare(
            'DELETE FROM link 
                      WHERE id_link = :id_link'
        );
        $req->bindParam(':id_link', $id_link, PDO::PARAM_INT);
        return $req->execute();
    }
}