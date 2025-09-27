<?php
// Authentication start
$router->get(base_url('/'), 'controllers/auth.php', []);
$router->post(base_url('/'), 'controllers/auth.php', []);
$router->get(base_url('/logout'), 'controllers/logout.php', []);
$router->get(base_url('/profile'), 'controllers/profile.php', ['admin','parent','faculty','student']);

$router->patch(base_url('/update'), 'controllers/update.php', ['admin','parent','faculty','student']);

// Authentication end


//ADMIN ROUTES

//Programs start
$router->get(base_url('/admin/programs'), 'controllers/admin/programs/index.php', ['admin']);
$router->get(base_url('/admin/program/edit/:id'), 'controllers/admin/programs/edit.php', ['admin']);
$router->patch(base_url('/admin/program/update'), 'controllers/admin/programs/update.php', ['admin']);
$router->post(base_url('/admin/program/store'), 'controllers/admin/programs/store.php', ['admin']);
$router->delete(base_url('/admin/program/delete'), 'controllers/admin/programs/destroy.php', ['admin']);
$router->get(base_url('/admin/program'), 'controllers/admin/programs/create.php', ['admin']);
//Programs end



//Sections Start
$router->delete(base_url('/admin/section/delete'), 'controllers/admin/sections/destroy.php', ['admin']);
$router->post(base_url('/admin/section/store'), 'controllers/admin/sections/store.php', ['admin']);
$router->get(base_url('/admin/program/:id/sections'), 'controllers/admin/sections/index.php', ['admin']);
$router->patch(base_url('/admin/section/update'), 'controllers/admin/sections/update.php', ['admin']);
$router->get(base_url('/admin/program/sections/json'), 'controllers/admin/programs/sections-json.php', ['admin']);
//Sections end



//Subjects Start
$router->get(base_url('/admin/program/:id/subjects'), 'controllers/admin/subjects/index.php', ['admin']);
$router->get(base_url('/admin/program/:id/subject'), 'controllers/admin/subjects/create.php', ['admin']);
$router->post(base_url('/admin/program/subject/store'), 'controllers/admin/subjects/store.php', ['admin']);
$router->get(base_url('/admin/program/:id/subject/:sid/edit'), 'controllers/admin/subjects/edit.php', ['admin']);
$router->patch(base_url('/admin/program/subject/update'), 'controllers/admin/subjects/update.php', ['admin']);
$router->delete(base_url('/admin/program/subject/delete'), 'controllers/admin/subjects/destroy.php', ['admin']);
//Subjects end

//Users Start
$router->get(base_url('/admin/users/faculties'), 'controllers/admin/users/faculties/index.php', ['admin']);
$router->get(base_url('/admin/users/faculty'), 'controllers/admin/users/faculties/create.php', ['admin']);
$router->post(base_url('/admin/users/faculty/store') , 'controllers/admin/users/faculties/store.php', ['admin']);
$router->get(base_url('/admin/users/faculty/:id/edit') , 'controllers/admin/users/faculties/edit.php', ['admin']);
$router->delete(base_url('/admin/users/faculty/delete') , 'controllers/admin/users/faculties/destroy.php', ['admin']);
$router->patch(base_url('/admin/users/faculty/update') , 'controllers/admin/users/faculties/update.php', ['admin']);

$router->get(base_url('/admin/users/students') , 'controllers/admin/users/students/index.php', ['admin']);
$router->get(base_url('/admin/users/student') , 'controllers/admin/users/students/create.php', ['admin']);
$router->post(base_url('/admin/users/student/store') , 'controllers/admin/users/students/store.php', ['admin']);
$router->get(base_url('/admin/users/student/:id/edit') , 'controllers/admin/users/students/edit.php', ['admin']);
$router->patch(base_url('/admin/users/student/update') , 'controllers/admin/users/students/update.php', ['admin']);
$router->delete(base_url('/admin/users/student/delete') , 'controllers/admin/users/students/destroy.php', ['admin']);

$router->get(base_url('/admin/users/parents') , 'controllers/admin/users/parents/index.php', ['admin']);
$router->get(base_url('/admin/users/parent') , 'controllers/admin/users/parents/create.php', ['admin']);
$router->post(base_url('/admin/users/parent/store') , 'controllers/admin/users/parents/store.php', ['admin']);
$router->get(base_url('/admin/users/parent/:id/edit') , 'controllers/admin/users/parents/edit.php', ['admin']);
$router->patch(base_url('/admin/users/parent/update') , 'controllers/admin/users/parents/update.php', ['admin']);
$router->delete(base_url('/admin/users/parent/delete') , 'controllers/admin/users/parents/destroy.php', ['admin']);

$router->post(base_url('/admin/users/parent/link') , 'controllers/admin/users/parents/link.php', ['admin']);


$router->get(base_url('/admin/users/check-email'), 'controllers/admin/users/check-email.php', ['admin']);
//Users end



