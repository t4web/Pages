<?php

namespace T4webPages\Controller\Console;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Ddl;
use Zend\Db\Sql\Ddl\Column;
use Zend\Db\Sql\Ddl\Constraint;
use Zend\Db\Sql\Sql;
use PDOException;

class InitController extends AbstractActionController {

    /**
     * @var Adapter
     */
    private $dbAdapter;

    public function __construct(Adapter $dbAdapter){
        $this->dbAdapter = $dbAdapter;
    }

    public function runAction() {

        $this->createTablePages();

        return "Success completed" . PHP_EOL;
    }

    private function createTablePages() {
        $table = new Ddl\CreateTable('pages');

        $id = new Column\Integer('id');
        $id->setOption('AUTO_INCREMENT', 1);
        $table->addColumn($id);
        $table->addColumn(new Column\Varchar('title', 255));
        $table->addColumn(new Column\Text('body'));
        $table->addColumn(new Column\Datetime('dt_created'));
        $table->addColumn(new Column\Datetime('dt_updated'));

        $table->addConstraint(new Constraint\PrimaryKey('id'));

        $sql = new Sql($this->dbAdapter);

        try {
            $this->dbAdapter->query(
                $sql->buildSqlString($table),
                Adapter::QUERY_MODE_EXECUTE
            );
        } catch (PDOException $e) {
            return $e->getMessage() . PHP_EOL;
        }
    }

}
