<?php
class Term extends AppModel{
var $name = 'Term';
    function __construct() {
        $id = array("id"=>false,
                    "table"=>"wp_terms",//テーブル名
                   );
        parent::__construct($id);
	$this->primaryKey = 'term_id';
    }
	
}
?>