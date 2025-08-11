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

    <!-- Active Activities -->
    <div class="mb-8">
        <h2 class="text-lg font-semibold text-gray-900 mb-2">Active Activities</h2>
        <input type="text" placeholder="Search active activities..."
            class="searchInput w-full mb-4 px-4 py-3 text-sm bg-white border-0 rounded-lg shadow-sm ring-1 ring-gray-200 focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all"
            data-target="active">

        <div class="bg-white rounded-xl shadow-sm ring-1 ring-gray-200 overflow-hidden">
            <div class="p-6 text-gray-600 text-sm">
                <div class="max-h-[500px] overflow-y-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-gray-100">
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Title</th>

                                <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase">Deadline</th>
                                <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase">Created</th>
                                <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            <?php foreach ($notSubmittedActivities as $activity): ?>
                                <tr class="hover:bg-gray-25 transition-colors duration-150 searchRow" data-group="active" data-search-value="<?= htmlspecialchars($activity['title']) ?>">
                                    <td class="px-6 py-5">
                                        <div class="text-sm font-medium text-gray-900"><?= htmlspecialchars($activity['title']) ?></div>
                                    </td>

                                    <td class="px-6 py-5 text-center"><?= date("F j, Y g:i A", strtotime($activity['deadline'])) ?></td>
                                    <td class="px-6 py-5 text-center"><?= date("F j, Y g:i A", strtotime($activity['created_at'])) ?></td>

                                    <td class="px-6 py-5 text-center">
                                        <a href="<?= base_url('/student/subject/' . $activity['subject_id'] . '/activity/' . $activity['activity_id']) ?>"
                                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-indigo-600 rounded-md hover:bg-indigo-700 transition-colors duration-150">
                                            View
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php if (empty($notSubmittedActivities)): ?>
                                <tr>
                                    <td colspan="5" class="px-6 py-5 text-center text-gray-500">No active activities found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Submitted Activities -->
    <div>
        <h2 class="text-lg font-semibold text-gray-900 mb-2">Submitted Activities</h2>
        <input type="text" placeholder="Search submitted activities..."
            class="searchInput w-full mb-4 px-4 py-3 text-sm bg-white border-0 rounded-lg shadow-sm ring-1 ring-gray-200 focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all"
            data-target="inactive">

        <div class="bg-white rounded-xl shadow-sm ring-1 ring-gray-200 overflow-hidden">
            <div class="p-6 text-gray-600 text-sm">
                <div class="max-h-[500px] overflow-y-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-gray-100">
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Title</th>

                                <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase">Submitted At</th>
                                <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase">Grade</th>

                                <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase">Action</th>

                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            <?php foreach ($submittedActivities as $activity): ?>
                                <tr class="hover:bg-gray-25 transition-colors duration-150 searchRow" data-group="inactive" data-search-value="<?= htmlspecialchars($activity['title']) ?>">
                                    <td class="px-6 py-5 text-sm font-medium text-gray-900"><?= htmlspecialchars($activity['title']) ?></td>

                                    <td class="px-6 py-5 text-center"><?= date("F j, Y g:i A", strtotime($activity['submitted_at'])) ?></td>
                                    <td class="px-6 py-5 text-center font-semibold">
                                        <?= htmlspecialchars($activity['total_score'] ?? '—') ?>
                                    </td>

                                    <td class="px-6 py-5 text-center text-gray-600">
                                        <?php if ($activity['is_checked']): ?>
                                            <span class="inline-block px-2 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded">
                                                Evaluated
                                            </span>
                                        <?php else: ?>
                                            <span class="inline-block px-2 py-1 text-xs font-semibold text-amber-700 bg-amber-100 rounded">
                                                Not Evaluated
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-6 py-5 text-center">
                                        <?php if ($activity['is_checked']): ?>
                                            <button
                                                data-activity='<?= htmlspecialchars(json_encode($activity), ENT_QUOTES, 'UTF-8') ?>'
                                                command="show-modal"
                                                commandfor="drawer"
                                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-indigo-600 rounded-md hover:bg-indigo-700 transition-colors duration-150">
                                                Show Feedback
                                            </button>
                                        <?php endif; ?>
                                    </td>

                                </tr>
                            <?php endforeach; ?>
                            <?php if (empty($submittedActivities)): ?>
                                <tr>
                                    <td colspan="5" class="px-6 py-5 text-center text-gray-500">No submitted activities found.</td>
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
                        <h2 id="drawer-title" class="text-base font-semibold text-gray-900">Activity</h2>
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


                const activity = JSON.parse(button.dataset.activity);

                const title = document.getElementById('title');
                const rating = document.getElementById('rating');
                const feedback = document.getElementById('feedback');



                title.innerHTML = `<strong>Title :</strong> <br> ${activity.title}`;
                rating.innerHTML = activity.total_score ? `<strong >Score : <br> <span class='text-green-700'>${activity.total_score} </span> </strong>` : '<strong>Score :</strong><br><span class="inline-block px-2 py-1 text-xs font-semibold text-amber-700 bg-amber-100 rounded">Not Evaluated</span>';
                feedback.innerHTML = activity.feedback ? `<strong>Feedback :</strong> <br> ${activity.feedback} ` : '<strong>Feedback :</strong>';





            });
        });
    });
</script>

<?php require("views/partials/foot.php"); ?>