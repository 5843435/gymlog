<?php
class Post extends AppModel{
var $name = 'Post';
    function __construct() {
        $id = array("id"=>false,
                    "table"=>"wp_posts",//テーブル名
                   );
        parent::__construct($id);
	$this->primaryKey = 'ID';
    }
	
}
?>