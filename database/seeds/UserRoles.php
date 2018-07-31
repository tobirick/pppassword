<?php


use Phinx\Seed\AbstractSeed;

class UserRoles extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $admin_role = [
            'name' => 'Administrator',
            'is_admin' => 1
        ];

        $user_roles = $this->table('user_roles');
        $user_roles->insert($admin_role)
            ->save();
    }
}
