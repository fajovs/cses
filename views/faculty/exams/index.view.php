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
        <div class="flex flex-col gap-4">
            <a href="<?= base_url('/faculty/subject/' . $subject['subject_id']) . '/exam' ?>"
                class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition-colors focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 outline-none">
                Create Exam
            </a>
        </div>
    </div>
</header>

<main class="flex-1 overflow-y-auto px-30 py-6">

    <!-- Active Exams -->
    <div class="mb-8">
        <h2 class="text-lg font-semibold text-gray-900 mb-2">Active Exams</h2>
        <input type="text" placeholder="Search active exams..."
            class="searchInput w-full mb-4 px-4 py-3 text-sm bg-white border-0 rounded-lg shadow-sm ring-1 ring-gray-200 focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all"
            data-target="active">

        <div class="bg-white rounded-xl shadow-sm ring-1 ring-gray-200 overflow-hidden">
            <div class="p-6 text-gray-600 text-sm">
                <div class="max-h-[500px] overflow-y-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-gray-100">
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                                <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase">Items</th>
                                <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase">Passing Score</th>
                                <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase">Deadline</th>
                                <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase">Date Created</th>
                                <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            <?php foreach ($activeExams as $exam): ?>
                                <tr class="hover:bg-gray-25 transition-colors duration-150 searchRow"
                                    data-search-value="<?= htmlspecialchars($exam['title']) ?>"
                                    data-group="active">
                                    <td class="px-6 py-5">
                                        <div class="text-sm font-medium text-gray-900"><?= htmlspecialchars($exam['title']) ?></div>
                                    </td>
                                    <td class="px-6 py-5 text-center"><?= htmlspecialchars($exam['num_questions']) ?></td>
                                    <td class="px-6 py-5 text-center"><?= htmlspecialchars($exam['passing_score']) ?></td>
                                    <td class="px-6 py-5 text-center"><?= htmlspecialchars($exam['deadline']) ?></td>
                                    <td class="px-6 py-5 text-center"><?= htmlspecialchars($exam['created_at']) ?></td>
                                    <td class="px-6 py-5 text-center">
                                        <span class="inline-block px-2 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded">Active</span>
                                    </td>
                                    <td class="px-6 py-5 text-center flex gap-2">
                                        <form method="POST" action=<?= base_url('/faculty/subject/exam/state') ?>>
                                            <input type="hidden" name="_method" value="PATCH" />
                                            <input type="hidden" name="status" value=0 />
                                            <input type="hidden" name="exam_id" value=<?= $exam['exam_id'] ?> />
                                            <button
                                                class="h-9 inline-flex items-center px-3 text-sm font-medium text-white bg-amber-600 rounded-md hover:bg-amber-700 transition-colors duration-150">
                                                Set Inactive
                                            </button>
                                        </form>

                                        <a href="<?= base_url('/faculty/subject/' . $exam['subject_id'] . '/exam/' . $exam['exam_id']) ?>"
                                            class="h-9 inline-flex items-center px-3 text-sm font-medium text-white bg-indigo-600 rounded-md hover:bg-indigo-700 transition-colors duration-150">
                                            View
                                        </a>
                                        <button href="#"
                                            data-exam-id="<?= $exam['exam_id'] ?>"
                                            data-exam-title="<?= htmlspecialchars($exam['title']) ?>"
                                            class="h-9 delete-btn inline-flex items-center px-3 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-700 transition-colors duration-150">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php if (empty($activeExams)): ?>
                                <tr>
                                    <td colspan="7" class="px-6 py-5 text-center text-gray-500">No active exams found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Inactive Exams -->
    <div>
        <h2 class="text-lg font-semibold text-gray-900 mb-2">Inactive Exams</h2>
        <input type="text" placeholder="Search inactive exams..."
            class="searchInput w-full mb-4 px-4 py-3 text-sm bg-white border-0 rounded-lg shadow-sm ring-1 ring-gray-200 focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all"
            data-target="inactive">

        <div class="bg-white rounded-xl shadow-sm ring-1 ring-gray-200 overflow-hidden">
            <div class="p-6 text-gray-600 text-sm">
                <div class="max-h-[500px] overflow-y-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-gray-100">
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                                <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase">Items</th>
                                <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase">Passing Score</th>
                                <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase">Deadline</th>
                                <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase">Date Created</th>
                                <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            <?php foreach ($inactiveExams as $exam): ?>
                                <tr class="hover:bg-gray-25 transition-colors duration-150 searchRow"
                                    data-search-value="<?= htmlspecialchars($exam['title']) ?>"
                                    data-group="inactive">
                                    <td class="px-6 py-5">
                                        <div class="text-sm font-medium text-gray-900"><?= htmlspecialchars($exam['title']) ?></div>
                                    </td>
                                    <td class="px-6 py-5 text-center"><?= htmlspecialchars($exam['num_questions']) ?></td>
                                    <td class="px-6 py-5 text-center"><?= htmlspecialchars($exam['passing_score']) ?></td>
                                    <td class="px-6 py-5 text-center"><?= htmlspecialchars($exam['deadline']) ?></td>
                                    <td class="px-6 py-5 text-center"><?= htmlspecialchars($exam['created_at']) ?></td>
                                    <td class="px-6 py-5 text-center">
                                        <span class="inline-block px-2 py-1 text-xs font-semibold text-gray-700 bg-gray-200 rounded">Inactive</span>
                                    </td>
                                    <td class="px-6 py-5 text-center flex gap-2">
                                        <form method="POST" action=<?= base_url('/faculty/subject/exam/state') ?>>
                                            <input type="hidden" name="_method" value="PATCH" />
                                            <input type="hidden" name="status" value=1 />
                                            <input type="hidden" name="exam_id" value=<?= $exam['exam_id'] ?> />
                                            <button
                                                class="h-9 inline-flex items-center px-3 text-sm font-medium text-white bg-green-600 rounded-md hover:bg-green-700 transition-colors duration-150">
                                                Set Active
                                            </button>
                                        </form>

                                        <a href="<?= base_url('/faculty/subject/' . $exam['subject_id'] . '/exam/' . $exam['exam_id']) ?>"
                                            class="h-9 inline-flex items-center px-3 text-sm font-medium text-white bg-indigo-600 rounded-md hover:bg-indigo-700 transition-colors duration-150">
                                            View
                                        </a>
                                        <button href="#"
                                            data-exam-id="<?= $exam['exam_id'] ?>"
                                            data-exam-title="<?= htmlspecialchars($exam['title']) ?>"
                                            class="h-9 delete-btn inline-flex items-center px-3 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-700 transition-colors duration-150">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php if (empty($inactiveExams)): ?>
                                <tr>
                                    <td colspan="7" class="px-6 py-5 text-center text-gray-500">No inactive exams found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Delete confirmation modal -->
