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
            <a href=<?= base_url('/admin/program/edit/' . $program['program_id']) ?> class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition-colors focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 outline-none">
                Manage
            </a>
            <a href=<?= base_url('/admin/program/' . $program['program_id']) . '/sections' ?> class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition-colors focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 outline-none">
                Sections
            </a>
        </div>
    </div>
</header>

<main class="flex-1 overflow-y-auto px-30 py-6">
    <!-- Search Section -->
    <div class="mb-8 w-full">
        <input
            type="text"
            placeholder="Search subjects..."
            class="searchInput w-full px-4 py-3 text-sm bg-white border-0 rounded-lg shadow-sm ring-1 ring-gray-200 focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all">
    </div>

    <div>
        <div class="bg-white rounded-xl shadow-sm ring-1 ring-gray-200 overflow-hidden">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 bg-gray-50">
                <h2 class="text-lg font-semibold text-gray-900">Subjects</h2>
                <a href="<?= base_url('/admin/program/'. $program['program_id'] .'/subject') ?>"
                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-indigo-600 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors duration-150">
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
                                <tr
                                    class="hover:bg-gray-25 transition-colors duration-150 searchRow"
                                    data-search-value="<?= htmlspecialchars($subject['subject_name']) ?>">
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
                                        <a href="<?= base_url("/admin/program/" . htmlspecialchars($subject['program_id']). "/subject/".htmlspecialchars($subject['subject_id'])."/edit") ?>"
                                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors duration-150">
                                            Manage
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

<!-- Search script (keep this somewhere below, before </body>) -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
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
</script>




<?php require("views/partials/foot.php"); ?>