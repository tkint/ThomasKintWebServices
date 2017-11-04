<?php
/**
 * Created by PhpStorm.
 * User: tkint
 * Date: 02/08/2017
 * Time: 22:10
 */

namespace dao;

use PDO;
use model\Article;

/**
 * Class ArticleDAO
 * @package dao
 */
class ArticleDAO
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
    public function getArticles()
    {
        $articles = array();
        $req = $this->pdo->prepare(
            'SELECT id_article, id_user, title, content, creation_date, update_date, image
                      FROM article'
        );
        $req->execute();

        $o = null;
        while ($o = $req->fetchObject(Article::class)) {
            $articles[] = $o;
        }

        $req->closeCursor();

        return $articles;
    }

    /**
     * @param $id_article
     * @return Article
     */
    public function getArticleByIdArticle($id_article)
    {
        $article = new Article();

        $req = $this->pdo->prepare(
            'SELECT id_article, id_user, title, content, creation_date, update_date, image
                      FROM article 
                      WHERE id_article = :id_article'
        );
        $req->bindParam(':id_article', $id_article, PDO::PARAM_INT);
        $req->execute();

        $o = null;
        if (($o = $req->fetchObject(Article::class)) !== false) {
            $article = $o;
        }

        $req->closeCursor();

        return $article;
    }

    /**
     * @param Article $article
     * @return Article
     */
    public function createArticle(Article $article)
    {
        $req = $this->pdo->prepare(
            'INSERT INTO article (id_user, title, content, creation_date, update_date, image) 
                      VALUES (:id_user, :title, :content, :creation_date, :update_date, :image)'
        );
        $req->bindParam(':id_user', $article->id_user, PDO::PARAM_STR);
        $req->bindParam(':title', $article->title, PDO::PARAM_STR);
        $req->bindParam(':content', $article->content, PDO::PARAM_STR);
        $req->bindParam(':creation_date', $article->creation_date, PDO::PARAM_STR);
        $req->bindParam(':update_date', $article->update_date, PDO::PARAM_STR);
        $req->bindParam(':image', $article->image, PDO::PARAM_STR);
        $req->execute();

        return $article;
    }

    public function updateArticle(Article $article)
    {
        if ($article->id_article != null) {
            $req = $this->pdo->prepare(
                'UPDATE article SET 
                          id_user = :id_user,
						  title = :title,
                          content = :content,
						  creation_date = :creation_date,
						  update_date = :update_date,
						  image = :image
                          WHERE id_article = :id_article'
            );
            $req->bindParam(':id_article', $article->id_article, PDO::PARAM_INT);
            $req->bindParam(':id_user', $article->id_user, PDO::PARAM_STR);
            $req->bindParam(':title', $article->title, PDO::PARAM_STR);
            $req->bindParam(':content', $article->content, PDO::PARAM_STR);
            $req->bindParam(':creation_date', $article->creation_date, PDO::PARAM_STR);
            $req->bindParam(':update_date', $article->update_date, PDO::PARAM_STR);
            $req->bindParam(':image', $article->image, PDO::PARAM_STR);
            $req->execute();
        }
        return $article;
    }

    public function deleteArticle($id_article)
    {
        $req = $this->pdo->prepare(
            'DELETE FROM article 
                      WHERE id_article = :id_article'
        );
        $req->bindParam(':id_article', $id_article, PDO::PARAM_INT);
        return $req->execute();
    }
}