<?php
require("views/partials/head.php");
require("views/partials/nav.php");
require("views/partials/banner.php");
require("views/partials/notification.php");

?>

<main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">


            <!-- Cards Grid Container -->
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

                <?php foreach ($subjects as $subject) : ?>
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow">
                        <!-- Thumbnail -->
                        <div class="h-48 bg-gradient-to-br from-purple-400 to-purple-600 flex items-center justify-center">
                            <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                            </svg>
                        </div>
                        <!-- Content -->
                        <div class="bg-white mb-3 p-6 flex flex-col min-h-[320px]">
                            <!-- Upper Content -->
                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <h3 class="text-lg font-semibold text-gray-900"><?= htmlspecialchars($subject['subject_name']) ?></h3>
                                </div>
                                <p class="text-gray-600 text-sm mb-4"><?= htmlspecialchars($subject['subject_about']) ?></p>

                                <div class="space-y-2 mb-4">
                                    <div class="flex items-center text-sm text-gray-500">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        <span><?= htmlspecialchars($subject['faculty_name']) ?></span>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Buttons pushed to bottom -->
                            <div class="mt-auto space-y-2">
                                
                                <button
                                    data-id="<?= $subject['subject_id'] ?>"
                                    data-sname="<?= htmlspecialchars($subject['subject_name']) ?>"
                                    data-about="<?= htmlspecialchars($subject['subject_about']) ?>"
                                    data-program="<?= htmlspecialchars($subject['program_id']) ?>"
                                    data-faculty="<?= htmlspecialchars($subject['user_id']) ?>"
                                    class="openDrawerEdit w-full px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700 transition-colors text-sm font-medium">
                                    Manage Subject
                                </button>
                                <!-- <button class="w-full px-4 py-2 bg-teal-600 text-white rounded-md hover:bg-teal-700 transition-colors text-sm font-medium">
                                    Enroll Students
                                </button> -->
                            </div>
                        </div>

                    </div>
                <?php endforeach; ?>

            </div>


            <!-- Load More Button -->
            <!-- <div class="mt-8 text-center">
                <button class="px-6 py-3 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition-colors font-medium">
                    Load More Subjects
                </button>
            </div> -->
        </div>
    </div>
</main>

<!-- Adding Program Start -->

