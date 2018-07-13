<?php


use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class AddUserDetails extends AbstractMigration
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
        $user_details = $this->table('users_details');
        $user_details
            ->addColumn('user_id', 'integer')
            ->addColumn('first_name', 'string', ['limit' => 255])
            ->addColumn('last_name', 'string', ['limit' => 255])
            ->addColumn('city', 'string', ['limit' => 255])
            ->addColumn('plz', 'string', ['limit' => 255])
            ->addColumn('street', 'string', ['limit' => 255])
            ->addColumn('notes', 'string', ['limit' => MysqlAdapter::TEXT_MEDIUM])
            ->addIndex(['user_id'])
            ->addForeignKey('user_id', 'users', 'id', ['delete'=> 'CASCADE', 'update'=> 'NO_ACTION'])
            ->create();
    }
}
