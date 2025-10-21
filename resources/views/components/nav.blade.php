@props(['active' => null])

<nav class="bg-[#3a3d54] border-b border-[#8d99ae] sticky top-0 z-50 nav-fade-in">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between h-16">
      <!-- Logo/Brand -->
      <div class="flex-shrink-0">
        <a href="{{ route('home') }}" class="text-lg font-semibold text-[#edf2f4] hover:text-[#b7c9c3] transition-all duration-300 logo-hover">
          Bookstore
        </a>
      </div>

      <!-- Desktop Navigation with Dropdown -->
      <div class="hidden md:block">
        <div class="relative dropdown-container">
          <button type="button" id="desktop-menu-button" class="dropdown-trigger px-4 py-2 rounded-md text-sm font-medium text-[#edf2f4] bg-[#8d99ae] hover:bg-[#b7c9c3] hover:text-[#2b2d42] transition-all duration-200 flex items-center gap-2">
            <span>Menu</span>
            <svg class="w-4 h-4 dropdown-arrow transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
          </button>

          <!-- Dropdown Content -->
          <div id="desktop-dropdown" class="dropdown-content hidden absolute right-0 mt-2 w-72 bg-[#3a3d54] border border-[#8d99ae] rounded-lg shadow-2xl overflow-hidden">
            <div class="py-1">
              <!-- List of Books -->
              <a href="{{ route('home') }}" class="dropdown-item {{ request()->routeIs('home') ? 'active' : '' }}">
                <div class="flex items-center gap-3 px-4 py-3">
                  <div class="flex-shrink-0">
                    <svg class="w-5 h-5 text-[#b7c9c3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                  </div>
                  <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-white">List of Books</p>
                    <p class="text-xs text-gray-500 truncate">Browse all books</p>
                  </div>
                </div>
              </a>

              <!-- Top 10 Authors -->
              <a href="{{ route('authors.top') }}" class="dropdown-item {{ request()->routeIs('authors.top') ? 'active' : '' }}">
                <div class="flex items-center gap-3 px-4 py-3">
                  <div class="flex-shrink-0">
                    <svg class="w-5 h-5 text-[#b7c9c3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                    </svg>
                  </div>
                  <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-white">Top 10 Most Famous Author</p>
                    <p class="text-xs text-gray-500 truncate">View author rankings</p>
                  </div>
                </div>
              </a>

              <!-- Divider -->
              <div class="border-t border-[#8d99ae] my-1"></div>

              <!-- Insert Rating -->
              <a href="{{ route('ratings.create') }}" class="dropdown-item {{ request()->routeIs('ratings.create') ? 'active' : '' }}">
                <div class="flex items-center gap-3 px-4 py-3">
                  <div class="flex-shrink-0">
                    <svg class="w-5 h-5 text-[#b7c9c3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                  </div>
                  <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-white">Insert Rating</p>
                    <p class="text-xs text-gray-500 truncate">Rate a book</p>
                  </div>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>

      <!-- Mobile menu button -->
      <div class="md:hidden">
        <button id="mobile-menu-button" type="button" class="text-gray-400 hover:text-white transition-colors duration-200">
          <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
        </button>
      </div>
    </div>
  </div>

  <!-- Mobile menu -->
  <div id="mobile-menu" class="hidden md:hidden border-t border-[#8d99ae]">
    <div class="px-2 pt-2 pb-3 space-y-1">
      <a href="{{ route('home') }}" class="mobile-nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
        </svg>
        List of Books
      </a>

      <a href="{{ route('authors.top') }}" class="mobile-nav-link {{ request()->routeIs('authors.top') ? 'active' : '' }}">
        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
        </svg>
        Top 10 Most Famous Author
      </a>

      <div class="border-t border-[#8d99ae] my-2"></div>

      <a href="{{ route('ratings.create') }}" class="mobile-nav-link {{ request()->routeIs('ratings.create') ? 'active' : '' }}">
        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        Insert Rating
      </a>
    </div>
  </div>
</nav>

