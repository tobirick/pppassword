<?php


use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class AddUsersTable extends AbstractMigration
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
        $users = $this->table('users');
        $users
            ->addColumn('email', 'string', ['limit' => 100])
            ->addColumn('username', 'string', ['limit' => 255])
            ->addColumn('password', 'string', ['limit' => 255])
            ->addColumn('password_reset_token', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('password_reset_expiry_date', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('created_at', 'timestamp', ['null' => false, 'default' => '0000-00-00 00:00:00'])
            ->addColumn('updated_at', 'timestamp', ['null' => false, 'default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('last_login', 'timestamp', ['null' => false, 'default' => '0000-00-00 00:00:00'])
            ->addIndex(['email', 'username'], ['unique' => true])
            ->create();
    }
}
