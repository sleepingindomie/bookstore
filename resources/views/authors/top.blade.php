<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Top 10 Most Famous Author - Bookstore</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      background: #282933ff;
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
      transition: background-color 0.15s ease;
    }

    .data-table tbody tr:hover {
      background: #4a4d64;
    }

    /* Section header */
    .section-header {
      border-bottom: 1px solid #8d99ae;
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

    .animate-fade-in-up {
      animation: fadeInUp 0.6s ease-out;
    }

    .stagger-1 { animation-delay: 0.1s; opacity: 0; animation-fill-mode: forwards; }
    .stagger-2 { animation-delay: 0.2s; opacity: 0; animation-fill-mode: forwards; }

    /* Enhanced hover for table rows */
    .data-table tbody tr {
      transition: all 0.2s ease;
    }

    .data-table tbody tr:hover {
      transform: translateX(4px);
    }

    /* Badge animation */
    .badge-circle {
      transition: all 0.3s ease;
    }

    .data-table tbody tr:hover .badge-circle {
      transform: scale(1.1);
    }

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

      /* Info notice */
      .info-notice {
        font-size: 0.875rem;
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

    /* Mobile card styling for authors */
    .mobile-card {
      background: #3a3d54;
      border: 1px solid #8d99ae;
      border-radius: 0.5rem;
      padding: 1rem;
      margin-bottom: 1rem;
      transition: all 0.2s ease;
      display: flex;
      align-items: center;
      gap: 1rem;
    }

    .mobile-card:hover {
      background: #4a4d64;
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .mobile-card-badge {
      flex-shrink: 0;
    }

    .mobile-card-content {
      flex: 1;
      min-width: 0;
    }

    .mobile-card-name {
      font-weight: 600;
      color: #fff;
      font-size: 1rem;
      margin-bottom: 0.25rem;
      word-break: break-word;
    }

    .mobile-card-votes {
      font-size: 0.875rem;
      color: #8d99ae;
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

  <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8 container-responsive">
    <!-- Header -->
    <header class="mb-8 animate-fade-in-up">
      <h1 class="text-3xl font-semibold text-white mb-2">Top 10 Most Famous Author</h1>
      <p class="text-gray-400">Ranked by high ratings (rating > 5)</p>
    </header>

    <!-- Info Notice -->
    <div class="bg-[#3a3d54] border border-[#8d99ae] rounded-lg p-4 mb-8 animate-fade-in-up stagger-1 info-notice">
      <p class="text-sm text-gray-300">
        <span class="text-[#b7c9c3] font-medium">Note:</span> Only ratings greater than 5 are counted in the ranking
      </p>
    </div>

    <!-- Authors Table -->
    <section class="animate-fade-in-up stagger-2">
      @if($authors->isEmpty())
        <div class="bg-[#3a3d54] border border-[#8d99ae] rounded-lg p-12 text-center">
          <p class="text-gray-400">No authors found</p>
        </div>
      @else
        <div class="data-table rounded-lg overflow-hidden">
          <table class="w-full">
            <thead>
              <tr>
                <th class="px-4 py-3 text-left">No</th>
                <th class="px-4 py-3 text-left">Author</th>
                <th class="px-4 py-3 text-right">Voter</th>
              </tr>
            </thead>
            <tbody>
              @foreach($authors as $author)
                <tr>
                  <td class="px-4 py-4">
                    <span class="badge-circle inline-flex items-center justify-center w-8 h-8 rounded-full {{ $loop->iteration <= 3 ? 'bg-[#b7c9c3] text-[#2b2d42]' : 'bg-[#8d99ae] text-[#edf2f4]' }} text-sm font-medium">
                      {{ $loop->iteration }}
                    </span>
                  </td>
                  <td class="px-4 py-4">
                    <div class="font-medium text-white">{{ $author->name }}</div>
                  </td>
                  <td class="px-4 py-4 text-right text-gray-400 text-sm">
                    {{ number_format($author->votes) }}
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>

          <!-- Mobile Cards (visible on mobile only) -->
          <div class="mobile-cards">
            @foreach($authors as $author)
              <div class="mobile-card">
                <div class="mobile-card-badge">
                  <span class="badge-circle inline-flex items-center justify-center w-12 h-12 rounded-full {{ $loop->iteration <= 3 ? 'bg-[#b7c9c3] text-[#2b2d42]' : 'bg-[#8d99ae] text-[#edf2f4]' }} text-lg font-bold">
                    {{ $loop->iteration }}
                  </span>
                </div>
                <div class="mobile-card-content">
                  <div class="mobile-card-name">{{ $author->name }}</div>
                  <div class="mobile-card-votes">
                    {{ number_format($author->votes) }} high ratings
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      @endif
    </section>

    <!-- Back Link -->
    <div class="mt-8">
      <a href="{{ route('home') }}" class="inline-flex items-center text-sm text-gray-400 hover:text-white transition-colors">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        Back to Books
      </a>
    </div>
  </div>
</body>
</html>
