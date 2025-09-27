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
            <a href="<?= base_url('/faculty/subject/' . $subject['subject_id']) . '/projects' ?>"
                class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition-colors focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 outline-none">
                Cancel
            </a>
        </div>
    </div>
</header>

<main class="flex-1 overflow-y-auto px-30 py-6">
    <h1 class="text-2xl font-bold mb-4">Create New Project</h1>
    <form method="POST" action="<?= base_url('/faculty/subject/project/store') ?>" enctype="multipart/form-data">
        <div class="space-y-12">
            <input type="hidden" name="subject_id" value="<?= htmlspecialchars($subject['subject_id']) ?>" />

            <div class="border-b border-gray-900/10 pb-12">
                <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                    <div class="sm:col-span-4">
                        <label for="title" class="block text-sm font-medium text-gray-900">Project Title</label>
                        <input required id="title" type="text" name="title" placeholder="Enter Project title"
                            class="mt-2 block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 outline-gray-300 focus:outline-2 focus:outline-green-600" />
                    </div>

                    <div class="sm:col-span-3">
                        <label for="deadline" class="block text-sm font-medium text-gray-900">Deadline</label>
                        <input required id="deadline" type="datetime-local" name="deadline"
                            class="mt-2 block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 outline-gray-300 focus:outline-2 focus:outline-green-600"
                            min="<?= date('Y-m-d\TH:i') ?>" />
                    </div>

                    <div class="sm:col-span-full">
                        <label for="description" class="block text-sm font-medium text-gray-900">Description</label>
                        <textarea required id="description" name="description" rows="5"
                            class="h-50 mt-2 block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 outline-gray-300 focus:outline-2 focus:outline-green-600"
                            placeholder="Briefly describe the Project..."></textarea>
                    </div>

                    <!-- ✅ Optional File Upload -->
                    <div class="sm:col-span-full">
                        <label for="file" class="block text-sm font-medium text-gray-900">Attach File (Optional)</label>
                        <input id="file" name="file" type="file" accept=".pdf, .png, .jpg, .jpeg"
                            class="mt-2 block w-full text-sm text-gray-900 file:mr-4 file:py-2 file:px-4
                               file:rounded-md file:border-0 file:bg-green-600 file:text-white 
                               hover:file:bg-green-500 focus:outline-none" />
                        <p class="mt-1 text-xs text-gray-500">Accepted formats: PDF, PNG, JPG, JPEG</p>
                    </div>
                </div>
            </div>

            <div>
                <h2 class="text-xl font-semibold">Criteria</h2>
                <div id="criteriaContainer" class="space-y-6 mt-4"></div>

                <button type="button" id="addCriteriaBtn"
                    class="mt-4 rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-green-600">
                    Add Criteria
                </button>
            </div>

            <div class="mt-6 flex justify-end">
                <button type="submit"
                    class="rounded-md bg-green-600 px-4 py-2 text-sm font-semibold text-white hover:bg-green-500 focus:ring-2 focus:ring-green-600">
                    Save Project
                </button>
            </div>
        </div>
    </form>

</main>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const addCriteriaBtn = document.getElementById('addCriteriaBtn');
        const container = document.getElementById('criteriaContainer');
        const deadlineInput = document.getElementById('deadline');
        const form = document.querySelector('form');

        // Set default deadline minimum
        deadlineInput.addEventListener('change', () => {
            const selectedDate = new Date(deadlineInput.value);
            const now = new Date();
            now.setMinutes(now.getMinutes() + 5);
            deadlineInput.min = now.toISOString().slice(0, 16);
            if (selectedDate <= now) {
                alert('Deadline must be at least 5 minutes in the future.');
                deadlineInput.value = '';
            }
        });

        let counter = 0;
        addCriteriaBtn.addEventListener('click', () => {
            counter++;
            container.insertAdjacentHTML('beforeend', createCriteriaBlock(counter));
        });

        function createCriteriaBlock(index) {
            return `
                <div class="border border-gray-300 rounded-lg p-4 criteria-block">
                    <div class="flex flex-col sm:flex-row gap-4">
                        <div class="w-full">
                            <label class="block text-sm font-medium text-gray-900">Criteria</label>
                            <input required type="text" name="criteria_name[]" placeholder="e.g. Clarity"
                                class="mt-1 block w-full rounded-md bg-white px-3 py-1.5 text-gray-900 outline outline-1 outline-gray-300 focus:outline-2 focus:outline-green-600" />
                        </div>
                        <div class="w-full sm:w-1/3">
                            <label class="block text-sm font-medium text-gray-900">Weight (%)</label>
                            <input required type="number" name="criteria_weight[]" placeholder="e.g. 30" min="1" max="100"
                                class="mt-1 block w-full rounded-md bg-white px-3 py-1.5 text-gray-900 outline outline-1 outline-gray-300 focus:outline-2 focus:outline-green-600" />
                        </div>
                        <div class="flex items-end">
                            <button type="button" onclick="this.closest('.criteria-block').remove();"
                                class="text-sm text-red-600 hover:underline">Remove</button>
                        </div>
                    </div>
                </div>
            `;
        }

        // Form submission validation
        form.addEventListener('submit', (e) => {
            const criteriaBlocks = document.querySelectorAll('.criteria-block');
            if (criteriaBlocks.length === 0) {
                e.preventDefault();
                alert('Please add at least one criteria before submitting the form.');
                return;
            }

            // Sum all weights
            const weightInputs = document.querySelectorAll('input[name="criteria_weight[]"]');
            let totalWeight = 0;
            weightInputs.forEach(input => {
                totalWeight += parseFloat(input.value) || 0;
            });

            if (totalWeight !== 100) {
                e.preventDefault();
                alert(`Total criteria weight must be exactly 100%. Current total: ${totalWeight}%.`);
            }
        });
    });
</script>



<?php require("views/partials/foot.php"); ?>