<?php 
require ("views/partials/head.php");
require ("views/partials/nav.php");
require ("views/partials/banner.php");
?>


<main>
    <div class="max-w-7xl mx-auto my-2 py-5">
        <!-- User Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">


            <!-- Staff Card 1 -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden hover:shadow-lg hover:border-purple-300 transition-all duration-200 cursor-pointer transform hover:-translate-y-1" onclick="openUserProfile('staff', 'Carlos Mendoza')">
                <div class="p-6">
                    <!-- Avatar -->
                    <div class="flex items-center mb-4">
                        <!-- <img class="w-16 h-16 rounded-full object-cover border-2 border-purple-100" src="/placeholder.svg?height=64&width=64" alt="Carlos Mendoza"> -->
                        <div class="ml-4 flex-1">
                            <h3 class="text-lg font-semibold text-gray-900">Carlos Mendoza</h3>
                            <!-- <div class="flex items-center">
                            <span class="inline-flex px-2 py-1 text-xs font-medium bg-purple-100 text-purple-800 rounded-full">Staff</span>
                            <div class="ml-2 w-2 h-2 bg-green-400 rounded-full" title="Online"></div>
                        </div> -->
                        </div>
                    </div>

                    <!-- User Info -->
                    <div class="space-y-2 mb-4">
                        <div class="flex items-center text-sm text-gray-600">
                            <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <span>Bachelor of Science in Information Technology</span>
                        </div>


                    </div>

                    <!-- Action Buttons -->
                    <div class="flex space-x-2">
                        <button class="flex-1 px-3 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700 transition-colors text-sm font-medium" onclick="event.stopPropagation(); sendMessage('Carlos Mendoza')">
                            View
                        </button>
                        <!-- <button class="px-3 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 transition-colors text-sm" onclick="event.stopPropagation(); viewProfile('Carlos Mendoza')">
                        View
                    </button> -->
                    </div>
                </div>
            </div>



        </div>
    </div>
</main>

<?php require ("views/partials/foot.php"); ?>