<!-- Drawer Backdrop & Panel -->
<div id="drawerBackdrop" class="fixed inset-0 z-10 hidden">
    <!-- Backdrop -->
    <div class="absolute inset-0 bg-gray-500/75 transition-opacity" aria-hidden="true"></div>

    <!-- Drawer Wrapper -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute inset-0 overflow-hidden">
            <div class="fixed inset-y-0 right-0 flex max-w-full pl-10 sm:pl-16">
                <!-- Sliding Panel -->
                <div id="drawerPanel" class="w-screen max-w-md bg-white shadow-xl transform transition-transform duration-500 translate-x-full">

                    <!-- Close Button -->
                    <div class="absolute top-0 right-0 flex pt-4 pr-4">
                        <button id="closeDrawer" type="button" class="rounded-md text-gray-300 hover:text-white focus:outline-none focus:ring-2 focus:ring-white">
                            <span class="sr-only">Close panel</span>
                            <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Drawer Content -->
                    <div class="flex h-full flex-col overflow-y-auto py-6 px-4 sm:px-6">
                        <h2 class="text-base font-semibold text-gray-900" id="drawer-title">Add Subject</h2>
                        <p class="mt-1 text-sm/6 text-gray-600">Please provide the Subject details. This information will be visible to system users.</p>
                        <div class="mt-6 flex-1">
                            <form method="POST" action=<?= base_url('/admin/subject/create') ?>>
                                <div class="space-y-12">
                                    <div class="border-b border-gray-900/10 pb-12">

                                        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-6">
                                            <div class="col-span-full">
                                                <label for="subject" class="block text-sm/6 font-medium text-gray-900">Subject</label>
                                                <div class="mt-2">
                                                    <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                                        <div class="shrink-0 text-base text-gray-500 select-none sm:text-sm/6"></div>
                                                        <input type="text" name="subject" id="subject" class="block w-full min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6" placeholder="e.g., Data Structures" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-span-full">
                                                <label for="program" class="block text-sm font-medium text-gray-900 mb-2">Program</label>
                                                <select id="program" name="program"
                                                    class="pr-10 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 text-gray-900 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 sm:text-sm"
                                                    <?= empty($programs) ? 'disabled' : 'required' ?>>

                                                    <?php if (empty($programs)) : ?>
                                                        <option selected disabled>No Program Available</option>
                                                    <?php else : ?>
                                                        <option value="" selected disabled>Select a Program</option>
                                                        <?php foreach ($programs as $program) : ?>
                                                            <option value="<?= htmlspecialchars($program['program_id']) ?>"><?= htmlspecialchars($program['program_name']) ?></option>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select>
                                            </div>

                                            <div class="col-span-full">
                                                <label for="faculty" class="block text-sm font-medium text-gray-900 mb-2">Subject Adviser</label>
                                                <select id="faculty" name="faculty" autocomplete="off" placeholder="Search or select a Subject Adviser..."
                                                    class="block w-full rounded-md border border-gray-300 bg-white py-2 px-3 text-gray-900 focus:outline-none focus:ring-1 focus:ring-indigo-500 sm:text-sm">

                                                    <?php

                                                    foreach ($faculties as $faculty): ?>
                                                        <option value="<?= htmlspecialchars($faculty['user_id']) ?>">
                                                            <?= htmlspecialchars($faculty['last_name'] . ', ' . $faculty['first_name']) ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>



                                            <div class="col-span-full">
                                                <label for="about" class="block text-sm/6 font-medium text-gray-900">About</label>
                                                <div class="mt-2">
                                                    <textarea name="about" id="about" rows="3" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"></textarea>
                                                </div>
                                                <p class="mt-3 text-sm/6 text-gray-600">Write a few sentences about the Subject.</p>
                                            </div>

                                        </div>
                                    </div>

                                </div>

                                <div class="mt-6 flex items-center justify-end gap-x-6">
                                    <button id="cancel" type="button" class="text-sm/6 font-semibold text-gray-900">Cancel</button>
                                    <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
                                </div>
                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


<!-- Adding Program End -->






<!-- Edit Program Start -->

