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

        </div>


    </div>
</header>

<main class="flex-1 overflow-y-auto px-30 py-6">


    <form method="POST" action=<?= base_url('/admin/program/subject/update') ?>>
        <input type="hidden" name="_method" value="PATCH">
        <input type="hidden" name="subject_id" value=<?= htmlspecialchars($subject['subject_id']); ?>>
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-6">
                    <div class="col-span-full">
                        <label for="subject_name" class="block text-sm/6 font-medium text-gray-900">Subject</label>
                        <div class="mt-2">
                            <input value=<?= htmlspecialchars($subject['subject_name']) ?> type="text" name="subject_name" id="subject_name" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 outline-gray-300 focus:outline-2 focus:outline-indigo-600 sm:text-sm/6" placeholder="e.g., Data Structures" required>
                        </div>
                    </div>

                    <div class="col-span-full">
                        <label for="subject_about" class="block text-sm/6 font-medium text-gray-900">About</label>
                        <div class="mt-2">
                            <textarea required id="subject_about" name="subject_about" rows="3" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"><?= htmlspecialchars($subject['subject_about']) ?></textarea>
                        </div>
                        <p class="mt-3 text-sm/6 text-gray-600">Write a few sentences about the subject.</p>
                    </div>

                    <div class="col-span-full">
                        <label for="program_id" class="block text-sm font-medium text-gray-900 mb-2">Program</label>
                        <select id="program_id" name="program_id" class="w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 outline-gray-300 focus:outline-2 focus:outline-indigo-600 sm:text-sm/6" <?= empty($programs) ? 'disabled' : 'required' ?>>
                            <?php if (empty($programs)) : ?>
                                <option selected disabled>No Program Available</option>
                            <?php else : ?>
                                <option value="" disabled <?= empty($subject['program_id']) ? 'selected' : '' ?>>Select a Program</option>
                                <?php foreach ($programs as $program) : ?>
                                    <option value="<?= htmlspecialchars($program['program_id']) ?>"
                                        <?= ($program['program_id'] == $subject['program_id']) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($program['program_name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>


                    <div class="sm:col-span-2" id="sections-container">
                        <label for="section_id" class="block text-sm/6 font-medium text-gray-900">Section</label>
                        <select required name="section_id" id="section_id" class="w-full rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 outline-gray-300 focus:outline-2 focus:outline-indigo-600 sm:text-sm/6">
                            <?php if (!empty($subject['section_id'])): ?>
                                <option value="<?= htmlspecialchars($subject['section_id']) ?>" selected>
                                    <?= htmlspecialchars($subject['section_name']) ?>
                                </option>
                            <?php else: ?>
                                <option value="" selected disabled>Select Section</option>
                            <?php endif; ?>
                        </select>
                    </div>



                    <div class="col-span-full">
                        <label for="faculty_id" class="block text-sm font-medium text-gray-900 mb-2">Subject Adviser</label>
                        <select id="faculty_id" name="faculty_id" class="block w-full rounded-md border border-gray-300 bg-white py-2 px-3 text-gray-900 focus:outline-none focus:ring-1 focus:ring-indigo-500 sm:text-sm">
                            <?php foreach ($faculties as $faculty): ?>
                                <option value="<?= htmlspecialchars($faculty['faculty_id']) ?>"
                                    <?= ($faculty['faculty_id'] == $subject['faculty_id']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($faculty['faculty_name']) ?>
                                </option>
                            <?php endforeach; ?>

                        </select>
                    </div>

                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-between gap-x-6">

            <div class="mt-6 flex items-center justify-end gap-x-6">
                <button command="show-modal" commandfor="delete-dialog" type="button" class="rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-red-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">DELETE</button>

            </div>
            <div class="mt-6 flex items-center justify-end gap-x-6">

                <a href=<?= base_url("/admin/program/" . $subject['program_id'] . "/subjects") ?> id="cancel" type="button" class="text-sm/6 font-semibold text-gray-900">Cancel</a>
                <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white hover:bg-indigo-500">Save</button>
            </div>
        </div>
    </form>


</main>


<!-- Delete confirmation modal -->
<el-dialog>
    <dialog id="delete-dialog" aria-labelledby="dialog-title"
        class="fixed inset-0 overflow-y-auto bg-transparent backdrop:bg-transparent">
        <el-dialog-backdrop class="fixed inset-0 bg-gray-500/75 transition-opacity"></el-dialog-backdrop>
        <div class="fixed inset-0 flex items-center justify-center p-4">
            <el-dialog-panel class="relative bg-white rounded-lg shadow-xl sm:w-full sm:max-w-lg">
                <div class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex size-12 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:size-10">
                            <svg class="size-6 text-red-600" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v3.75M12 15.75h.007v.008H12v-.008ZM3.697 17.126c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L3.697 17.126Z" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 id="dialog-title" class="text-base font-semibold text-gray-900">Delete Subject?</h3>
                            <p class="mt-2 text-sm text-gray-500">Are you sure you want to delete <?= htmlspecialchars($subject['subject_name']) ?>? This action cannot be undone.</p>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse">
                  
                    <form method="POST" action=<?= base_url('/admin/program/subject/delete') ?>>
                        <input type="hidden" name="_method" value="DELETE" />
                        <input type="hidden" name="subject_id" value=<?= htmlspecialchars($subject['subject_id']) ?> />
                        <input type="hidden" name="program_id" value=<?= htmlspecialchars($subject['program_id']) ?> />
                        
                        <button type="submit"
                            class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-red-500 sm:ml-3 sm:w-auto">
                            Delete
                        </button>
                    </form>
                    <button type="button" command="close" commandfor="delete-dialog"
                        class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-xs ring-1 ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">
                        Cancel
                    </button>
                </div>
            </el-dialog-panel>
        </div>
    </dialog>
</el-dialog>

<script>
    new TomSelect('#faculty_id', {
        create: false,
        sortField: {
            field: 'text',
            direction: 'asc'
        }
    });

    document.addEventListener('DOMContentLoaded', async () => {
        const programSelect = document.getElementById('program_id');
        const sectionsSelect = document.getElementById('section_id');
        const selectedSectionId = "<?= htmlspecialchars($subject['section_id'] ?? '') ?>";
        const selectedSectionName = "<?= htmlspecialchars($subject['section_name'] ?? 'Unknown Section') ?>";
        const programId = programSelect.value;

        async function loadSections(programId, preselectId = null, preselectName = null) {
            sectionsSelect.innerHTML = '<option value="" disabled>Loading...</option>';

            try {
                const response = await fetch('<?= base_url('/admin/program/sections/json') ?>?program_id=' + programId);
                const sections = await response.json();

                let found = false;

                if (sections.length > 0) {
                    sectionsSelect.innerHTML = '<option value="" disabled>Select Section</option>';

                    sections.forEach(section => {
                        const option = document.createElement('option');
                        option.value = section.section_id;
                        option.textContent = section.section_name;
                        if (preselectId && section.section_id == preselectId) {
                            option.selected = true;
                            found = true;
                        }
                        sectionsSelect.appendChild(option);
                    });

                    if (preselectId && !found) {
                        const manualOption = document.createElement('option');
                        manualOption.value = preselectId;
                        manualOption.textContent = preselectName || "Unknown Section";
                        manualOption.selected = true;
                        sectionsSelect.appendChild(manualOption);
                    }
                } else {
                    sectionsSelect.innerHTML = '<option value="" selected disabled>No sections available</option>';
                }
            } catch (error) {
                console.error('Error loading sections:', error);
                sectionsSelect.innerHTML = '<option value="" selected disabled>Error loading sections</option>';
            }
        }

        if (programId) {
            await loadSections(programId, selectedSectionId, selectedSectionName);
        }

        programSelect.addEventListener('change', () => {
            loadSections(programSelect.value);
        });
    });
</script>





<?php require("views/partials/foot.php"); ?>