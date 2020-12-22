<?php

use MattDaneshvar\Survey\Models\Survey;
use App\Moocs;

$moocs = Moocs::create([
    'title' => 'Video text',
    'type' => 'youtube',
    'url' => 'v495332'
]);

$survey = $moocs->survey()->create([
    'name' => 'Cat Population Survey'
]);
$survey->questions()->create([
    'content' => 'How many cats do you have?',
    'type' => 'number',
    'rules' => ['numeric', 'min:0']
]);
$survey->questions()->create([
    'content' => 'What\'s the name of your first cat',
]);

$survey->questions()->create([
    'content' => 'Would you want a new cat?',
    'type' => 'radio',
    'options' => ['Yes', 'Oui']
]);
