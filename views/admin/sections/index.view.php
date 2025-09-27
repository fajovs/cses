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
        <div class="flex flex-col gap-4">
            <a href=<?= base_url('/admin/program/edit/' . $program['program_id']) ?> class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-colors focus:ring-2 focus:ring-green-500 focus:ring-offset-2 outline-none">
                Manage
            </a>
            <a href=<?= base_url('/admin/program/' . $program['program_id']) . '/subjects' ?> class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-colors focus:ring-2 focus:ring-green-500 focus:ring-offset-2 outline-none">
                Subjects
            </a>

        </div>

    </div>
</header>

<main class="flex-1 overflow-y-auto px-27 py-6">
    <div class="my-2 flex justify-end">
        <button command="show-modal" commandfor="drawer"
            class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-green-600 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors duration-150">
            Add Section
        </button>
    </div>

    <?php ksort($sections); // sort years ascending 
    ?>
    <?php foreach ($sections as $year => $yearSections): ?>
        

        <div class="mb-12">
            <?php if ($year === 1) : ?>
                <h2 class="text-lg font-semibold text-gray-900 mb-4">First Year</h2>
            <?php elseif ($year === 2) : ?>
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Second Year</h2>
            <?php elseif ($year === 3) : ?>
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Third Year</h2>
            <?php elseif ($year === 4) : ?>
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Fourth Year</h2>
            <?php endif; ?>
            <!-- Search Input for this year -->
            <input type="text" placeholder="Search sections in Year <?= $year ?>..."
                class="searchInput w-full px-4 py-3 text-sm bg-white border-0 rounded-lg shadow-sm ring-1 ring-gray-200 focus:ring-2 focus:ring-green-500 mb-4"
                data-year="<?= $year ?>">

            <div class="bg-white rounded-xl shadow-sm ring-1 ring-gray-200 overflow-hidden">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-100">
                            <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Section</th>
                            <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Students</th>
                            <th class="w-50 px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Year Level</th>
                            <th class="w-50 px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        <?php foreach ($yearSections as $section): ?>
                            <tr class="hover:bg-gray-25 transition-colors duration-150 searchRow"
                                data-search-value="<?= htmlspecialchars($section['section_name']) ?>"
                                data-year="<?= $year ?>">
                                <td class="px-6 py-5 text-center"><?= htmlspecialchars($section['section_name']) ?></td>
                                <td class="px-6 py-5 text-center"><?= htmlspecialchars($section['student_count']) ?></td>
                                <td class="px-6 py-5 text-center">
                            
                                        <span class="inline-flex items-center rounded-md bg-green-400/10 px-2 py-1 text-xs font-medium text-green-400 inset-ring inset-ring-green-400/20"><?= $year === 1 ? 'First Year' : ($year === 2 ? 'Second Year' : ($year === 3 ? 'Third Year' : ($year === 4 ? 'Fourth Year' : ''))) ?></span>
                                   
                                </td>
                                <td class="w-50 px-6 py-5 text-center">
                                    <button command="show-modal" commandfor="drawerEdit"
                                        data-section-id="<?= htmlspecialchars($section['section_id']) ?>"
                                        data-section-name="<?= htmlspecialchars($section['section_name']) ?>"
                                        data-year-level="<?= htmlspecialchars($section['year_level']) ?>"
                                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700">EDIT</button>
                                    <button type="button" command="show-modal" commandfor="delete-dialog-<?= htmlspecialchars($section['section_id']) ?>"
                                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700">Delete</button>
                                </td>
                                
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endforeach; ?>
</main>

<!-- Add Drawer -->
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
                                        <!-- Section Name -->
                                        <div class="sm:col-span-6">
                                            <label for="section_name" class="block text-sm/6 font-medium text-gray-900">Section Name</label>
                                            <div class="mt-2">
                                                <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-green-600">
                                                    <input type="hidden" name="program_id" value=<?= htmlspecialchars($program['program_id']) ?> />
                                                    <input required id="section_name" type="text" name="section_name" placeholder="eg. BSIT-1A" class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6" />
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Year Level -->
                                        <div class="sm:col-span-6">
                                            <label for="year_level" class="block text-sm/6 font-medium text-gray-900 mt-4">Year Level</label>
                                            <div class="mt-2">
                                                <input required id="year_level" type="number" name="year_level" min="1" max="4" value="1" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 outline-gray-300 focus:outline-2 focus:outline-green-600 sm:text-sm/6" />
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

