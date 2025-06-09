<?php 
require ("views/partials/head.php");
require ("views/partials/nav.php");
require ("views/partials/banner.php");
?>


<main>
    <div class="max-w-7xl mx-auto py-2">
        

        <!-- User Stats -->
        <div class="grid grid-cols-2 md:grid-cols-1 gap-4 mb-6">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-gray-900">2</p>
                        <p class="text-sm text-gray-500">Students</p>
                    </div>
                </div>
            </div>
            
            
            
        </div>

        <!-- User Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            <!-- Student Card 1 -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden hover:shadow-lg hover:border-blue-300 transition-all duration-200 cursor-pointer transform hover:-translate-y-1" onclick="openUserProfile('student', 'Marco Antonio Reyes')">
                <div class="p-6">
                    <!-- Avatar -->
                    <div class="flex items-center mb-4">
                        <!-- <img class="w-16 h-16 rounded-full object-cover border-2 border-blue-100" src="/placeholder.svg?height=64&width=64" alt="Marco Antonio Reyes"> -->
                        <div class="ml-4 flex-1">
                            <h3 class="text-lg font-semibold text-gray-900">Marco Antonio Reyes</h3>
                            <div class="flex items-center">
                                <!-- <span class="inline-flex px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">Student</span>
                                <div class="ml-2 w-2 h-2 bg-green-400 rounded-full" title="Online"></div> -->
                            </div>
                        </div>
                    </div>

                    <!-- User Info -->
                    <div class="space-y-2 mb-4">
                        <div class="flex items-center text-sm text-gray-600">
                            <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path>
                            </svg>
                            <span>BS Computer Science • Year 3</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            <span>GPA: 3.85</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <span>marco.reyes@student.edu.ph</span>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex space-x-2">
                        <button class="flex-1 px-3 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors text-sm font-medium" onclick="event.stopPropagation(); sendMessage('Marco Antonio Reyes')">
                            View
                        </button>
                        <!-- <button class="px-3 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 transition-colors text-sm" onclick="event.stopPropagation(); viewProfile('Marco Antonio Reyes')">
                            View
                        </button> -->
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden hover:shadow-lg hover:border-blue-300 transition-all duration-200 cursor-pointer transform hover:-translate-y-1" onclick="openUserProfile('student', 'Ana Marie Gonzales')">
                <div class="p-6">
                    <!-- Avatar -->
                    <div class="flex items-center mb-4">
                        <!-- <img class="w-16 h-16 rounded-full object-cover border-2 border-blue-100" src="/placeholder.svg?height=64&width=64" alt="Ana Marie Gonzales"> -->
                        <div class="ml-4 flex-1">
                            <h3 class="text-lg font-semibold text-gray-900">Ana Marie Gonzales</h3>
                            <div class="flex items-center">
                                <!-- <span class="inline-flex px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">Student</span>
                                <div class="ml-2 w-2 h-2 bg-green-400 rounded-full" title="Online"></div> -->
                            </div>
                        </div>
                    </div>

                    <!-- User Info -->
                    <div class="space-y-2 mb-4">
                        <div class="flex items-center text-sm text-gray-600">
                            <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path>
                            </svg>
                            <span>BS Entertainment & Multimedia • Year 1</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            <span>GPA: 3.67</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <span>ana.gonzales@student.edu.ph</span>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex space-x-2">
                        <button class="flex-1 px-3 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors text-sm font-medium" onclick="event.stopPropagation(); sendMessage('Ana Marie Gonzales')">
                            View
                        </button>
                        <!-- <button class="px-3 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 transition-colors text-sm" onclick="event.stopPropagation(); viewProfile('Ana Marie Gonzales')">
                            View
                        </button> -->
                    </div>
                </div>
            </div>

            <!-- Staff Card 2 -->
            
        </div>

        <!-- Load More Button -->
        <div class="mt-8 text-center">
            <button class="px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors font-medium">
                Load More Users
            </button>
        </div>
    </div>
</main>

     <?php require ("views/partials/foot.php"); ?>