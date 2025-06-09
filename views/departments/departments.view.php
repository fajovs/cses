<?php 
require ("views/partials/head.php");
require ("views/partials/nav.php");
require ("views/partials/banner.php");
?>
<main>
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
          <div class="max-w-7xl mx-auto">
            
            <!-- Cards Container -->
            <div class="space-y-4">
              <!-- Card 1 -->
              <div
                class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow"
              >
                <div
                  class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4"
                >
                  <!-- Left Content -->
                  <div
                    class="flex flex-col sm:flex-row sm:items-center gap-4 flex-1"
                  >
                    <div
                      class="w-16 h-16 bg-purple-100 rounded-lg flex items-center justify-center flex-shrink-0"
                    >
                      <svg
                        class="w-8 h-8 text-purple-600"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                      >
                        <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                        ></path>
                      </svg>
                    </div>
                    <div class="flex-1">
                      <h3 class="text-lg font-semibold text-gray-900">
                        College of Computer Studies
                      </h3>
                      <p class="text-gray-600 text-sm mt-1">
                        Information Technology, Computer Science, Entertainment and Multimedia Computing, and Associate in Computer Technology programs
                      </p>
                      <div class="flex flex-wrap items-center gap-4 mt-3">
                        
                        <span class="text-sm text-gray-500"
                          >15 Faculty Members</span
                        >
                        <span class="text-sm text-gray-500"
                          >856 Students</span
                        >
                      </div>
                    </div>
                  </div>

                  <!-- Right Content -->
                  <div
                    class="flex flex-col sm:flex-row items-start sm:items-center gap-3"
                  >
                    <div class="text-right">
                      <div class="text-2xl font-bold text-gray-900">4</div>
                      <div class="text-sm text-gray-500">Programs Offered</div>
                    </div>
                    <div class="flex flex-col gap-2">
                    
                      <button
                        class="px-4 py-2 text-sm bg-purple-600 text-white rounded-md hover:bg-purple-700 transition-colors"
                      >
                        Manage Department
                      </button>
                    </div>
                  </div>
                </div>
              </div>


        

              

         
    
            </div>

            <!-- Load More Button -->
            <div class="mt-8 text-center">
              <button
                class="px-6 py-3 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition-colors font-medium"
              >
                Load More Departments
              </button>
            </div>
          </div>
        </div>
      </main>

      <?php require ("views/partials/foot.php"); ?>