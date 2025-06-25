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


<!-- Adding Program Start -->

<!-- Drawer Backdrop & Panel -->
<div id="drawerBackdrop" class="fixed inset-0 z-10 hidden">
  <!-- Backdrop -->
  <div class="absolute inset-0 bg-gray-500/75 transition-opacity" aria-hidden="true"></div>

  <!-- Drawer Wrapper -->
  <div class="absolute inset-0 overflow-hidden">
    <div class="absolute inset-0 overflow-hidden">
      <div class="fixed inset-y-0 right-0 flex max-w-full pl-10 sm:pl-16">
        <!-- Sliding Panel -->
        <div id="drawerPanel" class="w-screen max-w-5xl bg-white shadow-xl transform transition-transform duration-500 translate-x-full">

          <!-- Close Button -->
          <div class="absolute top-0 right-0 flex pt-4 pr-4">
            <button id="closeDrawer" type="button" class="rounded-md text-gray-300 hover:text-white focus:outline-none focus:ring-2 focus:ring-white">
              <span class="sr-only">Close panel</span>
              <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
              </svg>
            </button>
          </div>

          <!-- Drawer Content -->
          <div class="flex h-full flex-col overflow-y-auto py-6 px-4 sm:px-6">
            <h2 class="text-base font-semibold text-gray-900" id="drawer-title">Add User</h2>
            <div class="mt-6 flex-1">

              <form method="POST" action=<?= base_url('/admin/program/create') ?>>
                <div class="space-y-12">

                  <div class="border-b border-gray-900/10 pb-12">
                    <h2 class="text-base/7 font-semibold text-gray-900">Personal Information</h2>
                    <p class="mt-1 text-sm/6 text-gray-600">Please provide the User details. This information will be visible to system users.</p>

                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-10">
                      <div class="sm:col-span-3">
                        <label for="first-name" class="block text-sm/6 font-medium text-gray-900">First name</label>
                        <div class="mt-2">
                          <input type="text" name="first-name" id="first-name" autocomplete="given-name" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                        </div>
                      </div>

                      <div class="sm:col-span-3">
                        <label for="middle-name" class="block text-sm/6 font-medium text-gray-900">Middle name</label>
                        <div class="mt-2">
                          <input type="text" name="middle-name" id="middle-name" autocomplete="middle-name" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                        </div>
                      </div>

                      <div class="sm:col-span-3">
                        <label for="last-name" class="block text-sm/6 font-medium text-gray-900">Last name</label>
                        <div class="mt-2">
                          <input type="text" name="last-name" id="last-name" autocomplete="family-name" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                        </div>
                      </div>

                      <div class="sm:col-span-1">
                        <label for="suffix" class="block text-sm/6 font-medium text-gray-900">Suffix</label>
                        <div class="mt-2">
                          <input type="text" name="suffix" id="suffix" autocomplete="suffix" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                        </div>
                      </div>

                      <div class="sm:col-span-4">
                        <label for="email" class="block text-sm/6 font-medium text-gray-900">Email address</label>
                        <div class="mt-2">
                          <input id="email" name="email" type="email" autocomplete="email" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                        </div>
                      </div>

                      <div class="sm:col-span-3">
                        <label for="password" class="block text-sm/6 font-medium text-gray-900">Password</label>
                        <div class="mt-2">
                          <input id="password" name="password" type="password" autocomplete="password" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                        </div>
                      </div>

                      <div class="sm:col-span-3">
                        <label for="confirm_password" class="block text-sm/6 font-medium text-gray-900">Confirm Password</label>
                        <div class="mt-2">
                          <input id="confirm_password" name="confirm_password" type="confirm_password" autocomplete="confirm_password" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                        </div>
                      </div>

                      <div class="sm:col-span-2">
                        <label for="role" class="block text-sm/6 font-medium text-gray-900">Role</label>
                        <div class="mt-2 grid grid-cols-1">
                          <select id="role" name="role" autocomplete="role" class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                            <option selected disabled>Select a Role </option>
                            <option value="faculty">Faculty</option>
                            <option value="student">Student</option>
                            <option value="parent">Parent</option>
                          </select>
                          <svg class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" data-slot="icon">
                            <path fill-rule="evenodd" d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                          </svg>
                        </div>
                      </div>

                      <div class="sm:col-span-4">
                        <label for="deparment" class="block text-sm/6 font-medium text-gray-900">Department</label>
                        <div class="mt-2 grid grid-cols-1">
                          <select id="deparment" name="deparment" autocomplete="deparment" class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                            <option selected disabled>Select a Department </option>
                   
                          </select>
                          <svg class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" data-slot="icon">
                            <path fill-rule="evenodd" d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                          </svg>
                        </div>
                      </div>

                      <div class="sm:col-span-4">
                        <label for="program" class="block text-sm/6 font-medium text-gray-900">Program</label>
                        <div class="mt-2 grid grid-cols-1">
                          <select id="program" name="program" autocomplete="program" class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                            <option selected disabled>Select a Program </option>
                          
                          </select>
                          <svg class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" data-slot="icon">
                            <path fill-rule="evenodd" d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                          </svg>
                        </div>
                      </div>

                      <div class="sm:col-span-4">
                        <label for="student" class="block text-sm/6 font-medium text-gray-900">Student</label>
                        <div class="mt-2 grid grid-cols-1">
                          <select id="student" name="student" autocomplete="student" class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                            <option selected disabled>Select a Student </option>
                            <option value="faculty">Faculty</option>
                            <option value="student">Student</option>
                            <option value="parent">Parent</option>
                          </select>
                          <svg class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" data-slot="icon">
                            <path fill-rule="evenodd" d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                          </svg>
                        </div>
                      </div>


                      


                    </div>
                  </div>



                  


                </div>



                <div class="mt-6 flex items-center justify-end gap-x-6">
                  <button id="cancel" type="button" class="text-sm/6 font-semibold text-gray-900">Cancel</button>
                  <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
                </div>
              </form>

            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>


