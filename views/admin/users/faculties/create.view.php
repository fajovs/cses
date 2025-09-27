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


    <form method="POST" action=<?= base_url('/admin/users/faculty/store') ?>>
        <div class="space-y-12">

            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base/7 font-semibold text-gray-900">Create Faculty</h2>



                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-12">


                    <div class="sm:col-span-6">
                        <label for="faculty_number" class="block text-sm/6 font-medium text-gray-900">Faculty Number</label>
                        <div class="mt-2">
                            <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-green-600">
                                <input
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
                                <option value="" selected disabled>Select a Program</option>
                                <?php foreach ($programs as $programe) : ?>
                                    <option value="<?= htmlspecialchars($programe['program_id']) ?>"><?= htmlspecialchars($programe['program_name']) ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="first_name" class="block text-sm/6 font-medium text-gray-900">First Name</label>
                        <div class="mt-2">
                            <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-green-600">
                                <input
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
                                    required
                                    id="email"
                                    type="text"
                                    name="email"
                                    placeholder=""
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
                                    required
                                    id="password"
                                    type="password"
                                    name="password"
                                    placeholder=""
                                    class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6" />
                            </div>
                        </div>
                    </div>

                    <div class="sm:col-span-4">
                        <label for="confirm_password" class="block text-sm/6 font-medium text-gray-900">Confirm Password</label>
                        <div class="mt-2">
                            <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-green-600">
                                <input
                                    required
                                    id="confirm_password"
                                    type="password"
                                    name="confirm_password"
                                    placeholder=""
                                    class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6" />
                            </div>
                        </div>
                        <p id="passwordError" class="mt-1 text-sm text-red-600 hidden">Passwords do not match.</p>
                    </div>

                 

                </div>
            </div>




        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <a href=<?= base_url("/admin/users/faculties") ?> class="text-sm/6 font-semibold text-gray-900">
                Cancel
            </a>
            <button type="submit" class="rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-green-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">
                Create
            </button>
        </div>
    </form>


</main>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    const confirmInput = document.getElementById('confirm_password');
    const submitBtn = document.querySelector('button[type="submit"]');

    const emailError = document.createElement('p');
    emailError.className = 'mt-1 text-sm text-red-600';
    emailInput.closest('.mt-2').after(emailError);

    const passwordError = document.createElement('p');
    passwordError.className = 'mt-1 text-sm text-red-600';
    confirmInput.closest('.mt-2').after(passwordError);

    let emailValid = false;
    let emailUnique = false;
    let passwordsMatch = false;

    async function validateEmail() {
        const email = emailInput.value.trim();
        emailValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);

        if (!emailValid) {
            emailError.textContent = "Invalid email format.";
            emailUnique = false;
        } else {
            try {
                const response = await fetch('<?= base_url('/admin/users/check-email') ?>?email=' + encodeURIComponent(email));
                const data = await response.json();
               
                if (data.exists) {
                    emailError.textContent = "This email is already taken.";
                    emailUnique = false;
                } else {
                    emailError.textContent = "";
                    emailUnique = true;
                }
            } catch (error) {
                emailError.textContent = "Error checking email.";
                emailUnique = false;
            }
        }
        updateSubmitState();
    }

    function validatePasswords() {
        if (passwordInput.value && confirmInput.value && passwordInput.value !== confirmInput.value) {
            passwordError.textContent = "Passwords do not match.";
            passwordsMatch = false;
        } else {
            passwordError.textContent = "";
            passwordsMatch = true;
        }
        updateSubmitState();
    }

    function updateSubmitState() {
        if (emailValid && emailUnique && passwordsMatch) {
            submitBtn.disabled = false;
            submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
        } else {
            submitBtn.disabled = true;
            submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
        }
    }

    emailInput.addEventListener('input', validateEmail);
    passwordInput.addEventListener('input', validatePasswords);
    confirmInput.addEventListener('input', validatePasswords);

    // Initial disable
    submitBtn.disabled = true;
    submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
});
</script>








<?php require("views/partials/foot.php"); ?>