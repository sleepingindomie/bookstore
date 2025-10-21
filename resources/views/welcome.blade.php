<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Bookstore - List</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      background: #2b2d42;
      color: #edf2f4;
    }

    /* Minimal table styling */
    .data-table {
      background: #3a3d54;
      border: 1px solid #8d99ae;
    }

    .data-table th {
      background: #3a3d54;
      border-bottom: 1px solid #8d99ae;
      color: #b7c9c3;
      font-weight: 500;
      text-transform: uppercase;
      font-size: 0.75rem;
      letter-spacing: 0.05em;
    }

    .data-table td {
      border-bottom: 1px solid #8d99ae;
    }

    .data-table tbody tr {
      transition: all 0.2s ease;
    }

    .data-table tbody tr:hover {
      background: #4a4d64;
      transform: translateX(4px);
    }

    /* Minimal badge */
    .badge {
      background: #8d99ae;
      color: #edf2f4;
      font-size: 0.75rem;
      font-weight: 500;
    }

    /* Filter inputs */
    .filter-input, .filter-select {
      background: #3a3d54;
      border: 1px solid #8d99ae;
      color: #edf2f4;
      transition: all 0.15s ease;
    }

    .filter-input:focus, .filter-select:focus {
      outline: none;
      border-color: #b7c9c3;
      background: #3a3d54;
      transform: translateY(-2px);
    }

    .filter-select option {
      background: #3a3d54;
    }

    /* Button */
    .btn-primary {
      background: #b7c9c3;
      color: #2b2d42;
      transition: all 0.15s ease;
      font-weight: 500;
    }

    .btn-primary:hover {
      background: #a8c5ba;
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(183, 201, 195, 0.2);
    }

    .btn-primary:active {
      transform: translateY(0);
    }

    /* Section header */
    .section-header {
      border-bottom: 1px solid #8d99ae;
    }

    /* Pagination styling */
    nav[role="navigation"] {
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 0.5rem;
      padding: 1.5rem 0;
    }

    nav[role="navigation"] p {
      display: none;
    }

    nav[role="navigation"] a,
    nav[role="navigation"] span {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      min-width: 2.25rem;
      height: 2.25rem;
      padding: 0 0.5rem;
      font-size: 0.875rem;
      border-radius: 0.25rem;
      transition: all 0.15s ease;
      background: transparent;
      color: #edf2f4;
      border: none;
    }

    nav[role="navigation"] a:hover {
      background: #4a4d64;
      color: #edf2f4;
    }

    nav[role="navigation"] span[aria-current="page"] {
      background: #b7c9c3;
      color: #2b2d42;
      font-weight: 500;
    }

    nav[role="navigation"] span[aria-disabled="true"] {
      color: #6b6e84;
      cursor: not-allowed;
    }

    nav[role="navigation"] svg {
      width: 1rem;
      height: 1rem;
    }

    /* Smooth animations */
    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }

    .animate-fade-in-up {
      animation: fadeInUp 0.6s ease-out;
    }

    .animate-fade-in {
      animation: fadeIn 0.4s ease-out;
    }

    .stagger-1 { animation-delay: 0.1s; opacity: 0; animation-fill-mode: forwards; }
    .stagger-2 { animation-delay: 0.2s; opacity: 0; animation-fill-mode: forwards; }
    .stagger-3 { animation-delay: 0.3s; opacity: 0; animation-fill-mode: forwards; }

    /* ============================================
       RESPONSIVE DESIGN - Mobile First
       ============================================ */

    /* Mobile: Hide table, show cards */
    @media (max-width: 768px) {
      .data-table table {
        display: none;
      }

      .mobile-cards {
        display: block;
      }

      /* Header responsive */
      h1 {
        font-size: 1.75rem !important;
      }

      /* Filter form stacking */
      .filter-section {
        gap: 1rem;
      }

      /* Pagination responsive */
      nav[role="navigation"] a,
      nav[role="navigation"] span {
        min-width: 2rem;
        height: 2rem;
        font-size: 0.75rem;
      }

      /* Hide some pagination numbers on mobile */
      nav[role="navigation"] a:not(:first-child):not(:last-child):not([aria-current="page"]),
      nav[role="navigation"] span:not(:first-child):not(:last-child):not([aria-current="page"]) {
        display: none;
      }

      nav[role="navigation"] a:first-child,
      nav[role="navigation"] a:last-child,
      nav[role="navigation"] span[aria-current="page"] {
        display: inline-flex;
      }
    }

    /* Tablet and up: Show table, hide cards */
    @media (min-width: 769px) {
      .data-table table {
        display: table;
      }

      .mobile-cards {
        display: none;
      }
    }

    /* Mobile card styling */
    .mobile-card {
      background: #3a3d54;
      border: 1px solid #8d99ae;
      border-radius: 0.5rem;
      padding: 1rem;
      margin-bottom: 1rem;
      transition: all 0.2s ease;
    }

    .mobile-card:hover {
      background: #4a4d64;
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .mobile-card-row {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      margin-bottom: 0.75rem;
    }

    .mobile-card-row:last-child {
      margin-bottom: 0;
    }

    .mobile-card-label {
      font-size: 0.75rem;
      color: #8d99ae;
      text-transform: uppercase;
      letter-spacing: 0.05em;
      font-weight: 500;
    }

    .mobile-card-value {
      font-size: 0.875rem;
      color: #edf2f4;
      text-align: right;
      flex: 1;
      margin-left: 1rem;
    }

    .mobile-card-title {
      font-weight: 600;
      color: #fff;
      word-break: break-word;
    }

    /* Touch-friendly buttons for mobile */
    @media (max-width: 640px) {
      .btn-primary {
        padding: 0.75rem 1.5rem !important;
        width: 100%;
      }

      .filter-input,
      .filter-select {
        font-size: 16px !important; /* Prevent zoom on iOS */
      }
    }

    /* Container padding responsive */
    @media (max-width: 640px) {
      .container-responsive {
        padding-left: 1rem;
        padding-right: 1rem;
      }
    }
  </style>
</head>
<body class="antialiased">
  <!-- Navigation Component -->
  <x-nav />

  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 container-responsive">
    <!-- Header -->
    <header class="mb-8 animate-fade-in-up">
      <h1 class="text-3xl font-semibold text-white mb-2">Bookstore</h1>
      <p class="text-gray-400">Browse and discover books</p>
    </header>

    <!-- Filter Section -->
    <section class="bg-[#3a3d54] border border-[#8d99ae] rounded-lg p-6 mb-8 animate-fade-in-up stagger-1">
      <form method="GET" action="{{ route('home') }}" class="flex flex-col md:flex-row gap-4">
        <div class="flex-1">
          <label class="block text-sm font-medium text-gray-400 mb-2">Search</label>
          <input
            type="text"
            name="q"
            value="{{ request('q') }}"
            placeholder="Search by book name or author..."
            class="filter-input w-full px-4 py-2 rounded-md text-sm"
          />
        </div>

        <div class="w-full md:w-40">
          <label class="block text-sm font-medium text-gray-400 mb-2">Items</label>
          <select name="per_page" class="filter-select w-full px-4 py-2 rounded-md text-sm">
            @for($i=10;$i<=100;$i+=10)
              <option value="{{ $i }}" @if(request('per_page') == $i) selected @endif>{{ $i }}</option>
            @endfor
          </select>
        </div>

        <div class="flex items-end">
          <button type="submit" class="btn-primary px-6 py-2 rounded-md text-sm font-medium">
            Search
          </button>
        </div>
      </form>
    </section>

    <!-- All Books Section -->
    <section class="animate-fade-in-up stagger-2">
      <div class="section-header pb-4 mb-6 flex items-center justify-between">
        <div>
          <h2 class="text-xl font-semibold text-white">All Books</h2>
          <p class="text-sm text-gray-400 mt-1">{{ $books->total() }} books total</p>
        </div>
        <div class="text-sm text-gray-500">
          Showing {{ $books->firstItem() ?? 0 }}-{{ $books->lastItem() ?? 0 }}
        </div>
      </div>

      @if($books->isEmpty())
        <div class="bg-[#3a3d54] border border-[#8d99ae] rounded-lg p-12 text-center">
          <p class="text-gray-400">No books found matching your criteria</p>
          <a href="{{ route('home') }}" class="inline-block mt-4 text-[#b7c9c3] hover:text-[#a8c5ba] text-sm">Clear filters</a>
        </div>
      @else
        <div class="data-table rounded-lg overflow-hidden mb-6">
          <table class="w-full">
            <thead>
              <tr>
                <th class="px-4 py-3 text-left">No</th>
                <th class="px-4 py-3 text-left">Book Title</th>
                <th class="px-4 py-3 text-left">Category</th>
                <th class="px-4 py-3 text-left">Author</th>
                <th class="px-4 py-3 text-right">Average Rating</th>
                <th class="px-4 py-3 text-right">Voter</th>
              </tr>
            </thead>
            <tbody>
              @foreach($books as $book)
                <tr>
                  <td class="px-4 py-4 text-gray-500 text-sm">
                    {{ $loop->iteration + (($books->currentPage()-1) * $books->perPage()) }}
                  </td>
                  <td class="px-4 py-4">
                    <div class="font-medium text-white">{{ $book->title }}</div>
                  </td>
                  <td class="px-4 py-4">
                    <span class="badge inline-block px-2 py-1 rounded-md">
                      {{ $book->category->name ?? 'N/A' }}
                    </span>
                  </td>
                  <td class="px-4 py-4 text-gray-400">{{ $book->author->name ?? '-' }}</td>
                  <td class="px-4 py-4 text-right">
                    <span class="text-sm font-medium text-white">{{ number_format($book->average_rating ?? 0, 2) }}</span>
                  </td>
                  <td class="px-4 py-4 text-right text-gray-400 text-sm">
                    {{ number_format($book->voter_count ?? 0) }}
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>

          <!-- Mobile Cards (visible on mobile only) -->
          <div class="mobile-cards">
            @foreach($books as $book)
              <div class="mobile-card">
                <div class="mobile-card-row">
                  <span class="mobile-card-label">No.</span>
                  <span class="mobile-card-value">
                    {{ $loop->iteration + (($books->currentPage()-1) * $books->perPage()) }}
                  </span>
                </div>
                <div class="mobile-card-row">
                  <span class="mobile-card-label">Book Title</span>
                  <span class="mobile-card-value mobile-card-title">{{ $book->title }}</span>
                </div>
                <div class="mobile-card-row">
                  <span class="mobile-card-label">Category</span>
                  <span class="mobile-card-value">
                    <span class="badge inline-block px-2 py-1 rounded-md">
                      {{ $book->category->name ?? 'N/A' }}
                    </span>
                  </span>
                </div>
                <div class="mobile-card-row">
                  <span class="mobile-card-label">Author</span>
                  <span class="mobile-card-value">{{ $book->author->name ?? '-' }}</span>
                </div>
                <div class="mobile-card-row">
                  <span class="mobile-card-label">Rating</span>
                  <span class="mobile-card-value font-medium">{{ number_format($book->average_rating ?? 0, 2) }}</span>
                </div>
                <div class="mobile-card-row">
                  <span class="mobile-card-label">Voter</span>
                  <span class="mobile-card-value">{{ number_format($book->voter_count ?? 0) }}</span>
                </div>
              </div>
            @endforeach
          </div>
        </div>

        <!-- Pagination -->
        <div class="flex justify-center">
          {{ $books->onEachSide(1)->withQueryString()->links() }}
        </div>
      @endif
    </section>
  </div>
</body>
</html>
