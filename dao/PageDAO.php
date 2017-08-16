<?php
/**
 * Created by PhpStorm.
 * User: tkint
 * Date: 02/08/2017
 * Time: 22:10
 */

namespace dao;

use PDO;
use model\Page;

/**
 * Class PageDAO
 * @package dao
 */
class PageDAO
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
    public function getPages()
    {
        $pages = array();
        $req = $this->pdo->prepare(
            'SELECT id_page, name, path
                      FROM page'
        );
        $req->execute();

        $page = null;
        while ($page = $req->fetchObject(Page::class)) {
            $pages[] = $page;
        }

        $req->closeCursor();

        return $pages;
    }

    /**
     * @param $id_page
     * @return Page
     */
    public function getPageById($id_page)
    {
        $page = new Page();

        $req = $this->pdo->prepare(
            'SELECT id_page, name, path, content
                      FROM page 
                      WHERE id_page = :id_page'
        );
        $req->bindParam(':id_page', $id_page, PDO::PARAM_INT);
        $req->execute();

        if (($p = $req->fetchObject(Page::class)) !== false) {
            $page = $p;
        }

        $req->closeCursor();

        return $page;
    }

    /**
     * @param $name
     * @return Page
     */
    public function getPageByName($name)
    {
        $page = new Page();

        $req = $this->pdo->prepare(
            'SELECT id_page, name, path, content
                      FROM page 
                      WHERE name = :name'
        );
        $req->bindParam(':name', $name, PDO::PARAM_STR);
        $req->execute();

        if (($p = $req->fetchObject(Page::class)) !== false) {
            $page = $p;
        }

        $req->closeCursor();

        return $page;
    }

    public function getFirstPage()
    {
        $page = new Page();

        $req = $this->pdo->prepare(
            'SELECT id_page, name, path, content
                      FROM page 
                      WHERE id_page = (SELECT MIN(id_page) FROM page)');
        $req->execute();

        if (($a = $req->fetchObject(Page::class)) !== false) {
            $page = $a;
        }

        $req->closeCursor();

        return $page;
    }

    public function getLastPage()
    {
        $page = new Page();

        $req = $this->pdo->prepare(
            'SELECT id_page, name, path, content
                      FROM page 
                      WHERE id_page = (SELECT MAX(id_page) FROM page)');
        $req->execute();

        if (($p = $req->fetchObject(Page::class)) !== false) {
            $page = $p;
        }

        $req->closeCursor();

        return $page;
    }

    /**
     * @param Page $page
     * @return Page
     */
    public function createPage(Page $page)
    {
        $req = $this->pdo->prepare(
            'INSERT INTO page (name, path, content) 
                      VALUES (:name, :path, :content)'
        );
        $req->bindParam(':name', $page->name, PDO::PARAM_STR);
        $req->bindParam(':path', $page->path, PDO::PARAM_STR);
        $req->bindParam(':content', $page->content, PDO::PARAM_STR);
        $req->execute();

        $page->setIdPage($this->pdo->lastInsertId());

        return $page;
    }

    public function updatePage(Page $page)
    {
        if ($page->id_page != null) {
            $req = $this->pdo->prepare(
                'UPDATE page SET 
                          name = :name,
                          path = :path,
                          content = :content
                          WHERE id_page = :id_page'
            );
            $req->bindParam(':id_page', $page->id_page, PDO::PARAM_INT);
            $req->bindParam(':name', $page->name, PDO::PARAM_STR);
            $req->bindParam(':path', $page->path, PDO::PARAM_STR);
            $req->bindParam(':content', $page->content, PDO::PARAM_STR);
            $req->execute();
        }
        return $page;
    }

    public function deletePage($id_page)
    {
        $req = $this->pdo->prepare(
            'DELETE FROM page 
                      WHERE id_page = :id_page'
        );
        $req->bindParam(':id_page', $id_page, PDO::PARAM_INT);
        return $req->execute();
    }
}