<?php
require("views/partials/head.php");
require("views/partials/nav.php");
require("views/partials/notification.php");

?>


<header class="bg-white shadow-sm px-30 flex-none">
    <div class="mx-auto max-w-7xl py-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

        <div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Faculties </h1>
            <p class="mt-1 text-sm/6 text-gray-600">Manage and view details of all faculty members</p>

        </div>

        <a href=<?= base_url("/admin/users/faculty") ?>
            class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors duration-150">
            <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Add Faculty
        </a>



    </div>
</header>

<main class="flex-1 overflow-y-auto px-30 py-6">
    <!-- Search Section -->
    <div class="mb-8 w-full">
        <input
            type="text"
            placeholder="Search faculty..."
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
                            Faculty Number
                        </th>
                        <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Role
                        </th>
                        <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Email
                        </th>
                        <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Program
                        </th>
                        <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">

                    <?php foreach ($faculties as $faculty): ?>
                        <tr class="searchRow hover:bg-gray-25 transition-colors duration-150" data-search-value=<?= htmlspecialchars($faculty['full_name']) ?>>
                            <td class="px-6 py-5">
                                <div class="text-sm font-medium text-gray-900"><?= htmlspecialchars($faculty['full_name']) ?></div>
                            </td>
                            <td class="px-6 py-5 text-center">
                                <span class="text-sm text-gray-600"><?= htmlspecialchars($faculty['faculty_number']) ?></span>
                            </td>
                            <td class="px-6 py-5 text-center">
                                <span class="inline-flex px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">Faculty</span>
                            </td>
                            <td class="px-6 py-5 text-center">
                                <span class="text-sm font-medium text-gray-900"><?= htmlspecialchars($faculty['email']) ?></span>
                            </td>
                            <td class="px-6 py-5 text-center">
                                <span class="text-sm font-medium text-gray-900"><?= htmlspecialchars($faculty['program_name']) ?></span>
                            </td>
                            <td class="px-6 py-5 text-center">

                                <a href=<?= base_url("/admin/users/faculty/" . htmlspecialchars($faculty['user_id']) . "/edit") ?>
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

<!-- Search script (keep this somewhere below, before </body>) -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.searchInput').forEach(input => {
            input.addEventListener('keyup', () => {
                const filter = input.value.toLowerCase();
                document.querySelectorAll('.searchRow').forEach(row => {
                    const value = row.dataset.searchValue.toLowerCase();
                    row.style.display = value.includes(filter) ? '' : 'none';
                });
            });
        });
    });
</script>




<?php require("views/partials/foot.php"); ?>