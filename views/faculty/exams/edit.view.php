<?php
require("views/partials/head.php");
require("views/partials/nav.php");
require("views/partials/notification.php");
?>

<header class="bg-white shadow-sm px-30 flex-none">
    <div class="mx-auto max-w-7xl py-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2"><?= htmlspecialchars($subject['subject_name']) ?></h1>
            <p class="mt-1 text-sm/6 text-gray-600"><?= htmlspecialchars($subject['subject_about']) ?></p>
            <p class="mt-1 text-sm/6 text-gray-600"><strong><?= htmlspecialchars($subject['section_name']) ?></strong></p>
        </div>
        <div class="flex flex-col gap-4">
            <a href="<?= base_url('/faculty/subject/' . $subject['subject_id']) . '/exams' ?>"
               class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition-colors focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                Return to Exams
            </a>
        </div>
    </div>
</header>

<main class="flex-1 overflow-y-auto px-30 py-6">
    <h1 class="text-2xl font-bold mb-4">Edit Exam</h1>

    <form method="POST" action="<?= base_url('/faculty/subject/' . $exam['subject_id'] . '/exam/' . $exam['exam_id'] . '/update') ?>">
        <input type="hidden" name="_method" value="PATCH" />
        <input type="hidden" name="exam_id" value="<?= htmlspecialchars($exam['exam_id']) ?>" />

        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="sm:col-span-4">
                    <label class="block text-sm/6 font-medium text-gray-900">Exam Title</label>
                    <input required type="text" name="title" value="<?= htmlspecialchars($exam['title']) ?>"
                           class="mt-2 block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 outline-gray-300 focus:outline-green-600 sm:text-sm/6" />
                </div>

                <div class="sm:col-span-2">
                    <label class="block text-sm/6 font-medium text-gray-900">Number of Items</label>
                    <input required id="num_questions" type="number" name="num_questions" min="1" max="100"
                           value="<?= htmlspecialchars($exam['num_questions']) ?>"
                           class="mt-2 block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 outline-gray-300 focus:outline-green-600 sm:text-sm/6" />
                </div>

                <div class="sm:col-span-2">
                    <label class="block text-sm/6 font-medium text-gray-900">Passing Score</label>
                    <input required id="passing_score" type="number" name="passing_score" min="1"
                           value="<?= htmlspecialchars($exam['passing_score']) ?>"
                           class="mt-2 block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 outline-gray-300 focus:outline-green-600 sm:text-sm/6" />
                    <p class="mt-1 text-xs text-gray-500">Must not be higher than number of items.</p>
                </div>

                <div class="sm:col-span-3">
                    <label class="block text-sm/6 font-medium text-gray-900">Deadline</label>
                    <input required id="deadline" type="datetime-local" name="deadline"
                           value="<?= htmlspecialchars(date('Y-m-d\TH:i', strtotime($exam['deadline']))) ?>"
                           class="mt-2 block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 outline-gray-300 focus:outline-green-600 sm:text-sm/6" />
                    <p class="mt-1 text-xs text-gray-500">Set when the exam automatically becomes inactive.</p>
                </div>
            </div>

            <div class="mt-4">
                <button type="button" id="generateBtn"
                        class="rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-green-500 focus:outline-green-600">
                    Adjust Number of Questions
                </button>
            </div>

            <h1 class="text-2xl font-bold mb-4">Questions</h1>

            <div id="questionsContainer" class="space-y-12">
                <?php foreach ($questions as $index => $q): ?>
                    <div class="border-b border-gray-900/10 pb-12 question-block">
                        <input type="hidden" name="question_ids[]" value="<?= htmlspecialchars($q['exam_question_id']) ?>" />
                        <label class="block text-sm/6 font-medium text-gray-900">Question #<?= $index+1 ?></label>
                        <input required type="text" name="question[]" value="<?= htmlspecialchars($q['question_text']) ?>"
                               class="mt-2 block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 outline-gray-300 focus:outline-green-600" />

                        <div class="sm:col-span-4 mt-4">
                            <label class="block text-sm/6 font-medium text-gray-900">Choices</label>
                            <div class="mt-2 space-y-2">
                                <?php foreach (['a','b','c','d'] as $letter): ?>
                                    <input required type="text" name="choice_<?= $letter ?>[]" value="<?= htmlspecialchars($q["choice_$letter"]) ?>"
                                           placeholder="Choice <?= strtoupper($letter) ?>"
                                           class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 outline-gray-300 focus:outline-green-600" />
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div class="sm:col-span-4 mt-4">
                            <label class="block text-sm/6 font-medium text-gray-900">Correct Answer</label>
                            <select name="answer[]" required
                                    class="mt-2 w-full rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 outline-gray-300 focus:outline-green-600">
                                <?php foreach (['A','B','C','D'] as $letter): ?>
                                    <option value="<?= $letter ?>" <?= $q['correct_answer'] == $letter ? 'selected' : '' ?>><?= $letter ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="mt-6 flex items-center justify-end gap-x-6">
                <button type="submit"
                        class="rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-green-500 focus:outline-green-600">
                    Save Changes
                </button>
            </div>
        </div>
    </form>
</main>

<?php require("views/partials/foot.php"); ?>