<style>
  /* Dropdown animations */
  .dropdown-content {
    animation: fadeInDown 0.3s ease-out;
  }

  @keyframes fadeInDown {
    from {
      opacity: 0;
      transform: translateY(-10px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .dropdown-container.open .dropdown-arrow {
    transform: rotate(180deg);
  }

  /* Dropdown Items */
  .dropdown-item {
    display: block;
    transition: all 0.2s ease;
    position: relative;
  }

  .dropdown-item::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    bottom: 0;
    width: 3px;
    background: transparent;
    transition: all 0.2s ease;
  }

  .dropdown-item:hover {
    background-color: #4a4d64;
  }

  .dropdown-item:hover::before {
    background-color: #b7c9c3;
  }

  .dropdown-item.active {
    background-color: rgba(183, 201, 195, 0.1);
  }

  .dropdown-item.active::before {
    background-color: #b7c9c3;
  }

  /* Mobile Nav Links */
  .mobile-nav-link {
    display: flex;
    align-items: center;
    padding: 0.75rem;
    border-radius: 0.375rem;
    font-size: 1rem;
    font-weight: 500;
    color: #9ca3af;
    transition: all 0.2s ease;
  }

  .mobile-nav-link:hover {
    color: #edf2f4;
    background-color: #4a4d64;
    transform: translateX(4px);
  }

  .mobile-nav-link.active {
    background-color: #b7c9c3;
    color: #2b2d42;
  }

  /* Mobile menu slide animation */
  #mobile-menu.show {
    animation: slideDown 0.3s ease-out;
  }

  @keyframes slideDown {
    from {
      opacity: 0;
      max-height: 0;
    }
    to {
      opacity: 1;
      max-height: 500px;
    }
  }

  /* Nav fade in animation */
  @keyframes navFadeIn {
    from {
      opacity: 0;
      transform: translateY(-10px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .nav-fade-in {
    animation: navFadeIn 0.4s ease-out;
  }

  /* Logo hover effect */
  .logo-hover:hover {
    transform: scale(1.05);
  }

  /* Icon animations */
  .dropdown-item svg {
    transition: transform 0.2s ease;
  }

  .dropdown-item:hover svg {
    transform: translateX(3px);
  }

  /* ============================================
     RESPONSIVE DESIGN
     ============================================ */

  /* Mobile responsive improvements */
  @media (max-width: 640px) {
    /* Brand/Logo */
    .logo-hover {
      font-size: 1.125rem !important;
    }

    /* Mobile menu button - touch friendly */
    #mobile-menu-button {
      padding: 0.5rem;
      margin: -0.5rem;
    }

    /* Mobile nav links - larger touch targets */
    .mobile-nav-link {
      padding: 1rem !important;
      font-size: 1rem;
    }

    /* Mobile menu container */
    #mobile-menu {
      background: #2b2d42;
    }

    /* Mobile menu padding */
    #mobile-menu > div {
      padding: 0.5rem;
    }
  }

  /* Tablet */
  @media (min-width: 641px) and (max-width: 768px) {
    .dropdown-content {
      width: 16rem;
    }
  }

  /* Ensure dropdown doesn't overflow on small screens */
  @media (max-width: 1024px) {
    .dropdown-content {
      max-width: calc(100vw - 2rem);
      right: 0;
    }
  }
</style>

<script>
  // Desktop Dropdown (Click-based)
  const desktopMenuButton = document.getElementById('desktop-menu-button');
  const desktopDropdown = document.getElementById('desktop-dropdown');
  const dropdownContainer = document.querySelector('.dropdown-container');

  if (desktopMenuButton && desktopDropdown) {
    // Toggle dropdown on button click
    desktopMenuButton.addEventListener('click', function(e) {
      e.stopPropagation();
      desktopDropdown.classList.toggle('hidden');
      dropdownContainer.classList.toggle('open');
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
      if (!dropdownContainer.contains(event.target)) {
        desktopDropdown.classList.add('hidden');
        dropdownContainer.classList.remove('open');
      }
    });

    // Prevent dropdown from closing when clicking inside it
    desktopDropdown.addEventListener('click', function(e) {
      e.stopPropagation();
    });
  }

  // Mobile menu toggle
  const mobileMenuButton = document.getElementById('mobile-menu-button');
  const mobileMenu = document.getElementById('mobile-menu');

  if (mobileMenuButton && mobileMenu) {
    mobileMenuButton.addEventListener('click', function(e) {
      e.stopPropagation();
      mobileMenu.classList.toggle('hidden');
      if (!mobileMenu.classList.contains('hidden')) {
        mobileMenu.classList.add('show');
      }
    });

    // Close mobile menu when clicking outside
    document.addEventListener('click', function(event) {
      if (!mobileMenu.contains(event.target) && !mobileMenuButton.contains(event.target)) {
        mobileMenu.classList.add('hidden');
      }
    });
  }
</script>
