 
    <script>
      function toggleMenu() {
        const menuButton = document.getElementById("user-menu-button");
        const menu = document.getElementById("mobile-menu");
        const mobileMenu = document.getElementById("menu");
        const icon = document.getElementById("chevron-icon");
        
        let menuOpen = icon.getAttribute("name") === "chevron-up";

        menuOpen = !menuOpen;

        console.log(menuOpen);
        menu.classList.toggle("hidden");
        mobileMenu.classList.toggle("hidden");

        icon.setAttribute("name", menuOpen ? "chevron-up" : "chevron-down");
      }
    </script>
  </body>
</html>