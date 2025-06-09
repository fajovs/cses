<?php
require("views/partials/head.php");
require("views/partials/nav.php");
require("views/partials/banner.php");
?>
<main>
  <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">



      <!-- Table Section -->
      <div
        class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <!-- Table Header -->
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
          <div class="flex items-center justify-between">
            <h2 class="text-lg font-semibold text-gray-900">
              User Accounts
            </h2>
            <span class="text-sm text-gray-500">24 users</span>
          </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
          <table class="w-full">
            <thead class="bg-gray-50 border-b border-gray-200">
              <tr>
                <th
                  class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  <input
                    type="checkbox"
                    class="rounded border-gray-300 text-emerald-600 focus:ring-emerald-500" />
                </th>
                <th
                  class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  User
                </th>
                <th
                  class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Role
                </th>
                <th
                  class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Account Creation Date
                </th>
                <th
                  class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Actions
                </th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <!-- Row 1 -->
              <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4 whitespace-nowrap">
                  <input
                    type="checkbox"
                    class="rounded border-gray-300 text-emerald-600 focus:ring-emerald-500" />
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <div
                      class="h-10 w-10 rounded-full bg-emerald-100 flex items-center justify-center">
                      <span class="text-emerald-600 font-medium text-sm">JD</span>
                    </div>
                    <div class="ml-4">
                      <div class="text-sm font-medium text-gray-900">
                        Juan Dela Cruz
                      </div>
                      <div class="text-sm text-gray-500">
                        juan.delacruz@example.com
                      </div>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span
                    class="inline-flex px-2 py-1 text-xs font-medium bg-purple-100 text-purple-800 rounded-full">Admin</span>
                </td>
                <td
                  class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                  Jan 15, 2023
                </td>
                <td
                  class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                  <button
                    class="text-teal-600 hover:text-teal-900 mr-3">
                    Edit
                  </button>
                  <button class="text-red-600 hover:text-red-900">
                    Delete
                  </button>
                </td>
              </tr>

              <!-- Row 2 -->
              <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4 whitespace-nowrap">
                  <input
                    type="checkbox"
                    class="rounded border-gray-300 text-emerald-600 focus:ring-emerald-500" />
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <div
                      class="h-10 w-10 rounded-full bg-orange-100 flex items-center justify-center">
                      <span class="text-orange-600 font-medium text-sm">MR</span>
                    </div>
                    <div class="ml-4">
                      <div class="text-sm font-medium text-gray-900">
                        Maria Reyes
                      </div>
                      <div class="text-sm text-gray-500">
                        maria.reyes@example.com
                      </div>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span
                    class="inline-flex px-2 py-1 text-xs font-medium bg-emerald-100 text-emerald-800 rounded-full">Faculty</span>
                </td>
                <td
                  class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                  Mar 22, 2023
                </td>
                <td
                  class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                  <button
                    class="text-teal-600 hover:text-teal-900 mr-3">
                    Edit
                  </button>
                  <button class="text-red-600 hover:text-red-900">
                    Delete
                  </button>
                </td>
              </tr>

              <!-- Row 3 -->
              <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4 whitespace-nowrap">
                  <input
                    type="checkbox"
                    class="rounded border-gray-300 text-emerald-600 focus:ring-emerald-500" />
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <div
                      class="h-10 w-10 rounded-full bg-pink-100 flex items-center justify-center">
                      <span class="text-pink-600 font-medium text-sm">AS</span>
                    </div>
                    <div class="ml-4">
                      <div class="text-sm font-medium text-gray-900">
                        Antonio Santos
                      </div>
                      <div class="text-sm text-gray-500">
                        antonio.santos@example.com
                      </div>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span
                    class="inline-flex px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">Student</span>
                </td>
                <td
                  class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                  May 10, 2023
                </td>
                <td
                  class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                  <button
                    class="text-teal-600 hover:text-teal-900 mr-3">
                    Edit
                  </button>
                  <button class="text-red-600 hover:text-red-900">
                    Delete
                  </button>
                </td>
              </tr>

              <!-- Row 4 -->
              <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4 whitespace-nowrap">
                  <input
                    type="checkbox"
                    class="rounded border-gray-300 text-emerald-600 focus:ring-emerald-500" />
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <div
                      class="h-10 w-10 rounded-full bg-teal-100 flex items-center justify-center">
                      <span class="text-teal-600 font-medium text-sm">LL</span>
                    </div>
                    <div class="ml-4">
                      <div class="text-sm font-medium text-gray-900">
                        Luisa Lim
                      </div>
                      <div class="text-sm text-gray-500">
                        luisa.lim@example.com
                      </div>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span
                    class="inline-flex px-2 py-1 text-xs font-medium bg-amber-100 text-amber-800 rounded-full">Parent</span>
                </td>
                <td
                  class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                  Jun 5, 2023
                </td>
                <td
                  class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                  <button
                    class="text-teal-600 hover:text-teal-900 mr-3">
                    Edit
                  </button>
                  <button class="text-red-600 hover:text-red-900">
                    Delete
                  </button>
                </td>
              </tr>

              <!-- Row 5 -->
              <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4 whitespace-nowrap">
                  <input
                    type="checkbox"
                    class="rounded border-gray-300 text-emerald-600 focus:ring-emerald-500" />
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <div
                      class="h-10 w-10 rounded-full bg-violet-100 flex items-center justify-center">
                      <span class="text-violet-600 font-medium text-sm">RA</span>
                    </div>
                    <div class="ml-4">
                      <div class="text-sm font-medium text-gray-900">
                        Roberto Aquino
                      </div>
                      <div class="text-sm text-gray-500">
                        roberto.aquino@example.com
                      </div>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span
                    class="inline-flex px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">Student</span>
                </td>
                <td
                  class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                  Aug 17, 2023
                </td>
                <td
                  class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                  <button
                    class="text-teal-600 hover:text-teal-900 mr-3">
                    Edit
                  </button>
                  <button class="text-red-600 hover:text-red-900">
                    Delete
                  </button>
                </td>
              </tr>

              <!-- Row 6 -->
              <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4 whitespace-nowrap">
                  <input
                    type="checkbox"
                    class="rounded border-gray-300 text-emerald-600 focus:ring-emerald-500" />
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <div
                      class="h-10 w-10 rounded-full bg-rose-100 flex items-center justify-center">
                      <span class="text-rose-600 font-medium text-sm">CM</span>
                    </div>
                    <div class="ml-4">
                      <div class="text-sm font-medium text-gray-900">
                        Carmela Mendoza
                      </div>
                      <div class="text-sm text-gray-500">
                        carmela.mendoza@example.com
                      </div>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span
                    class="inline-flex px-2 py-1 text-xs font-medium bg-emerald-100 text-emerald-800 rounded-full">Faculty</span>
                </td>
                <td
                  class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                  Oct 3, 2023
                </td>
                <td
                  class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                  <button
                    class="text-teal-600 hover:text-teal-900 mr-3">
                    Edit
                  </button>
                  <button class="text-red-600 hover:text-red-900">
                    Delete
                  </button>
                </td>
              </tr>

              <!-- Row 7 -->
              <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4 whitespace-nowrap">
                  <input
                    type="checkbox"
                    class="rounded border-gray-300 text-emerald-600 focus:ring-emerald-500" />
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <div
                      class="h-10 w-10 rounded-full bg-amber-100 flex items-center justify-center">
                      <span class="text-amber-600 font-medium text-sm">PG</span>
                    </div>
                    <div class="ml-4">
                      <div class="text-sm font-medium text-gray-900">
                        Paolo Garcia
                      </div>
                      <div class="text-sm text-gray-500">
                        paolo.garcia@example.com
                      </div>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span
                    class="inline-flex px-2 py-1 text-xs font-medium bg-amber-100 text-amber-800 rounded-full">Parent</span>
                </td>
                <td
                  class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                  Nov 12, 2023
                </td>
                <td
                  class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                  <button
                    class="text-teal-600 hover:text-teal-900 mr-3">
                    Edit
                  </button>
                  <button class="text-red-600 hover:text-red-900">
                    Delete
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- Table Footer -->
        <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
          <div class="flex items-center justify-between">
            <div class="text-sm text-gray-500">
              Showing 1 to 7 of 24 results
            </div>
            <div class="flex items-center space-x-2">
              <button
                class="px-3 py-1 text-sm border border-gray-300 rounded-md hover:bg-gray-100 transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
                disabled>
                Previous
              </button>
              <button
                class="px-3 py-1 text-sm bg-teal-600 text-white rounded-md hover:bg-emerald-700 transition-colors">
                1
              </button>
              <button
                class="px-3 py-1 text-sm border border-gray-300 rounded-md hover:bg-gray-100 transition-colors">
                2
              </button>
              <button
                class="px-3 py-1 text-sm border border-gray-300 rounded-md hover:bg-gray-100 transition-colors">
                3
              </button>
              <button
                class="px-3 py-1 text-sm border border-gray-300 rounded-md hover:bg-gray-100 transition-colors">
                Next
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<?php require("views/partials/foot.php"); ?>