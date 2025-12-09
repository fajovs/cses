<?php
// controllers/admin/users/check-email.php
use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

header('Content-Type: application/json');
 

      


    
    try {
  
        $subject = $_GET['subject'];

        $student = $db->query(
                'SELECT st.*, u.first_name, u.middle_name, u.last_name, u.suffix, ps.section_name
                        FROM students st
                        LEFT JOIN users u ON st.user_id = u.user_id
                        LEFT JOIN program_sections ps ON st.section_id = ps.section_id
                        WHERE u.user_id = :user_id',
                [':user_id' => $_SESSION['user_id']]
        )->fetch();

         $faculty = $db->query(
                'SELECT f.*, u.first_name, u.middle_name, u.last_name, u.suffix, sb.subject_name
                        FROM faculties f
                        LEFT JOIN users u ON f.user_id = u.user_id
                        LEFT JOIN subjects sb ON f.faculty_id = sb.faculty_id
                        WHERE sb.subject_id = :subject_id',
                [':subject_id' => $subject]
        )->fetch();

     
        $quizzes = $db->query(
                'SELECT q.title, sqa.score , q.num_questions  
                        FROM quizzes q
                        LEFT JOIN student_quiz_attempts sqa ON q.quiz_id = sqa.quiz_id
                        WHERE (q.subject_id = :subject AND sqa.student_id = :student_id)',
                [':subject' => $subject,
                        ':student_id' => $student['student_id']
                ]
        )->fetchAll();

        $examinations = $db->query(
                'SELECT e.title, sea.score, e.num_questions 
                        FROM examinations e
                        LEFT JOIN student_exam_attempts sea ON e.exam_id = sea.exam_id
                        WHERE (e.subject_id = :subject AND sea.student_id = :student_id)',
                [':subject' => $subject,
                        ':student_id' => $student['student_id']
                ]
        )->fetchAll();

        $assignments = $db->query(
                'SELECT a.title, asub.total_score score, SUM(acrit.weight) AS total
                        FROM assignments a
                        LEFT JOIN assignment_criteria acrit ON a.assignment_id = acrit.assignment_id
                        LEFT JOIN assignment_submissions asub ON a.assignment_id = asub.assignment_id
                        WHERE (a.subject_id = :subject AND asub.student_id = :student_id) 
                        GROUP BY a.assignment_id;',
                [':subject' => $subject,
                        ':student_id' => $student['student_id']
                ]
        )->fetchAll();

       
        $projects = $db->query(
                'SELECT p.title, psub.total_score score , SUM(pcrit.weight) AS total
                        FROM projects p
                        LEFT JOIN project_criteria pcrit ON p.project_id = pcrit.project_id
                        LEFT JOIN project_submissions psub ON p.project_id = psub.project_id
                        WHERE (p.subject_id = :subject AND psub.student_id = :student_id)
                        GROUP BY p.project_id;'
                        ,
                [':subject' => $subject,
                        ':student_id' => $student['student_id']
                ]
        )->fetchAll();

     

        echo json_encode(value: [ 'student' => $student, 'faculty' => $faculty, 'quizzes' => $quizzes ,'examinations' => $examinations, 'assignments' => $assignments, 'projects' => $projects]);
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Server error']);
    }



exit;