<!-- Drawer Backdrop & Panel -->
<div id="drawerBackdropEdit" class="fixed inset-0 z-10 hidden">
    <!-- Backdrop -->
    <div class="absolute inset-0 bg-gray-500/75 transition-opacity" aria-hidden="true"></div>

    <!-- Drawer Wrapper -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute inset-0 overflow-hidden">
            <div class="fixed inset-y-0 right-0 flex max-w-full pl-10 sm:pl-16">
                <!-- Sliding Panel -->
                <div id="drawerPanelEdit" class="w-screen max-w-md bg-white shadow-xl transform transition-transform duration-500 translate-x-full">

                    <!-- Close Button -->
                    <div class="absolute top-0 right-0 flex pt-4 pr-4">
                        <button id="closeDrawerEdit" type="button" class="rounded-md text-gray-300 hover:text-white focus:outline-none focus:ring-2 focus:ring-white">
                            <span class="sr-only">Close panel</span>
                            <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Drawer Content -->
                    <div class="flex h-full flex-col overflow-y-auto py-6 px-4 sm:px-6">
                        <h2 class="text-base font-semibold text-gray-900" id="drawer-title">Update Subject</h2>
                        <p class="mt-1 text-sm/6 text-gray-600">Please provide the subject details needed to be updated. This information will be visible to system users.</p>
                        <div class="mt-6 flex-1">
                            <form method="POST" action=<?= base_url('/admin/subject/update') ?>>
                                <input type="hidden" name="_method" value="PATCH">
                                <div class="space-y-12">
                                    <div class="border-b border-gray-900/10 pb-12">

                                        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-6">
                                            <div class="col-span-full">
                                                <label for="subject" class="block text-sm/6 font-medium text-gray-900">Subject</label>
                                                <div class="mt-2">
                                                    <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                                        <div class="shrink-0 text-base text-gray-500 select-none sm:text-sm/6"></div>
                                                        <input class="hidden" name="subject_id">
                                                        <input type="text" name="subject" id="subject" class="block w-full min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6" placeholder="e.g., Data Structures" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-span-full">
                                                <label for="program" class="block text-sm font-medium text-gray-900 mb-2">Program</label>
                                                <select id="program" name="program"
                                                    class="pr-10 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 text-gray-900 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 sm:text-sm"
                                                 <?= empty($programs) ? 'disabled' : 'required' ?>>

                                                    
                                                        <option value="" selected disabled>Select a Program</option>
                                                        <?php foreach ($programs as $program) : ?>
                                                            <option value="<?= htmlspecialchars($program['program_id']) ?>"><?= htmlspecialchars($program['program_name']) ?></option>
                                                        <?php endforeach; ?>
                                                  
                                                
                                                </select>
                                            </div>

                                            <div class="col-span-full">
                                                <label for="faculty" class="block text-sm font-medium text-gray-900 mb-2">Subject Adviser</label>
                                                <select id="faculty" name="faculty" autocomplete="off" placeholder="Search or select a Subject Adviser..."
                                                    class="block w-full rounded-md border border-gray-300 bg-white py-2 px-3 text-gray-900 focus:outline-none focus:ring-1 focus:ring-indigo-500 sm:text-sm">

                                                    <?php

                                                    foreach ($faculties as $faculty): ?>
                                                        <option value="<?= htmlspecialchars($faculty['user_id']) ?>">
                                                            <?= htmlspecialchars($faculty['last_name'] . ', ' . $faculty['first_name']) ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>



                                            <div class="col-span-full">
                                                <label for="about" class="block text-sm/6 font-medium text-gray-900">About</label>
                                                <div class="mt-2">
                                                    <textarea name="about" id="about" rows="3" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"></textarea>
                                                </div>
                                                <p class="mt-3 text-sm/6 text-gray-600">Write a few sentences about the Subject.</p>
                                            </div>

                                        </div>
                                    </div>

                                </div>

                                <div class="mt-6 flex items-center justify-between gap-x-6">
                                    <button id="openDialog" type="button" class="text-sm/6  font-semibold text-red-600">DELETE</button>
                                    <button type="submit" class="rounded-md bg-indigo-600  w-50 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
                                </div>
                            </form>


                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Program End -->



<!-- Confirmation Dialog Start -->

<!-- Modal Backdrop & Container -->
<div id="dialogWrapper" class="hidden fixed inset-0 z-10 w-screen overflow-y-auto bg-gray-500/75 backdrop-blur-sm flex items-center justify-center">
    <div id="dialogPanel" class="opacity-0 scale-95 transition-all duration-300 ease-out relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl sm:w-full sm:max-w-lg">
        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="sm:flex sm:items-start">
                <div class="mx-auto flex size-12 shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:size-10">
                    <svg class="size-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                    </svg>
                </div>
                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                    <h3 class="text-base font-semibold text-gray-900">Delete Item</h3>
                    <p class="mt-2 text-sm text-gray-500">Are you sure you want to delete the Item? The item will be permanently removed. This action cannot be undone.</p>
                </div>
            </div>
        </div>
        <form method="POST" action="<?= base_url('/admin/subject/delete') ?>">
            <input type="hidden" name="subject_id" id="subject_id">
            <input type="hidden" name="_method" value="DELETE">
            <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                <button type="submit"
                    class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-red-500 sm:ml-3 sm:w-auto">
                    Delete
                </button>
                <button id="cancelDialog" type="button"
                    class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-xs ring-1 ring-gray-300 ring-inset hover:bg-gray-50 sm:mt-0 sm:w-auto">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Confirmation Dialog End -->




