<?php
$act = "rounded-lg bg-green-600 text-white shadow-lg shadow-green-600/25 border border-green-500/20";
$nact = "rounded-lg text-slate-200 hover:bg-slate-700/50 hover:text-white transition-all duration-200 backdrop-blur-sm border border-transparent hover:border-slate-600/30";
require base_path('CORE/nav-notification.php');
?>

<!-- Enhanced navigation with gradient background and glassmorphic styling -->
<nav class="bg-gradient-to-r from-slate-900 via-slate-800 to-slate-900 border-b border-slate-700/50 backdrop-blur-xl">
    <!-- Added floating blur elements for visual depth -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-4 -left-4 w-24 h-24 bg-green-500/10 rounded-full blur-xl"></div>
        <div class="absolute top-8 right-1/4 w-32 h-32 bg-slate-500/5 rounded-full blur-2xl"></div>
        <div class="absolute -bottom-4 right-8 w-20 h-20 bg-green-400/8 rounded-full blur-xl"></div>
    </div>
    
    <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <div class="flex items-center">
                <div class="shrink-0">
                    <!-- Logo placeholder -->
                </div>
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-2">
                        <?php if ($role === "admin"): ?>
                            <a href=<?= base_url('/admin/programs') ?> class="<?= $heading === "Programs" ? $act : $nact ?> px-4 py-2.5 text-sm font-medium transition-all duration-200">Programs</a>
                            
                            <!-- Enhanced dropdown button with better styling -->
                            <button popovertarget="desktop-menu-solutions" class="<?= $heading === "Users" ? $act : $nact ?> px-4 py-2.5 text-sm font-medium inline-flex items-center gap-x-2 transition-all duration-200 hover:scale-105">
                                Users 
                                <svg viewBox="0 0 20 20" fill="currentColor" class="size-4 transition-transform duration-200 group-hover:rotate-180">
                                    <path d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" fill-rule="evenodd" />
                                </svg>
                            </button>

                            <!-- Enhanced popover with glassmorphic styling -->
                            <el-popover id="desktop-menu-solutions" anchor="bottom" popover class="w-screen max-w-max overflow-visible bg-transparent px-4 transition transition-discrete [--anchor-gap:--spacing(5)] backdrop:bg-transparent open:flex data-closed:translate-y-1 data-closed:opacity-0 data-enter:duration-200 data-enter:ease-out data-leave:duration-150 data-leave:ease-in">
                                <div class="w-screen max-w-md flex-auto overflow-hidden rounded-2xl bg-white/95 backdrop-blur-xl text-sm/6 shadow-2xl ring-1 ring-slate-200/50 border border-white/20">
                                    <div class="p-6">
                                        <!-- Enhanced menu items with better hover effects -->
                                        <div class="group relative flex gap-x-6 rounded-xl p-4 hover:bg-slate-50/80 transition-all duration-200 hover:scale-[1.02]">
                                            <div class="mt-1 flex size-12 flex-none items-center justify-center rounded-xl bg-gradient-to-br from-green-50 to-slate-50 group-hover:from-green-100 group-hover:to-slate-100 transition-all duration-200 shadow-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-slate-600">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <a href=<?= base_url('/admin/users/faculties') ?> class="font-semibold text-slate-900 group-hover:text-green-600 transition-colors duration-200">
                                                    Faculties
                                                    <span class="absolute inset-0"></span>
                                                </a>
                                                <p class="mt-1 text-slate-600 group-hover:text-slate-700 transition-colors duration-200">Manage and view details of all faculty members</p>
                                            </div>
                                        </div>
                                        <div class="group relative flex gap-x-6 rounded-lg p-4 hover:bg-gray-50">
                                            <div class="mt-1 flex size-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                                </svg>

                                            </div>
                                            <div>
                                                <a href=<?= base_url('/admin/users/students') ?> class="font-semibold text-gray-900">
                                                    Students
                                                    <span class="absolute inset-0"></span>
                                                </a>
                                                <p class="mt-1 text-gray-600">Browse and manage student and section assignments.</p>
                                            </div>
                                        </div>
                                        <div class="group relative flex gap-x-6 rounded-lg p-4 hover:bg-gray-50">
                                            <div class="mt-1 flex size-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                                </svg>

                                            </div>
                                            <div>
                                                <a href=<?= base_url('/admin/users/parents') ?> class="font-semibold text-gray-900">
                                                    Parents
                                                    <span class="absolute inset-0"></span>
                                                </a>
                                                <p class="mt-1 text-gray-600">View and manage parent accounts linked to their children’s student profiles</p>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </el-popover>


                        <?php elseif ($role === "faculty"): ?>
                            <a href=<?= base_url('/faculty/subjects') ?> class="<?= $heading === "Subjects" ? $act : $nact ?> px-4 py-2.5 text-sm font-medium transition-all duration-200">Subjects</a>
                            
                            <button popovertarget="submissions" class="<?= $heading === "Submissions" ? $act : $nact ?> px-4 py-2.5 text-sm font-medium inline-flex items-center gap-x-2 transition-all duration-200 hover:scale-105">
                                Submissions 
                                <svg viewBox="0 0 20 20" fill="currentColor" class="size-4 transition-transform duration-200 group-hover:rotate-180">
                                    <path d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" fill-rule="evenodd" />
                                </svg>
                            </button>

                            <el-popover id="submissions" anchor="bottom" popover class="w-screen max-w-max overflow-visible bg-transparent px-4 transition transition-discrete [--anchor-gap:--spacing(5)] backdrop:bg-transparent open:flex data-closed:translate-y-1 data-closed:opacity-0 data-enter:duration-200 data-enter:ease-out data-leave:duration-150 data-leave:ease-in">
                                <div class="w-screen max-w-md flex-auto overflow-hidden rounded-3xl bg-white text-sm/6 shadow-lg ring-1 ring-gray-900/5">
                                    <div class="p-4">

                                        <!-- Activities -->
                                        <div class="group relative flex gap-x-6 rounded-lg p-4 hover:bg-gray-50">
                                            <div class="mt-1 flex size-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">
                                                <!-- Clipboard Icon -->
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 4H7a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2.172a2 2 0 0 1 1.414.586l.828.828a2 2 0 0 0 1.414.586H17a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2Z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <a href="<?= base_url('/faculty/submissions/activities') ?>" class="font-semibold text-gray-900">
                                                    Activities
                                                    <span class="absolute inset-0"></span>
                                                </a>
                                                <p class="mt-1 text-gray-600">View and score submitted activities. </p>
                                            </div>
                                        </div>

                                        <!-- Quizzes -->
                                        <div class="group relative flex gap-x-6 rounded-lg p-4 hover:bg-gray-50">
                                            <div class="mt-1 flex size-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">
                                                <!-- Pencil Icon -->
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487a2.25 2.25 0 1 1 3.182 3.182L7.5 20.213l-4.5.75.75-4.5L16.862 4.487Z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <a href="<?= base_url('/faculty/submissions/quizzes') ?>" class="font-semibold text-gray-900">
                                                    Quizzes
                                                    <span class="absolute inset-0"></span>
                                                </a>
                                                <p class="mt-1 text-gray-600">Review and record scores of submitted quizzes.</p>
                                            </div>
                                        </div>

                                        <!-- Examinations -->
                                        <div class="group relative flex gap-x-6 rounded-lg p-4 hover:bg-gray-50">
                                            <div class="mt-1 flex size-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">
                                                <!-- Document Icon -->
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5V6a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 6v1.5M3 7.5v9a2.25 2.25 0 0 0 2.25 2.25h13.5A2.25 2.25 0 0 0 21 16.5v-9M3 7.5h18M9.75 12h4.5m-4.5 3h3" />
                                                </svg>
                                            </div>
                                            <div>
                                                <a href="<?= base_url('/faculty/submissions/exams') ?>" class="font-semibold text-gray-900">
                                                    Examinations
                                                    <span class="absolute inset-0"></span>
                                                </a>
                                                <p class="mt-1 text-gray-600">"Review and record scores of submitted examinations.</p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </el-popover>
                        <?php elseif ($role === "student"): ?>
                            <a href=<?= base_url('/student/subjects') ?> class="<?= $heading === "Subjects" ? $act : $nact ?> px-4 py-2.5 text-sm font-medium transition-all duration-200">Subjects</a>
                        <?php elseif ($role === "parent"): ?>
                            <a href=<?= base_url('/parent/students') ?> class="<?= $heading === "Students" ? $act : $nact ?> px-4 py-2.5 text-sm font-medium transition-all duration-200">MyStudents</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="hidden md:block">
                <div class="ml-4 flex items-center md:ml-6 space-x-4">
                    <?php if ($_SESSION['role'] === 'faculty') : ?>
                        <!-- Enhanced notification button with glassmorphic styling -->
                        <button popovertarget="notifications" type="button" class="relative rounded-xl p-3 text-slate-300 hover:text-white hover:bg-slate-700/50 focus:outline-2 focus:outline-offset-2 focus:outline-green-500 transition-all duration-200 backdrop-blur-sm border border-slate-600/30 hover:border-slate-500/50" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                            <span class="absolute -inset-1.5"></span>
                            <span class="sr-only">View notifications</span>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="size-6">
                                <path d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            
                            <?php if ((!empty($activityNotification) || !empty($quizNotification) || !empty($examNotification)) && $_SESSION['role'] === 'faculty') : ?>
                                <!-- Enhanced notification marker with glow effect -->
                                <span class="absolute -top-1 -right-1 block h-3 w-3 rounded-full bg-gradient-to-r from-red-500 to-red-400 ring-2 ring-slate-800 shadow-lg shadow-red-500/50"></span>

                                <el-popover id="notifications" anchor="bottom" popover class="w-screen max-w-max overflow-visible bg-transparent px-4 transition transition-discrete [--anchor-gap:--spacing(5)] backdrop:bg-transparent open:flex data-closed:translate-y-1 data-closed:opacity-0 data-enter:duration-200 data-enter:ease-out data-leave:duration-150 data-leave:ease-in">
                                    <div class="w-80 flex-auto overflow-hidden rounded-xl bg-gray-50 text-sm ring-1 ring-gray-300 shadow-lg">
                                        <!-- Scrollable container -->
                                        <div class="p-2 max-h-60 overflow-y-auto">

                                            <!-- Activities -->
                                            <?php if (!empty($activityNotification)): ?>
                                                <div class="px-3 py-2 text-xs font-semibold text-gray-500 uppercase">Activities</div>
                                                <?php foreach ($activityNotification as $notif): ?>
                                                    <a href="<?= base_url('/faculty/submissions/subject/' . htmlspecialchars($notif['subject_id']) . '/activity/' . htmlspecialchars($notif['activity_id'])) ?>" class="block p-3 border-b border-gray-200 last:border-none hover:bg-gray-100 transition-colors duration-150 text-left">
                                                        <div class="font-semibold text-gray-900">
                                                            <?= htmlspecialchars($notif['activity_title'] ?? 'Untitled Activity') ?>
                                                        </div>
                                                        <p class="mt-1 text-gray-700 text-sm">
                                                            <?= htmlspecialchars($notif['subject_name'] ?? 'Untitled Subject') ?> —
                                                            <?= (int)$notif['total_submissions'] ?> new submission<?= $notif['total_submissions'] > 1 ? 's' : '' ?>.
                                                        </p>
                                                    </a>
                                                <?php endforeach; ?>
                                            <?php endif; ?>

                                            <!-- Quizzes -->
                                            <?php if (!empty($quizNotification)): ?>
                                                <div class="px-3 py-2 text-xs font-semibold text-gray-500 uppercase">Quizzes</div>
                                                <?php foreach ($quizNotification as $notif): ?>
                                                    <a href="<?= base_url('/faculty/submissions/subject/' . htmlspecialchars($notif['subject_id']) . '/quiz/' . htmlspecialchars($notif['quiz_id'])) ?>" class="block p-3 border-b border-gray-200 last:border-none hover:bg-gray-100 transition-colors duration-150 text-left">
                                                        <div class="font-semibold text-gray-900">
                                                            <?= htmlspecialchars($notif['quiz_title'] ?? 'Untitled Quiz') ?>
                                                        </div>
                                                        <p class="mt-1 text-gray-700 text-sm">
                                                            <?= htmlspecialchars($notif['subject_name'] ?? 'Untitled Subject') ?> —
                                                            <?= (int)$notif['total_submissions'] ?> new submission<?= $notif['total_submissions'] > 1 ? 's' : '' ?>.
                                                        </p>
                                                    </a>
                                                <?php endforeach; ?>
                                            <?php endif; ?>

                                            <!-- Exams -->
                                            <?php if (!empty($examNotification)): ?>
                                                <div class="px-3 py-2 text-xs font-semibold text-gray-500 uppercase">Exams</div>
                                                <?php foreach ($examNotification as $notif): ?>
                                                    <a href="<?= base_url('/faculty/submissions/subject/' . htmlspecialchars($notif['subject_id']) . '/exam/' . htmlspecialchars($notif['exam_id'])) ?>" class="block p-3 border-b border-gray-200 last:border-none hover:bg-gray-100 transition-colors duration-150 text-left">
                                                        <div class="font-semibold text-gray-900">
                                                            <?= htmlspecialchars($notif['exam_title'] ?? 'Untitled Exam') ?>
                                                        </div>
                                                        <p class="mt-1 text-gray-700 text-sm">
                                                            <?= htmlspecialchars($notif['subject_name'] ?? 'Untitled Subject') ?> —
                                                            <?= (int)$notif['total_submissions'] ?> new submission<?= $notif['total_submissions'] > 1 ? 's' : '' ?>.
                                                        </p>
                                                    </a>
                                                <?php endforeach; ?>
                                            <?php endif; ?>

                                        </div>
                                    </div>
                                </el-popover>
                            <?php endif; ?>
                        <?php endif; ?>

                        <!-- Enhanced profile dropdown with glassmorphic styling -->
                        <div class="relative ml-3">
                            <div>
                                <button type="button" onclick="toggleMenu()" class="flex items-center gap-x-3 rounded-xl bg-slate-700/50 backdrop-blur-sm border border-slate-600/30 px-4 py-2.5 text-sm font-medium text-white hover:bg-slate-600/50 focus:outline-2 focus:outline-offset-2 focus:outline-green-500 transition-all duration-200 hover:scale-105" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                    <div class="flex items-center gap-x-3">
                                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-green-500 to-slate-600 flex items-center justify-center text-white font-semibold text-sm">
                                            <?= strtoupper(substr($_SESSION['first_name'], 0, 1)) ?>
                                        </div>
                                        <span class="hidden sm:block"><?= htmlspecialchars($_SESSION['last_name'] . ', ' . $_SESSION['first_name']) ?></span>
                                    </div>
                                    <box-icon id="chevron-icon" color="white" name="chevron-down" class="transition-transform duration-200"></box-icon>
                                </button>
                            </div>
                            
                            <!-- Enhanced dropdown menu with glassmorphic styling -->
                            <div id="menu" class="hidden absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-xl bg-white/95 backdrop-blur-xl py-2 shadow-2xl ring-1 ring-slate-200/50 border border-white/20 focus:outline-hidden" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                                <a href=<?= base_url('/logout') ?> class="flex items-center gap-x-3 px-4 py-3 text-sm text-slate-700 hover:bg-slate-50/80 hover:text-slate-900 transition-all duration-200 mx-2 rounded-lg" role="menuitem" tabindex="-1" id="user-menu-item-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                                    </svg>
                                    Logout
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Enhanced mobile menu button -->
            <div class="-mr-2 flex md:hidden">
                <button type="button" onclick="toggleMenu()" class="relative inline-flex items-center justify-center rounded-xl bg-slate-700/50 backdrop-blur-sm border border-slate-600/30 p-2.5 text-slate-300 hover:bg-slate-600/50 hover:text-white focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-slate-800 focus:outline-hidden transition-all duration-200" aria-controls="mobile-menu" aria-expanded="false">
                    <span class="absolute -inset-0.5"></span>
                    <span class="sr-only">Open main menu</span>
                    <svg class="block size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Enhanced mobile menu with glassmorphic styling -->
    <div class="hidden md:hidden" id="mobile-menu">
        <div class="bg-slate-800/95 backdrop-blur-xl border-t border-slate-700/50">
            <div class="space-y-2 px-4 pt-4 pb-3 sm:px-6">
                <?php if ($role === "admin"): ?>
                    <a href=<?= base_url('/admin/dashboard') ?> class="block <?= $heading === "Dashboard" ? $act : $nact ?> px-4 py-3 text-base font-medium transition-all duration-200" aria-current="page">Dashboard</a>
                    <a href=<?= base_url('/admin/programs') ?> class="block <?= $heading === "Programs" ? $act : $nact ?> px-4 py-3 text-base font-medium transition-all duration-200">Programs</a>
                    <a href=<?= base_url('/admin/subjects') ?> class="block <?= $heading === "Subjects" ? $act : $nact ?> px-4 py-3 text-base font-medium transition-all duration-200">Subjects</a>
                    <a href=<?= base_url('/admin/users') ?> class="block <?= $heading === "Users" ? $act : $nact ?> px-4 py-3 text-base font-medium transition-all duration-200">Users</a>
                <?php elseif ($role === "faculty"): ?>
                    <a href=<?= base_url('/faculty/dashboard') ?> class="block <?= $heading === "Dashboard" ? $act : $nact ?> px-4 py-3 text-base font-medium transition-all duration-200" aria-current="page">Dashboard</a>
                    <a href=<?= base_url('/faculty/students') ?> class="block <?= $heading === "Students" ? $act : $nact ?> px-4 py-3 text-base font-medium transition-all duration-200">Students</a>
                    <a href=<?= base_url('/faculty/subjects') ?> class="block <?= $heading === "Subjects" ? $act : $nact ?> px-4 py-3 text-base font-medium transition-all duration-200">Subjects</a>
                <?php elseif ($role === "student"): ?>
                    <a href=<?= base_url('/student/dashboard') ?> class="block <?= $heading === "Dashboard" ? $act : $nact ?> px-4 py-3 text-base font-medium transition-all duration-200" aria-current="page">Dashboard</a>
                    <a href=<?= base_url('/student/subjects') ?> class="block <?= $heading === "Subjects" ? $act : $nact ?> px-4 py-3 text-base font-medium transition-all duration-200">Subjects</a>
                    <a href=<?= base_url('/student/activities') ?> class="block <?= $heading === "Activities" ? $act : $nact ?> px-4 py-3 text-base font-medium transition-all duration-200">Activities</a>
                <?php elseif ($role === "parent"): ?>
                    <a href=<?= base_url('/parent/dashboard') ?> class="block <?= $heading === "Dashboard" ? $act : $nact ?> px-4 py-3 text-base font-medium transition-all duration-200" aria-current="page">Dashboard</a>
                    <a href=<?= base_url('/parent/students') ?> class="block <?= $heading === "Students" ? $act : $nact ?> px-4 py-3 text-base font-medium transition-all duration-200">Students</a>
                <?php endif; ?>
            </div>
            
            <!-- Enhanced mobile profile section -->
            <div class="border-t border-slate-700/50 pt-4 pb-3 bg-slate-900/50">
                <div class="flex items-center px-6">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-green-500 to-slate-600 flex items-center justify-center text-white font-semibold">
                        <?= strtoupper(substr($_SESSION['first_name'], 0, 1)) ?>
                    </div>
                    <div class="ml-4">
                        <div class="text-base font-medium text-white"><?= htmlspecialchars($_SESSION['last_name'] . ', ' . $_SESSION['first_name']) ?></div>
                        <div class="text-sm font-medium text-slate-400"><?= htmlspecialchars($_SESSION['email']) ?></div>
                    </div>
                </div>
                <div class="mt-4 space-y-2 px-4">
                    <a href=<?= base_url('/logout') ?> class="flex items-center gap-x-3 rounded-lg px-4 py-3 text-base font-medium text-slate-300 hover:bg-slate-700/50 hover:text-white transition-all duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                        </svg>
                        Logout
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>

<script>
    const toggleBtn = document.getElementById('toggleBtn');
    const dropdown = document.getElementById('dropdown');

    function showDropdown() {
        if (dropdown) {
            dropdown.classList.remove('opacity-0', 'translate-y-1', 'pointer-events-none');
            dropdown.classList.add('opacity-100', 'translate-y-0');
        }
    }

    function hideDropdown() {
        if (dropdown) {
            dropdown.classList.remove('opacity-100', 'translate-y-0');
            dropdown.classList.add('opacity-0', 'translate-y-1', 'pointer-events-none');
        }
    }

    if (toggleBtn && dropdown) {
        toggleBtn.addEventListener('click', () => {
            const isVisible = dropdown.classList.contains('opacity-100');
            isVisible ? hideDropdown() : showDropdown();
        });

        toggleBtn.addEventListener('mouseenter', showDropdown);
        dropdown.addEventListener('mouseleave', hideDropdown);
    }
</script>