<!-- Edit Drawer -->
<el-dialog>
    <dialog id="drawerEdit" aria-labelledby="drawer-title" class="fixed inset-0 size-auto max-h-none max-w-none overflow-hidden bg-transparent not-open:hidden backdrop:bg-transparent">
        <el-dialog-backdrop class="absolute inset-0 bg-gray-500/75 transition-opacity duration-500 ease-in-out data-closed:opacity-0"></el-dialog-backdrop>
        <div tabindex="0" class="absolute inset-0 pl-10 focus:outline-none sm:pl-16">
            <el-dialog-panel class="group/dialog-panel relative ml-auto block size-full max-w-md transform transition duration-500 ease-in-out data-closed:translate-x-full sm:duration-700">
                <div class="flex h-full flex-col overflow-y-auto bg-white py-6 shadow-xl">
                    <div class="px-4 sm:px-6">
                        <h2 id="drawer-title" class="text-base font-semibold text-gray-900">Edit Section</h2>
                    </div>
                    <div class="relative mt-6 flex-1 px-4 sm:px-6">
                        <form method="POST" action=<?= base_url("/admin/section/update") ?>>
                            <div class="space-y-12">
                                <div class="border-b border-gray-900/10 pb-12">
                                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                        <!-- Section Name -->
                                        <div class="sm:col-span-6">
                                            <label for="edit-section-name" class="block text-sm/6 font-medium text-gray-900">Section Name</label>
                                            <div class="mt-2">
                                                <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-green-600">
                                                    <input type="hidden" name="_method" value="PATCH" />
                                                    <input type="hidden" name="program_id" value=<?= htmlspecialchars($program['program_id']) ?> />
                                                    <input type="hidden" name="section_id" id="edit-section-id" value="" />
                                                    <input required id="edit-section-name" type="text" name="section_name" placeholder="eg. BSIT-1A" class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6" />
                                                </div>
                                            </div>
                                        </div>


                                        <!-- Year Level -->
                                        <div class="sm:col-span-6">
                                            <label for="edit-year-level" class="block text-sm/6 font-medium text-gray-900 mt-4">Year Level</label>
                                            <div class="mt-2">
                                                <input required id="edit-year-level" type="number" name="year_level" min="1" max="4" value="1" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 outline-gray-300 focus:outline-2 focus:outline-green-600 sm:text-sm/6" />
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="mt-6 flex items-center justify-end gap-x-6">
                                <button command="close" commandfor="drawerEdit" type="button" class="text-sm/6 font-semibold text-gray-900">Cancel</button>
                                <button type="submit" class="rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-green-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </el-dialog-panel>
        </div>
    </dialog>
</el-dialog>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const editButtons = document.querySelectorAll('button[commandfor="drawerEdit"]');

        editButtons.forEach(button => {
            button.addEventListener('click', () => {
                const sectionId = button.getAttribute('data-section-id');
                const sectionName = button.getAttribute('data-section-name');
                const yearLevel = button.getAttribute('data-year-level');

                document.getElementById('edit-section-id').value = sectionId;
                document.getElementById('edit-section-name').value = sectionName;
                document.getElementById('edit-year-level').value = yearLevel || 1;
            });
        });

        document.querySelectorAll('.searchInput').forEach(input => {
            input.addEventListener('keyup', () => {
                const filter = input.value.toLowerCase();
                document.querySelectorAll('.searchRow').forEach(row => {
                    const value = row.dataset.searchValue.toLowerCase();
                    row.style.display = value.includes(filter) ? '' : 'none';
                });
            });
        });
    });

    document.querySelectorAll('.searchInput').forEach(input => {
        input.addEventListener('keyup', () => {
            const filter = input.value.toLowerCase();
            const year = input.dataset.year;
            document.querySelectorAll(`.searchRow[data-year="${year}"]`).forEach(row => {
                row.style.display = row.dataset.searchValue.toLowerCase().includes(filter) ? '' : 'none';
            });
        });
    });
</script>

<?php require("views/partials/foot.php"); ?>