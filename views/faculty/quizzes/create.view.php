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
                class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition-colors focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 outline-none">
                Cancel
            </a>
        </div>
    </div>
</header>

<main class="flex-1 overflow-y-auto px-30 py-6">
    <h1 class="text-2xl font-bold mb-4">Create New Quiz</h1>

    <form method="POST" action="<?= base_url('/faculty/subject/quiz/store') ?>" enctype="multipart/form-data">
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <input type="hidden" name="subject_id" value="<?= htmlspecialchars($subject['subject_id']) ?>" />

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                    <div class="sm:col-span-4">
                        <label for="title" class="block text-sm/6 font-medium text-gray-900">Quiz Title</label>
                        <div class="mt-2">
                            <input required id="title" type="text" name="title" placeholder="Enter quiz title"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 outline-gray-300 focus:outline-2 focus:outline-green-600 sm:text-sm/6" />
                        </div>
                    </div>

                    <div class="sm:col-span-2">
                        <label for="num_questions" class="block text-sm/6 font-medium text-gray-900">Number of Items</label>
                        <div class="mt-2">
                            <input required id="num_questions" type="number" name="num_questions" min="1" max="100" placeholder="e.g. 5"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 outline-gray-300 focus:outline-2 focus:outline-green-600 sm:text-sm/6" />
                        </div>
                    </div>

                    <div class="sm:col-span-2">
                        <label for="passing_score" class="block text-sm/6 font-medium text-gray-900">Passing Score</label>
                        <div class="mt-2">
                            <input required id="passing_score" type="number" name="passing_score" min="1" placeholder="e.g. 3"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 outline-gray-300 focus:outline-2 focus:outline-green-600 sm:text-sm/6" />
                        </div>
                        <p class="mt-1 text-xs text-gray-500">Must not be higher than number of items.</p>
                    </div>

                    <div class="sm:col-span-2">
                        <label for="deadline" class="block text-sm/6 font-medium text-gray-900">Deadline</label>
                        <div class="mt-2">
                            <input required id="deadline" type="datetime-local" name="deadline"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 outline-gray-300 focus:outline-2 focus:outline-green-600 sm:text-sm/6" />
                        </div>
                        <p class="mt-1 text-xs text-gray-500">Set the date & time when the quiz will automatically become inactive.</p>
                    </div>

                    <div class="sm:col-span-2">
                        <label for="duration" class="block text-sm/6 font-medium text-gray-900">Duration (minutes)</label>
                        <div class="mt-2">
                            <input required id="duration" type="number" name="duration" min="1" max="300" value="30"
                                placeholder="e.g. 30"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 outline-gray-300 focus:outline-2 focus:outline-green-600 sm:text-sm/6" />
                        </div>
                        <p class="mt-1 text-xs text-gray-500">Students will have at least 30 minutes to complete the quiz (default).</p>
                    </div>

                </div>

                <div class="mt-4 flex flex-col sm:flex-row gap-4 items-start">
                    <button type="button" id="generateBtn"
                        class="rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-green-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">
                        Generate Questions
                    </button>

                    <!-- ✅ Upload Excel -->
                    <div>
                        <label for="quiz_excel" class="block text-sm/6 font-medium text-gray-900">Upload Excel File (Optional)</label>
                        <input type="file" id="quiz_excel" accept=".xlsx, .xls"
                            class="mt-2 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-white focus:outline-none" />
                        <p class="mt-1 text-xs text-gray-500">Upload Excel file to auto-fill quiz questions and choices.</p>
                    </div>

                    <!-- ✅ Download Excel Format -->
                    <div>
                        <button type="button" id="downloadTemplateBtn"
                            class="rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-blue-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                            Download Excel Format
                        </button>
                        <p class="mt-1 text-xs text-gray-500">Download sample Excel format for uploading quiz questions.</p>
                    </div>
                </div>
            </div>

            <h1 class="text-2xl font-bold mb-4">Questions</h1>

            <div id="questionsContainer" class="space-y-12"></div>

            <div class="mt-6 flex items-center justify-end gap-x-6">
                <button type="submit"
                    class="rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-green-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">
                    Save Quiz
                </button>
            </div>
        </div>
    </form>
</main>

