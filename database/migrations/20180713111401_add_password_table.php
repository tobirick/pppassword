<?php


use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class AddPasswordTable extends AbstractMigration
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
        $password_records = $this->table('password_records');
        $password_records
            ->addColumn('title', 'string', ['limit' => 255])
            ->addColumn('url', 'string', ['limit' => 255])
            ->addColumn('username', 'string', ['limit' => 255])
            ->addColumn('password', 'string', ['limit' => 255])
            ->addColumn('email', 'string', ['limit' => 255])
            ->addColumn('notes', 'string', ['limit' => MysqlAdapter::TEXT_MEDIUM])
            ->addColumn('created_at', 'timestamp', ['null' => false, 'default' => '0000-00-00 00:00:00'])
            ->addColumn('updated_at', 'timestamp', ['null' => false, 'default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('created_by', 'integer')
            ->addIndex(['created_by'])
            ->addForeignKey('created_by', 'users', 'id', ['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION'])
            ->create();

        $password_record_clients = $this->table('password_record_clients', ['id' => false, 'primary_key' => ['password_record_id', 'client_id']]);
        $password_record_clients
            ->addColumn('password_record_id', 'integer')
            ->addColumn('client_id', 'integer')
            ->addIndex(['password_record_id', 'client_id'])
            ->addForeignKey('password_record_id', 'password_records', 'id', ['delete'=> 'CASCADE', 'update'=> 'NO_ACTION'])
            ->addForeignKey('client_id', 'clients', 'id', ['delete'=> 'CASCADE', 'update'=> 'NO_ACTION'])
            ->create();
    }
}
