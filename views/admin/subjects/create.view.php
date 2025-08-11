<?php
require("views/partials/head.php");
require("views/partials/nav.php");
require("views/partials/notification.php");

?>


<header class="bg-white shadow-sm px-30 flex-none">
    <div class="mx-auto max-w-7xl py-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2"><?= htmlspecialchars($program['program_name']); ?> </h1>
            <p class="mt-1 text-sm/6 text-gray-600"><?= htmlspecialchars($program['program_about']); ?></p>
            
        </div>


    </div>
</header>

<main class="flex-1 overflow-y-auto px-30 py-6">


    <form method="POST" action=<?= base_url('/admin/program/subject/store') ?>>
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-6">
                    <div class="col-span-full">
                        <label for="subject_name" class="block text-sm/6 font-medium text-gray-900">Subject</label>
                        <div class="mt-2">
                            <input type="text" name="subject_name" id="subject_name" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 outline-gray-300 focus:outline-2 focus:outline-indigo-600 sm:text-sm/6" placeholder="e.g., Data Structures" required>
                        </div>
                    </div>

                    <div class="col-span-full">
                        <label for="subject_about" class="block text-sm/6 font-medium text-gray-900">About</label>
                        <div class="mt-2">
                            <textarea required id="subject_about" name="subject_about" rows="3" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"></textarea>
                        </div>
                        <p class="mt-3 text-sm/6 text-gray-600">Write a few sentences about the subject.</p>
                    </div>

                    <div class="col-span-full">
                        <label for="program_id" class="block text-sm font-medium text-gray-900 mb-2">Program</label>
                        <select id="program_id" name="program_id" class="w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 outline-gray-300 focus:outline-2 focus:outline-indigo-600 sm:text-sm/6" <?= empty($programs) ? 'disabled' : 'required' ?>>
                            <?php if (empty($programs)) : ?>
                                <option selected disabled>No Program Available</option>
                            <?php else : ?>
                                <option value="" selected disabled>Select a Program</option>
                                <?php foreach ($programs as $programe) : ?>
                                    <option value="<?= htmlspecialchars($programe['program_id']) ?>"><?= htmlspecialchars($programe['program_name']) ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>

                    <div class="sm:col-span-2" id="sections-container">
                        <label for="section_id" class="block text-sm/6 font-medium text-gray-900">Section</label>
                        <select required name="section_id" id="section_id" class="w-full rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 outline-gray-300 focus:outline-2 focus:outline-indigo-600 sm:text-sm/6">
                            <option value="" selected disabled>Select Section</option>
                        </select>
                    </div>
                    

                    <div class="col-span-full">
                        <label for="faculty_id" class="block text-sm font-medium text-gray-900 mb-2">Subject Adviser</label>
                        <select id="faculty_id" name="faculty_id" class="block w-full rounded-md border border-gray-300 bg-white py-2 px-3 text-gray-900 focus:outline-none focus:ring-1 focus:ring-indigo-500 sm:text-sm">
                            <?php foreach ($faculties as $faculty): ?>
                                <option value="<?= htmlspecialchars($faculty['faculty_id']) ?>"><?= htmlspecialchars($faculty['faculty_name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            
            <a href=<?= base_url("/admin/program/".$program['program_id']."/subjects") ?> id="cancel" type="button" class="text-sm/6 font-semibold text-gray-900">Cancel</a>
            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white hover:bg-indigo-500">Save</button>
        </div>
    </form>


</main>

<script>
    new TomSelect('#faculty_id', {
        create: false,
        sortField: {
            field: 'text',
            direction: 'asc'
        }
    });

    document.addEventListener('DOMContentLoaded', () => {
        const programSelect = document.getElementById('program_id');
        const sectionsSelect = document.getElementById('section_id');

        programSelect.addEventListener('change', async () => {
            const programId = programSelect.value;

            // Clear previous options
            sectionsSelect.innerHTML = '<option value="" selected disabled>Loading...</option>';

            try {
                const response = await fetch('<?= base_url('/admin/program/sections/json') ?>?program_id=' + programId);

                const sections = await response.json();

                if (sections.length > 0) {
                    sectionsSelect.innerHTML = '<option value="" selected disabled>Select Section</option>';
                    sections.forEach(section => {
                        const option = document.createElement('option');
                        option.value = section.section_id;
                        option.textContent = section.section_name;
                        sectionsSelect.appendChild(option);
                    });
                } else {
                    sectionsSelect.innerHTML = '<option value="" selected disabled>No sections available</option>';
                }
            } catch (error) {
                console.error('Error loading sections:', error);
                sectionsSelect.innerHTML = '<option value="" selected disabled>Error loading sections</option>';
            }
        });
    });
</script>


<?php require("views/partials/foot.php"); ?>