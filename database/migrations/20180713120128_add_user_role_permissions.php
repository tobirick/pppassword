<?php


use Phinx\Migration\AbstractMigration;

class AddUserRolePermissions extends AbstractMigration
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
        $permissions = $this->table('permissions');
        $permissions
            ->addColumn('name', 'string', ['limit' => 255])
            ->create();

        $user_role_permissions = $this->table('user_role_permissions', ['id' => false, 'primary_key' => ['user_role_id', 'permission_id']]);
        $user_role_permissions
            ->addColumn('user_role_id', 'integer')
            ->addColumn('permission_id', 'integer')
            ->addIndex(['user_role_id', 'permission_id'])
            ->addForeignKey('user_role_id', 'user_roles', 'id', ['delete'=> 'CASCADE', 'update'=> 'NO_ACTION'])
            ->addForeignKey('permission_id', 'permissions', 'id', ['delete'=> 'CASCADE', 'update'=> 'NO_ACTION'])
            ->create();
    }
}