<!-- ✅ SheetJS for Excel parsing & generation -->
<script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const generateBtn = document.getElementById('generateBtn');
    const downloadTemplateBtn = document.getElementById('downloadTemplateBtn');
    const numQuestionsInput = document.getElementById('num_questions');
    const passingScoreInput = document.getElementById('passing_score');
    const deadlineInput = document.getElementById('deadline');
    const durationInput = document.getElementById('duration');
    const container = document.getElementById('questionsContainer');
    const excelInput = document.getElementById('quiz_excel');

    // ✅ Generate Questions
    generateBtn.addEventListener('click', () => {
        const desiredNum = parseInt(numQuestionsInput.value, 10);
        if (isNaN(desiredNum) || desiredNum <= 0) {
            alert('Please enter a valid number of questions.');
            return;
        }

        container.innerHTML = "";
        for (let i = 1; i <= desiredNum; i++) {
            container.insertAdjacentHTML('beforeend', createQuestionBlock(i));
        }
    });

    // ✅ Download Excel Template
    downloadTemplateBtn.addEventListener('click', () => {
        const data = [
            ["Question", "Choice A", "Choice B", "Choice C", "Choice D", "Answer"],
            ["What is 2 + 2?", "1", "2", "3", "4", "D"],
            ["What is the capital of France?", "Berlin", "London", "Paris", "Madrid", "C"]
        ];
        const ws = XLSX.utils.aoa_to_sheet(data);
        const wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, ws, "Quiz Format");
        XLSX.writeFile(wb, "quiz_format.xlsx");
    });

    // ✅ Excel upload
    excelInput.addEventListener('change', (event) => {
        const file = event.target.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = (e) => {
            const data = new Uint8Array(e.target.result);
            const workbook = XLSX.read(data, { type: 'array' });
            const sheet = workbook.Sheets[workbook.SheetNames[0]];
            const rows = XLSX.utils.sheet_to_json(sheet, { header: 1 });

            if (rows.length < 2) {
                alert("Excel file must have at least one question row.");
                return;
            }

            container.innerHTML = "";
            rows.slice(1).forEach((row, index) => {
                const [question, choiceA, choiceB, choiceC, choiceD, answer] = row;
                container.insertAdjacentHTML('beforeend', createQuestionBlock(index + 1));

                const lastBlock = container.querySelector('.question-block:last-child');
                lastBlock.querySelector('input[name="question[]"]').value = question || "";
                lastBlock.querySelector('input[name="choice_a[]"]').value = choiceA || "";
                lastBlock.querySelector('input[name="choice_b[]"]').value = choiceB || "";
                lastBlock.querySelector('input[name="choice_c[]"]').value = choiceC || "";
                lastBlock.querySelector('input[name="choice_d[]"]').value = choiceD || "";
                if (answer) lastBlock.querySelector('select[name="answer[]"]').value = answer.trim().toUpperCase();
            });

            numQuestionsInput.value = rows.length - 1;
            alert(`Loaded ${rows.length - 1} questions from Excel!`);
        };
        reader.readAsArrayBuffer(file);
    });

    // ✅ Input validation
    passingScoreInput.addEventListener('input', () => {
        const numQuestions = parseInt(numQuestionsInput.value, 10);
        const passingScore = parseInt(passingScoreInput.value, 10);
        if (!isNaN(numQuestions) && !isNaN(passingScore) && passingScore > numQuestions) {
            alert('Passing score cannot be higher than the number of items.');
            passingScoreInput.value = '';
        }
    });

    deadlineInput.addEventListener('change', () => {
        const selectedDate = new Date(deadlineInput.value);
        const now = new Date();
        now.setMinutes(now.getMinutes() + 5);
        deadlineInput.min = now.toISOString().slice(0, 16);
        if (selectedDate <= now) {
            alert('Deadline must be in the future.');
            deadlineInput.value = '';
        }
    });

    durationInput.addEventListener('input', () => {
        const duration = parseInt(durationInput.value, 10);
        if (isNaN(duration) || duration < 1 || duration > 300) {
            alert('Duration must be between 1 and 300 minutes.');
            durationInput.value = '';
        }
    });

    // ✅ Dynamic Question Block
    function createQuestionBlock(index) {
        return `
        <div class="border-b border-gray-900/10 pb-12 question-block">
            <div class="sm:col-span-4">
                <label class="block text-sm/6 font-medium text-gray-900">Question #${index}</label>
                <div class="mt-2">
                    <input required type="text" name="question[]" placeholder="Enter your question here"
                        class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 placeholder:text-gray-400 outline-1 outline-gray-300 focus:outline-2 focus:outline-green-600 sm:text-sm/6" />
                </div>
            </div>
            <div class="sm:col-span-4 mt-4">
                <label class="block text-sm/6 font-medium text-gray-900">Choices</label>
                <div class="mt-2 space-y-2">
                    <input required type="text" name="choice_a[]" placeholder="Choice A"
                        class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 outline-gray-300 focus:outline-2 focus:outline-green-600 sm:text-sm/6" />
                    <input required type="text" name="choice_b[]" placeholder="Choice B"
                        class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 outline-gray-300 focus:outline-2 focus:outline-green-600 sm:text-sm/6" />
                    <input required type="text" name="choice_c[]" placeholder="Choice C"
                        class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 outline-gray-300 focus:outline-2 focus:outline-green-600 sm:text-sm/6" />
                    <input required type="text" name="choice_d[]" placeholder="Choice D"
                        class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 outline-gray-300 focus:outline-2 focus:outline-green-600 sm:text-sm/6" />
                </div>
            </div>
            <div class="sm:col-span-4 mt-4">
                <label class="block text-sm/6 font-medium text-gray-900">Correct Answer</label>
                <div class="mt-2">
                    <select name="answer[]" required
                        class="w-full rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 outline-gray-300 focus:outline-2 focus:outline-green-600 sm:text-sm/6">
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
});
</script>

<?php require("views/partials/foot.php"); ?>
