<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

$subject_id = $_POST['subject_id'] ?? null;
$quiz_id    = $_POST['quiz_id'] ?? null;
$sa_id = $_POST['sa_id'] ?? null;
$submissionType = $_POST['submission_type'] ?? 'submitted';



if (!$subject_id || !$quiz_id) {
    http_response_code(400);
    $_SESSION['error'] = 'Missing quiz or subject information.';
    header('Location: ' . base_url('/student/subjects'));
    exit;
}

// Fetch logged-in student
$user = $db->query(
    "SELECT * FROM students WHERE user_id = :user_id",
    [':user_id' => $_SESSION['user_id']]
)->fetch();

// Fetch subject & section
$subject = $db->query(
    "SELECT s.*, ps.* 
     FROM subjects s
     LEFT JOIN program_sections ps ON s.section_id = ps.section_id
     WHERE s.subject_id = :subject_id",
    [':subject_id' => $subject_id]
)->fetch();

if (!$subject) {
    http_response_code(404);
    require base_path('views/404.view.php');
    exit;
}

// Validate student is in correct section
if ($subject['section_id'] != $user['section_id']) {
    http_response_code(403);
    require base_path('views/403.view.php');
    exit;
}

// Fetch quiz (with passing_score)
$quiz = $db->query(
    "SELECT * FROM quizzes 
     WHERE quiz_id = :quiz_id AND subject_id = :subject_id AND is_active = 1",
    [
        ':quiz_id'    => $quiz_id,
        ':subject_id' => $subject_id
    ]
)->fetch();

if (!$quiz) {
    http_response_code(404);
    require base_path('views/404.view.php');
    exit;
}

// Get submitted answers
$answers = $_POST['answers'] ?? [];

try {
    $db->beginTransaction();

   


   
    $correctAnswers = $db->query(
        "SELECT quiz_question_id, correct_answer 
         FROM quiz_questions 
         WHERE quiz_id = :quiz_id",
        [':quiz_id' => $quiz_id]
    )->fetchAll(PDO::FETCH_KEY_PAIR);

    $score = 0;

    foreach ($answers as $questionId => $selected) {
        $selected = strtoupper($selected);
        $correct = (isset($correctAnswers[$questionId]) && $selected === $correctAnswers[$questionId]) ? 1 : 0;

        if ($correct) {
            $score++;
        }

        $db->query(
            "INSERT INTO student_quiz_answers 
                (student_quiz_attempt_id, quiz_question_id, selected_answer, is_correct)
             VALUES (:attempt_id, :question_id, :selected_answer, :is_correct)",
            [
                ':attempt_id'      => $sa_id,
                ':question_id'     => $questionId,
                ':selected_answer' => $selected,
                ':is_correct'      => $correct
            ]
        );
    }


    $remarks = ($score >= $quiz['passing_score']) ? 'passed' : 'failed';

   
    $db->query(
        "UPDATE student_quiz_attempts 
     SET score = :score, 
         remarks = :remarks, 
         status = :status,
         submitted_at = now()
     WHERE student_quiz_attempt_id = :attempt_id",
        [
            ':score'      => $score,
            ':remarks'    => $remarks,
            ':status'     => $submissionType,
            ':attempt_id' => $sa_id
        ]
    );


    $db->commit();

    $_SESSION['success'] = "Quiz submitted! Your score: $score/{$quiz['num_questions']} - You {$status}!";
} catch (Exception $e) {
    $db->rollBack();
    $_SESSION['error'] = 'Failed to submit quiz: ' . $e->getMessage();
}

// Redirect back
header('Location: ' . base_url('/student/subject/' . $subject_id . '/quizzes'));
exit;