<!-- Adding Program End -->






<!-- Edit Program Start -->

<!-- Drawer Backdrop & Panel -->
<div id="drawerBackdropEdit" class="fixed inset-0 z-10 hidden">
  <!-- Backdrop -->
  <div class="absolute inset-0 bg-gray-500/75 transition-opacity" aria-hidden="true"></div>

  <!-- Drawer Wrapper -->
  <div class="absolute inset-0 overflow-hidden">
    <div class="absolute inset-0 overflow-hidden">
      <div class="fixed inset-y-0 right-0 flex max-w-full pl-10 sm:pl-16">
        <!-- Sliding Panel -->
        <div id="drawerPanelEdit" class="w-screen max-w-md bg-white shadow-xl transform transition-transform duration-500 translate-x-full">

          <!-- Close Button -->
          <div class="absolute top-0 right-0 flex pt-4 pr-4">
            <button id="closeDrawerEdit" type="button" class="rounded-md text-gray-300 hover:text-white focus:outline-none focus:ring-2 focus:ring-white">
              <span class="sr-only">Close panel</span>
              <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
              </svg>
            </button>
          </div>

          <!-- Drawer Content -->
          <div class="flex h-full flex-col overflow-y-auto py-6 px-4 sm:px-6">
            <h2 class="text-base font-semibold text-gray-900" id="drawer-title">Update Program</h2>
            <p class="mt-1 text-sm/6 text-gray-600">Please provide the program details needed to be updated. This information will be visible to system users.</p>
            <div class="mt-6 flex-1">
              <form method="POST" action=<?= base_url('/admin/program/update') ?>>
                <input type="hidden" name="_method" value="PATCH">
                <div class="space-y-12">
                  <div class="border-b border-gray-900/10 pb-12">

                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-6">
                      <div class="col-span-full">
                        <label for="program_edit" class="block text-sm/6 font-medium text-gray-900">Program</label>
                        <div class="mt-2">
                          <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                            <div class="shrink-0 text-base text-gray-500 select-none sm:text-sm/6"></div>
                            <input type="hidden" name="program_id">
                            <input type="text" name="program_edit" id="program_edit" class="block w-full min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6" placeholder="e.g., Bachelor of Science in Information Technology" required>
                          </div>
                        </div>
                      </div>

                      <div class="col-span-full">
                        <label for="department_edit" class="block text-sm font-medium text-gray-900 mb-2">Department</label>
                        <select id="department_edit" name="department_edit"
                          class="pr-10 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 text-gray-900 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 sm:text-sm" required>

                          <?php foreach ($departments as $department) : ?>
                            <option value=<?= $department['department_id'] ?>><?= $department['department_name'] ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>



                      <div class="col-span-full">
                        <label for="about" class="block text-sm/6 font-medium text-gray-900">About</label>
                        <div class="mt-2">
                          <textarea name="about" id="about" rows="3" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"></textarea>
                        </div>
                        <p class="mt-3 text-sm/6 text-gray-600">Write a few sentences about the Program.</p>
                      </div>

                    </div>
                  </div>

                </div>

                <div class="mt-6 flex items-center justify-between gap-x-6">
                  <button id="openDialog" type="button" class="text-sm/6  font-semibold text-red-600">DELETE</button>
                  <button type="submit" class="rounded-md bg-indigo-600  w-50 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
                </div>
              </form>


            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>

<!-- Edit Program End -->



<!-- Confirmation Dialog Start -->

