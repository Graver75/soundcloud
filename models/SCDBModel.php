<?php

class SCDBModel {
    protected $dbn;
    protected $tableName;
    protected $insertQuery;
    protected $uniqueField;

    public $fields;

    public function __construct($dbn) {
        $this->dbn         = $dbn;
        $this->insertQuery = $this->buildInsertQuery();
    }

    public function insert($data) {
        $this->dbn->beginTransaction();
        $stmt = $this->dbn->prepare($this->insertQuery);
        $stmt->execute($data);
        $this->dbn->commit();
    }

    public function isExists($data) {
        if (isset($data['id'])) {
            $countQuery = $this->buildSelectQuery($this->uniqueField, $data['id']);
            $stmt  = $this->dbn->query($countQuery);
            return $stmt->fetch();
        }
        return false;
    }

    protected function buildInsertQuery() {
        $fieldsPart = implode(',', $this->fields);
        $valuesPart = implode(',', array_fill(0, count($this->fields), '?'));

        //код не защищен от sql инъекции, если будет требование для этого - перепишу
        return 'INSERT INTO ' . $this->tableName . '(' . $fieldsPart . ')' . ' VALUES (' . $valuesPart .')';
    }

    protected function buildSelectQuery($field, $value) {
        //код не защищен от sql инъекции, если будет требование для этого - перепишу
        return 'SELECT id FROM  ' . $this->tableName . ' WHERE ' . $field . '=' . $value;
    }
}