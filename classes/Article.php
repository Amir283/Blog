<?php

class Article
{

    public $id;

    public $title;

    public $content;

    public $published_at;

    public $errors = []; // validation errors array


    //  get all the articles (as associative array). parameter: $conn - connection to the database
    public static function getAll($conn) 
    {
        $sql = "SELECT *
                FROM article
                ORDER BY published_at;";

        $results = $conn->query($sql);

        return $results->fetchAll(PDO::FETCH_ASSOC); // fetchAll() - "empty array is returned if there are zero results to fetch"
    }


    //get the article based on the ID, returns the article as an object of this class or null if not found
    public static function getByID($conn, $id)
    {
        $sql = "SELECT *
                FROM article
                WHERE id = :id"; 

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Article'); // set mode to return an object (the article is an object with the properties of id, title etc)

        if ($stmt->execute()) { // execute() returns true if worked ok (and of course false if not)

            return $stmt->fetch();

        }
    }


    // get the article record based on the ID along with associated categories (if any). 
    // return associative array of the article data with categories.

    public static function getWithCategories($conn, $id)
    {
        $sql = "SELECT article.*, category.name AS category_name
                FROM article
                LEFT JOIN article_category
                ON article.id = article_category.article_id
                LEFT JOIN category
                ON article_category.category_id = category.id
                WHERE article.id = :id"; 

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    
    // update the article with its current property values. return true if the update was successful, false if not
     
    public function update($conn)
    {
        if ($this->validate()) { // validate() will return true if it was valtidated ok (without errors)

            $sql = "UPDATE article
                    SET title = :title,
                        content = :content,
                        published_at = :published_at
                    WHERE id = :id";

            $stmt = $conn->prepare($sql);

            $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
            $stmt->bindValue(':title', $this->title, PDO::PARAM_STR);
            $stmt->bindValue(':content', $this->content, PDO::PARAM_STR);

            if ($this->published_at == '') {
                $stmt->bindValue(':published_at', null, PDO::PARAM_NULL);
            } else {
                $stmt->bindValue(':published_at', $this->published_at, PDO::PARAM_STR);
            }

            return $stmt->execute();

        } else { // if the validate function returns errors - i'll not update and just return false 
            return false;  
        }
    }

    
    // validate the properties, putting any validation error messages in the $errors property-array.
    // return true if the current properties are valid, false if not.
    // checks better than "required" att in html-form-tag, and makes it easier to display the other 'filled-ok' fields while presenting the error of the empty or problematic field 
    
    protected function validate()
    {
        if ($this->title == '') {
            $this->errors[] = 'title is required';
        }
        if ($this->content == '') {
            $this->errors[] = 'Content is required';
        }

        return empty($this->errors); // i'll return 'true' if there are no errors (the 'errors' array is empty)
    }



    // delete the current article. returns true if the delete was successful, false if not

    public function delete($conn)
    {
        $sql = "DELETE FROM article
                WHERE id = :id";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    

    // insert a new article with its current property values. return true if the insert was successful, false if not

    public function create($conn)
    {
        if ($this->validate()) {

            $sql = "INSERT INTO article (title, content, published_at)
                    VALUES (:title, :content, :published_at)";

            $stmt = $conn->prepare($sql);

            $stmt->bindValue(':title', $this->title, PDO::PARAM_STR);
            $stmt->bindValue(':content', $this->content, PDO::PARAM_STR);

            if ($this->published_at == '') {
                $stmt->bindValue(':published_at', null, PDO::PARAM_NULL);
            } else {
                $stmt->bindValue(':published_at', $this->published_at, PDO::PARAM_STR);
            }

            if ($stmt->execute()) {
                $this->id = $conn->lastInsertId(); // assigning to the new article-object its id. (with lastinsertid function i can know what was the id that was created automatically by the DB). 
                return true;
            }

        } else {
            return false;
        }
    }
}
