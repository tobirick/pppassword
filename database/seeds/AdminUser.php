<?php


use Phinx\Seed\AbstractSeed;

class AdminUser extends AbstractSeed
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
        $admin = [
            'email' => 'tobirickmann@gmail.com',
            'username' => 'tobi',
            'password' => password_hash('testtest', PASSWORD_BCRYPT),
            'created_at' => date("Y-m-d H:i:s"),
            'user_role_id' => 1
        ];

        $users = $this->table('users');
        $users->insert($admin)
            ->save();

        $user_details = $this->table('user_details');
        $user_details->insert([
                'user_id' => 1
            ])->save();
    }
}
