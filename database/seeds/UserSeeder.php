<?php

use App\Domain\Users\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $emails = [
            'calonzo@getnerdify.com',
            'carlos@getnerdify.com',
            'eli@getnerdify.com',
            'fernando@getnerdify.com',
            'gustavo@getnerdify.com',
            'hosmel@getnerdify.com',
            'jonathan@getnerdify.com',
        ];

        foreach ($emails as $email) {
            /** @var User $user */
            $user = factory(User::class)->create(
                [
                    'email' => $email,
                ]
            );
        }
    }
}
