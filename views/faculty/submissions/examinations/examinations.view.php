<?php
require("views/partials/head.php");
require("views/partials/nav.php");
require("views/partials/notification.php");
?>

<header class="bg-white shadow-sm px-30 flex-none">
    <div class="mx-auto max-w-7xl py-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2"><?= htmlspecialchars($subject['subject_name']); ?> </h1>
            <p class="mt-1 text-sm/6 text-gray-600"><?= htmlspecialchars($subject['subject_about']); ?></p>
            <p class="mt-1 text-sm/6 text-gray-600"><strong><?= htmlspecialchars($subject['section_name']); ?></strong></p>
        </div>
        <div>
            <a href="<?= base_url('/faculty/submissions/exams') ?>"
                class="h-9 inline-flex items-center px-3 text-sm font-medium text-white bg-gray-600 rounded-md hover:bg-gray-700 transition-colors duration-150">

                <!-- Back arrow SVG -->
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-4 h-4 mr-2"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M15 19l-7-7 7-7" />
                </svg>

                Back
            </a>
        </div>

    </div>
</header>

<main class="flex-1 overflow-y-auto px-30 py-6">

    <!-- Active examinations -->
    <div class="mb-8">
        <h2 class="text-lg font-semibold text-gray-900 mb-2">Examinations</h2>
        <input type="text" placeholder="Search examinations..."
            class="searchInput w-full mb-4 px-4 py-3 text-sm bg-white border-0 rounded-lg shadow-sm ring-1 ring-gray-200 focus:ring-2 focus:ring-green-500 focus:outline-none transition-all"
            data-target="active">

        <div class="bg-white rounded-xl shadow-sm ring-1 ring-gray-200 overflow-hidden">
            <div class="p-6 text-gray-600 text-sm">
                <div class="max-h-[500px] overflow-y-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-gray-100">
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                                <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase">Submitted</th>

                                <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase">Deadline</th>
                                <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase">Date Created</th>
                                <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            <?php foreach ($examinations as $exam): ?>
                                <tr class="hover:bg-gray-25 transition-colors duration-150 searchRow"
                                    data-search-value="<?= htmlspecialchars($exam['title']) ?>"
                                    data-group="active">
                                    <td class="px-6 py-5">
                                        <div class="text-sm font-medium text-gray-900"><?= htmlspecialchars($exam['title']) ?></div>
                                    </td>
                                    <td class="px-6 py-5 text-center"><?= htmlspecialchars($exam['submitted_count']) ?></td>

                                    <td class="px-6 py-5 text-center"><?= date("F j, Y g:i A", strtotime($exam['deadline'])) ?></td>
                                    <td class="px-6 py-5 text-center"><?= date("F j, Y g:i A", strtotime($exam['created_at'])) ?></td>
                                    <td class="px-6 py-5 text-center">
                                        <span class="inline-block px-2 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded">Active</span>
                                    </td>
                                    <td class="px-6 py-5 text-center flex justify-center gap-2">


                                        <a href="<?= base_url('/faculty/submissions/subject/' . $exam['subject_id'] . '/exam/' . $exam['exam_id']) ?>"
                                            class="h-9 inline-flex items-center px-3 text-sm font-medium text-white bg-green-600 rounded-md hover:bg-green-700 transition-colors duration-150">
                                            View
                                        </a>

                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php if (empty($examinations)): ?>
                                <tr>
                                    <td colspan="7" class="px-6 py-5 text-center text-gray-500">No active examinations found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


</main>


<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.searchInput').forEach(input => {
            input.addEventListener('keyup', () => {
                const filter = input.value.toLowerCase();
                const target = input.dataset.target;
                document.querySelectorAll(`.searchRow[data-group="${target}"]`).forEach(row => {
                    const value = row.dataset.searchValue.toLowerCase();
                    row.style.display = value.includes(filter) ? '' : 'none';
                });
            });
        });


    });
</script>

<?php require("views/partials/foot.php"); ?>