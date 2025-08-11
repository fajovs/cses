<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

$quiz_id = $params['qid'];

// Fetch quiz
$quiz = $db->query(
    "SELECT * FROM quizzes WHERE quiz_id = :quiz_id",
    [':quiz_id' => $quiz_id]
)->fetch();

if (!$quiz) {
    http_response_code(404);
    require base_path('views/404.view.php');
    exit;
}

// Check if logged in user is the owner faculty
$user = $db->query(
    "SELECT * FROM faculties WHERE user_id = :user_id",
    [':user_id' => $_SESSION['user_id']]
)->fetch();

$subject = $db->query(
    "SELECT s.*, ps.* 
     FROM subjects s
     LEFT JOIN program_sections ps ON s.section_id = ps.section_id
     WHERE s.subject_id = :subject_id",
    [':subject_id' => $quiz['subject_id']]
)->fetch();

if (!$subject || $user['faculty_id'] != $subject['faculty_id']) {
    http_response_code(403);
    require base_path('views/403.view.php');
    exit;
}

// Fetch existing questions (for initial render if needed)
$questions = $db->query(
    "SELECT * FROM quiz_questions WHERE quiz_id = :quiz_id",
    [':quiz_id' => $quiz_id]
)->fetchAll();


// Handle POST request
$title = trim($_POST['title'] ?? '');
$deadline = trim($_POST['deadline'] ?? '');
$num_questions = (int) ($_POST['num_questions'] ?? 0);
$passing_score = (int) ($_POST['passing_score'] ?? 0);
$question_texts = $_POST['question'] ?? [];
$choice_a = $_POST['choice_a'] ?? [];
$choice_b = $_POST['choice_b'] ?? [];
$choice_c = $_POST['choice_c'] ?? [];
$choice_d = $_POST['choice_d'] ?? [];
$correct_answers = $_POST['answer'] ?? [];
$question_ids = $_POST['question_ids'] ?? [];

try {
    $db->beginTransaction();

    // Update quiz info (added passing_score)
    $db->query(
        "UPDATE quizzes 
         SET title = :title, deadline = :deadline, num_questions = :num_questions, passing_score = :passing_score
         WHERE quiz_id = :quiz_id",
        [
            ':title' => $title,
            ':deadline' => $deadline,
            ':num_questions' => $num_questions,
            ':passing_score' => $passing_score,
            ':quiz_id' => $quiz_id
        ]
    );

    // Loop through questions
    foreach ($question_texts as $index => $text) {
        $qid = $question_ids[$index] ?: null;

        $params = [
            ':question_text' => trim($text),
            ':choice_a' => trim($choice_a[$index]),
            ':choice_b' => trim($choice_b[$index]),
            ':choice_c' => trim($choice_c[$index]),
            ':choice_d' => trim($choice_d[$index]),
            ':correct_answer' => trim($correct_answers[$index])
        ];

        if ($qid) {
            // Update existing question
            $params[':qid'] = $qid;
            $db->query(
                "UPDATE quiz_questions 
                 SET question_text = :question_text,
                     choice_a = :choice_a,
                     choice_b = :choice_b,
                     choice_c = :choice_c,
                     choice_d = :choice_d,
                     correct_answer = :correct_answer
                 WHERE quiz_question_id = :qid",
                $params
            );
        } else {
            // Insert new question
            $params[':quiz_id'] = $quiz_id;
            $db->query(
                "INSERT INTO quiz_questions 
                 (quiz_id, question_text, choice_a, choice_b, choice_c, choice_d, correct_answer)
                 VALUES (:quiz_id, :question_text, :choice_a, :choice_b, :choice_c, :choice_d, :correct_answer)",
                $params
            );
        }
    }

    $db->commit();

    $_SESSION['success'] = 'Quiz updated successfully!';
    header('Location: ' . base_url('/faculty/subject/' . $subject['subject_id'] . '/quiz/' . $quiz_id));
    exit;
} catch (Exception $e) {
    $db->rollBack();

    // Optional: log $e->getMessage()
    $_SESSION['error'] = 'Failed to update quiz. Please try again.';
    header('Location: ' . base_url('/faculty/subject/' . $subject['subject_id'] . '/quiz/' . $quiz_id . '/update'));
    exit;
}
