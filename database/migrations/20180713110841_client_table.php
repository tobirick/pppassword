<?php


use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class ClientTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    addCustomColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Any other destructive changes will result in an error when trying to
     * rollback the migration.
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $clients = $this->table('clients');
        $clients
            ->addColumn('name', 'string', ['limit' => 255])
            ->addColumn('notes', 'string', ['limit' => MysqlAdapter::TEXT_MEDIUM])
            ->addColumn('city', 'string', ['limit' => 255])
            ->addColumn('plz', 'string', ['limit' => 255])
            ->addColumn('street', 'string', ['limit' => 255])
            ->addColumn('email', 'string', ['limit' => 255])
            ->addColumn('phone', 'string', ['limit' => 255])
            ->addColumn('mobile_phone', 'string', ['limit' => 255])
            ->addColumn('created_at', 'timestamp', ['null' => false, 'default' => '0000-00-00 00:00:00'])
            ->addColumn('updated_at', 'timestamp', ['null' => false, 'default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('created_by', 'integer')
            ->addIndex(['created_by'])
            ->addForeignKey('created_by', 'users', 'id', ['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION'])
            ->create();
    }
}
