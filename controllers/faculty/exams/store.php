<?php
use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

$subject_id     = $_POST['subject_id'];                         
$title          = trim($_POST['title']);
$num_questions  = (int)$_POST['num_questions'];
$passing_score  = (int)$_POST['passing_score'] ?? 0;
$deadline_raw   = $_POST['deadline'];
$deadline       = date('Y-m-d H:i:s', strtotime($deadline_raw));
$datetime       = date('Y-m-d H:i:s'); // current timestamp

$questions      = $_POST['question'] ?? [];
$choices_a      = $_POST['choice_a'] ?? [];
$choices_b      = $_POST['choice_b'] ?? [];
$choices_c      = $_POST['choice_c'] ?? [];
$choices_d      = $_POST['choice_d'] ?? [];
$answers        = $_POST['answer'] ?? [];

// ✅ Validate subject exists and belongs to faculty
$subject = $db->query(
    "SELECT s.*, ps.* FROM subjects s
     LEFT JOIN program_sections ps ON s.section_id = ps.section_id
     WHERE subject_id = :subject_id",
    [':subject_id' => $subject_id]
)->fetch();

if (!$subject) {
    http_response_code(404);
    require base_path('views/404.view.php');
    exit;
}

// Validate logged-in faculty
$user = $db->query(
    "SELECT * FROM faculties WHERE user_id = :user_id",
    [':user_id' => $_SESSION['user_id']]
)->fetch();

if ($user['faculty_id'] != $subject['faculty_id']) {
    http_response_code(403);
    require base_path('views/403.view.php');
    exit;
}

// ✅ Extra validation
$errors = [];

if ($title === '') {
    $errors[] = "Exam title is required.";
}

if ($num_questions <= 0 || count($questions) !== $num_questions) {
    $errors[] = "Number of questions doesn't match the data.";
}

if ($passing_score <= 0) {
    $errors[] = "Passing score must be greater than zero.";
} elseif ($passing_score > $num_questions) {
    $errors[] = "Passing score cannot be higher than number of items.";
}

if (strtotime($deadline) <= time()) {
    $errors[] = "Deadline must be in the future.";
}

// Validate each question & choices
for ($i = 0; $i < count($questions); $i++) {
    if (trim($questions[$i]) === '' ||
        trim($choices_a[$i]) === '' ||
        trim($choices_b[$i]) === '' ||
        trim($choices_c[$i]) === '' ||
        trim($choices_d[$i]) === '' ||
        empty($answers[$i])) {
        $errors[] = "Question #" . ($i+1) . " and all its choices must not be empty, and must have a correct answer.";
    }
}

// ✅ If errors, redirect back with error message
if (!empty($errors)) {
    $_SESSION['error'] = implode(' ', $errors);
    header('Location: ' . base_url('/faculty/subject/' . $subject_id . '/exams'));
    exit;
}

// ✅ transaction
try {
    $db->beginTransaction();

    // Insert exam including passing_score
    $db->query(
        "INSERT INTO examinations (subject_id, title, num_questions, passing_score, deadline, is_active, created_at)
         VALUES (:subject_id, :title, :num_questions, :passing_score, :deadline, 1, :created_at)",
        [
            ':subject_id'    => $subject_id,
            ':title'         => $title,
            ':num_questions' => $num_questions,
            ':passing_score' => $passing_score,
            ':deadline'      => $deadline,
            ':created_at'    => $datetime
        ]
    );

    $exam_id = $db->lastInsertId();

    // Insert questions
    for ($i = 0; $i < count($questions); $i++) {
        $db->query(
            "INSERT INTO exam_questions (exam_id, question_text, choice_a, choice_b, choice_c, choice_d, correct_answer)
             VALUES (:exam_id, :question_text, :choice_a, :choice_b, :choice_c, :choice_d, :correct_answer)",
            [
                ':exam_id'        => $exam_id,
                ':question_text'  => trim($questions[$i]),
                ':choice_a'       => trim($choices_a[$i]),
                ':choice_b'       => trim($choices_b[$i]),
                ':choice_c'       => trim($choices_c[$i]),
                ':choice_d'       => trim($choices_d[$i]),
                ':correct_answer' => $answers[$i]
            ]
        );
    }

    $db->commit();

    $_SESSION['success'] = 'Exam created successfully!';
} catch (Exception $e) {
    $db->rollBack();
    $_SESSION['error'] = 'Failed to create Exam: ' . $e->getMessage();
}

// Redirect back to exams page
header('Location: ' . base_url('/faculty/subject/' . $subject_id . '/exams'));
exit;
