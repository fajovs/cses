<?php
require("views/partials/head.php");
require("views/partials/nav.php");
require("views/partials/notification.php");
?>

<header class="bg-white shadow-sm px-30 flex-none">
    <div class="mx-auto max-w-7xl py-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2"><?= htmlspecialchars($subject['subject_name']); ?></h1>
            <p class="mt-1 text-sm/6 text-gray-600"><?= htmlspecialchars($subject['subject_about']); ?></p>
            <p class="mt-1 text-sm/6 text-gray-600"><strong><?= htmlspecialchars($subject['section_name']); ?></strong></p>
        </div>
        <div class="flex flex-col gap-4">
            <a href="<?= base_url('/student/subject/' . $subject['subject_id'] . '/activities') ?>"
                class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition-colors focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 outline-none">
                Back
            </a>
        </div>
    </div>
</header>

<main class="flex-1 overflow-y-auto px-30 py-6">
    <div class="max-w-4xl mx-auto space-y-8">

        <div class="border border-gray-200 rounded-lg p-6 bg-white shadow-sm">
            <h2 class="text-2xl font-bold text-gray-800 mb-2"><?= htmlspecialchars($activity['title']) ?></h2>
            <p class="text-gray-700 mb-2"><?= nl2br(htmlspecialchars($activity['description'])) ?></p>
            <p class="text-sm text-gray-600">
                <strong>Deadline:</strong> <?= date("F j, Y g:i A", strtotime($activity['deadline'])) ?>
            </p>
        </div>

        <div class="border border-gray-200 rounded-lg p-6 bg-white shadow-sm">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Criteria</h3>
            <ul class="list-disc pl-6 space-y-1 text-gray-700">
                <?php foreach ($criteria as $criterion): ?>
                    <li>
                        <?= htmlspecialchars($criterion['criteria_name']) ?> —
                        <strong><?= htmlspecialchars($criterion['weight']) ?>%</strong>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <form action="<?= base_url('/student/activity/submit') ?>"
            method="POST" enctype="multipart/form-data" class="border border-gray-200 rounded-lg p-6 bg-white shadow-sm space-y-6">
            <input type="hidden" name="activity_id" value=<?= htmlspecialchars($activity['activity_id']) ?> />
            <input type="hidden" name="subject_id" value=<?= htmlspecialchars($activity['subject_id']) ?> />

            <div>
                <label for="file" class="block text-sm font-medium text-gray-900">Upload File (PDF, PNG, JPG, JPEG)</label>
                <input required id="file" name="file" type="file" accept=".pdf, .png, .jpg, .jpeg"
                    class="mt-2 block w-full text-sm text-gray-900 file:mr-4 file:py-2 file:px-4
                           file:rounded-md file:border-0 file:bg-indigo-600 file:text-white 
                           hover:file:bg-indigo-500 focus:outline-none" />
            </div>

            <div>
                <label for="note" class="block text-sm font-medium text-gray-900">Notes (Optional)</label>
                <textarea id="note" name="note" rows="4"
                    class="mt-2 block w-full rounded-md bg-white px-3 py-2 text-base text-gray-900 outline outline-1 outline-gray-300 focus:outline-2 focus:outline-indigo-600"
                    placeholder="Write any notes or comments..."></textarea>
            </div>

            <div class="flex justify-end">
                <button type="submit"
                    class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-500 focus:ring-2 focus:ring-indigo-600">
                    Submit Activity
                </button>
            </div>
        </form>
    </div>
</main>

<?php require("views/partials/foot.php"); ?>