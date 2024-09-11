<?php

namespace Database\Seeders;

use App\Models\Choice;
use App\Models\Question;
use App\Models\Survey;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        DB::insert(
            'insert into surveys (title) values (:title)',
            ['title' => 'Step 1 survey']
        );

        $this->seedStepOneQuestions();

        //additional sample questions
        $surveys = Survey::factory(rand(3, 6))->create();
        // $questions = Question::factory(rand(10, 25))->recycle($surveys)->create();
        $surveys->each(function ($survey) {
            $questions = Question::factory(rand(2, 5))->recycle($survey)->create();

            $questions->each(function ($question) {
                Choice::factory(rand(2, 5))->recycle($question)->create();
            });
        });
    }

    private function seedStepOneQuestions()
    {
        $questions = [
            [
                'title' => 'How old are you?',
                'type' => 'radio',
                'choices' => [
                    [
                        'value' => 'lessThan18',
                        'label' => 'Less than 18',
                    ],
                    [
                        'value' => '18To99',
                        'label' => '18-99',
                    ],
                    [
                        'value' => 'moreThan99',
                        'label' => 'More than 99',
                    ],
                ],
            ],
            [
                'title' => 'Are you happy?',
                'type' => 'radio',
                'choices' => [
                    [
                        'value' => 'yes',
                        'label' => 'Yes',
                    ],
                    [
                        'value' => 'no',
                        'label' => 'No',
                    ],
                ],
            ],
            [
                'title' => 'What countries have you visited?',
                'type' => 'checkbox',
                'choices' => [
                    [
                        'value' => 'spain',
                        'label' => 'Spain',
                    ],
                    [
                        'value' => 'france',
                        'label' => 'France',
                    ],
                    [
                        'value' => 'italy',
                        'label' => 'Italy',
                    ],
                    [
                        'value' => 'england',
                        'label' => 'Engalnd',
                    ],
                    [
                        'value' => 'portugal',
                        'label' => 'Portugal',
                    ],
                ],
            ],
            [
                'title' => 'What is your favorite sport?',
                'type' => 'radio',
                'choices' => [
                    [
                        'value' => 'football',
                        'label' => 'Football',
                    ],
                    [
                        'value' => 'basketball',
                        'label' => 'Basketball',
                    ],
                    [
                        'value' => 'soccer',
                        'label' => 'Soccer',
                    ],
                    [
                        'value' => 'volleyball',
                        'label' => 'Volleyball',
                    ],
                ],
            ],
            [
                'title' => 'What programming languages do you know?',
                'type' => 'checkbox',
                'choices' => [
                    [
                        'value' => 'php',
                        'label' => 'PHP',
                    ],
                    [
                        'value' => 'ruby',
                        'label' => 'Ruby',
                    ],
                    [
                        'value' => 'javascript',
                        'label' => 'JavaScript',
                    ],
                    [
                        'value' => 'python',
                        'label' => 'Python',
                    ],
                ],
            ],
        ];

        foreach ($questions as $idx => $question) {
            DB::insert(
                '
                    insert into questions (title, type, display_order, survey_id)
                    values (:title, :type, :display_order, :survey_id)
                ',
                [
                    'title' => $question['title'],
                    'type' => $question['type'],
                    'display_order' => $idx,
                    'survey_id' => 1,
                ]
            );

            foreach ($question['choices'] as $choice) {
                DB::insert(
                    '
                        insert into choices (value, label, question_id)
                        select 
                            :value, :label, id
                        from questions 
                        where 
                            title = :title 
                        and type = :type
                        and survey_id = :survey_id
                    ',
                    [
                        'value' => $choice['value'],
                        'label' => $choice['label'],
                        'title' => $question['title'],
                        'type' => $question['type'],
                        'survey_id' => 1,
                    ]
                );
            }
        }
    }
}
