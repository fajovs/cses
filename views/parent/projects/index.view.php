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
            <a href="<?= base_url('/parent/student/' . $student['student_id'] . '/subjects') ?>"
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




    <div>
        <h2 class="text-lg font-semibold text-gray-900 mb-2">Submitted Projects</h2>
        <input type="text" placeholder="Search submitted projects..."
            class="searchInput w-full mb-4 px-4 py-3 text-sm bg-white border-0 rounded-lg shadow-sm ring-1 ring-gray-200 focus:ring-2 focus:ring-green-500 focus:outline-none transition-all"
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
                                <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase">Rating</th>

                                <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase">Action</th>

                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            <?php foreach ($projects as $project): ?>
                                <tr class="hover:bg-gray-25 transition-colors duration-150 searchRow" data-group="inactive" data-search-value="<?= htmlspecialchars($project['title']) ?>">
                                    <td class="px-6 py-5 text-sm font-medium text-gray-900"><?= htmlspecialchars($project['title']) ?></td>

                                    <td class="px-6 py-5 text-center"><?= date("F j, Y g:i A", strtotime($project['submitted_at'])) ?></td>
                                    <td class="px-6 py-5 text-center font-semibold">
                                        <?= htmlspecialchars($project['total_score'] ?? '—') ?>
                                    </td>

                                    <td class="px-6 py-5 text-center text-gray-600">
                                        <?php if ($project['is_checked']): ?>
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
                                        <?php
                                        $rate = $project['equivalent_rate'] ?? null;

                                        if ($rate === null) {
                                            $colorClass = "text-gray-700 bg-gray-100"; // neutral color for null
                                            $displayRate = "--";
                                        } else {
                                            $colorClass = ($rate > 3.0)
                                                ? "text-red-700 bg-red-100"
                                                : "text-green-700 bg-green-100";
                                            $displayRate = htmlspecialchars($rate);
                                        }
                                        ?>

                                        <span class="inline-block px-2 py-1 text-xs font-semibold rounded <?= $colorClass ?>">
                                            <?= $displayRate ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-5 text-center">
                                        <?php if ($project['is_checked']): ?>
                                            <button
                                                data-project='<?= htmlspecialchars(json_encode($project), ENT_QUOTES, 'UTF-8') ?>'
                                                command="show-modal"
                                                commandfor="drawer"
                                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-green-600 rounded-md hover:bg-green-700 transition-colors duration-150">
                                                Show Feedback
                                            </button>
                                        <?php endif; ?>
                                    </td>

                                </tr>
                            <?php endforeach; ?>
                            <?php if (empty($projects)): ?>
                                <tr>
                                    <td colspan="5" class="px-6 py-5 text-center text-gray-500">No submitted projects found.</td>
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
                        <h2 id="drawer-title" class="text-base font-semibold text-gray-900">project</h2>
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


                const project = JSON.parse(button.dataset.project);

                const title = document.getElementById('title');
                const rating = document.getElementById('rating');
                const feedback = document.getElementById('feedback');



                title.innerHTML = `<strong>Title :</strong> <br> ${project.title}`;
                rating.innerHTML = project.total_score ? `<strong >Score : <br> <span class='text-green-700'>${project.total_score} </span> </strong>` : '<strong>Score :</strong><br><span class="inline-block px-2 py-1 text-xs font-semibold text-amber-700 bg-amber-100 rounded">Not Evaluated</span>';
                feedback.innerHTML = project.feedback ? `<strong>Feedback :</strong> <br> ${project.feedback} ` : '<strong>Feedback :</strong>';





            });
        });
    });
</script>

<?php require("views/partials/foot.php"); ?>