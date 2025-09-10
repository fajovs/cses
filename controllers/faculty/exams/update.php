<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

$exam_id = $params['eid'];

// Fetch exam
$exam = $db->query(
    "SELECT * FROM examinations WHERE exam_id = :exam_id",
    [':exam_id' => $exam_id]
)->fetch();

if (!$exam) {
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
    [':subject_id' => $exam['subject_id']]
)->fetch();

if (!$subject || $user['faculty_id'] != $subject['faculty_id']) {
    http_response_code(403);
    require base_path('views/403.view.php');
    exit;
}

// Fetch existing questions
$questions = $db->query(
    "SELECT * FROM exam_questions WHERE exam_id = :exam_id",
    [':exam_id' => $exam_id]
)->fetchAll();

// Handle POST request
$title          = trim($_POST['title'] ?? '');
$deadline_raw   = trim($_POST['deadline'] ?? '');
$deadline       = date('Y-m-d H:i:s', strtotime($deadline_raw));
$num_questions  = (int) ($_POST['num_questions'] ?? 0);
$passing_score  = (int) ($_POST['passing_score'] ?? 0);
$duration       = (int) ($_POST['duration'] ?? 60); // ✅ default 60

$question_texts   = $_POST['question'] ?? [];
$choice_a         = $_POST['choice_a'] ?? [];
$choice_b         = $_POST['choice_b'] ?? [];
$choice_c         = $_POST['choice_c'] ?? [];
$choice_d         = $_POST['choice_d'] ?? [];
$correct_answers  = $_POST['answer'] ?? [];
$question_ids     = $_POST['question_ids'] ?? [];

// ✅ Validation
$errors = [];

if ($title === '') {
    $errors[] = "Exam title is required.";
}

if ($num_questions <= 0 || count($question_texts) !== $num_questions) {
    $errors[] = "Number of questions doesn't match the data.";
}

if ($passing_score <= 0) {
    $errors[] = "Passing score must be greater than zero.";
} elseif ($passing_score > $num_questions) {
    $errors[] = "Passing score cannot be higher than number of items.";
}

if ($duration <= 0 || $duration > 300) {
    $errors[] = "Duration must be between 1 and 300 minutes.";
}

if (strtotime($deadline) <= time()) {
    $errors[] = "Deadline must be in the future.";
}

for ($i = 0; $i < count($question_texts); $i++) {
    if (trim($question_texts[$i]) === '' ||
        trim($choice_a[$i]) === '' ||
        trim($choice_b[$i]) === '' ||
        trim($choice_c[$i]) === '' ||
        trim($choice_d[$i]) === '' ||
        empty($correct_answers[$i])) {
        $errors[] = "Question #" . ($i+1) . " and all its choices must not be empty, and must have a correct answer.";
    }
}

// If errors, redirect back
if (!empty($errors)) {
    $_SESSION['error'] = implode(' ', $errors);
    header('Location: ' . base_url('/faculty/subject/' . $subject['subject_id'] . '/exam/' . $exam_id . '/update'));
    exit;
}

try {
    $db->beginTransaction();

    // ✅ Update exam info
    $db->query(
        "UPDATE examinations 
         SET title = :title,
             deadline = :deadline,
             num_questions = :num_questions,
             passing_score = :passing_score,
             duration = :duration
         WHERE exam_id = :exam_id",
        [
            ':title'         => $title,
            ':deadline'      => $deadline,
            ':num_questions' => $num_questions,
            ':passing_score' => $passing_score,
            ':duration'      => $duration,
            ':exam_id'       => $exam_id
        ]
    );

    // ✅ Step 1: Delete removed questions
    $existing_ids = $db->query(
        "SELECT exam_question_id FROM exam_questions WHERE exam_id = :exam_id",
        [':exam_id' => $exam_id]
    )->fetchAll(PDO::FETCH_COLUMN);

    $submitted_ids = array_filter($question_ids);
    $to_delete = array_diff($existing_ids, $submitted_ids);

    if (!empty($to_delete)) {
        $placeholders = implode(',', array_fill(0, count($to_delete), '?'));
        $db->query(
            "DELETE FROM exam_questions WHERE exam_question_id IN ($placeholders)",
            array_values($to_delete)
        );
    }

    // ✅ Step 2: Update or Insert
    foreach ($question_texts as $index => $text) {
        $qid = $question_ids[$index] ?: null;

        $params = [
            ':question_text'   => trim($text),
            ':choice_a'        => trim($choice_a[$index]),
            ':choice_b'        => trim($choice_b[$index]),
            ':choice_c'        => trim($choice_c[$index]),
            ':choice_d'        => trim($choice_d[$index]),
            ':correct_answer'  => trim($correct_answers[$index])
        ];

        if ($qid) {
            $params[':qid'] = $qid;
            $db->query(
                "UPDATE exam_questions 
                 SET question_text = :question_text,
                     choice_a = :choice_a,
                     choice_b = :choice_b,
                     choice_c = :choice_c,
                     choice_d = :choice_d,
                     correct_answer = :correct_answer
                 WHERE exam_question_id = :qid",
                $params
            );
        } else {
            $params[':exam_id'] = $exam_id;
            $db->query(
                "INSERT INTO exam_questions 
                 (exam_id, question_text, choice_a, choice_b, choice_c, choice_d, correct_answer)
                 VALUES (:exam_id, :question_text, :choice_a, :choice_b, :choice_c, :choice_d, :correct_answer)",
                $params
            );
        }
    }

    $db->commit();

    $_SESSION['success'] = 'Exam updated successfully!';
    header('Location: ' . base_url('/faculty/subject/' . $subject['subject_id'] . '/exam/' . $exam_id));
    exit;
} catch (Exception $e) {
    $db->rollBack();
    $_SESSION['error'] = 'Failed to update exam. Please try again.';
    header('Location: ' . base_url('/faculty/subject/' . $subject['subject_id'] . '/exam/' . $exam_id . '/update'));
    exit;
}