<!-- Modal Backdrop & Container -->
<div id="dialogWrapper" class="hidden fixed inset-0 z-10 w-screen overflow-y-auto bg-gray-500/75 backdrop-blur-sm flex items-center justify-center">
  <div id="dialogPanel" class="opacity-0 scale-95 transition-all duration-300 ease-out relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl sm:w-full sm:max-w-lg">
    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
      <div class="sm:flex sm:items-start">
        <div class="mx-auto flex size-12 shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:size-10">
          <svg class="size-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
          </svg>
        </div>
        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
          <h3 class="text-base font-semibold text-gray-900">Delete Item</h3>
          <p class="mt-2 text-sm text-gray-500">Are you sure you want to delete the Item? The item will be permanently removed. This action cannot be undone.</p>
        </div>
      </div>
    </div>
    <form method="POST" action="<?= base_url('/admin/program/delete') ?>">
      <input type="hidden" name="program_id" id="program_id">
      <input type="hidden" name="_method" value="DELETE">
      <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
        <button type="submit"
          class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-red-500 sm:ml-3 sm:w-auto">
          Delete
        </button>
        <button id="cancelDialog" type="button"
          class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-xs ring-1 ring-gray-300 ring-inset hover:bg-gray-50 sm:mt-0 sm:w-auto">
          Cancel
        </button>
      </div>
    </form>
  </div>
</div>

<!-- Confirmation Dialog End -->




<!-- JS to handle open/close -->
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const openBtn = document.getElementById('openDrawer');
    const closeBtn = document.getElementById('closeDrawer');
    const drawerBackdrop = document.getElementById('drawerBackdrop');
    const drawerPanel = document.getElementById('drawerPanel');
    const cancel = document.getElementById('cancel');

    const openBtnEdit = document.getElementsByClassName('openDrawerEdit');
    const closeBtnEdit = document.getElementById('closeDrawerEdit');
    const drawerBackdropEdit = document.getElementById('drawerBackdropEdit');
    const drawerPanelEdit = document.getElementById('drawerPanelEdit');



    function clearInputs() {
      const inputs = drawerPanel.querySelectorAll('input, textarea');
      inputs.forEach(input => {
        input.value = ''
      });

    }

    function closeDrawer() {
      drawerPanel.classList.add('translate-x-full');
      drawerPanel.addEventListener('transitionend', () => {
        drawerBackdrop.classList.add('hidden');
        clearInputs(); // Clear form inputs after closing
      }, {
        once: true
      });

    }

    function closeEditDrawer() {

      drawerPanelEdit.classList.add('translate-x-full');
      drawerPanelEdit.addEventListener('transitionend', () => {
        drawerBackdropEdit.classList.add('hidden');
        clearInputs(); // Clear form inputs after closing
      }, {
        once: true
      });
    }


    openBtn.addEventListener('click', () => {
      drawerBackdrop.classList.remove('hidden');
      setTimeout(() => drawerPanel.classList.remove('translate-x-full'), 10);
    });

    Array.from(openBtnEdit).forEach(btn => {
      btn.addEventListener('click', () => {
        // Populate form fields
        const id = btn.dataset.id;
        const dpid = btn.dataset.dpid;
        const pname = btn.dataset.pname;
        const about = btn.dataset.about;

        document.querySelector('#drawerPanelEdit input[name="program_id"]').value = id;
        document.querySelector('#drawerPanelEdit select[name="department"]').value = dpid;
        document.querySelector('#drawerPanelEdit input[name="program"]').value = pname;
        document.querySelector('#drawerPanelEdit textarea[name="about"]').value = about;

        openDialog.setAttribute('data-id', id);

        // Show drawer
        drawerBackdropEdit.classList.remove('hidden');
        setTimeout(() => drawerPanelEdit.classList.remove('translate-x-full'), 10);
      });
    });

    cancel.addEventListener('click', closeDrawer);
    closeBtn.addEventListener('click', closeDrawer);


    closeBtnEdit.addEventListener('click', closeEditDrawer);



    //Confiramtion dialog script
    const openDialog = document.getElementById('openDialog');
    const cancelBtn = document.getElementById('cancelDialog');
    const wrapper = document.getElementById('dialogWrapper');
    const panel = document.getElementById('dialogPanel');
    const deparment_id = document.getElementById('deparment_id')

    openDialog.addEventListener('click', () => {

      const id = openDialog.getAttribute('data-id');
      program_id.value = id;

      wrapper.classList.remove('hidden');
      setTimeout(() => {
        panel.classList.remove('opacity-0', 'scale-95');
        panel.classList.add('opacity-100', 'scale-100');
      }, 10);
    });

    cancelBtn.addEventListener('click', () => {
      panel.classList.remove('opacity-100', 'scale-100');
      panel.classList.add('opacity-0', 'scale-95');
      setTimeout(() => {
        wrapper.classList.add('hidden');
      }, 300);
    });



    //Role value change
    const addInfo = document.getElementById('add-info');
    const role = document.getElementById('role');

    role.addEventListener('change', () => {
      const roleValue = this.value;

      if (roleValue === 'faculty' || roleValue === 'student') {
        addInfo.classList.remove('hidden');
      }

    })

    role.addEventListener('change', () => {
      const roleValue = role.value;

      if (roleValue === 'faculty' || roleValue === 'student') {
        addInfo.classList.remove('hidden');
      }else if(roleValue === 'parent'){
        addInfo.classList.add('hidden');
      }else{
        addInfo.classList.add('hidden');
      }

    });

  })
</script>



<?php require("views/partials/foot.php"); ?>