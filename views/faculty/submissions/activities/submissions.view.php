<?php
require("views/partials/head.php");
require("views/partials/nav.php");
require("views/partials/notification.php");
?>

<main class="flex-1 overflow-y-auto px-30 py-6">
    <div class="mb-5">
        <a href="<?= base_url('/faculty/submissions/' . htmlspecialchars($subject['subject_id']) . '/activities') ?>"
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


    <div class="border border-gray-200 rounded-lg p-6 bg-white shadow-sm mb-5">
        <h1 class="text-3xl font-bold text-gray-900 mb-2"><?= htmlspecialchars($activity['title']); ?> </h1>
        <p class="mt-1 text-sm/6 text-gray-600"><?= htmlspecialchars($activity['description']); ?></p>
        <p class="mt-1 text-sm/6 text-gray-600"><strong>Subject : </strong><?= htmlspecialchars($subject['subject_name']); ?></p>
        <p class="mt-1 text-sm/6 text-gray-600"><strong>Section : </strong><?= htmlspecialchars($subject['section_name']); ?></p>

        <p class="text-sm text-gray-600">
            <strong>Deadline :</strong> <?= date("F j, Y g:i A", strtotime($activity['deadline'])) ?>
        </p>

    </div>

    <!-- Active activitys -->
    <div class="mb-8">
        <h2 class="text-lg font-semibold text-gray-900 mb-2">Not Evaluluated Activities</h2>
        <input type="text" placeholder="Search Students..."
            class="searchInput w-full mb-4 px-4 py-3 text-sm bg-white border-0 rounded-lg shadow-sm ring-1 ring-gray-200 focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all"
            data-target="active">

        <div class="bg-white rounded-xl shadow-sm ring-1 ring-gray-200 overflow-hidden">
            <div class="p-6 text-gray-600 text-sm">
                <div class="max-h-[500px] overflow-y-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-gray-100">
                                <th class="px-6 py-4  text-center text-xs font-medium text-gray-500 uppercase">Students</th>
                                <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase">Submitted</th>
                                <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            <?php foreach ($unchecked_submissions as $submission): ?>
                                <tr class="hover:bg-gray-25 transition-colors duration-150 searchRow"
                                    data-search-value="<?= htmlspecialchars($submission['full_name']) ?>"
                                    data-group="active">
                                    <td class="px-6 py-5">
                                        <div class="text-sm  text-center font-medium text-gray-900"><?= htmlspecialchars($submission['full_name']) ?></div>
                                    </td>
                                    <td class="px-6 py-5 text-center"><?= date("F j, Y g:i A", strtotime($submission['submitted_at'])) ?></td>

                                    <td class="px-6 py-5 text-center">
                                        <span class="inline-block px-2 py-1 text-xs font-semibold text-amber-700 bg-amber-100 rounded">Not Evaluated</span>
                                    </td>
                                    <td class="px-6 py-5 text-center flex justify-center gap-2">


                                        <button
                                            data-submission='<?= htmlspecialchars(json_encode($submission), ENT_QUOTES, 'UTF-8') ?>'
                                            data-activity='<?= htmlspecialchars(json_encode($activity), ENT_QUOTES, 'UTF-8') ?>'
                                            data-criterias='<?= htmlspecialchars(json_encode($criterias), ENT_QUOTES, 'UTF-8') ?>'
                                            data-subject='<?= htmlspecialchars(json_encode($subject), ENT_QUOTES, 'UTF-8') ?>'

                                            command="show-modal"
                                            commandfor="drawer"
                                            class="h-9 inline-flex items-center px-3 text-sm font-medium text-white bg-indigo-600 rounded-md hover:bg-indigo-700 transition-colors duration-150">
                                            Evaluate
                                        </button>

                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php if (empty($unchecked_submissions)): ?>
                                <tr>
                                    <td colspan="7" class="px-6 py-5 text-center text-gray-500">No not evaluated activities found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Checked activities -->
    <div class="mb-8">
        <h2 class="text-lg font-semibold text-gray-900 mb-2">Evaluated Activities</h2>
        <input type="text" placeholder="Search Students..."
            class="searchInput w-full mb-4 px-4 py-3 text-sm bg-white border-0 rounded-lg shadow-sm ring-1 ring-gray-200 focus:ring-2 focus:ring-green-500 focus:outline-none transition-all"
            data-target="checked">

        <div class="bg-white rounded-xl shadow-sm ring-1 ring-gray-200 overflow-hidden">
            <div class="p-6 text-gray-600 text-sm">
                <div class="max-h-[500px] overflow-y-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-gray-100">
                                <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase">Students</th>
                                <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase">Submitted</th>
                                <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase">Score</th>
                                <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            <?php foreach ($checked_submissions as $submission): ?>
                                <tr class="hover:bg-gray-25 transition-colors duration-150 searchRow"
                                    data-search-value="<?= htmlspecialchars($submission['full_name']) ?>"
                                    data-group="checked">
                                    <td class="px-6 py-5">
                                        <div class="text-sm text-center font-medium text-gray-900"><?= htmlspecialchars($submission['full_name']) ?></div>
                                    </td>
                                    <td class="px-6 py-5 text-center"><?= date("F j, Y g:i A", strtotime($submission['submitted_at'])) ?></td>
                                    <td class="px-6 py-5 text-center">

                                        <?= htmlspecialchars($submission['total_score']) ?>
                                    </td>
                                    <td class="px-6 py-5 text-center">
                                        <span class="inline-block px-2 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded">Evaluated</span>
                                    </td>
                                    <td class="px-6 py-5 text-center flex justify-center gap-2">
                                        <button
                                            data-submission='<?= htmlspecialchars(json_encode($submission), ENT_QUOTES, 'UTF-8') ?>'
                                            data-activity='<?= htmlspecialchars(json_encode($activity), ENT_QUOTES, 'UTF-8') ?>'
                                            data-criterias='<?= htmlspecialchars(json_encode($criterias), ENT_QUOTES, 'UTF-8') ?>'
                                            data-subject='<?= htmlspecialchars(json_encode($subject), ENT_QUOTES, 'UTF-8') ?>'

                                            command="show-modal"
                                            commandfor="drawer"
                                            class="h-9 inline-flex items-center px-3 text-sm font-medium text-white bg-indigo-600 rounded-md hover:bg-indigo-700 transition-colors duration-150">
                                            Show Evaluation
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php if (empty($checked_submissions)): ?>
                                <tr>
                                    <td colspan="7" class="px-6 py-5 text-center text-gray-500">No evaluated activities found.</td>
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
                        <h2 id="drawer-title" class="text-base font-semibold text-gray-900">Student</h2>
                    </div>
                    <div class="relative mt-6 flex-1 px-4 sm:px-6">
                        <form method="POST" action=<?= base_url("/faculty/submissions/activity/evaluate") ?>>
                            <div class="space-y-12 ">
                                <input type="hidden" name="_method" value="PATCH" />
                                <input type="hidden" name="submission-id" id="submission-id" />
                                <input type="number" class="hidden" name="total-score" id="total-score" />
                                <div class="border-b border-gray-900/10 pb-12 flex gap-4 flex-col">
                                    <p id="st-name" class="mt-1 text-sm/6 text-gray-600"></p>
                                    <p id="st-section" class="mt-1 text-sm/6 text-gray-600"></p>
                                    <p id="activity-name" class="mt-1 text-sm/6 text-gray-600"></p>
                                    <p id="rating" name="rating" class="mt-1 text-sm/6 text-gray-600"></p>


                                    <div class="mt-4 flex gap-2">
                                        <a
                                            id="downloadBtn"
                                            href=""
                                            download
                                            class="hidden px-3 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                                            Download
                                        </a>


                                    </div>


                                    <div id="criteriaContainer" class="space-y-4"></div>

                                    <div class="sm:col-span-full">
                                        <label for="feedback" class="block text-sm font-medium text-gray-900">Feedback (Optional)</label>
                                        <textarea id="feedback" name="feedback" rows="5"
                                            class="h-48 mt-2 block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 outline-gray-300 focus:outline-2 focus:outline-indigo-600"
                                            placeholder="Feedback..."></textarea>


                                    </div>

                                </div>
                            </div>
                            <div class="mt-6 flex items-center justify-end gap-x-6">
                                <button command="close" commandfor="drawer" type="button" class="text-sm/6 font-semibold text-gray-900">Cancel</button>
                                <button type="submit" id="submit-btn" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"></button>
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
        // Search filtering
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

        // Populate criteria in drawer
        document.querySelectorAll('[command="show-modal"][commandfor="drawer"]').forEach(button => {
            button.addEventListener('click', () => {
                const criterias = JSON.parse(button.dataset.criterias);
                const container = document.getElementById('criteriaContainer');
                const submissionId = document.getElementById('submission-id');
                const submitBtn = document.getElementById('submit-btn');
                const totalRating = document.getElementById('total-score');
                const submission = JSON.parse(button.dataset.submission);
                const subject = JSON.parse(button.dataset.subject);
                const activity = JSON.parse(button.dataset.activity);
                container.innerHTML = ''; // Clear old data
                const overall = document.getElementById('rating');


                submissionId.value = submission.submission_id;
                totalRating.value = submission.total_score;
                submitBtn.innerHTML = submission.total_score ? 'Re - Evaluate' : 'Evaluate';


                criterias.forEach(criteria => {
                    const isRequired = !submission.total_score ? 'required' : '';

                    const criteriaHTML = `
                        <div class="flex flex-col sm:flex-row gap-4">
                            <div class="w-full">
                                <label class="block text-sm font-medium text-gray-900">Criteria</label>
                                <input type="text" value="${criteria.criteria_name}" disabled
                                    class="mt-1 block w-full rounded-md bg-gray-100 px-3 py-1.5 text-gray-900 outline outline-1 outline-gray-300" />
                            </div>
                            <div class="w-full">
                                <label class="block text-sm font-medium text-gray-900">Weight (%)</label>
                                <input type="number" value="${criteria.weight}" disabled
                                    class="mt-1 block w-full rounded-md bg-gray-100 px-3 py-1.5 text-gray-900 outline outline-1 outline-gray-300 weight-input" />
                            </div>
                            <div class="w-full">
                                <label class="block text-sm font-medium text-gray-900">Score</label>
                                <input ${isRequired} type="number" min="0" max="100"
                                    class="score-input mt-1 block w-full rounded-md bg-white px-3 py-1.5 text-black-900 outline outline-1 outline-gray-300" />
                            </div>
                        </div>
                    `;

                    container.insertAdjacentHTML('beforeend', criteriaHTML);
                });


                // ✅ Set download & preview buttons
                const filePath = submission.file_path;
                const fileUrl = `/ccses/download?file=${encodeURIComponent(filePath)}`;

                const downloadBtn = document.getElementById('downloadBtn');

                const stName = document.getElementById('st-name');
                const stSection = document.getElementById('st-section');
                const activityName = document.getElementById('activity-name');


                if (filePath) {
                    downloadBtn.href = fileUrl;
                    downloadBtn.classList.remove('hidden');

                    stName.innerHTML = `<strong>Name : <br></strong>${submission.full_name}`;
                    stSection.innerHTML = `<strong>Section : <br></strong>${subject.section_name}`;
                    activityName.innerHTML = `<strong>Activity :<br> </strong>${activity.title}`;
                    const scoreValue = submission.overall || submission.total_score;

                    overall.innerHTML = scoreValue ?
                        `<strong>Score : <br><span class='text-green-700'> ${scoreValue} </span> </strong>` :
                        `<strong>Score : <br></strong> <span class="inline-block px-2 py-1 text-xs font-semibold text-amber-700 bg-amber-100 rounded">Not Evaluated</span>`;



                } else {
                    downloadBtn.classList.add('hidden');

                }

                // ✅ Score inputs logic (live update + validation)
                const scoreInputs = container.querySelectorAll('.score-input');

                function recalcOverall() {
                    let totalScore = 0;
                    let totalWeight = 0;
                    let hasScore = false;

                    scoreInputs.forEach((scoreInput, i) => {
                        const weightInput = container.querySelectorAll('.weight-input')[i];
                        const weight = parseFloat(weightInput.value) || 0;
                        const score = parseFloat(scoreInput.value);

                        if (!isNaN(score) && score > 0) {
                            hasScore = true;
                        }

                        totalScore += (score || 0) * weight;
                        totalWeight += weight;
                    });

                    const total = totalWeight > 0 ? (totalScore / totalWeight).toFixed(2) : 0;
                    totalRating.value = total;

                    overall.innerHTML = hasScore ?
                        `<strong>Score :</strong> ${total}` :
                        `<strong>Score :</strong> <span class="inline-block px-2 py-1 text-xs font-semibold text-gray-700 bg-gray-200 rounded-full">Unrated</span>`;
                }

                scoreInputs.forEach(input => {
                    input.addEventListener('input', () => {
                        if (input.value < 0) input.value = 0;
                        if (input.value > 100) input.value = 100;
                        recalcOverall();
                    });
                });

            });
        });
    });
</script>






<?php require("views/partials/foot.php"); ?>