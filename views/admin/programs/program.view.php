<?php
require("views/partials/head.php");
require("views/partials/nav.php");
require("views/partials/notification.php");
?>

<header class="bg-white shadow-sm px-30 flex-none">
    <div class="mx-auto max-w-7xl py-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2"><?= htmlentities($program['program_name']); ?> </h1>
            <p class="mt-1 text-sm/6 text-gray-600"><?= htmlentities($program['program_about']); ?></p>
        </div>
        <a href=<?= base_url('/admin/program/edit/' . $program['program_id']) ?> class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-colors focus:ring-2 focus:ring-green-500 focus:ring-offset-2 outline-none">
            Manage
        </a>
    </div>
</header>

<main class="flex-1 overflow-y-auto px-30 py-6">

    <!-- Sections Table -->
    <div class="mb-6">
        <div class="bg-white rounded-xl shadow-sm ring-1 ring-gray-200 overflow-hidden">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 bg-gray-50">
                <h2 class="text-lg font-semibold text-gray-900">Sections</h2>
                <button command="show-modal" commandfor="drawer"
                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-green-600 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors duration-150">
                    Add Section
                </button>
            </div>
            <div class="max-h-[600px] overflow-y-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-100">
                            <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Section</th>
                            <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Students</th>
                            <th class="w-50 px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        <?php foreach ($sections as $section): ?>
                            <tr class="hover:bg-gray-25 transition-colors duration-150">
                                <td class="px-6 py-5 text-center">
                                    <div class="text-sm font-medium text-gray-900"><?= htmlspecialchars($section['section_name']) ?></div>
                                </td>
                                <td class="px-6 py-5 text-center">
                                    <span class="text-sm text-gray-600"><?= htmlspecialchars($section['student_count']) ?></span>
                                </td>
                                <td class="w-50 px-6 py-5 text-right">
                                    <a href="<?= base_url("/admin/program/" . htmlspecialchars($section['section_id'])) ?>"
                                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-amber-600 rounded-lg hover:bg-amber-700">
                                        EDIT
                                    </a>
                                    <button type="button" command="show-modal" commandfor="delete-dialog-<?= htmlspecialchars($section['section_id']) ?>"
                                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-rose-600 rounded-lg hover:bg-rose-700">
                                        Delete
                                    </button>
                                </td>
                            </tr>

                            <!-- Delete confirmation modal -->
                            <el-dialog>
                                <dialog id="delete-dialog-<?= htmlspecialchars($section['section_id']) ?>" aria-labelledby="dialog-title"
                                    class="fixed inset-0 overflow-y-auto bg-transparent backdrop:bg-transparent">
                                    <el-dialog-backdrop class="fixed inset-0 bg-gray-500/75 transition-opacity"></el-dialog-backdrop>
                                    <div class="fixed inset-0 flex items-center justify-center p-4">
                                        <el-dialog-panel class="relative bg-white rounded-lg shadow-xl sm:w-full sm:max-w-lg">
                                            <div class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                                <div class="sm:flex sm:items-start">
                                                    <div class="mx-auto flex size-12 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:size-10">
                                                        <svg class="size-6 text-red-600" fill="none" stroke="currentColor" stroke-width="1.5">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M12 9v3.75M12 15.75h.007v.008H12v-.008ZM3.697 17.126c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L3.697 17.126Z" />
                                                        </svg>
                                                    </div>
                                                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                                        <h3 id="dialog-title" class="text-base font-semibold text-gray-900">Delete Section?</h3>
                                                        <p class="mt-2 text-sm text-gray-500">Are you sure you want to delete <?= htmlspecialchars($section['section_name']) ?>? This action cannot be undone.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse">
                                                <form method="POST" action=<?= base_url("/admin/section/delete") ?>>
                                                    <input type="hidden" name="_method" value="DELETE" />
                                                    <input type="hidden" name="program_id" value=<?= htmlspecialchars($section['program_id']) ?> />

                                                    <input type="hidden" name="section_id" value=<?= htmlspecialchars($section['section_id']) ?> />
                                                    <button type="submit"
                                                        class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-red-500 sm:ml-3 sm:w-auto">
                                                        Delete
                                                    </button>
                                                </form>
                                                <button type="button" command="close" commandfor="delete-dialog-<?= htmlspecialchars($section['section_id']) ?>"
                                                    class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-xs ring-1 ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">
                                                    Cancel
                                                </button>
                                            </div>
                                        </el-dialog-panel>
                                    </div>
                                </dialog>
                            </el-dialog>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Subjects Table -->
    <div>
        <div class="bg-white rounded-xl shadow-sm ring-1 ring-gray-200 overflow-hidden">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 bg-gray-50">
                <h2 class="text-lg font-semibold text-gray-900">Subjects</h2>
                <a href="<?= base_url('/admin/program/subject/add') ?>"
                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-green-600 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors duration-150">
                    Add Subject
                </a>
            </div>
            <div class="p-6 text-gray-600 text-sm">
                <div class="max-h-[600px] overflow-y-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-gray-100">
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subject</th>
                                <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Faculty</th>
                                <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Students</th>
                                <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Section</th>
                                <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            <?php foreach ($subjects as $subject): ?>
                                <tr class="hover:bg-gray-25 transition-colors duration-150">
                                    <td class="px-6 py-5">
                                        <div class="text-sm font-medium text-gray-900"><?= htmlspecialchars($subject['subject_name']) ?></div>
                                    </td>
                                    <td class="px-6 py-5 text-center">
                                        <span class="text-sm text-gray-600"><?= htmlspecialchars($subject['faculty_name']) ?></span>
                                    </td>
                                    <td class="px-6 py-5 text-center">
                                        <span class="text-sm text-gray-600"><?= htmlspecialchars($subject['student_count']) ?></span>
                                    </td>
                                    <td class="px-6 py-5 text-center">
                                        <span class="text-sm text-gray-600"><?= htmlspecialchars($subject['section_name']) ?></span>
                                    </td>
                                    <td class="px-6 py-5 text-center">
                                        <a href="<?= base_url("/admin/program/" . htmlspecialchars($subject['section_id'])) ?>"
                                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors duration-150">
                                            EDIT
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</main>

