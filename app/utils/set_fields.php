<?php 
    function set_fields($data) {
        $fields = array_keys($data);
        $setClause = implode(" = ?, ", $fields) . " = ?";
        return $setClause;
    }
?>