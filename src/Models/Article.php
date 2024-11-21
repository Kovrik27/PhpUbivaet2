<?php

namespace App\Models;

use App\Core\Helper as h;
use App\Core\CoreModel;
use App\Core\Interfaces\ModelInterface;
use PDO;

class Article extends CoreModel implements ModelInterface
{
    protected $table;
    public array $fields = ['id', 'title', 'image', 'content'];
    public array $rules = [
        'title' => 'required',
        'image' => 'required',
        'content' => 'required'
    ];
    public array $filter = [
        'id' => 'whole_number',
        'title' => 'trim|sanitize_string',
        'image' => 'trim|sanitize_string',
        'content' => 'trim|basic_tags'
    ];
//    public function __construct(DataBase $db)
//    {
//
//    }

    /**
     * @param mixed $table
     */



    public function create(array $article)
    {
        //$this->setTable('articles');
        $sql = 'INSERT INTO  '.$this->table.' ( title, image, content) VALUES ( :title, :image, :content)';
        //h::dd( $sql);
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':title', $article['title']);
        $stmt->bindValue(':image', $article['image']);
        $stmt->bindValue(':content', $article['content']);
        $stmt->execute();
        return true;
    }


    public function update($article)
    {
        $sql = 'UPDATE '.$this->table.' SET title = :title, image = :image, content = :content WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':title', $article['title']);
        $stmt->bindValue(':image', $article['image']);
        $stmt->bindValue(':content', $article['content']);
        $stmt->bindValue(':id', $article['id']);
        $stmt->execute();
        return true;

    }

    public function delete($id)
    {
        $sql = 'DELETE FROM '.$this->table.' WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return true;
    }


}