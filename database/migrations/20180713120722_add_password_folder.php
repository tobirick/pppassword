<?php


use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class AddPasswordFolder extends AbstractMigration
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
        $folders = $this->table('folders');
        $folders
            ->addColumn('name', 'string', ['limit' => 255])
            ->addColumn('position', 'integer')
            ->addColumn('is_client', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'default' => 0])
            ->addColumn('client_id', 'integer')
            ->addColumn('parent_id', 'integer')
            ->addColumn('created_by', 'integer')
            ->addIndex(['parent_id', 'client_id', 'created_by'])
            ->addForeignKey('created_by', 'users', 'id', ['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION'])
            ->addForeignKey('parent_id', 'folders', 'id', ['delete'=> 'CASCADE', 'update'=> 'NO_ACTION'])
            ->addForeignKey('client_id', 'clients', 'id', ['delete'=> 'CASCADE', 'update'=> 'NO_ACTION'])
            ->create();
    }
}
