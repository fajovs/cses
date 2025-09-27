<?php
require("views/partials/head.php");
require("views/partials/nav.php");
require("views/partials/notification.php");

?>


<header class="bg-white shadow-sm px-30 flex-none">
    <div class="mx-auto max-w-7xl py-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

        <div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Parents </h1>
            <p class="mt-1 text-sm/6 text-gray-600">View and manage parent accounts linked to their children’s student profiles</p>

        </div>

        <a href=<?= base_url("/admin/users/parent") ?>
            class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors duration-150">
            <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Add Parent
        </a>



    </div>
</header>

<main class="flex-1 overflow-y-auto px-30 py-6">
    <!-- Search Section -->
    <div class="mb-8 w-full">
        <input
            type="text"
            placeholder="Search parent..."
            class="searchInput w-full px-4 py-3 text-sm bg-white border-0 rounded-lg shadow-sm ring-1 ring-gray-200 focus:ring-2 focus:ring-green-500 focus:outline-none transition-all">
    </div>

    <!-- Table Container with fixed height and scroll -->
    <div class="bg-white rounded-xl shadow-sm ring-1 ring-gray-200 overflow-hidden">
        <div class="max-h-[600px] overflow-y-auto p-5">

            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-100">
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Name
                        </th>
                        <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Role
                        </th>
                        <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Email
                        </th>
                        <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">

                    <?php foreach ($parents as $parent): ?>
                        <tr class="searchRow hover:bg-gray-25 transition-colors duration-150" data-search-value=<?= htmlspecialchars($parent['full_name']) ?>>
                            <td class="px-6 py-5">
                                <div class="text-sm font-medium text-gray-900"><?= htmlspecialchars($parent['full_name']) ?></div>
                            </td>

                            <td class="px-6 py-5 text-center">
                                <span class="inline-flex px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Parent</span>
                            </td>
                            <td class="px-6 py-5 text-center">
                                <span class="text-sm font-medium text-gray-900"><?= htmlspecialchars($parent['email']) ?></span>
                            </td>

                            <td class="px-6 py-5 text-center">
                                <?php
                                $linked = $linked_students[$parent['parent_id']] ?? [];
                                ?>
                                <button
                                    data-parent-id="<?= htmlspecialchars($parent['parent_id']) ?>"
                                    data-linked-students='<?= json_encode($linked) ?>'
                                    command="show-modal"
                                    commandfor="drawer"
                                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-amber-600 rounded-lg hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 transition-colors duration-150">
                                    Link
                                </button>

                                <a href=<?= base_url("/admin/users/parent/" . htmlspecialchars($parent['user_id']) . "/edit") ?>
                                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors duration-150">
                                    Manage
                                </a>



                            </td>
                        </tr>
                    <?php endforeach; ?>


                </tbody>
            </table>
        </div>
    </div>
</main>

<el-dialog>
    <dialog id="drawer" aria-labelledby="drawer-title" class="fixed inset-0 size-auto max-h-none max-w-none overflow-hidden bg-transparent not-open:hidden backdrop:bg-transparent">
        <el-dialog-backdrop class="absolute inset-0 bg-gray-500/75 transition-opacity duration-500 ease-in-out data-closed:opacity-0"></el-dialog-backdrop>
        <div tabindex="0" class="absolute inset-0 pl-10 focus:outline-none sm:pl-16">
            <el-dialog-panel class="group/dialog-panel relative ml-auto block size-full max-w-md transform transition duration-500 ease-in-out data-closed:translate-x-full sm:duration-700">
                <div class="flex h-full flex-col overflow-y-auto bg-white py-6 shadow-xl">
                    <div class="px-4 sm:px-6">
                        <h2 id="drawer-title" class="text-base font-semibold text-gray-900">Link Student</h2>
                    </div>
                    <div class="relative mt-6 flex-1 px-4 sm:px-6">
                        <form method="POST" action=<?= base_url("/admin/users/parent/link") ?>>
                            <div class="space-y-12">
                                <div class="border-b border-gray-900/10 pb-12">
                                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                        <div class="col-span-full">
                                            <input type="hidden" name="parent_id" id="parent_id" value="">
                                            <label for="student_id" class="block text-sm font-medium text-gray-900 mb-2">Student</label>
                                            <select required multiple id="student_id" name="student_id[]" class="tom-select w-full rounded-md border border-gray-300 bg-white py-2 px-3 text-gray-900 sm:text-sm">
                                                <?php foreach ($students as $student): ?>
                                                    <option value="<?= htmlspecialchars($student['student_id']) ?>">
                                                        <?= htmlspecialchars($student['full_name']) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-6 flex items-center justify-end gap-x-6">
                                <button command="close" commandfor="drawer" type="button" class="text-sm/6 font-semibold text-gray-900">Cancel</button>
                                <button type="submit" class="rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-green-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">Link</button>
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
        // ✅ Store the instance so it can be reused
        const studentSelectInstance = new TomSelect('#student_id', {
            plugins: ['remove_button'],
            placeholder: "Select one or more students",
            maxItems: null,
            persist: false,
            create: false,
        });

        // ✅ Search filter
        document.querySelectorAll('.searchInput').forEach(input => {
            input.addEventListener('keyup', () => {
                const filter = input.value.toLowerCase();
                document.querySelectorAll('.searchRow').forEach(row => {
                    const value = row.dataset.searchValue.toLowerCase();
                    row.style.display = value.includes(filter) ? '' : 'none';
                });
            });
        });

        // ✅ Open modal and prefill form
        document.querySelectorAll('[command="show-modal"][commandfor="drawer"]').forEach(button => {
            button.addEventListener('click', () => {
                const parentId = button.getAttribute('data-parent-id');
                const linkedStudents = JSON.parse(button.getAttribute('data-linked-students') || '[]');

                document.getElementById('parent_id').value = parentId;

                // ✅ Clear and set selected values properly
                studentSelectInstance.clear(true);
                if (linkedStudents.length > 0) {
                    studentSelectInstance.setValue(linkedStudents);
                }
            });
        });
    });
</script>






<?php require("views/partials/foot.php"); ?>