//FACULTY ROUTES
$router->get(base_url('/faculty/subjects'), 'controllers/faculty/subjects/index.php', ['faculty']);
$router->get(base_url('/faculty/subject/:id/quizzes'), 'controllers/faculty/quizzes/index.php', ['faculty']);
$router->get(base_url('/faculty/subject/:id/quiz'), 'controllers/faculty/quizzes/create.php', ['faculty']);
$router->post(base_url('/faculty/subject/quiz/store'), 'controllers/faculty/quizzes/store.php', ['faculty']);
$router->get(base_url('/faculty/subject/:id/quiz/:qid'), 'controllers/faculty/quizzes/edit.php', ['faculty']);
$router->patch(base_url('/faculty/subject/:id/quiz/:qid/update'), 'controllers/faculty/quizzes/update.php', ['faculty']);
$router->patch(base_url('/faculty/subject/quiz/state'), 'controllers/faculty/quizzes/state.php', ['faculty']);
$router->delete(base_url('/faculty/quiz/delete'), 'controllers/faculty/quizzes/destroy.php', ['faculty']);

$router->get(base_url('/faculty/subject/:id/exams'), 'controllers/faculty/exams/index.php', ['faculty']);
$router->get(base_url('/faculty/subject/:id/exam'), 'controllers/faculty/exams/create.php', ['faculty']);
$router->post(base_url('/faculty/subject/exam/store'), 'controllers/faculty/exams/store.php', ['faculty']);
$router->get(base_url('/faculty/subject/:id/exam/:eid'), 'controllers/faculty/exams/edit.php', ['faculty']);
$router->patch(base_url('/faculty/subject/:id/exam/:eid/update'), 'controllers/faculty/exams/update.php', ['faculty']);
$router->patch(base_url('/faculty/subject/exam/state'), 'controllers/faculty/exams/state.php', ['faculty']);
$router->delete(base_url('/faculty/exam/delete'), 'controllers/faculty/exams/destroy.php', ['faculty']);



$router->get(base_url('/faculty/subject/:id/assignments'), 'controllers/faculty/assignments/index.php', ['faculty']);
$router->get(base_url('/faculty/subject/:id/assignment'), 'controllers/faculty/assignments/create.php', ['faculty']);
$router->get(base_url('/faculty/subject/:id/assignment/:aid'), 'controllers/faculty/assignments/edit.php', ['faculty']);
$router->post(base_url('/faculty/subject/assignment/store'), 'controllers/faculty/assignments/store.php', ['faculty']);
$router->patch(base_url('/faculty/subject/assignment/state'), 'controllers/faculty/assignments/state.php', ['faculty']);
$router->delete(base_url('/faculty/assignment/delete'), 'controllers/faculty/assignments/destroy.php', ['faculty']);
$router->patch(base_url('/faculty/subject/:id/assignment/:aid/update'), 'controllers/faculty/assignments/update.php', ['faculty']);

$router->get(base_url('/faculty/subject/:id/projects'), 'controllers/faculty/projects/index.php', ['faculty']);
$router->get(base_url('/faculty/subject/:id/project'), 'controllers/faculty/projects/create.php', ['faculty']);
$router->get(base_url('/faculty/subject/:id/project/:aid'), 'controllers/faculty/projects/edit.php', ['faculty']);
$router->post(base_url('/faculty/subject/project/store'), 'controllers/faculty/projects/store.php', ['faculty']);
$router->patch(base_url('/faculty/subject/project/state'), 'controllers/faculty/projects/state.php', ['faculty']);
$router->delete(base_url('/faculty/project/delete'), 'controllers/faculty/projects/destroy.php', ['faculty']);
$router->patch(base_url('/faculty/subject/:id/project/:aid/update'), 'controllers/faculty/projects/update.php', ['faculty']);



$router->get(base_url('/faculty/reports'), 'controllers/faculty/reports/index.php', ['faculty']);
$router->get(base_url('/faculty/reports/students'), 'controllers/faculty/reports/students.php', ['faculty']);
$router->get(base_url('/faculty/reports/generate'), 'controllers/faculty/reports/generate.php', ['faculty']);





$router->get(base_url('/faculty/submissions/projects'), 'controllers/faculty/submissions/projects/index.php', ['faculty']);
$router->get(base_url('/faculty/submissions/:id/projects'), 'controllers/faculty/submissions/projects/projects.php', ['faculty']);
$router->get(base_url('/faculty/submissions/subject/:id/project/:aid'), 'controllers/faculty/submissions/projects/submissions.php', ['faculty']);
$router->get(base_url('/download'), 'controllers/download.php',['faculty', 'student']);
$router->patch(base_url('/faculty/submissions/project/evaluate'), 'controllers/faculty/submissions/projects/evaluate.php',['faculty']);


