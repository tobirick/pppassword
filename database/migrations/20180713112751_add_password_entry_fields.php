<?php


use Phinx\Migration\AbstractMigration;

class AddPasswordEntryFields extends AbstractMigration
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
        $password_record_entry_fields = $this->table('password_record_entry_fields');
        $password_record_entry_fields
            ->addColumn('password_record_id', 'integer')
            ->addColumn('field_key', 'string', ['limit' => 255])
            ->addColumn('field_value', 'string', ['limit' => 255])
            ->addIndex(['password_record_id'])
            ->addForeignKey('password_record_id', 'password_records', 'id', ['delete'=> 'CASCADE', 'update'=> 'NO_ACTION'])
            ->create();
    }
}
