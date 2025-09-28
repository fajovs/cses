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
    </div>
</header>


<main class="flex-1 overflow-y-auto px-30 py-6">


    <form method="POST" action=<?= base_url('/admin/users/faculty/update') ?>>
        <div class="space-y-12">
            <input type="hidden" name="_method" value="PATCH" />
            <input type="hidden" name="user_id" value=<?= htmlspecialchars($users['user_id']) ?> />
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base/7 font-semibold text-gray-900">Manage Faculty</h2>



                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-12">


                    <div class="sm:col-span-6">
                        <label for="faculty_number" class="block text-sm/6 font-medium text-gray-900">Faculty Number</label>
                        <div class="mt-2">
                            <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-green-600">
                                <input
                                    value=<?= htmlspecialchars($users['faculty_number']) ?>
                                    required
                                    id="faculty_number"
                                    type="text"
                                    name="faculty_number"
                                    placeholder=""
                                    class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6" />
                            </div>
                        </div>
                    </div>

                    <div class="sm:col-span-6">
                        <label for="program_id" class="block text-sm font-medium text-gray-900 mb-3">Program</label>
                        <select id="program_id" name="program_id" class="w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 outline-gray-300 focus:outline-2 focus:outline-green-600 sm:text-sm/6" <?= empty($programs) ? 'disabled' : 'required' ?>>
                            <?php if (empty($programs)) : ?>
                                <option selected disabled>No Program Available</option>
                            <?php else : ?>
                                <option value="" disabled <?= empty($users['program_id']) ? 'selected' : '' ?>>Select a Program</option>
                                <?php foreach ($programs as $programe) : ?>
                                    <option
                                        value="<?= htmlspecialchars($programe['program_id']) ?>"
                                        <?= ($programe['program_id'] == $users['program_id']) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($programe['program_name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>


                    <div class="sm:col-span-3">
                        <label for="first_name" class="block text-sm/6 font-medium text-gray-900">First Name</label>
                        <div class="mt-2">
                            <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-green-600">
                                <input
                                    value=<?= htmlspecialchars($users['first_name']) ?>
                                    required
                                    id="first_name"
                                    type="text"
                                    name="first_name"
                                    placeholder=""
                                    class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6" />
                            </div>
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="middle_name" class="block text-sm/6 font-medium text-gray-900">Middle Name</label>
                        <div class="mt-2">
                            <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-green-600">
                                <input
                                    value=<?= htmlspecialchars($users['middle_name']) ?>
                                    required
                                    id="middle_name"
                                    type="text"
                                    name="middle_name"
                                    placeholder=""
                                    class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6" />
                            </div>
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="last_name" class="block text-sm/6 font-medium text-gray-900">Last Name</label>
                        <div class="mt-2">
                            <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-green-600">
                                <input
                                    value=<?= htmlspecialchars($users['last_name']) ?>
                                    required
                                    id="last_name"
                                    type="text"
                                    name="last_name"
                                    placeholder=""
                                    class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6" />
                            </div>
                        </div>
                    </div>



                    <div class="sm:col-span-1">
                        <label for="suffix" class="block text-sm/6 font-medium text-gray-900">Suffix</label>
                        <div class="mt-2">
                            <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-green-600">
                                <input
                                    value="<?= htmlspecialchars($users['suffix']) ?>"
                       
                                    id="suffix"
                                    type="text"
                                    name="suffix"
                                    placeholder=""
                                    class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6" />
                            </div>
                        </div>
                    </div>



                    <div class="sm:col-span-4">
                        <label for="email" class="block text-sm/6 font-medium text-gray-900">Email</label>
                        <div class="mt-2">
                            <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-green-600">
                                <input
                                    disabled
                                    value=<?= htmlspecialchars($users['email']) ?>
                                    required
                                    id="email"
                                    type="text"
                                    name="email"
                                    placeholder=""
                                    data-original-email="<?= htmlspecialchars($users['email']) ?>"
                                    class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6" />

                            </div>
                        </div>
                        <p id="emailError" class="mt-1 text-sm text-red-600 hidden">Please enter a valid email address.</p>
                    </div>


                    <div class="sm:col-span-4">
                        <label for="password" class="block text-sm/6 font-medium text-gray-900">Password</label>
                        <div class="mt-2">
                            <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-green-600">
                                <input
                                    disabled
                                    required
                                    id="password"
                                    type="password"
                                    name="password"
                                    placeholder=""
                                    class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6 disabled:bg-slate-100 disabled:text-gray-500 disabled:cursor-not-allowed" />
                            </div>
                        </div>
                    </div>

                    <div class="sm:col-span-4">
                        <label for="confirm_password" class="block text-sm/6 font-medium text-gray-900">Confirm Password</label>
                        <div class="mt-2">
                            <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-green-600">
                                <input
                                    disabled
                                    required
                                    id="confirm_password"
                                    type="password"
                                    name="confirm_password"
                                    placeholder=""
                                    class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6 disabled:bg-slate-100 disabled:text-gray-500 disabled:cursor-not-allowed" />
                            </div>
                        </div>
                        <p id="passwordError" class="mt-1 text-sm text-red-600 hidden">Passwords do not match.</p>
                    </div>



                </div>
            </div>




        </div>

        <div class="mt-6 flex items-center justify-between gap-x-6">
            <div class="mt-6 flex items-center justify-end gap-x-6">
                <button command="show-modal" commandfor="delete-dialog" type="button" class="rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-red-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">DELETE</button>

            </div>
            <div class="mt-6 flex items-center justify-end gap-x-6">
                <button id="changePasswordBtn" type="button" class="rounded-md bg-amber-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-amber-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-600">Change Password</button>

            </div>

            <div class="mt-6 flex items-center justify-end gap-x-6">

                <a href=<?= base_url("/admin/users/faculties") ?> class="text-sm/6 font-semibold text-gray-900">
                    Cancel
                </a>
                <button type="submit" class="rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-green-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">
                    Update
                </button>
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
                            <h3 id="dialog-title" class="text-base font-semibold text-gray-900">Delete User?</h3>
                            <p class="mt-2 text-sm text-gray-500">Are you sure you want to delete <?= htmlspecialchars($users['first_name']) . ' ' . htmlspecialchars($users['last_name']) ?>? This action cannot be undone.</p>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse">

                    <form method="POST" action=<?= base_url('/admin/users/faculty/delete') ?>>
                        <input type="hidden" name="_method" value="DELETE" />
                        <input type="hidden" name="user_id" value=<?= htmlspecialchars($users['user_id']) ?> />

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
    document.addEventListener('DOMContentLoaded', () => {
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        const confirmInput = document.getElementById('confirm_password');
        const submitBtn = document.querySelector('button[type="submit"]');
        const changePasswordBtn = document.getElementById('changePasswordBtn');
        const originalEmail = emailInput.dataset.originalEmail;

        const emailError = document.getElementById('emailError');
        const passwordError = document.getElementById('passwordError');

        let emailValid = true;
        let emailUnique = true;
        let passwordsMatch = true;

        // Toggle password fields enabled/disabled
        changePasswordBtn.addEventListener('click', () => {
            const disabled = passwordInput.disabled;
            passwordInput.disabled = !disabled;
            confirmInput.disabled = !disabled;

            // Clear password fields & error when disabling
            if (!disabled) {
                passwordInput.value = '';
                confirmInput.value = '';
                passwordError.textContent = '';
                passwordError.classList.add('hidden');
                passwordsMatch = true;
            } else {
                passwordsMatch = false; // when enabling, need to validate
            }
            updateSubmitState();
        });

        async function validateEmail() {
            const email = emailInput.value.trim();
            if (email === originalEmail) {
                emailValid = true;
                emailUnique = true;
                emailError.classList.add('hidden');
            } else {
                emailValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
                if (!emailValid) {
                    emailError.textContent = "Invalid email format.";
                    emailError.classList.remove('hidden');
                    emailUnique = false;
                } else {
                    try {
                        const response = await fetch('<?= base_url('/admin/users/check-email') ?>?email=' + encodeURIComponent(email));
                        const data = await response.json();
                        if (data.exists) {
                            emailError.textContent = "This email is already taken.";
                            emailError.classList.remove('hidden');
                            emailUnique = false;
                        } else {
                            emailError.textContent = "";
                            emailError.classList.add('hidden');
                            emailUnique = true;
                        }
                    } catch (error) {
                        emailError.textContent = "Error checking email.";
                        emailError.classList.remove('hidden');
                        emailUnique = false;
                    }
                }
            }
            updateSubmitState();
        }

        function validatePasswords() {
            if (!passwordInput.disabled && passwordInput.value !== confirmInput.value) {
                passwordError.textContent = "Passwords do not match.";
                passwordError.classList.remove('hidden');
                passwordsMatch = false;
            } else {
                passwordError.textContent = "";
                passwordError.classList.add('hidden');
                passwordsMatch = true;
            }
            updateSubmitState();
        }

        function updateSubmitState() {
            let passwordReady = passwordInput.disabled || (passwordInput.value && confirmInput.value && passwordsMatch);
            if (emailValid && emailUnique && passwordReady) {
                submitBtn.disabled = false;
                submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            } else {
                submitBtn.disabled = true;
                submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
            }
        }

        // Bind events
        emailInput.addEventListener('input', validateEmail);
        passwordInput.addEventListener('input', validatePasswords);
        confirmInput.addEventListener('input', validatePasswords);

        // Initial check on load
        validateEmail();
        updateSubmitState();
    });
</script>









<?php require("views/partials/foot.php"); ?>