<?php
require("views/partials/head.php");
require("views/partials/nav.php");
require("views/partials/notification.php");

$remainingSeconds = null;
$durationSeconds = (int) $exam['duration'] * 60;

if ($existingAttempt) {
    $endTime = strtotime($existingAttempt['end_time']);
    $remainingSeconds = max(0, $endTime - time());
}
?>

<header class="bg-white shadow-sm px-30 flex-none">
    <div class="mx-auto max-w-7xl py-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2"><?= htmlspecialchars($exam['title']); ?></h1>
            <p class="mt-1 text-sm/6 text-gray-600">Number of Items: <strong><?= htmlspecialchars($exam['num_questions']) ?></strong></p>
            <p class="mt-1 text-sm/6 text-gray-600">Deadline: <?= htmlspecialchars(date('F j, Y g:i A', strtotime($exam['deadline']))); ?></p>
            <p class="mt-1 text-sm/6 text-gray-600">Duration: <strong><?= htmlspecialchars($exam['duration']) ?> minutes</strong></p>
        </div>

        <!-- Timer Circle -->
        <div id="timerContainer" class="flex flex-col items-center">
            <svg class="w-32 h-32">
                <circle class="text-gray-300"
                    stroke-width="8" stroke="currentColor" fill="transparent"
                    r="58" cx="64" cy="64"/>
                <circle id="progressCircle" class="text-green-600"
                    stroke-width="8" stroke="currentColor" fill="transparent"
                    r="58" cx="64" cy="64"
                    stroke-dasharray="<?= 2 * M_PI * 58 ?>" stroke-dashoffset="0"
                    stroke-linecap="round"
                    transform="rotate(90, 64, 64)" />
                <text id="timerText" x="50%" y="50%" text-anchor="middle" dy=".3em"
                    class="text-lg font-bold fill-gray-800">--:--</text>
            </svg>
        </div>
    </div>
</header>

<main class="flex-1 overflow-y-auto px-30 py-6">
    <!-- Start Button (only if no attempt yet) -->
    <?php if (!$existingAttempt): ?>
        <div id="startContainer" class="flex justify-center">
            <form id="startForm" method="POST" action="<?= base_url('/exam/attempt') ?>">
                <input type="hidden" name="exam_id" value="<?= htmlspecialchars($exam['exam_id']) ?>">
                <button type="submit" id="startBtn"
                    class="px-6 py-3 bg-green-600 text-white font-medium rounded-md hover:bg-green-700">
                    Start Exam
                </button>
            </form>
        </div>
    <?php endif; ?>

    <!-- Exam Form -->
    <form id="examForm" method="POST" action="<?= base_url('/student/exam/submit') ?>" class="<?= $existingAttempt ? '' : 'hidden' ?>">
        <input type="hidden" name="ea_id" value="<?= htmlspecialchars($existingAttempt['student_exam_attempt_id']) ?>" />
        <input type="hidden" name="exam_id" value="<?= htmlspecialchars($exam['exam_id']) ?>" />
        <input type="hidden" name="subject_id" value="<?= htmlspecialchars($exam['subject_id']) ?>" />
        <!-- Hidden field to track submission type -->
        <input type="hidden" id="submissionType" name="submission_type" value="submitted" />

        <div class="space-y-8">
            <?php shuffle($questions); ?>
            <?php foreach ($questions as $index => $q): ?>
                <div class="bg-white p-6 rounded-xl shadow-sm ring-1 ring-gray-200">
                    <h2 class="font-semibold text-gray-900 mb-4">Question #<?= $index + 1 ?>:</h2>
                    <p class="text-gray-700 mb-4"><?= htmlspecialchars($q['question_text']) ?></p>

                    <div class="space-y-2">
                        <?php foreach (['A', 'B', 'C', 'D'] as $choice): ?>
                            <label class="flex items-center space-x-3">
                                <input required type="radio" name="answers[<?= $q['exam_question_id'] ?>]" value="<?= $choice ?>"
                                    class="h-4 w-4 text-green-600 border-gray-300 focus:ring-green-500" />
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
                class="inline-flex items-center px-4 py-2 bg-green-600 text-white font-medium rounded-md hover:bg-green-700 focus:ring-2 focus:ring-green-500">
                Submit Answers
            </button>
        </div>
    </form>
</main>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const examForm = document.getElementById("examForm");
    const timerContainer = document.getElementById("timerContainer");
    const timerText = document.getElementById("timerText");
    const progressCircle = document.getElementById("progressCircle");
    const submissionType = document.getElementById("submissionType");

    const radius = 58;
    const circumference = 2 * Math.PI * radius;
    progressCircle.style.strokeDasharray = circumference;

    let remaining = <?= $remainingSeconds !== null ? $remainingSeconds : 0 ?>;
    const durationSeconds = <?= (int) $exam['duration'] * 60 ?>;

    if (remaining > 0) {
        timerContainer.classList.remove("hidden");
        examForm.classList.remove("hidden");
        startTimer();
    }

    function startTimer() {
        updateTimer();
        const interval = setInterval(() => {
            remaining--;
            updateTimer();

            if (remaining <= 0) {
                clearInterval(interval);
                submissionType.value = "expired"; // Mark as expired
                examForm.submit();
            }
        }, 1000);
    }

    function updateTimer() {
        const mins = Math.floor(remaining / 60);
        const secs = remaining % 60;
        timerText.textContent = `${mins}:${secs < 10 ? '0' : ''}${secs}`;

        const progress = remaining / durationSeconds;
        progressCircle.style.strokeDashoffset = circumference * (1 - progress);

        if (progress <= 0.25) {
            progressCircle.classList.add("text-red-600");
            progressCircle.classList.remove("text-green-600", "text-yellow-400");
        } else if (progress <= 0.5) {
            progressCircle.classList.add("text-yellow-400");
            progressCircle.classList.remove("text-green-600", "text-red-600");
        } else {
            progressCircle.classList.add("text-green-600");
            progressCircle.classList.remove("text-yellow-400", "text-red-600");
        }
    }
});
</script>

<?php require("views/partials/foot.php"); ?>
