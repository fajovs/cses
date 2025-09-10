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
            <a href="<?= base_url('/faculty/subject/' . $subject['subject_id']) . '/quizzes' ?>"
                class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition-colors focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                Return to Quizzes
            </a>
        </div>
    </div>
</header>

<main class="flex-1 overflow-y-auto px-30 py-6">
    <h1 class="text-2xl font-bold mb-4">Edit Quiz</h1>
    <form method="POST" action="<?= base_url('/faculty/subject/' . $quiz['subject_id'] . '/quiz/' . $quiz['quiz_id'] . '/update') ?>">
        <input type="hidden" name="_method" value="PATCH" />
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <input type="hidden" name="quiz_id" value="<?= htmlspecialchars($quiz['quiz_id']) ?>" />

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-4">
                        <label class="block text-sm/6 font-medium text-gray-900">Quiz Title</label>
                        <div class="mt-2">
                            <input required type="text" name="title" value="<?= htmlspecialchars($quiz['title']) ?>"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 outline-gray-300 focus:outline-green-600 sm:text-sm/6" />
                        </div>
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block text-sm/6 font-medium text-gray-900">Number of Items</label>
                        <div class="mt-2">
                            <input required id="num_questions" type="number" name="num_questions" min="1" max="100"
                                value="<?= htmlspecialchars($quiz['num_questions']) ?>"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 outline-gray-300 focus:outline-green-600 sm:text-sm/6" />
                        </div>
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block text-sm/6 font-medium text-gray-900">Passing Score</label>
                        <div class="mt-2">
                            <input required id="passing_score" type="number" name="passing_score" min="1"
                                value="<?= htmlspecialchars($quiz['passing_score']) ?>"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 outline-gray-300 focus:outline-green-600 sm:text-sm/6" />
                        </div>
                        <p class="mt-1 text-xs text-gray-500">Must not be higher than number of items.</p>
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block text-sm/6 font-medium text-gray-900">Deadline</label>
                        <div class="mt-2">
                            <input required id="deadline" type="datetime-local" name="deadline"
                                value="<?= htmlspecialchars(date('Y-m-d\TH:i', strtotime($quiz['deadline']))) ?>"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 outline-gray-300 focus:outline-green-600 sm:text-sm/6" />
                        </div>
                        <p class="mt-1 text-xs text-gray-500">Set the date & time when the quiz will automatically become inactive.</p>
                    </div>

                    <div class="sm:col-span-2">
                        <label for="duration" class="block text-sm/6 font-medium text-gray-900">Duration (minutes)</label>
                        <div class="mt-2">
                            <input required id="duration" type="number" name="duration"
                                min="1" max="300"
                                value="<?= htmlspecialchars($quiz['duration'] ?? 30) ?>"
                                placeholder="e.g. 30"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 outline-gray-300 focus:outline-green-600 sm:text-sm/6" />
                        </div>
                        <p class="mt-1 text-xs text-gray-500">Students will have at least 30 minutes to complete the quiz (default is 30).</p>
                    </div>
                </div>




                <div class="mt-4">
                    <button type="button" id="generateBtn"
                        class="rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-green-500 focus:outline-green-600">
                        Adjust Number of Questions
                    </button>
                </div>
            </div>

            <h1 class="text-2xl font-bold mb-4">Questions</h1>

            <div id="questionsContainer" class="space-y-12">
                <?php foreach ($questions as $index => $q): ?>
                    <div class="border-b border-gray-900/10 pb-12 question-block">
                        <input type="hidden" name="question_ids[]" value="<?= htmlspecialchars($q['quiz_question_id']) ?>">
                        <label class="block text-sm/6 font-medium text-gray-900">Question #<?= $index + 1 ?></label>
                        <div class="mt-2">
                            <input required type="text" name="question[]" value="<?= htmlspecialchars($q['question_text']) ?>"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 outline-gray-300 focus:outline-green-600" />
                        </div>
                        <div class="sm:col-span-4 mt-4">
                            <label class="block text-sm/6 font-medium text-gray-900">Choices</label>
                            <div class="mt-2 space-y-2">
                                <?php foreach (['a', 'b', 'c', 'd'] as $letter): ?>
                                    <input required type="text" name="choice_<?= $letter ?>[]" value="<?= htmlspecialchars($q["choice_$letter"]) ?>"
                                        placeholder="Choice <?= strtoupper($letter) ?>"
                                        class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 outline-gray-300 focus:outline-green-600" />
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="sm:col-span-4 mt-4">
                            <label class="block text-sm/6 font-medium text-gray-900">Correct Answer</label>
                            <div class="mt-2">
                                <select name="answer[]" required
                                    class="w-full rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 outline-gray-300 focus:outline-green-600">
                                    <option value="A" <?= $q['correct_answer'] == 'A' ? 'selected' : '' ?>>A</option>
                                    <option value="B" <?= $q['correct_answer'] == 'B' ? 'selected' : '' ?>>B</option>
                                    <option value="C" <?= $q['correct_answer'] == 'C' ? 'selected' : '' ?>>C</option>
                                    <option value="D" <?= $q['correct_answer'] == 'D' ? 'selected' : '' ?>>D</option>
                                </select>
                            </div>
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

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const generateBtn = document.getElementById('generateBtn');
        const numQuestionsInput = document.getElementById('num_questions');
        const passingScoreInput = document.getElementById('passing_score');
        const deadlineInput = document.getElementById('deadline');
        const container = document.getElementById('questionsContainer');

        generateBtn.addEventListener('click', () => {
            const desiredNum = parseInt(numQuestionsInput.value, 10);
            if (isNaN(desiredNum) || desiredNum <= 0) {
                alert('Please enter a valid number of questions.');
                return;
            }
            const currentNum = container.querySelectorAll('.question-block').length;

            if (desiredNum > currentNum) {
                for (let i = currentNum + 1; i <= desiredNum; i++) {
                    container.insertAdjacentHTML('beforeend', createEmptyBlock(i));
                }
            } else if (desiredNum < currentNum) {
                for (let i = currentNum; i > desiredNum; i--) {
                    container.querySelector('.question-block:last-child').remove();
                }
            }
        });

        // Validate passing score
        passingScoreInput.addEventListener('input', () => {
            const numQuestions = parseInt(numQuestionsInput.value, 10);
            const passingScore = parseInt(passingScoreInput.value, 10);
            if (!isNaN(numQuestions) && !isNaN(passingScore) && passingScore > numQuestions) {
                alert('Passing score cannot be higher than the number of items.');
                passingScoreInput.value = '';
            }
        });

        // Validate deadline is in the future
        deadlineInput.addEventListener('input', () => {
            const deadline = new Date(deadlineInput.value);
            const now = new Date();
            if (deadline <= now) {
                alert('Deadline must be in the future.');
                deadlineInput.value = '';
            }
        });

        function createEmptyBlock(index) {
            return `
        <div class="border-b border-gray-900/10 pb-12 question-block">
            <input type="hidden" name="question_ids[]" value="">
            <label class="block text-sm/6 font-medium text-gray-900">Question #${index}</label>
            <div class="mt-2">
                <input required type="text" name="question[]" placeholder="Enter your question here"
                       class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 outline-gray-300 focus:outline-green-600" />
            </div>
            <div class="sm:col-span-4 mt-4">
                <label class="block text-sm/6 font-medium text-gray-900">Choices</label>
                <div class="mt-2 space-y-2">
                    ${['A','B','C','D'].map(letter => `
                        <input required type="text" name="choice_${letter.toLowerCase()}[]" placeholder="Choice ${letter}"
                               class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 outline-gray-300 focus:outline-green-600" />`).join('')}
                </div>
            </div>
            <div class="sm:col-span-4 mt-4">
                <label class="block text-sm/6 font-medium text-gray-900">Correct Answer</label>
                <div class="mt-2">
                    <select name="answer[]" required
                            class="w-full rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 outline-gray-300 focus:outline-green-600">
                        <option value="" disabled selected>Select the correct answer</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                    </select>
                </div>
            </div>
        </div>`;
        }

        const durationInput = document.getElementById('duration');

        durationInput.addEventListener('input', () => {
            const duration = parseInt(durationInput.value, 10);
            if (!isNaN(duration) && duration < 30) {
                alert('Duration must be at least 30 minutes.');
                durationInput.value = 30;
            }
        });
    });
</script>

<?php require("views/partials/foot.php"); ?>