<!-- JS to handle open/close -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const openBtn = document.getElementById('openDrawer');
        const closeBtn = document.getElementById('closeDrawer');
        const drawerBackdrop = document.getElementById('drawerBackdrop');
        const drawerPanel = document.getElementById('drawerPanel');
        const cancel = document.getElementById('cancel');

        const openBtnEdit = document.getElementsByClassName('openDrawerEdit');
        const closeBtnEdit = document.getElementById('closeDrawerEdit');
        const drawerBackdropEdit = document.getElementById('drawerBackdropEdit');
        const drawerPanelEdit = document.getElementById('drawerPanelEdit');



        function clearInputs() {
            const inputs = drawerPanel.querySelectorAll('input, textarea');
            inputs.forEach(input => {
                input.value = ''
            });

        }

        function closeDrawer() {
            drawerPanel.classList.add('translate-x-full');
            drawerPanel.addEventListener('transitionend', () => {
                drawerBackdrop.classList.add('hidden');
                clearInputs(); // Clear form inputs after closing
            }, {
                once: true
            });

        }

        function closeEditDrawer() {

            drawerPanelEdit.classList.add('translate-x-full');
            drawerPanelEdit.addEventListener('transitionend', () => {
                drawerBackdropEdit.classList.add('hidden');
                clearInputs(); // Clear form inputs after closing
            }, {
                once: true
            });
        }


        openBtn.addEventListener('click', () => {
            drawerBackdrop.classList.remove('hidden');
            setTimeout(() => drawerPanel.classList.remove('translate-x-full'), 10);
        });

        Array.from(openBtnEdit).forEach(btn => {
            btn.addEventListener('click', () => {
                // Populate form fields
                const id = btn.dataset.id;
                const pid = btn.dataset.program;
                const sname = btn.dataset.sname;
                const about = btn.dataset.about;
                const faculty = btn.dataset.faculty;

                document.querySelector('#drawerPanelEdit input[name="subject_id"]').value = id;
                document.querySelector('#drawerPanelEdit select[name="program"]').value = pid;
                document.querySelector('#drawerPanelEdit select[name="faculty"]').value = faculty;
                document.querySelector('#drawerPanelEdit input[name="subject"]').value = sname;
                document.querySelector('#drawerPanelEdit textarea[name="about"]').value = about;

                openDialog.setAttribute('data-id', id);

                // Show drawer
                drawerBackdropEdit.classList.remove('hidden');
                setTimeout(() => drawerPanelEdit.classList.remove('translate-x-full'), 10);
            });
        });

        cancel.addEventListener('click', closeDrawer);
        closeBtn.addEventListener('click', closeDrawer);


        closeBtnEdit.addEventListener('click', closeEditDrawer);



        //Confiramtion dialog script
        const openDialog = document.getElementById('openDialog');
        const cancelBtn = document.getElementById('cancelDialog');
        const wrapper = document.getElementById('dialogWrapper');
        const panel = document.getElementById('dialogPanel');
        const subject_id = document.getElementById('subject_id')

        openDialog.addEventListener('click', () => {

            const id = openDialog.getAttribute('data-id');
            subject_id.value = id;

            wrapper.classList.remove('hidden');
            setTimeout(() => {
                panel.classList.remove('opacity-0', 'scale-95');
                panel.classList.add('opacity-100', 'scale-100');
            }, 10);
        });

        cancelBtn.addEventListener('click', () => {
            panel.classList.remove('opacity-100', 'scale-100');
            panel.classList.add('opacity-0', 'scale-95');
            setTimeout(() => {
                wrapper.classList.add('hidden');
            }, 300);
        });

        new TomSelect('#faculty', {
            create: false,
            sortField: {
                field: 'text',
                direction: 'asc'
            }
        });
    })
</script>



<?php require("views/partials/foot.php"); ?>