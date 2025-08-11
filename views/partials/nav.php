<?php
$act = "rounded-md bg-indigo-600 text-white";
$nact = "rounded-md  text-gray-300 hover:bg-indigo-700 hover:text-white";
?>

<nav class="bg-indigo-600">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <div class="flex items-center">
                <div class="shrink-0">
                    <!-- <img
                  class="size-8"
                  src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500"
                  alt="Your Company"
                /> -->
                </div>
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <!-- Current: "bg-gray-600 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                        <?php if ($role === "admin"): ?>

                            <a
                                href=<?= base_url('/admin/programs') ?>

                                class="<?= $heading === "Programs" ? $act : $nact ?> px-3 py-2 text-sm font-medium">Programs</a>
                            <button
                                popovertarget="desktop-menu-solutions"
                                class="<?= $heading === "Users" ? $act : $nact ?> px-3 py-2 text-sm font-medium inline-flex items-center gap-x-1 text-sm/6 font-semibold">Users <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="size-5">
                                    <path d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" fill-rule="evenodd" />
                                </svg></button>

                            <el-popover id="desktop-menu-solutions" anchor="bottom" popover class="w-screen max-w-max overflow-visible bg-transparent px-4 transition transition-discrete [--anchor-gap:--spacing(5)] backdrop:bg-transparent open:flex data-closed:translate-y-1 data-closed:opacity-0 data-enter:duration-200 data-enter:ease-out data-leave:duration-150 data-leave:ease-in">
                                <div class="w-screen max-w-md flex-auto overflow-hidden rounded-3xl bg-white text-sm/6 shadow-lg ring-1 ring-gray-900/5">
                                    <div class="p-4">
                                        <div class="group relative flex gap-x-6 rounded-lg p-4 hover:bg-gray-50">
                                            <div class="mt-1 flex size-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">

                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                                                </svg>

                                            </div>
                                            <div>
                                                <a href=<?= base_url('/admin/users/faculties') ?> class="font-semibold text-gray-900">
                                                    Faculties
                                                    <span class="absolute inset-0"></span>
                                                </a>
                                                <p class="mt-1 text-gray-600">Manage and view details of all faculty members</p>
                                            </div>
                                        </div>
                                        <div class="group relative flex gap-x-6 rounded-lg p-4 hover:bg-gray-50">
                                            <div class="mt-1 flex size-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
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


                            <a
                                href=<?= base_url('/faculty/subjects') ?>
                                class="<?= $heading === "Subjects" ? $act : $nact ?> px-3 py-2 text-sm font-medium">Subjects</a>
                            <button
                                popovertarget="submissions"
                                class="<?= $heading === "Submissions" ? $act : $nact ?> px-3 py-2 text-sm font-medium inline-flex items-center gap-x-1 text-sm/6 font-semibold">Submissions <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="size-5">
                                    <path d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" fill-rule="evenodd" />
                                </svg></button>

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

                            <a
                                href=<?= base_url('/student/subjects') ?>
                                class="<?= $heading === "Subjects" ? $act : $nact ?> px-3 py-2 text-sm font-medium">Subjects</a>






                        <?php elseif ($role === "parent"): ?>


                            <a
                                href=<?= base_url('/parent/students') ?>

                                class="<?= $heading === "Students" ? $act : $nact ?> px-3 py-2 text-sm font-medium">My Students</a>

                        <?php endif; ?>

                    </div>
                </div>
            </div>
            <div class="hidden md:block">
                <div class="ml-4 flex items-center md:ml-6">
                    <!-- Profile dropdown -->
                    <div class="relative ml-3">
                        <div>
                            <button
                                type="button"
                                onclick="toggleMenu()"
                                class="text-white font-bold flex max-w-xs items-center bg-indigo-600 text-sm focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 focus:outline-hidden"
                                id="user-menu-button"
                                aria-expanded="false"
                                aria-haspopup="true">
                                <?= htmlspecialchars($_SESSION['last_name'] . ', ' . $_SESSION['first_name']) ?>
                                <box-icon
                                    id="chevron-icon"
                                    color="white"
                                    name="chevron-down"></box-icon>
                            </button>
                        </div>
                        <div
                            id="menu"
                            class="hidden absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black/5 focus:outline-hidden"
                            role="menu"
                            aria-orientation="vertical"
                            aria-labelledby="user-menu-button"
                            tabindex="-1">

                            <a
                                href=<?= base_url('/logout') ?>
                                class="block px-4 py-2 text-sm text-gray-700"
                                role="menuitem"
                                tabindex="-1"
                                id="user-menu-item-2">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="-mr-2 flex md:hidden">
                <!-- Mobile menu button -->
                <button
                    type="button"
                    onclick="toggleMenu()"
                    class="relative inline-flex items-center justify-center rounded-md bg-indigo-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-indigo-800 focus:outline-hidden"
                    aria-controls="mobile-menu"
                    aria-expanded="false">
                    <span class="absolute -inset-0.5"></span>
                    <span class="sr-only">Open main menu</span>
                    <!-- Menu open: "hidden", Menu closed: "block" -->
                    <svg
                        class="block size-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        aria-hidden="true"
                        data-slot="icon">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <!-- Menu open: "block", Menu closed: "hidden" -->
                    <svg
                        class="hidden size-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        aria-hidden="true"
                        data-slot="icon">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div class="hidden md:hidden" id="mobile-menu">
        <div class="space-y-1 px-2 pt-2 pb-3 sm:px-3">
            <!-- Current: "bg-gray-600 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
            <?php if ($role === "admin"): ?>
                <a
                    href=<?= base_url('/admin/dashboard') ?>
                    class="block <?= $heading === "Dashboard" ? $act : $nact ?> px-3 py-2 text-base font-medium"
                    aria-current="page">Dashboard</a>

                <a
                    href=<?= base_url('/admin/programs') ?>

                    class="block <?= $heading === "Programs" ? $act : $nact ?> px-3 py-2 text-base font-medium">Programs</a>
                <a
                    href=<?= base_url('/admin/subjects') ?>

                    class="block <?= $heading === "Subjects" ? $act : $nact ?> px-3 py-2 text-base font-medium">Subjects</a>
                <a
                    href=<?= base_url('/admin/users') ?>

                    class="block <?= $heading === "Users" ? $act : $nact ?> px-3 py-2 text-base font-medium">Users</a>


            <?php elseif ($role === "faculty"): ?>

                <a
                    href=<?= base_url('/faculty/dashboard') ?>
                    class="block <?= $heading === "Dashboard" ? $act : $nact ?> px-3 py-2 text-base font-medium"
                    aria-current="page">Dashboard</a>
                <a
                    href=<?= base_url('/faculty/students') ?>
                    class="block <?= $heading === "Students" ? $act : $nact ?> px-3 py-2 text-base font-medium">Students</a>
                <a
                    href=<?= base_url('/faculty/subjects') ?>
                    class="block <?= $heading === "Subjects" ? $act : $nact ?> px-3 py-2 text-base font-medium">Subjects</a>

            <?php elseif ($role === "student"): ?>

                <a
                    href=<?= base_url('/student/dashboard') ?>
                    class="block <?= $heading === "Dashboard" ? $act : $nact ?> px-3 py-2 text-base font-medium"
                    aria-current="page">Dashboard</a>
                <a
                    href=<?= base_url('/student/subjects') ?>
                    class="block <?= $heading === "Subjects" ? $act : $nact ?> px-3 py-2 text-base font-medium">Subjects</a>


                <a
                    href=<?= base_url('/student/activities') ?>
                    class="block <?= $heading === "Activities" ? $act : $nact ?> px-3 py-2 text-base font-medium">Activities</a>

            <?php elseif ($role === "parent"): ?>

                <a
                    href=<?= base_url('/parent/dashboard') ?>
                    class="block <?= $heading === "Dashboard" ? $act : $nact ?> px-3 py-2 text-base font-medium"
                    aria-current="page">Dashboard</a>
                <a
                    href=<?= base_url('/parent/students') ?>
                    class="block <?= $heading === "Students" ? $act : $nact ?> px-3 py-2 text-base font-medium">Students</a>

            <?php endif; ?>
        </div>
        <div class="border-t border-gray-700 pt-4 pb-3">
            <div class="flex items-center px-5">

                <div class="ml-3">
                    <div class="text-base/5 font-medium text-white"><?= htmlspecialchars($_SESSION['last_name'] . ', ' . $_SESSION['first_name']) ?></div>
                    <div class="text-sm font-medium text-gray-400">
                        <?= htmlspecialchars($_SESSION['email']) ?>
                    </div>
                </div>

            </div>
            <div class="mt-3 space-y-1 px-2">
                <!-- <a
                href="#"
                class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white"
                >Your Profile</a
              > -->
                <a
                    href=<?= base_url('/logout') ?>
                    class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-indigo-700 hover:text-white">logout</a>
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