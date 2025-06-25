<?php if (isset($_SESSION['success']) || isset($_SESSION['error'])): ?>
  <div id="toast" class="fixed top-5 right-5 z-50 flex items-start gap-4 p-4 rounded-lg shadow-md bg-white border border-gray-200 min-w-[280px] max-w-sm overflow-hidden">
    <!-- Icon -->
    <div class="mt-1 <?php echo isset($_SESSION['success']) ? 'text-green-500' : 'text-red-500'; ?>">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="<?php echo isset($_SESSION['success']) ? 'M5 13l4 4L19 7' : 'M6 18L18 6M6 6l12 12'; ?>" />
      </svg>
    </div>

    <!-- Text content -->
    <div>
      <p class="font-semibold text-sm text-gray-900">
        <?php echo isset($_SESSION['success']) ? 'Success!' : 'Something went wrong!'; ?>
      </p>
      <p class="text-sm text-gray-500">
        <?php echo isset($_SESSION['success']) ? htmlspecialchars($_SESSION['success']) : htmlspecialchars($_SESSION['error']); ?>
      </p>
    </div>

    <!-- Close button -->
    <button onclick="document.getElementById('toast').remove()" class="text-gray-400 hover:text-gray-600">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
      </svg>
    </button>

    <!-- Progress bar -->
    <div class="absolute bottom-0 left-0 h-1 bg-green-400 animate-progress" style="width: 100%;"></div>
  </div>

  <style>
    @keyframes shrink {
      from {
        width: 100%;
      }

      to {
        width: 0%;
      }
    }

    .animate-progress {
      animation: shrink 5s linear forwards;
    }
  </style>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      // Auto-close after 5 seconds
      setTimeout(() => {
        const toast = document.getElementById('toast');
        if (toast) toast.remove();
      }, 5000);
    })
  </script>

  <?php unset($_SESSION['success'], $_SESSION['error']); ?>
<?php endif; ?>