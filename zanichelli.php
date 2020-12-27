<?php

namespace LucaTheHacker;
class Zanichelli
{

    /**
     * @var mixed
     */
    private $json;

    /*
     * Loads the JSON in the class
     *
     * @param string $data Text to load
     * */
    public function loadJson(string $data): void
    {
        $this->json = json_decode($data, true);
    }

    /*
     * Returns the solution of an exercise
     *
     * @param array $exercise
     * @return array
     * */
    private function solveExercise(array $exercise): array
    {
        // Decodes the list containing all the QA
        $options = json_decode(base64_decode($exercise['list']), true);

        // Search for exercise type
        if (strpos($exercise['question'], '<gap_ref idref="') !== false) {
            $solutions = $exercise['question'];
            foreach ($options as $option) {
                foreach ($option['values'] as $value) {
                    if ($value['correct'] || $value['correct'] === null) {
                        $solutions = str_replace('<gap_ref idref="_' . ($option['id'] ?? '?') . '"/>', $value['text'], $solutions);
                    }
                }
            }
        } elseif (strpos($exercise['question'], '<error_ref idref="') !== false) {
            $solutions = $exercise['question'];
            foreach ($options as $option) {
                foreach ($option['values'] as $value) {
                    if ($value['correct'] || $value['correct'] === null) {
                        $solutions = str_replace('<error_ref idref="_' . ($option['id'] ?? '?') . '"/>', $value['text'], $solutions);
                    }
                }
            }
        } else {
            $solutions = [];
            foreach ($options as $option) {
                if ($option['correct']) $solutions[] = rtrim($option['text']);
            }
        }

        return [
            'question' => rtrim($exercise['question']),
            'solutions' => $solutions,
        ];
    }

    /*
     * Solves the whole quiz
     *
     * @return array
     * */
    public function solve(): array
    {
        $results = [];
        foreach ($this->json['exercises'] as $exercise) {
            $result = $this->solveExercise($exercise['json']);

            // Question cleaner
            $result['question'] = str_replace('<br/>', PHP_EOL, $result['question']);
            $result['question'] = preg_replace('<(gap_ref|error_ref) idref="_[0-9]*"/>', 'INSERT HERE', $result['question']);

            // Solutions cleaner
            if (!is_array($result['solutions'])) {
                $result['solutions'] = str_replace('<br/>', PHP_EOL, $result['solutions']);
            }

            $results[] = $result;
        }

        return $results;
    }

    /*
     * Returns info about the quiz
     *
     * @return array
     * */
    public function getInfos(): array
    {
        return [
            'ID' => $this->json['_id'],
            'title' => $this->json['publicTitle'],
            'book' => [
                'ID' => $this->json['bookId'],
                'Title' => $this->json['bookTitle'],
            ],
            'course' => $this->json['courseTitle'],
            'subjects' => $this->json['subjects'],
            'owner' => [
                'ID' => $this->json['owner'],
                'name' => $this->json['creator']['firstName'] . ' ' . $this->json['creator']['lastName'],
                'email' => $this->json['exercises'][0]['owner'] ?? '',
            ],
        ];
    }
}
