<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Classroom;
use App\Entity\District;
use App\Entity\Questionnaire;
use App\Entity\School;
use App\Entity\SchoolYear;
use App\Entity\Student;
use App\Entity\Timeline;
use App\Enum\Gender;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Provider\Person;

class SchoolDataFixtures extends Fixture
{
    private \Faker\Generator $faker;

    public function __construct()
    {
        $this->faker = \Faker\Factory::create('cs_CZ');
    }

    public function load(ObjectManager $manager): void
    {
        // District
        $district = new District();
        $district->setName('Teplice');
        $manager->persist($district);

        // School
        $school = new School();
        $school->setName('Gymnázium Teplice');
        $school->setDistrict($district);
        $manager->persist($school);

        // Classroom
        $classroom = new Classroom();
        $classroom->setSchool($school);
        $classroom->setName('8.A');
        $manager->persist($classroom);

        // School year
        $schoolYear = new SchoolYear();
        $schoolYear->setYear('2023/2024');
        $manager->persist($schoolYear);

        // Timeline
        $timeline = new Timeline();
        $timeline->setSchoolYear($schoolYear);
        $timeline->setClassroom($classroom);
        $timeline->setActive(true);
        $manager->persist($timeline);

        // Questionnaire
        $questionnaire = new Questionnaire();
        $questionnaire->setName('Šetření 1');
        $questionnaire->setTimeline($timeline);
        $questionnaire->setPosition(1);
        $questionnaire->setFinished(false);
        $questionnaire->setType(Questionnaire::FULL_QUESTIONNAIRE);
        $questionnaire->setFillDate(new \DateTimeImmutable());
        $manager->persist($questionnaire);

        // Students
        for ($i = 0; $i < 30; $i++) {
            $student = new Student();

            if (random_int(0,1) === 0) {
                $gender = Person::GENDER_MALE;
            } else {
                $gender = Person::GENDER_FEMALE;
            }

            $student->setFirstname($this->faker->firstName($gender));
            $student->setLastname($this->faker->lastName($gender));
            $student->setEmail($this->faker->safeEmail());
            $student->setEgoId((string)$i);
            $student->setGender(Gender::tryFrom($gender));
            $classroom->addStudent($student);
            $questionnaire->addStudent($student);
            $manager->persist($student);
        }

        $manager->flush();
    }
}
