<?php
    $title=strtoupper($_REQUEST['title']);
    if (strlen($title)==0)
        $title='%';
    else
        $title='%'.$title.'%';
    $sort=$_REQUEST['sort'];
    $mydb = new PDO('mysql:host=sql106.infinityfree.com;port=3306; dbname=if0_37212468_amazonia', 'if0_37212468', 'aNpojtpHLMeZ');
    $stmt=$mydb->prepare("Select book.isbn, title, author_first, author_last, ".
                      "listprice, discount, book.category_code, category_name ".
                      "from book ".
                      "inner join writes ".
                      "on book.isbn=writes.isbn ".
                      "inner join author ".
                      "on writes.authorid=author.author_id ".
                      "inner join bookcat on book.category_code=bookcat.category_code ".
                      "where upper(title) like :thetitle ".
                      "order by ".$sort.", isbn, authororder"
                      );
    $stmt->execute([":thetitle"=>$title]);
    $result=$stmt->fetchAll();
echo json_encode($result);
?>