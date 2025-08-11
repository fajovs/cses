<?php
require("views/partials/head.php");
require("views/partials/nav.php");
require("views/partials/notification.php");

?>

<header class="bg-white shadow-sm px-30 flex-none">
    <div class="mx-auto max-w-7xl py-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

        <div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Create Program</h1>
        </div>
    </div>
</header>


<main class="flex-1 overflow-y-auto px-30 py-6">


    <form method="POST" action=<?= base_url('/admin/program/store') ?>>
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
            
      
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-4">
                        <label for="program_name" class="block text-sm/6 font-medium text-gray-900">Program Name</label>
                        <div class="mt-2">
                            <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                <input
                                    required
                                    id="program_name"
                                    type="text"
                                    name="program_name"
                                    placeholder=""
                                     class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6" />
                            </div>
                        </div>
                    </div>

                    <div class="col-span-full">
                        <label for="program_about" class="block text-sm/6 font-medium text-gray-900">About</label>
                        <div class="mt-2">
                            <textarea required id="program_about" name="program_about" rows="3" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"></textarea>
                        </div>
                        <p class="mt-3 text-sm/6 text-gray-600">Write a few sentences about the program.</p>
                    </div>



                </div>
            </div>




        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <a href=<?= base_url("/admin/programs") ?> class="text-sm/6 font-semibold text-gray-900">
                Cancel
            </a>
            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Create</button>
        </div>
    </form>


</main>




<?php require("views/partials/foot.php"); ?>