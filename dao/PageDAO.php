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
            'SELECT name, link, path, icon, numorder
                      FROM page
					  ORDER BY numorder'
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
     * @return array
     */
    public function getNumorders()
    {
        $numorders = array();
        $req = $this->pdo->prepare(
            'SELECT numorder
                      FROM page
					  ORDER BY numorder'
        );
        $req->execute();
		
		$numorders = $req->fetchAll();
            
        $req->closeCursor();

        return $numorders;
    }

    /**
     * @param $name
     * @return Page
     */
    public function getPageByName($name)
    {
        $page = new Page();

        $req = $this->pdo->prepare(
            'SELECT name, link, path, icon, numorder, content, style
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
            'SELECT name, link, path, icon, numorder, content, style
                      FROM page 
                      WHERE numorder = (SELECT MIN(numorder) FROM page)');
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
            'SELECT name, link, path, icon, numorder, content, style
                      FROM page 
                      WHERE numorder = (SELECT MAX(numorder) FROM page)');
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
            'INSERT INTO page (name, link, path, icon, numorder, content, style) 
                      VALUES (:name, :link, :path, :icon, :numorder, :content, :style)'
        );
        $req->bindParam(':name', $page->name, PDO::PARAM_STR);
		$req->bindParam(':link', $page->name, PDO::PARAM_STR);
        $req->bindParam(':path', $page->path, PDO::PARAM_STR);
		$req->bindParam(':icon', $page->icon, PDO::PARAM_STR);
		$req->bindParam(':numorder', $page->numorder, PDO::PARAM_INT);
        $req->bindParam(':content', $page->content, PDO::PARAM_STR);
        $req->bindParam(':style', $page->style, PDO::PARAM_STR);
        $req->execute();

        return $page;
    }

    public function updatePage(Page $page)
    {
        if ($page->name != null) {
            $req = $this->pdo->prepare(
                'UPDATE page SET 
                          name = :name,
						  link = :link,
                          path = :path,
						  icon = :icon,
						  numorder = :numorder,
                          content = :content,
						  style = :style
                          WHERE name = :name'
            );
            $req->bindParam(':name', $page->name, PDO::PARAM_STR);
			$req->bindParam(':link', $page->name, PDO::PARAM_STR);
			$req->bindParam(':path', $page->path, PDO::PARAM_STR);
			$req->bindParam(':icon', $page->icon, PDO::PARAM_STR);
			$req->bindParam(':numorder', $page->numorder, PDO::PARAM_INT);
			$req->bindParam(':content', $page->content, PDO::PARAM_STR);
			$req->bindParam(':style', $page->style, PDO::PARAM_STR);
            $req->execute();
        }
        return $page;
    }

    public function updateNumorders($pages)
    {
        foreach ($pages as $page) {
            if ($page->name != null) {
                $req = $this->pdo->prepare(
                    'UPDATE page SET 
						  numorder = :numorder
                          WHERE name = :name'
                );
                $req->bindParam(':name', $page->name, PDO::PARAM_STR);
                $req->bindParam(':numorder', $page->numorder, PDO::PARAM_INT);
                $req->execute();
            }
        }
        return $pages;
    }

    public function deletePage($name)
    {
        $req = $this->pdo->prepare(
            'DELETE FROM page 
                      WHERE name = :name'
        );
        $req->bindParam(':name', $name, PDO::PARAM_INT);
        return $req->execute();
    }
}