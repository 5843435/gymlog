<?php
class Taxonomy extends AppModel{
var $name = 'Term';
    function __construct() {
        $id = array("id"=>false,
                    "table"=>"wp_term_taxonomy",//テーブル名
                   );
        parent::__construct($id);
	$this->primaryKey = 'term_taxonomy_id';
    }
	
}
?>