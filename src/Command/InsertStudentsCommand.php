<?php

declare(strict_types=1);

namespace App\Command;

use App\Entity\Student;
use App\Repository\SchoolRepository;
use App\Repository\ClassroomRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:insert-students',
    description: 'Inserts a list of students into the database.'
)]
class InsertStudentsCommand extends Command
{
    public function __construct(
        private readonly SchoolRepository       $schoolRepository,
        private readonly ClassroomRepository    $classroomRepository,
        private readonly EntityManagerInterface $entityManager
    )
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $studentsData = [
            // –- 6.A --
            [
                'school_id' => '1eec4513-382e-6e8c-abe9-47706148996e',
                'classroom_id' => '1eec4514-b8b8-6ca0-8a40-e9c677a10ff8',
                'lastname' => 'Bán',
                'firstname' => 'Jakub',
                'egoId' => 'Jakub'
            ],
            [
                'school_id' => '1eec4513-382e-6e8c-abe9-47706148996e',
                'classroom_id' => '1eec4514-b8b8-6ca0-8a40-e9c677a10ff8',
                'lastname' => 'Dömischová',
                'firstname' => 'Dominika',
                'egoId' => 'Dominika'
            ],
            [
                'school_id' => '1eec4513-382e-6e8c-abe9-47706148996e',
                'classroom_id' => '1eec4514-b8b8-6ca0-8a40-e9c677a10ff8',
                'lastname' => 'Erben',
                'firstname' => 'Vít',
                'egoId' => 'Vít'
            ],
            [
                'school_id' => '1eec4513-382e-6e8c-abe9-47706148996e',
                'classroom_id' => '1eec4514-b8b8-6ca0-8a40-e9c677a10ff8',
                'lastname' => 'Gottwaldová',
                'firstname' => 'Veronika',
                'egoId' => 'Veronika'
            ],
            [
                'school_id' => '1eec4513-382e-6e8c-abe9-47706148996e',
                'classroom_id' => '1eec4514-b8b8-6ca0-8a40-e9c677a10ff8',
                'lastname' => 'Hadrbolec',
                'firstname' => 'Šimon',
                'egoId' => 'Šimon'
            ],
            [
                'school_id' => '1eec4513-382e-6e8c-abe9-47706148996e',
                'classroom_id' => '1eec4514-b8b8-6ca0-8a40-e9c677a10ff8',
                'lastname' => 'Hanusyn',
                'firstname' => 'Jana',
                'egoId' => 'Jana'
            ],
            [
                'school_id' => '1eec4513-382e-6e8c-abe9-47706148996e',
                'classroom_id' => '1eec4514-b8b8-6ca0-8a40-e9c677a10ff8',
                'lastname' => 'Herain',
                'firstname' => 'Lukáš',
                'egoId' => 'Luky'
            ],
            [
                'school_id' => '1eec4513-382e-6e8c-abe9-47706148996e',
                'classroom_id' => '1eec4514-b8b8-6ca0-8a40-e9c677a10ff8',
                'lastname' => 'Hrabáková',
                'firstname' => 'Beata',
                'egoId' => 'Beata'
            ],
            [
                'school_id' => '1eec4513-382e-6e8c-abe9-47706148996e',
                'classroom_id' => '1eec4514-b8b8-6ca0-8a40-e9c677a10ff8',
                'lastname' => 'Hrdina',
                'firstname' => 'Matyáš',
                'egoId' => 'Matyas H'
            ],
            [
                'school_id' => '1eec4513-382e-6e8c-abe9-47706148996e',
                'classroom_id' => '1eec4514-b8b8-6ca0-8a40-e9c677a10ff8',
                'lastname' => 'Jirásková',
                'firstname' => 'Sandra',
                'egoId' => 'Sandra'
            ],
            [
                'school_id' => '1eec4513-382e-6e8c-abe9-47706148996e',
                'classroom_id' => '1eec4514-b8b8-6ca0-8a40-e9c677a10ff8',
                'lastname' => 'Josíeková',
                'firstname' => 'Karolína',
                'egoId' => 'Karolína'
            ],
            [
                'school_id' => '1eec4513-382e-6e8c-abe9-47706148996e',
                'classroom_id' => '1eec4514-b8b8-6ca0-8a40-e9c677a10ff8',
                'lastname' => 'Měchura',
                'firstname' => 'Roman',
                'egoId' => 'Roman'
            ],
            [
                'school_id' => '1eec4513-382e-6e8c-abe9-47706148996e',
                'classroom_id' => '1eec4514-b8b8-6ca0-8a40-e9c677a10ff8',
                'lastname' => 'Morawiecová',
                'firstname' => 'Emma',
                'egoId' => 'Emma'
            ],
            [
                'school_id' => '1eec4513-382e-6e8c-abe9-47706148996e',
                'classroom_id' => '1eec4514-b8b8-6ca0-8a40-e9c677a10ff8',
                'lastname' => 'Ognar',
                'firstname' => 'Alexandr',
                'egoId' => 'Alexandr'
            ],
            [
                'school_id' => '1eec4513-382e-6e8c-abe9-47706148996e',
                'classroom_id' => '1eec4514-b8b8-6ca0-8a40-e9c677a10ff8',
                'lastname' => 'Procházková',
                'firstname' => 'Nela',
                'egoId' => 'Nela'
            ],
            [
                'school_id' => '1eec4513-382e-6e8c-abe9-47706148996e',
                'classroom_id' => '1eec4514-b8b8-6ca0-8a40-e9c677a10ff8',
                'lastname' => 'Roškota',
                'firstname' => 'Jan',
                'egoId' => 'Jan'
            ],
            [
                'school_id' => '1eec4513-382e-6e8c-abe9-47706148996e',
                'classroom_id' => '1eec4514-b8b8-6ca0-8a40-e9c677a10ff8',
                'lastname' => 'Dvořák',
                'firstname' => 'Matyáš',
                'egoId' => 'Matyáš D,'
            ],
            [
                'school_id' => '1eec4513-382e-6e8c-abe9-47706148996e',
                'classroom_id' => '1eec4514-b8b8-6ca0-8a40-e9c677a10ff8',
                'lastname' => 'Sichaliev',
                'firstname' => 'Ruslan',
                'egoId' => 'Ruslan'
            ],
            [
                'school_id' => '1eec4513-382e-6e8c-abe9-47706148996e',
                'classroom_id' => '1eec4514-b8b8-6ca0-8a40-e9c677a10ff8',
                'lastname' => 'Smoláková',
                'firstname' => 'Magdalena',
                'egoId' => 'Magdalena'
            ],
            [
                'school_id' => '1eec4513-382e-6e8c-abe9-47706148996e',
                'classroom_id' => '1eec4514-b8b8-6ca0-8a40-e9c677a10ff8',
                'lastname' => 'Škop',
                'firstname' => 'David',
                'egoId' => 'David Š'
            ],
            [
                'school_id' => '1eec4513-382e-6e8c-abe9-47706148996e',
                'classroom_id' => '1eec4514-b8b8-6ca0-8a40-e9c677a10ff8',
                'lastname' => 'Štěpnička',
                'firstname' => 'Filip',
                'egoId' => 'filip'
            ],
            [
                'school_id' => '1eec4513-382e-6e8c-abe9-47706148996e',
                'classroom_id' => '1eec4514-b8b8-6ca0-8a40-e9c677a10ff8',
                'lastname' => 'Učený',
                'firstname' => 'David',
                'egoId' => 'David U'
            ],
            // –! 6.A !-

            // –- 6.B --
            [
                'school_id' => '1eec4513-382e-6e8c-abe9-47706148996e',
                'classroom_id' => '1eec4526-ceb0-6a3c-bb01-6578f286dff5',
                'lastname' => 'Babovák',
                'firstname' => 'Daniel',
                'egoId' => 'Daniel'
            ],
            [
                'school_id' => '1eec4513-382e-6e8c-abe9-47706148996e',
                'classroom_id' => '1eec4526-ceb0-6a3c-bb01-6578f286dff5',
                'lastname' => 'Bajcsi',
                'firstname' => 'Vojtěch',
                'egoId' => 'Vojtěch'
            ],
            [
                'school_id' => '1eec4513-382e-6e8c-abe9-47706148996e',
                'classroom_id' => '1eec4526-ceb0-6a3c-bb01-6578f286dff5',
                'lastname' => 'Bartoň',
                'firstname' => 'Šimon',
                'egoId' => 'šimon'
            ],
            [
                'school_id' => '1eec4513-382e-6e8c-abe9-47706148996e',
                'classroom_id' => '1eec4526-ceb0-6a3c-bb01-6578f286dff5',
                'lastname' => 'Benda',
                'firstname' => 'Jakub',
                'egoId' => 'Jakub B'
            ],
            [
                'school_id' => '1eec4513-382e-6e8c-abe9-47706148996e',
                'classroom_id' => '1eec4526-ceb0-6a3c-bb01-6578f286dff5',
                'lastname' => 'Beránková',
                'firstname' => 'Karolína',
                'egoId' => 'Karolína B'
            ],
            [
                'school_id' => '1eec4513-382e-6e8c-abe9-47706148996e',
                'classroom_id' => '1eec4526-ceb0-6a3c-bb01-6578f286dff5',
                'lastname' => 'Bodláková',
                'firstname' => 'Lucie',
                'egoId' => 'Lucie'
            ],
            [
                'school_id' => '1eec4513-382e-6e8c-abe9-47706148996e',
                'classroom_id' => '1eec4526-ceb0-6a3c-bb01-6578f286dff5',
                'lastname' => 'Brožek',
                'firstname' => 'Tobiáš',
                'egoId' => 'tobias'
            ],
            [
                'school_id' => '1eec4513-382e-6e8c-abe9-47706148996e',
                'classroom_id' => '1eec4526-ceb0-6a3c-bb01-6578f286dff5',
                'lastname' => 'Čajková',
                'firstname' => 'Ema',
                'egoId' => 'Ema'
            ],
            [
                'school_id' => '1eec4513-382e-6e8c-abe9-47706148996e',
                'classroom_id' => '1eec4526-ceb0-6a3c-bb01-6578f286dff5',
                'lastname' => 'Čurdová',
                'firstname' => 'Markéta',
                'egoId' => 'Markéta'
            ],
            [
                'school_id' => '1eec4513-382e-6e8c-abe9-47706148996e',
                'classroom_id' => '1eec4526-ceb0-6a3c-bb01-6578f286dff5',
                'lastname' => 'Heimlichová',
                'firstname' => 'Adéla',
                'egoId' => 'Adéla'
            ],
            [
                'school_id' => '1eec4513-382e-6e8c-abe9-47706148996e',
                'classroom_id' => '1eec4526-ceb0-6a3c-bb01-6578f286dff5',
                'lastname' => 'Hrabánková',
                'firstname' => 'Barbora',
                'egoId' => 'Barbora'
            ],
            [
                'school_id' => '1eec4513-382e-6e8c-abe9-47706148996e',
                'classroom_id' => '1eec4526-ceb0-6a3c-bb01-6578f286dff5',
                'lastname' => 'Kočárková',
                'firstname' => 'Gabriela',
                'egoId' => 'Gabriela'
            ],
            [
                'school_id' => '1eec4513-382e-6e8c-abe9-47706148996e',
                'classroom_id' => '1eec4526-ceb0-6a3c-bb01-6578f286dff5',
                'lastname' => 'Krinwald',
                'firstname' => 'Adam',
                'egoId' => 'Adam'
            ],
            [
                'school_id' => '1eec4513-382e-6e8c-abe9-47706148996e',
                'classroom_id' => '1eec4526-ceb0-6a3c-bb01-6578f286dff5',
                'lastname' => 'Kříž',
                'firstname' => 'Dominik',
                'egoId' => 'Dominik'
            ],
            [
                'school_id' => '1eec4513-382e-6e8c-abe9-47706148996e',
                'classroom_id' => '1eec4526-ceb0-6a3c-bb01-6578f286dff5',
                'lastname' => 'Kubeš',
                'firstname' => 'Oliver',
                'egoId' => 'Oliver'
            ],
            [
                'school_id' => '1eec4513-382e-6e8c-abe9-47706148996e',
                'classroom_id' => '1eec4526-ceb0-6a3c-bb01-6578f286dff5',
                'lastname' => 'Lazur',
                'firstname' => 'Karolina',
                'egoId' => 'Karolina L'
            ],
            [
                'school_id' => '1eec4513-382e-6e8c-abe9-47706148996e',
                'classroom_id' => '1eec4526-ceb0-6a3c-bb01-6578f286dff5',
                'lastname' => 'Lednická',
                'firstname' => 'Marie',
                'egoId' => 'Marie L'
            ],
            [
                'school_id' => '1eec4513-382e-6e8c-abe9-47706148996e',
                'classroom_id' => '1eec4526-ceb0-6a3c-bb01-6578f286dff5',
                'lastname' => 'Martynov',
                'firstname' => 'Hlieb',
                'egoId' => 'Hlieb'
            ],
            [
                'school_id' => '1eec4513-382e-6e8c-abe9-47706148996e',
                'classroom_id' => '1eec4526-ceb0-6a3c-bb01-6578f286dff5',
                'lastname' => 'Mrvík',
                'firstname' => 'Tomáš',
                'egoId' => 'Tomáš'
            ],
            [
                'school_id' => '1eec4513-382e-6e8c-abe9-47706148996e',
                'classroom_id' => '1eec4526-ceb0-6a3c-bb01-6578f286dff5',
                'lastname' => 'Pecina',
                'firstname' => 'Štěpán',
                'egoId' => 'Štěpán'
            ],
            [
                'school_id' => '1eec4513-382e-6e8c-abe9-47706148996e',
                'classroom_id' => '1eec4526-ceb0-6a3c-bb01-6578f286dff5',
                'lastname' => 'Pešková',
                'firstname' => 'Tereza',
                'egoId' => 'Tereza'
            ],
            [
                'school_id' => '1eec4513-382e-6e8c-abe9-47706148996e',
                'classroom_id' => '1eec4526-ceb0-6a3c-bb01-6578f286dff5',
                'lastname' => 'Šefčík',
                'firstname' => 'Jakub',
                'egoId' => 'Šefčík J'
            ],
            [
                'school_id' => '1eec4513-382e-6e8c-abe9-47706148996e',
                'classroom_id' => '1eec4526-ceb0-6a3c-bb01-6578f286dff5',
                'lastname' => 'Waitzmanová',
                'firstname' => 'Sofie',
                'egoId' => 'Sofie'
            ],
            // –! 6.B !-

            // –- 7.C --
            [
                'school_id' => '1eec4513-382e-6e8c-abe9-47706148996e',
                'classroom_id' => '1eec4527-6f70-6c38-9b57-73f4839ac711',
                'lastname' => 'Baloun',
                'firstname' => 'Lukáš',
                'egoId' => 'Lukáš'
            ],
            [
                'school_id' => '1eec4513-382e-6e8c-abe9-47706148996e',
                'classroom_id' => '1eec4527-6f70-6c38-9b57-73f4839ac711',
                'lastname' => 'Beran',
                'firstname' => 'Matouš',
                'egoId' => 'Matouš'
            ],
            [
                'school_id' => '1eec4513-382e-6e8c-abe9-47706148996e',
                'classroom_id' => '1eec4527-6f70-6c38-9b57-73f4839ac711',
                'lastname' => 'Dlouhý',
                'firstname' => 'Matěj',
                'egoId' => 'matěj'
            ],
            [
                'school_id' => '1eec4513-382e-6e8c-abe9-47706148996e',
                'classroom_id' => '1eec4527-6f70-6c38-9b57-73f4839ac711',
                'lastname' => 'Dvořáček',
                'firstname' => 'Šimon',
                'egoId' => 'Šimon D.'
            ],
            [
                'school_id' => '1eec4513-382e-6e8c-abe9-47706148996e',
                'classroom_id' => '1eec4527-6f70-6c38-9b57-73f4839ac711',
                'lastname' => 'Křikavová',
                'firstname' => 'Tereza',
                'egoId' => 'Tereza Křikavová'
            ],
            [
                'school_id' => '1eec4513-382e-6e8c-abe9-47706148996e',
                'classroom_id' => '1eec4527-6f70-6c38-9b57-73f4839ac711',
                'lastname' => 'Kupčík',
                'firstname' => 'Kamil',
                'egoId' => 'Kamil'
            ],
            [
                'school_id' => '1eec4513-382e-6e8c-abe9-47706148996e',
                'classroom_id' => '1eec4527-6f70-6c38-9b57-73f4839ac711',
                'lastname' => 'Malá',
                'firstname' => 'Antonie',
                'egoId' => 'Atonie'
            ],
            [
                'school_id' => '1eec4513-382e-6e8c-abe9-47706148996e',
                'classroom_id' => '1eec4527-6f70-6c38-9b57-73f4839ac711',
                'lastname' => 'Marysko',
                'firstname' => 'Matyáš',
                'egoId' => 'Matyáš'
            ],
            [
                'school_id' => '1eec4513-382e-6e8c-abe9-47706148996e',
                'classroom_id' => '1eec4527-6f70-6c38-9b57-73f4839ac711',
                'lastname' => 'Mück',
                'firstname' => 'Matyas',
                'egoId' => 'Matyas'
            ],
            [
                'school_id' => '1eec4513-382e-6e8c-abe9-47706148996e',
                'classroom_id' => '1eec4527-6f70-6c38-9b57-73f4839ac711',
                'lastname' => 'Novotná',
                'firstname' => 'Ema',
                'egoId' => 'Ema'
            ],
            [
                'school_id' => '1eec4513-382e-6e8c-abe9-47706148996e',
                'classroom_id' => '1eec4527-6f70-6c38-9b57-73f4839ac711',
                'lastname' => 'Pokorný',
                'firstname' => 'Sebastián',
                'egoId' => 'Sebastián'
            ],
            [
                'school_id' => '1eec4513-382e-6e8c-abe9-47706148996e',
                'classroom_id' => '1eec4527-6f70-6c38-9b57-73f4839ac711',
                'lastname' => 'Prokop',
                'firstname' => 'Jiří',
                'egoId' => 'Jirka'
            ],
            [
                'school_id' => '1eec4513-382e-6e8c-abe9-47706148996e',
                'classroom_id' => '1eec4527-6f70-6c38-9b57-73f4839ac711',
                'lastname' => 'Stuchlík',
                'firstname' => 'Vojtěch',
                'egoId' => 'Vojtěch'
            ],
            [
                'school_id' => '1eec4513-382e-6e8c-abe9-47706148996e',
                'classroom_id' => '1eec4527-6f70-6c38-9b57-73f4839ac711',
                'lastname' => 'Truschánová',
                'firstname' => 'Karolína',
                'egoId' => 'Karolína Truschánová'
            ],
            [
                'school_id' => '1eec4513-382e-6e8c-abe9-47706148996e',
                'classroom_id' => '1eec4527-6f70-6c38-9b57-73f4839ac711',
                'lastname' => 'Uhlíř',
                'firstname' => 'Adam',
                'egoId' => 'Adam'
            ],
            [
                'school_id' => '1eec4513-382e-6e8c-abe9-47706148996e',
                'classroom_id' => '1eec4527-6f70-6c38-9b57-73f4839ac711',
                'lastname' => 'Urminská',
                'firstname' => 'Denisa',
                'egoId' => 'Denisa'
            ],
            [
                'school_id' => '1eec4513-382e-6e8c-abe9-47706148996e',
                'classroom_id' => '1eec4527-6f70-6c38-9b57-73f4839ac711',
                'lastname' => 'Wágnerová',
                'firstname' => 'Eliška',
                'egoId' => 'Eliška Wágnerová'
            ],
            [
                'school_id' => '1eec4513-382e-6e8c-abe9-47706148996e',
                'classroom_id' => '1eec4527-6f70-6c38-9b57-73f4839ac711',
                'lastname' => 'Zelenka',
                'firstname' => 'David',
                'egoId' => 'David'
            ],
            [
                'school_id' => '1eec4513-382e-6e8c-abe9-47706148996e',
                'classroom_id' => '1eec4527-6f70-6c38-9b57-73f4839ac711',
                'lastname' => 'Zelenka',
                'firstname' => 'Marek',
                'egoId' => 'Marek'
            ],
            // –! 7.C !-
        ];

        foreach ($studentsData as $data) {
            $school = $this->schoolRepository->find($data['school_id']);
            $classroom = $this->classroomRepository->find($data['classroom_id']);

            if (!$school || !$classroom) {
                $io->error("School or Classroom not found for student: {$data['firstname']} {$data['lastname']}");
                continue;
            }

            $student = new Student();
            $student->setSchool($school);
            $student->setClassroom($classroom);
            $student->setFirstname($data['firstname']);
            $student->setLastname($data['lastname']);
            $student->setEgoId($data['egoId']);
            $student->setEmail('');

            $this->entityManager->persist($student);

            $io->info(sprintf(
                'Importing student %s %s to classroom %s in school %s.',
                $data['firstname'],
                $data['lastname'],
                $classroom->getName(),
                $school->getName(),
            ));
        }

        $this->entityManager->flush();

        $io->success('Students have been successfully added.');

        return Command::SUCCESS;
    }
}
