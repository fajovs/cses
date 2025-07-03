<?php
require("views/partials/head.php");
require("views/partials/nav.php");
require("views/partials/banner.php");
require("views/partials/notification.php");



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
              <?php foreach ($users as $user) : ?>
                <?php switch ($user['role']) {
                  case 'admin':
                    $badge = 'bg-purple-100 text-purple-800';
                    $bg = 'bg-purple-100';
                    $bgtext = 'text-purple-600';
                    break;
                  case 'faculty':
                    $badge = 'bg-emerald-100 text-emerald-800';
                    $bg = 'bg-emerald-100';
                    $bgtext = 'text-emerald-600';
                    break;
                  case 'student':
                    $badge = 'bg-blue-100 text-blue-800';
                    $bg = 'bg-blue-100';
                    $bgtext = 'text-blue-600';
                    break;
                  case 'parent':
                    $badge = 'bg-amber-100 text-amber-800';
                    $bg = 'bg-amber-100';
                    $bgtext = 'text-amber-600';
                    break;
                } ?>
                <tr class="hover:bg-gray-50 transition-colors">

                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                      <div
                        class="h-10 w-10 rounded-full flex items-center justify-center <?= $bg ?>">
                        <span class="<?= $bgtext ?> font-medium text-sm">
                          <?= strtoupper($user['first_name'][0]) . strtoupper($user['last_name'][0]) ?>
                        </span>
                      </div>
                      <div class="ml-4">
                        <div class="text-sm font-medium text-gray-900">
                          <?= htmlspecialchars($user['first_name']) ?>
                          <?= $user['middle_name'] ? ' ' . htmlspecialchars($user['middle_name']) : '' ?>
                          <?= htmlspecialchars($user['last_name']) ?>
                          <?= $user['suffix'] ? ', ' . htmlspecialchars($user['suffix']) : '' ?> </div>
                        <div class="text-sm text-gray-500">
                          <?= htmlspecialchars($user['email']) ?>
                        </div>
                      </div>
                    </div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <span
                      class="inline-flex px-2 py-1 text-xs font-medium <?= $badge ?> rounded-full"><?= htmlspecialchars(ucfirst($user['role'])) ?></span>
                  </td>
                  <td
                    class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    <?= htmlspecialchars($user['created_at']) ?>
                  </td>
                  <?php if ($user['role'] != 'admin'): ?>
                    <td
                      class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                      <button
                        data-id="<?= htmlspecialchars($user['user_id']) ?>"
                        data-first="<?= htmlspecialchars($user['first_name']) ?>"
                        data-middle="<?= htmlspecialchars($user['middle_name']) ?>"
                        data-last="<?= htmlspecialchars($user['last_name']) ?>"
                        data-suffix="<?= htmlspecialchars($user['suffix']) ?>"
                        data-email="<?= htmlspecialchars($user['email']) ?>"
                        data-programid="<?= htmlspecialchars($user['program_id']) ?>"
                        data-role="<?= htmlspecialchars($user['role']) ?>"
                   
                        class="openDrawerEdit text-teal-600 hover:text-teal-900 mr-3">
                        Edit
                      </button>
               

                    </td>
                  <?php endif; ?>
                </tr>
              <?php endforeach; ?>

            </tbody>
          </table>
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

              <form method="POST" action=<?= base_url('/admin/user/create') ?>>
                <div class="space-y-12">

                  <div class="border-b border-gray-900/10 pb-12">
                    <h2 class="text-base/7 font-semibold text-gray-900">Personal Information</h2>
                    <p class="mt-1 text-sm/6 text-gray-600">Please provide the User details. This information will be visible to system users.</p>

                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-10">
                      <div class="sm:col-span-3">
                        <label for="first-name" class="block text-sm/6 font-medium text-gray-900">First name</label>
                        <div class="mt-2">
                          <input type="text" name="first-name" id="first-name" autocomplete="given-name" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 " required />
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
                          <input type="text" name="last-name" id="last-name" autocomplete="family-name" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 " required />
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
                          <input id="email" name="email" type="email" autocomplete="email" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 " required />
                          <p id="email-error" class="mt-2 text-sm px-2 text-red-600 hidden">

                          </p>
                        </div>
                      </div>

                      <div class="sm:col-span-3">
                        <label for="password" class="block text-sm/6 font-medium text-gray-900">Password</label>
                        <div class="mt-2">
                          <input id="password" name="password" type="password" autocomplete="password" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" required />
                        </div>
                      </div>

                      <div class="sm:col-span-3">
                        <label for="confirm_password" class="block text-sm/6 font-medium text-gray-900">Confirm Password</label>
                        <div class="mt-2">
                          <input id="confirm_password" name="confirm_password" type="password" autocomplete="confirm_password" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" required />
                          <p id="pass-error" class="mt-2 text-sm px-2 text-red-600 hidden"></p>
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



                      <div class="sm:col-span-4 hidden" id="program-container">
                        <label for="program" class="block text-sm/6 font-medium text-gray-900">Program</label>
                        <div class="mt-2 grid grid-cols-1">
                          <select id="program" name="program"
                            class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                            <?= empty($programs) ? 'disabled' : 'required' ?>>

                            <?php if (empty($programs)) : ?>
                              <option selected disabled>No Program Available</option>
                            <?php else : ?>
                              <option value="" selected disabled>Select a Program</option>
                              <?php foreach ($programs as $program) : ?>
                                <option value="<?= htmlspecialchars($program['program_id']) ?>"><?= htmlspecialchars($program['program_name']) ?></option>
                              <?php endforeach; ?>
                            <?php endif; ?>
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
                  <button id="save" type="submit" disabled="true" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
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
        <div id="drawerPanelEdit" class="w-screen max-w-5xl bg-white shadow-xl transform transition-transform duration-500 translate-x-full">

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
            <h2 class="text-base font-semibold text-gray-900" id="drawer-title">Update User</h2>
            <p class="mt-1 text-sm/6 text-gray-600">Please provide the user details needed to be updated. This information will be visible to system users.</p>
            <div class="mt-6 flex-1">
              <form method="POST" action=<?= base_url('/admin/user/update') ?>>
                <input type="hidden" name="_method" value="PATCH">
                <div class="space-y-12">

                  <div class="border-b border-gray-900/10 pb-12">
                    <h2 class="text-base/7 font-semibold text-gray-900">Personal Information</h2>
                    <p class="mt-1 text-sm/6 text-gray-600">Please provide the User details. This information will be visible to system users.</p>

                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-10">
                      <div class="sm:col-span-3">
                        <label for="first-name-edit" class="block text-sm/6 font-medium text-gray-900">First name</label>
                        <div class="mt-2">
                          <input class="hidden" name="user_id">
                          <input type="text" name="first-name-edit" id="first-name-edit" autocomplete="given-name" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 " required />
                        </div>
                      </div>

                      <div class="sm:col-span-3">
                        <label for="middle-name-edit" class="block text-sm/6 font-medium text-gray-900">Middle name</label>
                        <div class="mt-2">
                          <input type="text" name="middle-name-edit" id="middle-name-edit" autocomplete="middle-name" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                        </div>
                      </div>

                      <div class="sm:col-span-3">
                        <label for="last-name-edit" class="block text-sm/6 font-medium text-gray-900">Last name</label>
                        <div class="mt-2">
                          <input type="text" name="last-name-edit" id="last-name-edit" autocomplete="family-name" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 " required />
                        </div>
                      </div>

                      <div class="sm:col-span-1">
                        <label for="suffix-edit" class="block text-sm/6 font-medium text-gray-900">Suffix</label>
                        <div class="mt-2">
                          <input type="text" name="suffix-edit" id="suffix-edit" autocomplete="suffix" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                        </div>
                      </div>

                      <div class="sm:col-span-4">
                        <label for="email-edit" class="block text-sm/6 font-medium text-gray-900">Email address</label>
                        <div class="mt-2">
                          <input id="email-edit" name="email-edit" type="email" autocomplete="email" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 " />
                          <p id="email-error-edit" class="mt-2 text-sm px-2 text-red-600 hidden">

                          </p>
                        </div>
                      </div>

                      <div class="sm:col-span-3">
                        <label for="password-edit" class="block text-sm/6 font-medium text-gray-900">Password</label>
                        <div class="mt-2">
                          <input id="password-edit" name="password-edit" type="password" autocomplete="password" class="block w-full rounded-md bg-gray-200 px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" disabled />
                        </div>
                      </div>

                      <div class="sm:col-span-3">
                        <label for="confirm_password-edit" class="block text-sm/6 font-medium text-gray-900">Confirm Password</label>
                        <div class="mt-2">
                          <input id="confirm_password-edit" name="confirm_password-edit" type="password" autocomplete="confirm_password" class="block w-full rounded-md bg-gray-200 px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" disabled />
                          <p id="pass-error-edit" class="mt-2 text-sm px-2 text-red-600 hidden"></p>
                        </div>
                      </div>

                      <div class="sm:col-span-2">
                        <label for="role-edit" class="block text-sm/6 font-medium text-gray-900">Role</label>
                        <div class="mt-2 grid grid-cols-1">
                          <select id="role-edit" name="role-edit" autocomplete="role" class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
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



                      <div class="sm:col-span-4 hidden" id="program-container-edit">
                        <label for="program-edit" class="block text-sm/6 font-medium text-gray-900">Program</label>
                        <div class="mt-2 grid grid-cols-1">
                          <select id="program-edit" name="program-edit"
                            class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                            <?= empty($programs) ? 'disabled' : 'required' ?>>

                            <?php if (empty($programs)) : ?>
                              <option selected disabled>No Program Available</option>
                            <?php else : ?>
                              <option value="" selected disabled>Select a Program</option>
                              <?php foreach ($programs as $program) : ?>
                                <option value="<?= htmlspecialchars($program['program_id']) ?>"><?= htmlspecialchars($program['program_name']) ?></option>
                              <?php endforeach; ?>
                            <?php endif; ?>
                          </select>
                          <svg class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" data-slot="icon">
                            <path fill-rule="evenodd" d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                          </svg>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>


                <div class="mt-6 flex items-center justify-between gap-x-6">
                  <button id="openDialog" type="button" class="text-sm/6  font-semibold text-red-600">DELETE</button>
                  <button id="change" type="button" class="text-center rounded-md bg-emerald-600  w-50 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-emerald-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600">Change Password</button>

                  <button id="editBtn" type="submit" class="rounded-md bg-indigo-600  w-50 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
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
    <form method="POST" action="<?= base_url('/admin/user/delete') ?>">
      <input type="hidden" name="user_id" id="user_id">
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
        const first = btn.dataset.first;
        const middle = btn.dataset.middle;
        const last = btn.dataset.last;
        const suffix = btn.dataset.suffix;
        const programId = btn.dataset.programid;
        const role = btn.dataset.role;
        const email = btn.dataset.email;

        console.log(programId);

        document.querySelector('#drawerPanelEdit input[name="user_id"]').value = id;
        document.querySelector('#drawerPanelEdit input[name="first-name-edit"]').value = first;
        document.querySelector('#drawerPanelEdit input[name="middle-name-edit"]').value = middle;
        document.querySelector('#drawerPanelEdit input[name="last-name-edit"]').value = last;
        document.querySelector('#drawerPanelEdit input[name="suffix-edit"]').value = suffix;
        document.querySelector('#drawerPanelEdit input[name="email-edit"]').value = email;
        document.querySelector('#drawerPanelEdit select[name="program-edit"]').value = programId;
        document.querySelector('#drawerPanelEdit select[name="role-edit"]').value = role;
        handleRoleChange();

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
    const user_id = document.getElementById('user_id')

    openDialog.addEventListener('click', () => {

      const id = openDialog.getAttribute('data-id');
      user_id.value = id;

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

    const programContainer = document.getElementById('program-container');
    const program = document.getElementById('program');
    const role = document.getElementById('role');

    role.addEventListener('change', function() {
      const roleValue = this.value;

      if (roleValue === 'faculty' || roleValue === 'student') {
        programContainer.classList.remove('hidden');
        program.setAttribute('required', 'true');
      } else {
        programContainer.classList.add('hidden');
        program.setAttribute('required', 'false');
      }

    })

    const programContainerEdit = document.getElementById('program-container-edit');
    const programEdit = document.getElementById('program-edit');
    const roleEdit = document.getElementById('role-edit');

    function handleRoleChange() {
      const roleValue = roleEdit.value;

      if (roleValue === 'faculty' || roleValue === 'student') {
        programContainerEdit.classList.remove('hidden');
        programEdit.setAttribute('required', 'true');
      } else {
        programContainerEdit.classList.add('hidden');
        programEdit.removeAttribute('required'); 
      }
    }

    roleEdit.addEventListener('change', handleRoleChange);

    





    // Email Validation
    const existingEmails = <?= json_encode(array_map('strtolower', $emails), JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>;

    const emailInput = document.getElementById('email');
    const saveBtn = document.getElementById('save');
    const emailError = document.getElementById('email-error');

    const emailInputEdit = document.getElementById('email-edit');
    const editBtn = document.getElementById('editBtn');
    const emailErrorEdit = document.getElementById('email-error-edit');

    // Email format regex
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    function validateEmail(input, errorBox, button) {
      const email = input.value.trim().toLowerCase();

      // Format check
      if (!emailPattern.test(email)) {
        errorBox.innerHTML = 'Please enter a valid email address';
        errorBox.classList.remove('hidden');
        button.setAttribute('disabled', 'true');
        button.classList.remove('bg-indigo-600', 'hover:bg-indigo-500');
        button.classList.add('bg-gray-600');
        return;
      }

      // Duplicate check
      if (existingEmails.includes(email)) {
        errorBox.innerHTML = 'Email has already been taken';
        errorBox.classList.remove('hidden');
        button.setAttribute('disabled', 'true');
        button.classList.remove('bg-indigo-600', 'hover:bg-indigo-500');
        button.classList.add('bg-gray-600');
      } else {
        errorBox.classList.add('hidden');
        button.removeAttribute('disabled');
        button.classList.add('bg-indigo-600', 'hover:bg-indigo-500');
        button.classList.remove('bg-gray-600');
      }
    }


    emailInput.addEventListener('input', () => validateEmail(emailInput, emailError, saveBtn));

    emailInputEdit.addEventListener('input', () => validateEmail(emailInputEdit, emailErrorEdit, editBtn));




    //Confirm Password


    const password = document.getElementById('password');
    const confirmPass = document.getElementById('confirm_password');
    const passError = document.getElementById('pass-error');

    const passwordEdit = document.getElementById('password-edit');
    const confirmPassEdit = document.getElementById('confirm_password-edit');
    const passErrorEdit = document.getElementById('pass-error-edit');


    function validatePasswordMatch(pass, conf, errorBox) {
      if (pass.value !== conf.value) {
        errorBox.textContent = 'Password does not match';
        errorBox.classList.remove('hidden');
        saveBtn.setAttribute('disabled', 'true');
        saveBtn.classList.remove('bg-indigo-600', 'hover:bg-indigo-500');
        saveBtn.classList.add('bg-gray-600');
        editBtn.setAttribute('disabled', 'true');
        editBtn.classList.remove('bg-indigo-600', 'hover:bg-indigo-500');
        editBtn.classList.add('bg-gray-600');
      } else {
        errorBox.classList.add('hidden');
        saveBtn.removeAttribute('disabled');
        saveBtn.classList.add('bg-indigo-600', 'hover:bg-indigo-500');
        saveBtn.classList.remove('bg-gray-600');
        editBtn.removeAttribute('disabled');
        editBtn.classList.add('bg-indigo-600', 'hover:bg-indigo-500');
        editBtn.classList.remove('bg-gray-600');
      }
    }

    // For new password fields
    password.addEventListener('input', () => validatePasswordMatch(password, confirmPass, passError));
    confirmPass.addEventListener('input', () => validatePasswordMatch(password, confirmPass, passError));

    // For edit password fields
    passwordEdit.addEventListener('input', () => validatePasswordMatch(passwordEdit, confirmPassEdit, passErrorEdit));
    confirmPassEdit.addEventListener('input', () => validatePasswordMatch(passwordEdit, confirmPassEdit, passErrorEdit));

    const changeBtn = document.getElementById('change');

    var isChange = false;

    changeBtn.addEventListener('click', () => {
  isChange = !isChange; // Toggle the flag

  if (isChange) {
    passwordEdit.setAttribute('required', 'true');
    passwordEdit.removeAttribute('disabled');
    passwordEdit.classList.remove('bg-gray-200');
    passwordEdit.classList.add('bg-white');

    confirmPassEdit.setAttribute('required', 'true');
    confirmPassEdit.removeAttribute('disabled');
    confirmPassEdit.classList.remove('bg-gray-200');
    confirmPassEdit.classList.add('bg-white');

    changeBtn.classList.remove('bg-emerald-600', 'hover:bg-emerald-500', 'focus-visible:outline-emerald-600');
    changeBtn.classList.add('bg-red-600', 'hover:bg-red-500', 'focus-visible:outline-red-600');
    changeBtn.innerHTML = 'Cancel Change Password';
  } else {
    // Disable and reset fields
    passwordEdit.setAttribute('disabled', 'true');
    passwordEdit.removeAttribute('required');
    passwordEdit.classList.remove('bg-white');
    passwordEdit.classList.add('bg-gray-200');
    passwordEdit.value = '';

    confirmPassEdit.setAttribute('disabled', 'true');
    confirmPassEdit.removeAttribute('required');
    confirmPassEdit.classList.remove('bg-white');
    confirmPassEdit.classList.add('bg-gray-200');
    confirmPassEdit.value = '';

    // Reset button style and text
    changeBtn.classList.add('bg-emerald-600', 'hover:bg-emerald-500', 'focus-visible:outline-emerald-600');
    changeBtn.classList.remove('bg-red-600', 'hover:bg-red-500', 'focus-visible:outline-red-600');
    changeBtn.innerHTML = 'Change Password';
  }
});




  })
</script>



<?php require("views/partials/foot.php"); ?>