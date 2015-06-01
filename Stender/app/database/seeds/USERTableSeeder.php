<?php

use Faker\Factory as Faker;

// TODO Some of this code exists in HomeController
class USERTableSeeder extends Seeder {

	public function run()
	{
        // Generate default users
        $this->generateUser('Raymon', 'Bunt');
        $this->generateUser('Wybren', 'Jongstra');
        $this->generateUser('Gerjan', 'Oenen', 'van');
        $this->generateUser('Mark', 'Roelans');

        // Generate also random user accounts
        // When the config property not exists, faker creates dumber values.
		$faker = Faker::create(Config::get('app.locale'));

        for ($i = 0; $i <= 4; $i++)
        {
            $createdUserData = null;

            if($faker->boolean())
            {
                $createdUserData = $this->generateUser($faker->firstName, $faker->lastName, null, $faker->boolean(), $faker->boolean());
            }
            else
            {
                $createdUserData = $this->generateUser($faker->firstName, $faker->lastName, $faker->word, $faker->boolean(), $faker->boolean());
            }

            $this->command->info('Created random user. StudentEmail: ' . ($createdUserData['student'] ? '1' : '0') . ', Activated: ' . ($createdUserData['active'] ? '1' : '0') . ', Email: ' . $createdUserData['email'] . ', Password: ' . $createdUserData['password']);
        }
    }

    private function generateUser($firstName, $surname, $surnamePrefix = null, $isStudent = true, $isActivated = true)
    {
        // REMARK: Parameters not checked. Furthermore they are returned directly.

        $email       = $this->createEmail($firstName, $surnamePrefix, $surname, $isStudent);
        $profileUrl  = $this->createProfileUrl($firstName, $surnamePrefix, $surname);
        $displayName = $this->createDisplayName($firstName, $surnamePrefix, $surname);

        $confirmationCode = str_random(64);

        $password              = $firstName;
        $password              = Hash::make($password);
        $user                  = new User();
        $user->Email           = $email;
        $user->ActivationToken = $confirmationCode;
        $user->Password        = $password;
        $user->UserKindID      = 2;
        $user->DateCreated     = Carbon\Carbon::now();

        $userprofile                 = new UserProfile();
        $userprofile->FirstName      = $firstName;
        $userprofile->SurnamePrefix  = $surnamePrefix;
        $userprofile->Surname        = $surname;
        $userprofile->ProfileUrlPart = $this->getProfileUrlPart($profileUrl);
        $userprofile->Displayname    = $displayName;

        $userprofile->save();

        $user->UserProfileID = $userprofile->UserProfileID;
        $user->save();

        return array('active' => $isActivated, 'student' => $isStudent, 'email' => $email, 'password' => $firstName);
    }

    private function createEmail($firstName, $surnamePrefix, $surname, $isStudent)
    {
        $email = $this->createProfileUrl($firstName, $surnamePrefix, $surname) . '@';

        if($isStudent)
        {
            $email = $email . 'student.';
        }

        $email = $email . 'stenden.com';

        return $email;
    }

    private function createProfileUrl($firstName, $surnamePrefix, $surname)
    {
        if (is_null($surnamePrefix))
        {
            // Uses by default UTF-8 encoding
            return (mb_strtolower($firstName . '.' . $surname));
        }
        else
        {
            return (mb_strtolower($firstName . '.' . $surnamePrefix . '.' . $surname));
        }
    }

    private function createDisplayName($firstName, $surnamePrefix, $surname)
    {
        if (is_null($surnamePrefix))
        {
            return ($firstName . ' ' . $surname);
        }
        else
        {
            return ($firstName . ' ' . $surnamePrefix . ' ' . $surname);
        }
    }

    // TODO This code also exists in HomeController
    private function getProfileUrlPart($profileUrlPart)
    {
        // Get results
        $results = DB::table('USER_PROFILE')->select('ProfileUrlPart')->where('ProfileUrlPart', 'LIKE', $profileUrlPart . '%')->get();

        // Convert results to an array
        $profileUrlParts = array();
        for ($i = 0, $length = count($results); $i < $length; $i++)
        {
            $profileUrlParts[$i] = $results[$i]->ProfileUrlPart;
        }

        // First check the given ProfileUrlPart
        $newProfileUrlPart = $profileUrlPart;

        // Check if ProfileUrlPart already exists
        // If not generate an unique ProfileUrlPart
        // TODO Maybe speed optimisations
        $increment = 0;
        while(in_array($newProfileUrlPart, $profileUrlParts))
        {
            $increment++;
            $newProfileUrlPart = $profileUrlPart . $increment;
        }

        return $newProfileUrlPart;
    }

}