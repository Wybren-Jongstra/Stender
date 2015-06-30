<?php

use Faker\Factory as Faker;

class USERTableSeeder extends Seeder {

    // Use faker for random data
    private $faker;

	public function run()
	{
        // When the config property not exists, faker creates dumber values.
        $this->$faker = Faker::create(Config::get('app.locale'));
        $this->$faker->seed(5102); // create always the same fake accounts/data

        // Generate default users
        $this->generateUser('Raymon', 'Bunt', null, 'test_pictures/1_wuK4hc_profile_picture_raymon.png', 2);
        $this->generateUser('Wybren', 'Jongstra', null, 'test_pictures/2_HSCT11_profile_picture_wybren.png', 1);
        $this->generateUser('Gerjan', 'Oenen', 'van', null, 'test_pictures/3_2D7qxL_profile_picture_gerjan.png', 1);
        $this->generateUser('Mark', 'Roelans', null, 'test_pictures/4_3RvTRD_profile_picture_mark.png', 1);

        // Generate also random user accounts
        for ($i = 0; $i <= 4; $i++)
        {
            $createdUserData = null;

            $educationId = $this->$faker->boolean() ? $this->$faker->numberBetween(0, DB::table('EDUCATION')->count()) : null;

            if($this->$faker->boolean())
            {
                $createdUserData = $this->generateUser($this->$faker->firstName, $this->$faker->lastName, null, null, $educationId, $this->$faker->boolean(), $this->$faker->boolean(), $this->$faker->boolean(), $this->$faker->boolean());
            }
            else
            {
                $createdUserData = $this->generateUser($this->$faker->firstName, $this->$faker->lastName, $this->$faker->word, null, $educationId, $this->$faker->boolean(), $this->$faker->boolean(), $this->$faker->boolean(), $this->$faker->boolean());
            }

            $this->command->info('Created random user. StudentEmail: ' . ($createdUserData['student'] ? '1' : '0') . ', Activated: ' . ($createdUserData['active'] ? '1' : '0') . ', Email: ' . $createdUserData['email'] . ', Password: ' . $createdUserData['password']);
        }
    }

    private function generateUser($firstName, $surname, $surnamePrefix = null, $photoUrl = null, $educationId = null, $isStudent = true, $isActivated = true, $getsBirthDay = true, $getsCity = true)
    {
        // REMARK: Parameters not checked. Furthermore they are returned directly.

        $email       = $this->createEmail($firstName, $surnamePrefix, $surname, $isStudent);
        $profileUrl  = $this->createProfileUrl($firstName, $surnamePrefix, $surname);
        $displayName = $this->createDisplayName($firstName, $surnamePrefix, $surname);

        $confirmationCode = str_random(64);

        $password              = mb_strtolower($firstName);
        $user                  = new User();
        $user->Email           = $email;
        $user->Activated       = $isActivated;
        $user->ActivationToken = $confirmationCode;
        $user->Password        = Hash::make($password);
        $user->UserKindID      = 2;
        $user->DateCreated     = Carbon\Carbon::now();

        $userprofile                 = new UserProfile();
        $userprofile->FirstName      = $firstName;
        $userprofile->SurnamePrefix  = $surnamePrefix;
        $userprofile->Surname        = $surname;
        $userprofile->ProfileUrlPart = HomeController::getProfileUrlPart($profileUrl);
        $userprofile->Displayname    = $displayName;
        $userprofile->PhotoUrl       = $photoUrl;
        $userprofile->EducationId    = $educationId;
        $userprofile->BirthDay       = $getsBirthDay ? $this->$faker->date($format = 'Y-m-d', $max = '-20 years') : null;
        $userprofile->City           = $getsCity ? $this->$faker->city : null;

        $userprofile->save();

        $user->UserProfileID = $userprofile->UserProfileID;
        $user->save();

        return array('active' => $isActivated, 'student' => $isStudent, 'email' => $email, 'password' => $password);
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

}