<!-- Add Drawer (kept as is) -->
<el-dialog>
    <dialog id="drawer" aria-labelledby="drawer-title" class="fixed inset-0 size-auto max-h-none max-w-none overflow-hidden bg-transparent not-open:hidden backdrop:bg-transparent">
        <el-dialog-backdrop class="absolute inset-0 bg-gray-500/75 transition-opacity duration-500 ease-in-out data-closed:opacity-0"></el-dialog-backdrop>
        <div tabindex="0" class="absolute inset-0 pl-10 focus:outline-none sm:pl-16">
            <el-dialog-panel class="group/dialog-panel relative ml-auto block size-full max-w-md transform transition duration-500 ease-in-out data-closed:translate-x-full sm:duration-700">
                <div class="flex h-full flex-col overflow-y-auto bg-white py-6 shadow-xl">
                    <div class="px-4 sm:px-6">
                        <h2 id="drawer-title" class="text-base font-semibold text-gray-900">Add Section</h2>
                    </div>
                    <div class="relative mt-6 flex-1 px-4 sm:px-6">
                        <form method="POST" action=<?= base_url("/admin/section/store") ?>>
                            <div class="space-y-12">
                                <div class="border-b border-gray-900/10 pb-12">
                                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                        <div class="sm:col-span-6">
                                            <label for="section_name" class="block text-sm/6 font-medium text-gray-900">Section Name</label>
                                            <div class="mt-2">
                                                <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-green-600">
                                                    <input type="hidden" name="program_id" value=<?= htmlspecialchars($program['program_id']) ?> />
                                                    <input required id="section_name" type="text" name="section_name" placeholder="eg. BSIT-1A" class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-6 flex items-center justify-end gap-x-6">
                                <button command="close" commandfor="drawer" type="button" class="text-sm/6 font-semibold text-gray-900">Cancel</button>
                                <button type="submit" class="rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-green-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </el-dialog-panel>
        </div>
    </dialog>
</el-dialog>


<?php require("views/partials/foot.php"); ?>