<?php
namespace App\Controller\Api;

use App\Entity\Questionnaire;
use App\Entity\Results;
use App\Entity\Sociograms;
use App\Entity\StudentResults;
use App\Repository\QuestionnaireRepository;
use App\Repository\StudentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Uid\Uuid;

class ApiController extends AbstractController
{
    private EntityManagerInterface $entityManager;
    private QuestionnaireRepository $questionnaireRepository;
    private StudentRepository $studentRepository;

    public function __construct(
        EntityManagerInterface $entityManager,
        QuestionnaireRepository $questionnaireRepository,
        StudentRepository $studentRepository,
    )
    {
        $this->entityManager = $entityManager;
        $this->questionnaireRepository = $questionnaireRepository;
        $this->studentRepository = $studentRepository;
    }

    #[Route('/api/import/{id}', name: 'api_import_data', methods: ["PUT"])]
    public function importData(Questionnaire $questionnaire, Request $request): JsonResponse
    {
        $results = new Results();

        $results->setRawJson($request->getContent());
        $this->updateResultsForQuestionnaire($questionnaire,$results);
        $results->setQuestionnaire($questionnaire);

        $this->processDataFromJsonRequest(
            data: $request->getContent(),
            results: $results
        );

        try {
            $this->entityManager->persist($results);
            $this->entityManager->flush();
        } catch (\Exception $exception)
        {
            return new JsonResponse('Došlo k chybě při ukládání',Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse('Data byla úspěšně uložena', Response::HTTP_OK);
    }

    private function processDataFromJsonRequest(string $data, Results $results): void
    {
        $decodedData = json_decode($data,true);
        $classroomVars = $decodedData['classroom_level_variables'];

        $results->setBullyCorePeriphery1($classroomVars['other_classroom_level_variables']['bully_core_periphery_1'] ?? null);
        $results->setBullyCorePeriphery2($classroomVars['other_classroom_level_variables']['bully_core_periphery_2'] ?? null);
        $results->setBullyingReciprocation($classroomVars['other_classroom_level_variables']['bullying_reciprocation'] ?? null);
        $results->setVictimDefending($classroomVars['other_classroom_level_variables']['victim_defending'] ?? null);

        $results->setClassroomBullies($classroomVars['numbers_of_bullying_roles']['classroom_bullies'] ?? null);
        $results->setClassroomBullyVictims($classroomVars['numbers_of_bullying_roles']['classroom_bully_victims'] ?? null);
        $results->setClassroomDefenders($classroomVars['numbers_of_bullying_roles']['classroom_defenders'] ?? null);
        $results->setClassroomVictims($classroomVars['numbers_of_bullying_roles']['classroom_victims'] ?? null);

        $results->setHealthyRelationshipsIndex($classroomVars['healthy_relationship_index_components']['healthy_relationship_index']['healthy_relationships_index'] ?? null);
        $results->setTrustworthinessScore($classroomVars['healthy_relationship_index_components']['healthy_relationship_index']['trustworthiness_score'] ?? null);
        $results->setLower80CI($classroomVars['healthy_relationship_index_components']['healthy_relationship_index']['lower_80_CI'] ?? null);
        $results->setUpper80CI($classroomVars['healthy_relationship_index_components']['healthy_relationship_index']['upper_80_CI'] ?? null);

        $results->setCohesion($classroomVars['healthy_relationship_index_components']['cohesion'] ?? null);
        $results->setCorePeriphery1($classroomVars['healthy_relationship_index_components']['core_periphery_1'] ?? null);
        $results->setOverallReciprocity($classroomVars['healthy_relationship_index_components']['overall_reciprocity'] ?? null);
        $results->setAggression($classroomVars['healthy_relationship_index_components']['aggression'] ?? null);

        $results->setTotalStudents(count($decodedData['student_level_variables']['student_attributes']) ?? 0);

        foreach ($decodedData['student_level_variables']['student_attributes'] as $studentVars) {
            $student = $this->studentRepository->findOneBy(['egoId' => $studentVars['studentID']]);

            if (!$student) {
                throw new NotFoundHttpException(sprintf('Student with ego id "%s" not found.', $studentVars['studentID']));
            }

            $studentResult = new StudentResults();
            $studentResult->setResults($results);
            $studentResult->setStudent($student);

            $studentResult->setDegree($this->parseValueFromArray($studentVars, 'degree'));
            $studentResult->setBetweenness($this->parseValueFromArray($studentVars, 'betweenness'));
            $studentResult->setGroup1($this->parseValueFromArray($studentVars, 'group1'));
            $studentResult->setGroup2($this->parseValueFromArray($studentVars, 'group2'));
            $studentResult->setGroup3($this->parseValueFromArray($studentVars, 'group3'));
            $studentResult->setGroup4($this->parseValueFromArray($studentVars, 'group4'));
            $studentResult->setNrGroupsClassroomNotnormalized($this->parseValueFromArray($studentVars, 'nr_groups_classroom_notnormalized'));
            $studentResult->setNrGroupsClassroom($this->parseValueFromArray($studentVars, 'nr_groups_classroom'));
            $studentResult->setInfluence($this->parseValueFromArray($studentVars, 'influence'));
            $studentResult->setLeadership($this->parseValueFromArray($studentVars, 'leadership'));
            $studentResult->setGroupIdentification($this->parseValueFromArray($studentVars, 'group_identification'));
            $studentResult->setInternalization($this->parseValueFromArray($studentVars, 'internalization'));
            $studentResult->setClosenessFriendships($this->parseValueFromArray($studentVars, 'closeness_friendships'));
            $studentResult->setVictimizationIndegree($this->parseValueFromArray($studentVars, 'victimization_indegree'));
            $studentResult->setBullyingOutdegree($this->parseValueFromArray($studentVars, 'bullying_outdegree'));
            $studentResult->setDefendingIndegree($this->parseValueFromArray($studentVars, 'defending_indegree'));
            $studentResult->setDefendingOutdegree($this->parseValueFromArray($studentVars, 'defending_outdegree'));
            $studentResult->setResilience($this->parseValueFromArray($studentVars, 'resilience'));

            $this->entityManager->persist($studentResult);

        }

        if (array_key_exists('sociograms',$decodedData['classroom_level_variables'])){
            $sociogram = new Sociograms();
            $sociogram->setResults($results);
            $sociogram->setFriendshipNetworkUnweighted(json_encode($decodedData['classroom_level_variables']['sociograms']['friendship_network_unweighted_matrix'], JSON_THROW_ON_ERROR));
            $sociogram->setFriendshipNetworkWeighted(json_encode($decodedData['classroom_level_variables']['sociograms']['friendship_network_weighted_matrix'], JSON_THROW_ON_ERROR));
            $sociogram->setBullyNetworkUnweighted(json_encode($decodedData['classroom_level_variables']['sociograms']['bully_network_unweighted_matrix'], JSON_THROW_ON_ERROR));
            $sociogram->setBullyNetworkWeighted(json_encode($decodedData['classroom_level_variables']['sociograms']['bully_network_weighted_matrix'], JSON_THROW_ON_ERROR));
            $sociogram->setDefendingNetworkUnweighted(json_encode($decodedData['classroom_level_variables']['sociograms']['defending_network_unweighted_matrix'], JSON_THROW_ON_ERROR));
            $sociogram->setDefendingNetworkWeighted(json_encode($decodedData['classroom_level_variables']['sociograms']['defending_network_weighted_matrix'], JSON_THROW_ON_ERROR));

            $this->entityManager->persist($sociogram);
        }
    }

    private function parseValueFromArray($array, $key)
    {
        if (!isset($array[$key]) || $array[$key] === 'NaN') {
            return null;
        }

        return $array[$key];
    }

    private function updateResultsForQuestionnaire(Questionnaire $questionnaire, Results $newResults): void
    {
        // Získáme stávající Results přiřazený k Questionnaire
        $existingResults = $questionnaire->getResults();

        // Pokud existuje, tak ho odstraníme
        if ($existingResults !== null) {
            // Odstraníme entitu Results, ale pokud bychom měli orphanRemoval: true, stačilo by $this->entityManager->remove($existingResults);
            $questionnaire->setResults(null);
            $this->entityManager->remove($existingResults);
            $this->entityManager->flush(); // Uložíme změny v databázi
        }

        // Přiřadíme nový Results k Questionnaire
        $questionnaire->setResults($newResults);

        // Můžeme rovnou uložit změny, nebo nechat Symfony/Doctrine postarat se o to v rámci transakce
        $this->entityManager->persist($questionnaire);
        $this->entityManager->flush();
    }
}