$router->get(base_url('/faculty/submissions/assignments'), 'controllers/faculty/submissions/assignments/index.php', ['faculty']);
$router->get(base_url('/faculty/submissions/:id/assignments'), 'controllers/faculty/submissions/assignments/assignments.php', ['faculty']);
$router->get(base_url('/faculty/submissions/subject/:id/assignment/:aid'), 'controllers/faculty/submissions/assignments/submissions.php', ['faculty']);
$router->get(base_url('/download'), 'controllers/download.php',['faculty', 'student']);
$router->patch(base_url('/faculty/submissions/assignment/evaluate'), 'controllers/faculty/submissions/assignments/evaluate.php',['faculty']);



$router->get(base_url('/faculty/submissions/quizzes'), 'controllers/faculty/submissions/quizzes/index.php', ['faculty']);
$router->get(base_url('/faculty/submissions/:id/quizzes'), 'controllers/faculty/submissions/quizzes/quizzes.php', ['faculty']);
$router->get(base_url('/faculty/submissions/subject/:id/quiz/:qid'), 'controllers/faculty/submissions/quizzes/submissions.php', ['faculty']);
$router->patch(base_url('/faculty/submissions/quiz/check'), 'controllers/faculty/submissions/quizzes/check.php',['faculty']);

$router->get(base_url('/faculty/submissions/exams'), 'controllers/faculty/submissions/examinations/index.php', ['faculty']);
$router->get(base_url('/faculty/submissions/:id/exams'), 'controllers/faculty/submissions/examinations/exams.php', ['faculty']);
$router->get(base_url('/faculty/submissions/subject/:id/exam/:eid'), 'controllers/faculty/submissions/examinations/submissions.php', ['faculty']);
$router->patch(base_url('/faculty/submissions/exam/check'), 'controllers/faculty/submissions/examinations/check.php',['faculty']);



//STUDENT ROUTES

$router->get(base_url('/student/subjects'), 'controllers/student/subjects/index.php', ['student']);
$router->get(base_url('/student/subject/:id/quizzes'), 'controllers/student/quizzes/index.php', ['student']);
$router->get(base_url('/student/subject/:id/quiz/:qid'), 'controllers/student/quizzes/quiz.php', ['student']);
$router->post(base_url('/student/quiz/submit'), 'controllers/student/quizzes/store.php', ['student']);

$router->get(base_url('/student/subject/:id/exams'), 'controllers/student/exams/index.php', ['student']);
$router->get(base_url('/student/subject/:id/exam/:eid'), 'controllers/student/exams/exam.php', ['student']);
$router->post(base_url('/student/exam/submit'), 'controllers/student/exams/store.php', ['student']);

$router->get(base_url('/student/subject/:id/activities'), 'controllers/student/activities/index.php', ['student']);
$router->get(base_url('/student/subject/:id/activity/:aid'), 'controllers/student/activities/activity.php', ['student']);
$router->post(base_url('/student/activity/submit'), 'controllers/student/activities/store.php', ['student']);

$router->get(base_url('/student/subject/:id/projects'), 'controllers/student/projects/index.php', ['student']);
$router->get(base_url('/student/subject/:id/project/:aid'), 'controllers/student/projects/project.php', ['student']);
$router->post(base_url('/student/project/submit'), 'controllers/student/projects/store.php', ['student']);

$router->get(base_url('/student/subject/:id/assignments'), 'controllers/student/assignments/index.php', ['student']);
$router->get(base_url('/student/subject/:id/assignment/:aid'), 'controllers/student/assignments/assignment.php', ['student']);
$router->post(base_url('/student/assignment/submit'), 'controllers/student/assignments/store.php', ['student']);


$router->post(base_url('/quiz/attempt'), 'controllers/student/quizzes/attempt.php', ['student']);
$router->post(base_url('/exam/attempt'), 'controllers/student/exams/attempt.php', ['student']);

$router->get(base_url('/student/reports'), 'controllers/student/reports/index.php', ['student']);
$router->get(base_url('/student/reports/generate'), 'controllers/student/reports/generate.php', ['student']);


//PARENT ROUTES
$router->get(base_url('/parent/students'), 'controllers/parent/students/index.php', ['parent']);
$router->get(base_url('/parent/student/:sid/subjects'), 'controllers/parent/subjects/index.php', ['parent']);
$router->get(base_url('/parent/student/:sid/subject/:suid/projects'), 'controllers/parent/projects/index.php', ['parent']);
$router->get(base_url('/parent/student/:sid/subject/:suid/assignments'), 'controllers/parent/assignments/index.php', ['parent']);
$router->get(base_url('/parent/student/:sid/subject/:suid/quizzes'), 'controllers/parent/quizzes/index.php', ['parent']);
$router->get(base_url('/parent/student/:sid/subject/:suid/examinations'), 'controllers/parent/examinations/index.php', ['parent']);


$router->get(base_url('/parent/reports'), 'controllers/parent/reports/index.php', ['parent']);
$router->get(base_url('/parent/reports/generate'), 'controllers/parent/reports/generate.php', ['parent']);
$router->get(base_url('/parent/reports/subjects'), 'controllers/parent/reports/subjects.php', ['parent']);



