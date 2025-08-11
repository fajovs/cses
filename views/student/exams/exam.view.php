<?php
require("views/partials/head.php");
require("views/partials/nav.php");
require("views/partials/notification.php");
?>

<header class="bg-white shadow-sm px-30 flex-none">
    <div class="mx-auto max-w-7xl py-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2"><?= htmlspecialchars($exam['title']); ?></h1>
            <p class="mt-1 text-sm/6 text-gray-600">Number of Items: <strong><?= htmlspecialchars($exam['num_questions']) ?></strong></p>
            <p class="mt-1 text-sm/6 text-gray-600">Deadline: <?= htmlspecialchars(date('F j, Y g:i A', strtotime($exam['deadline']))); ?></p>
        </div>
    </div>
</header>

<main class="flex-1 overflow-y-auto px-30 py-6">
    <form method="POST" action="<?= base_url('/student/exam/submit') ?>">
        <input type="hidden" name="exam_id" value="<?= htmlspecialchars($exam['exam_id']) ?>" />
        <input type="hidden" name="subject_id" value="<?= htmlspecialchars($exam['subject_id']) ?>" />

        <div class="space-y-8">
            <?php foreach ($questions as $index => $q): ?>
                <div class="bg-white p-6 rounded-xl shadow-sm ring-1 ring-gray-200">
                    <h2 class="font-semibold text-gray-900 mb-4">Question #<?= $index + 1 ?>:</h2>
                    <p class="text-gray-700 mb-4"><?= htmlspecialchars($q['question_text']) ?></p>

                    <div class="space-y-2">
                        <?php foreach (['A', 'B', 'C', 'D'] as $choice): ?>
                            <label class="flex items-center space-x-3">
                                <input required type="radio" name="answers[<?= $q['exam_question_id'] ?>]" value="<?= $choice ?>"
                                    class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500" />
                                <span class="text-gray-800">
                                    <?= htmlspecialchars($q['choice_' . strtolower($choice)]) ?>
                                </span>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="mt-8 flex justify-end">
            <button type="submit"
                class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white font-medium rounded-md hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500">
                Submit Answers
            </button>
        </div>
    </form>
</main>

<?php require("views/partials/foot.php"); ?>
