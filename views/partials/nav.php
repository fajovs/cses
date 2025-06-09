<?php
    $act = "rounded-md bg-purple-900 text-white";
    $nact = "rounded-md  text-gray-300 hover:bg-purple-700 hover:text-white";
?>

<nav class="bg-purple-800">
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
                        <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                        <?php if($role === "admin"):?>
                            <a
                                href="/admin/dashboard"
                                class=  "<?= $heading === "Dashboard" ? $act : $nact?> px-3 py-2 text-sm font-medium"
                                aria-current="page">Dashboard</a>
                                
                            <a
                                href="/admin/departments"
                                class="<?= $heading === "Departments" ? $act : $nact?> px-3 py-2 text-sm font-medium">Departments</a>
                            <a
                                href="/admin/programs"
                                class="<?= $heading === "Programs" ? $act : $nact?> px-3 py-2 text-sm font-medium">Programs</a>
                            <a
                                href="/admin/subjects"
                                class="<?= $heading === "Subjects" ? $act : $nact?> px-3 py-2 text-sm font-medium">Subjects</a>
                            <a
                                href="/admin/users"
                                class="<?= $heading === "Users" ? $act : $nact?> px-3 py-2 text-sm font-medium">Users</a>
                        
                        <?php elseif($role === "faculty"):?>

                            <a
                                href="/faculty/dashboard"
                                class=  "<?= $heading === "Dashboard" ? $act : $nact?> px-3 py-2 text-sm font-medium"
                                aria-current="page">Dashboard</a>
                            <a
                                href="/faculty/students"
                                class="<?= $heading === "Students" ? $act : $nact?> px-3 py-2 text-sm font-medium">Students</a>
                            <a
                                href="/faculty/subjects"
                                class="<?= $heading === "Subjects" ? $act : $nact?> px-3 py-2 text-sm font-medium">Subjects</a>
                           
                        <?php elseif($role === "student"):?>

                            <a
                                href="/student/dashboard"
                                class=  "<?= $heading === "Dashboard" ? $act : $nact?> px-3 py-2 text-sm font-medium"
                                aria-current="page">Dashboard</a>
                            <a
                                href="/student/activities"
                                class="<?= $heading === "Activities" ? $act : $nact?> px-3 py-2 text-sm font-medium">Activities</a>
                         
                        <?php elseif($role === "parent"):?>

                            <a
                                href="/parent/dashboard"
                                class=  "<?= $heading === "Dashboard" ? $act : $nact?> px-3 py-2 text-sm font-medium"
                                aria-current="page">Dashboard</a>
                            <a
                                href="/parent/students"
                                class="<?= $heading === "Students" ? $act : $nact?> px-3 py-2 text-sm font-medium">Students</a>
                         
                        <?php endif;?>

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
                                class="text-white font-bold flex max-w-xs items-center bg-purple-800 text-sm focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 focus:outline-hidden"
                                id="user-menu-button"
                                aria-expanded="false"
                                aria-haspopup="true">
                                Dela Cruz, Juan
                                <box-icon
                                    id="chevron-icon"
                                    color="white"
                                    name="chevron-down"></box-icon>
                            </button>
                        </div>

                        <!--
                Dropdown menu, show/hide based on menu state.

                Entering: "transition ease-out duration-100"
                  From: "transform opacity-0 scale-95"
                  To: "transform opacity-100 scale-100"
                Leaving: "transition ease-in duration-75"
                  From: "transform opacity-100 scale-100"
                  To: "transform opacity-0 scale-95"
              -->
                        <div
                            id="menu"
                            class="hidden absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black/5 focus:outline-hidden"
                            role="menu"
                            aria-orientation="vertical"
                            aria-labelledby="user-menu-button"
                            tabindex="-1">
                            <!-- Active: "bg-gray-100 outline-hidden", Not Active: "" -->
                            <!-- <a
                      href="user-profile.html"
                      class="block px-4 py-2 text-sm text-gray-700"
                      role="menuitem"
                      tabindex="-1"
                      id="user-menu-item-0"
                      >Your Profile</a
                    > -->
                            <a
                                href="/"
                                class="block px-4 py-2 text-sm text-gray-700"
                                role="menuitem"
                                tabindex="-1"
                                id="user-menu-item-2">Sign out</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="-mr-2 flex md:hidden">
                <!-- Mobile menu button -->
                <button
                    type="button"
                    onclick="toggleMenu()"
                    class="relative inline-flex items-center justify-center rounded-md bg-purple-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-purple-800 focus:outline-hidden"
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
            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
            <?php if($role === "admin"):?>
                <a
                    href="/admin/dashboard"
                    class=  "block <?= $heading === "Dashboard" ? $act : $nact?> px-3 py-2 text-base font-medium"
                    aria-current="page">Dashboard</a>
                    
                <a
                    href="/admin/departments"
                    class="block <?= $heading === "Departments" ? $act : $nact?> px-3 py-2 text-base font-medium">Departments</a>
                <a
                    href="/admin/programs"
                    class="block <?= $heading === "Programs" ? $act : $nact?> px-3 py-2 text-base font-medium">Programs</a>
                <a
                    href="/admin/subjects"
                    class="block <?= $heading === "Subjects" ? $act : $nact?> px-3 py-2 text-base font-medium">Subjects</a>
                <a
                    href="/admin/users"
                    class="block <?= $heading === "Users" ? $act : $nact?> px-3 py-2 text-base font-medium">Users</a>
            
            <?php elseif($role === "faculty"):?>

                <a
                    href="/faculty/dashboard"
                    class=  "block <?= $heading === "Dashboard" ? $act : $nact?> px-3 py-2 text-base font-medium"
                    aria-current="page">Dashboard</a>
                <a
                    href="/faculty/students"
                    class="block <?= $heading === "Students" ? $act : $nact?> px-3 py-2 text-base font-medium">Students</a>
                <a
                    href="/faculty/subjects"
                    class="block <?= $heading === "Subjects" ? $act : $nact?> px-3 py-2 text-base font-medium">Subjects</a>
                
            <?php elseif($role === "student"):?>

                <a
                    href="/student/dashboard"
                    class=  "block <?= $heading === "Dashboard" ? $act : $nact?> px-3 py-2 text-base font-medium"
                    aria-current="page">Dashboard</a>
                <a
                    href="/student/activities"
                    class="block <?= $heading === "Activities" ? $act : $nact?> px-3 py-2 text-base font-medium">Activities</a>
                
            <?php elseif($role === "parent"):?>

                <a
                    href="/parent/dashboard"
                    class=  "block <?= $heading === "Dashboard" ? $act : $nact?> px-3 py-2 text-base font-medium"
                    aria-current="page">Dashboard</a>
                <a
                    href="/parent/students"
                    class="block <?= $heading === "Students" ? $act : $nact?> px-3 py-2 text-base font-medium">Students</a>
                
            <?php endif;?>
        </div>
        <div class="border-t border-gray-700 pt-4 pb-3">
            <div class="flex items-center px-5">

                <div class="ml-3">
                    <div class="text-base/5 font-medium text-white">Dela Cruz, Juan</div>
                    <div class="text-sm font-medium text-gray-400">
                        delacruzjuan@example.com
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
                    href="/"
                    class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-purple-700 hover:text-white">Sign out</a>
            </div>
        </div>
    </div>
</nav>