<el-dialog>
    <dialog id="delete-dialog" aria-labelledby="dialog-title" class="fixed inset-0 overflow-y-auto bg-transparent backdrop:bg-transparent">
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
                            <h3 id="dialog-title" class="text-base font-semibold text-gray-900">Delete Exam?</h3>
                            <p id="dialog-message" class="mt-2 text-sm text-gray-500">Are you sure you want to delete this exam? This action cannot be undone.</p>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse">
                    <form id="delete-form" method="POST" action="<?= base_url('/faculty/exam/delete') ?>">
                        <input type="hidden" name="_method" value="DELETE" />
                        <input type="hidden" name="exam_id" id="delete-exam-id" value="" />
                        <button type="submit"
                            class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-red-500 sm:ml-3 sm:w-auto">
                            Delete
                        </button>
                    </form>
                    <button type="button" id="cancel-delete-btn"
                        class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-xs ring-1 ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">
                        Cancel
                    </button>
                </div>
            </el-dialog-panel>
        </div>
    </dialog>
</el-dialog>

<!-- Script -->
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

        const deleteDialog = document.getElementById('delete-dialog');
        const deleteExamIdInput = document.getElementById('delete-exam-id');
        const dialogMessage = document.getElementById('dialog-message');
        const cancelBtn = document.getElementById('cancel-delete-btn');

        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                const examId = btn.dataset.examId;
                const examTitle = btn.dataset.examTitle;

                deleteExamIdInput.value = examId;
                dialogMessage.textContent = `Are you sure you want to delete the exam "${examTitle}"? This action cannot be undone.`;

                deleteDialog.showModal();
            });
        });

        cancelBtn.addEventListener('click', () => {
            deleteDialog.close();
        });
    });
</script>

<?php require("views/partials/foot.php"); ?>
