<?php


use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class AddUserRoles extends AbstractMigration
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
        $user_roles = $this->table('user_roles');
        $user_roles
            ->addColumn('name', 'string', ['limit' => 255])
            ->addColumn('is_admin', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'default' => 0])
            ->create();

        $users = $this->table('users');
        $users
            ->addColumn('user_role_id', 'integer')
            ->addIndex(['user_role_id'])
            ->addForeignKey('user_role_id', 'user_roles', 'id', ['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION'])
            ->update();
    }
}
