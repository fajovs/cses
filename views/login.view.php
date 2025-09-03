<?php require("views/partials/head.php"); ?>
    
<!-- Added gradient background and improved container styling -->
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 flex flex-col justify-center px-6 py-12 lg:px-8">
  <div class="sm:mx-auto sm:w-full sm:max-w-md">
    <!-- Updated heading with slate color scheme -->
    <h2 class="mt-10 text-center text-3xl font-bold tracking-tight text-slate-800">
      Sign in to your account
    </h2>
    <p class="mt-2 text-center text-sm text-slate-600">
      Welcome back! Please enter your credentials.
    </p>
  </div>

  <!-- Enhanced form container with card styling -->
  <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
    <div class="bg-white/80 backdrop-blur-sm py-8 px-6 shadow-xl shadow-slate-200/50 sm:rounded-2xl border border-slate-200/50">
      
      <!-- Improved error message styling -->
      <?php if (!empty($_SESSION['error'])): ?>
        <div class="mb-6 rounded-xl bg-red-50 border border-red-200 p-4 text-sm text-red-700">
          <div class="flex items-center">
            <svg class="w-4 h-4 mr-2 text-red-500" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
            </svg>
            <?= $_SESSION['error']; unset($_SESSION['error']); ?>
          </div>
        </div>
      <?php endif; ?>

      <form class="space-y-6" action=<?= base_url("/"); ?> method="POST">
        <input class="hidden" name="_method" value="POST">
        
        <div>
          <!-- Updated label styling with slate colors -->
          <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">Email address</label>
          <div class="relative">
            <!-- Enhanced input styling with better focus states -->
            <input
              type="email"
              name="email"
              id="email"
              autocomplete="email"
              required
              class="block w-full rounded-xl bg-slate-50/50 border border-slate-200 px-4 py-3 text-slate-800 placeholder:text-slate-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:bg-white transition-all duration-200 sm:text-sm"
              placeholder="Enter your email"
            />
          </div>
        </div>

        <div>
          <div class="flex items-center justify-between mb-2">
            <!-- Updated label styling -->
            <label for="password" class="block text-sm font-semibold text-slate-700">Password</label>
          
          </div>
          <div class="relative">
            <!-- Enhanced password input styling -->
            <input
              type="password"
              name="password"
              id="password"
              autocomplete="current-password"
              required
              class="block w-full rounded-xl bg-slate-50/50 border border-slate-200 px-4 py-3 text-slate-800 placeholder:text-slate-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:bg-white transition-all duration-200 sm:text-sm"
              placeholder="Enter your password"
            />
          </div>
        </div>

        <div>
          <!-- Enhanced button with indigo primary color and better styling -->
          <button
            type="submit"
            class="flex w-full justify-center items-center rounded-xl bg-indigo-600 px-4 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-600/25 hover:bg-indigo-700 hover:shadow-xl hover:shadow-indigo-600/30 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition-all duration-200 transform hover:-translate-y-0.5"
          >
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
            </svg>
            Sign In
          </button>
        </div>
      </form>

      <!-- Added subtle footer with slate styling -->
      <div class="mt-6 text-center">
        <p class="text-xs text-slate-500">
          Protected by advanced security measures
        </p>
      </div>
    </div>
  </div>
</div>

</body>
</html>
