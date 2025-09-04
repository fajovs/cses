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
    </div>
</header>

<main class="flex-1 overflow-y-auto px-30 py-6">

    <!-- Active Exams -->
    <div class="mb-8">
        <h2 class="text-lg font-semibold text-gray-900 mb-2">Active Exams</h2>
        <input type="text" placeholder="Search active exams..."
            class="searchInput w-full mb-4 px-4 py-3 text-sm bg-white border-0 rounded-lg shadow-sm ring-1 ring-gray-200 focus:ring-2 focus:ring-green-500 focus:outline-none transition-all"
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
                            <?php foreach ($notAttemptedExams as $exam): ?>
                                <tr class="hover:bg-gray-25 transition-colors duration-150 searchRow" data-group="active" data-search-value="<?= htmlspecialchars($exam['title']) ?>">
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
                                        <a href="<?= base_url('/student/subject/' . $exam['subject_id'] . '/exam/' . $exam['exam_id']) ?>"
                                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-green-600 rounded-md hover:bg-green-700 transition-colors duration-150">
                                            Answer
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php if (empty($notAttemptedExams)): ?>
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

    <!-- Submitted Exams -->
    <div>
        <h2 class="text-lg font-semibold text-gray-900 mb-2">Submitted Exams</h2>
        <input type="text" placeholder="Search submitted exams..."
            class="searchInput w-full mb-4 px-4 py-3 text-sm bg-white border-0 rounded-lg shadow-sm ring-1 ring-gray-200 focus:ring-2 focus:ring-green-500 focus:outline-none transition-all"
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
                                <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase">Date Submitted</th>
                                <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase">Score</th>
                                <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase">Action</th>
                          
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            <?php foreach ($attemptedExams as $exam): ?>
                                <tr class="hover:bg-gray-25 transition-colors duration-150 searchRow" data-group="inactive" data-search-value="<?= htmlspecialchars($exam['title']) ?>">
                                    <td class="px-6 py-5">
                                        <div class="text-sm font-medium text-gray-900"><?= htmlspecialchars($exam['title']) ?></div>
                                    </td>
                                    <td class="px-6 py-5 text-center"><strong><?= htmlspecialchars($exam['num_questions']) ?></strong></td>
                                    <td class="px-6 py-5 text-center"><strong><?= htmlspecialchars($exam['passing_score']) ?></strong></td>
                                    <td class="px-6 py-5 text-center"><?= htmlspecialchars($exam['deadline']) ?></td>
                                    <td class="px-6 py-5 text-center"><?= htmlspecialchars($exam['submitted_at']) ?></td>
                                    <td class="px-6 py-5 text-center">
                                        <strong><?= htmlspecialchars($exam['score']) ?> / <?= htmlspecialchars($exam['num_questions']) ?></strong>
                                    </td>
                                    <td class="px-6 py-5 text-center">
                                        <?php
                                            $status = htmlspecialchars($exam['status']);
                                            $colorClass = ($status === 'passed') ? 'text-green-600' : 'text-red-600';
                                        ?>
                                        <strong class="<?= $colorClass ?>">
                                            <?= ucfirst($status) ?>
                                        </strong>
                                    </td>
                                      <td class="px-6 py-5 text-center flex gap-2">

                                        <button
                                            data-exam='<?= htmlspecialchars(json_encode($exam), ENT_QUOTES, 'UTF-8') ?>'
                                            command="show-modal"
                                            commandfor="drawer"
                                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-green-600 rounded-md hover:bg-green-700 transition-colors duration-150">
                                            Show Feedback
                                        </button>

                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php if (empty($attemptedExams)): ?>
                                <tr>
                                    <td colspan="7" class="px-6 py-5 text-center text-gray-500">No submitted exams found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>

<el-dialog>
    <dialog id="drawer" aria-labelledby="drawer-title" class="fixed inset-0 size-auto max-h-none max-w-none overflow-hidden bg-transparent not-open:hidden backdrop:bg-transparent">
        <el-dialog-backdrop class="absolute inset-0 bg-gray-500/75 transition-opacity duration-500 ease-in-out data-closed:opacity-0"></el-dialog-backdrop>
        <div tabindex="0" class="absolute inset-0 pl-10 focus:outline-none sm:pl-16">
            <el-dialog-panel class="group/dialog-panel relative ml-auto block size-full max-w-2xl transform transition duration-500 ease-in-out data-closed:translate-x-full sm:duration-700">
                <div class="flex h-full flex-col overflow-y-auto bg-white py-6 shadow-xl">
                    <div class="px-4 sm:px-6">
                        <h2 id="drawer-title" class="text-base font-semibold text-gray-900">exam</h2>
                    </div>
                    <div class="relative mt-6 flex-1 px-4 sm:px-6">
                        <div class="space-y-12 ">
                            <div class="border-b border-gray-900/10 pb-12 flex gap-4 flex-col">
                                <p id="title" class="mt-1 text-sm/6 text-gray-600"></p>
                                <p id="rating" class="mt-1 text-sm/6 text-gray-600"></p>
                                <p id="status" name="rating" class="mt-1 text-sm/6 text-gray-600"></p>
                                <p id="feedback" name="rating" class="mt-1 text-sm/6 text-gray-600"></p>




                            </div>
                        </div>
                        <div class="mt-6 flex items-center justify-end gap-x-6">
                            <button command="close" commandfor="drawer" type="button" class="text-sm/6 font-semibold text-gray-900">Close</button>
                        </div>





                    </div>
                </div>


            </el-dialog-panel>
        </div>
    </dialog>
</el-dialog>

<!-- Script: separate search for each table -->
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

       document.querySelectorAll('[command="show-modal"][commandfor="drawer"]').forEach(button => {
            button.addEventListener('click', () => {


                const exam = JSON.parse(button.dataset.exam);

                const title = document.getElementById('title');
                const rating = document.getElementById('rating');
                const feedback = document.getElementById('feedback');

                console.log(exam);

                title.innerHTML = `<strong>Title :</strong> <br> ${exam.title}`;
                rating.innerHTML =  `<strong >Score : <br> <span class='text-green-700'>${exam.score} </span> </strong>`;
                feedback.innerHTML = exam.feedback ? `<strong>Feedback :</strong> <br> ${exam.feedback} ` : '<strong>Feedback :</strong>';





            });
        });
});
</script>

<?php require("views/partials/foot.php"); ?>
