<?php
// $router->get(base_url('/faculty/subject/:id/activities'), 'controllers/faculty/activities/index.php', ['faculty']);
// $router->get(base_url('/faculty/subject/:id/activity'), 'controllers/faculty/activities/create.php', ['faculty']);
// $router->get(base_url('/faculty/subject/:id/activity/:aid'), 'controllers/faculty/activities/edit.php', ['faculty']);
// $router->post(base_url('/faculty/subject/activity/store'), 'controllers/faculty/activities/store.php', ['faculty']);
// $router->patch(base_url('/faculty/subject/activity/state'), 'controllers/faculty/activities/state.php', ['faculty']);
// $router->delete(base_url('/faculty/activity/delete'), 'controllers/faculty/activities/destroy.php', ['faculty']);
// $router->patch(base_url('/faculty/subject/:id/activity/:aid/update'), 'controllers/faculty/activities/update.php', ['faculty']);




$router->get(base_url('/faculty/submissions/activities'), 'controllers/faculty/submissions/activities/index.php', ['faculty']);
$router->get(base_url('/faculty/submissions/:id/activities'), 'controllers/faculty/submissions/activities/activities.php', ['faculty']);
$router->get(base_url('/faculty/submissions/subject/:id/activity/:aid'), 'controllers/faculty/submissions/activities/submissions.php', ['faculty']);
$router->get(base_url('/download'), 'controllers/download.php',['faculty', 'student']);
$router->patch(base_url('/faculty/submissions/activity/evaluate'), 'controllers/faculty/submissions/activities/evaluate.php',['faculty']);


$router->get(base_url('/student/subject/:id/activities'), 'controllers/student/activities/index.php', ['student']);
$router->get(base_url('/student/subject/:id/activity/:aid'), 'controllers/student/activities/activity.php', ['student']);
$router->post(base_url('/student/activity/submit'), 'controllers/student/activities/store.php', ['student']);

$router->get(base_url('/parent/student/:sid/subject/:suid/activities'), 'controllers/parent/activities/index.php', ['parent']);
