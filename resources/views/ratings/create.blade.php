<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Insert Rating - Bookstore</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      background: #2b2d42;
      color: #edf2f4;
    }

    /* Form inputs */
    .form-input, .form-select {
      background: #3a3d54;
      border: 1px solid #8d99ae;
      color: #edf2f4;
      transition: all 0.15s ease;
    }

    .form-input:focus, .form-select:focus {
      outline: none;
      border-color: #b7c9c3;
      transform: translateY(-2px);
    }

    .form-select option {
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

    .btn-primary:disabled {
      opacity: 0.5;
      cursor: not-allowed;
    }

    /* Success message */
    .success-message {
      background: #3a3d54;
      border: 1px solid #10b981;
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

    /* ============================================
       RESPONSIVE DESIGN - Mobile First
       ============================================ */

    /* Mobile responsive */
    @media (max-width: 640px) {
      /* Header */
      h1 {
        font-size: 1.75rem !important;
      }

      /* Form container */
      .form-container {
        padding: 1.5rem !important;
      }

      /* Touch-friendly form inputs */
      .form-input,
      .form-select {
        font-size: 16px !important; /* Prevent zoom on iOS */
        padding: 0.75rem 1rem !important;
      }

      /* Submit button */
      .btn-primary {
        padding: 1rem !important;
        font-size: 1rem;
      }

      /* Info notice */
      .info-notice {
        padding: 1rem !important;
      }

      /* Container padding */
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

  <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8 container-responsive">
    <!-- Header -->
    <header class="mb-8 animate-fade-in-up">
      <h1 class="text-3xl font-semibold text-white mb-2">Insert Rating</h1>
      <p class="text-gray-400">Share your opinion on a book</p>
    </header>

    <!-- Success Message -->
    @if(session('success'))
      <div class="success-message rounded-lg p-4 mb-6 animate-fade-in">
        <p class="text-sm text-green-400">{{ session('success') }}</p>
      </div>
    @endif

    <!-- Form -->
    <div class="bg-[#3a3d54] border border-[#8d99ae] rounded-lg p-8 animate-fade-in-up stagger-1 form-container">
      <form method="POST" action="{{ route('ratings.store') }}" id="rating-form">
        @csrf

        <!-- Author Selection -->
        <div class="mb-6">
          <label class="block text-sm font-medium text-gray-300 mb-2">Author</label>
          <select
            id="author"
            name="author_id"
            class="form-select w-full px-4 py-2 rounded-md"
            required
          >
            <option value="">Select an author</option>
            @foreach($authors as $a)
              <option value="{{ $a->id }}">{{ $a->name }}</option>
            @endforeach
          </select>
          @error('author_id')
            <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
          @enderror
        </div>

        <!-- Book Selection -->
        <div class="mb-6">
          <label class="block text-sm font-medium text-gray-300 mb-2">Book</label>
          <div class="relative">
            <select
              id="book"
              name="book_id"
              class="form-select w-full px-4 py-2 rounded-md"
              required
              disabled
            >
              <option value="">Select an author first</option>
            </select>
            <div id="book-loading" class="hidden absolute right-3 top-1/2 -mt-3">
              <svg class="animate-spin h-6 w-6 text-[#b7c9c3]" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
              </svg>
            </div>
          </div>
          @error('book_id')
            <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
          @enderror
        </div>

        <!-- Rating Selection -->
        <div class="mb-6">
          <label class="block text-sm font-medium text-gray-300 mb-2">Rating (1-10)</label>
          <select
            id="rating"
            name="rating"
            class="form-select w-full px-4 py-2 rounded-md"
            required
          >
            <option value="">Select rating</option>
            @for($i = 1; $i <= 10; $i++)
              <option value="{{ $i }}">{{ $i }}</option>
            @endfor
          </select>
          @error('rating')
            <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
          @enderror
        </div>

        <!-- Submit Button -->
        <button
          type="submit"
          class="btn-primary w-full px-6 py-3 rounded-md font-medium"
          id="submit-btn"
        >
          Submit Rating
        </button>
      </form>
    </div>

    <!-- Info -->
    <div class="mt-6 bg-[#3a3d54] border border-[#8d99ae] rounded-lg p-4 info-notice">
      <p class="text-sm text-gray-300">
        <span class="text-[#b7c9c3] font-medium">Note:</span>
        Ratings above 5 contribute to the author's ranking in the top authors list.
      </p>
    </div>

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

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Author selection - Load books via AJAX
      document.getElementById('author').addEventListener('change', async function() {
        const authorId = this.value;
        const bookSelect = document.getElementById('book');
        const loadingIndicator = document.getElementById('book-loading');

        if (!authorId) {
          bookSelect.disabled = true;
          bookSelect.innerHTML = '<option value="">Select an author first</option>';
          return;
        }

        loadingIndicator.classList.remove('hidden');
        bookSelect.disabled = true;
        bookSelect.innerHTML = '<option value="">Loading books...</option>';

        try {
          const response = await fetch('/authors/' + authorId + '/books');
          const books = await response.json();

          bookSelect.innerHTML = '<option value="">Select a book</option>';

          if (books.length === 0) {
            bookSelect.innerHTML += '<option value="" disabled>No books found</option>';
          } else {
            books.forEach(book => {
              const option = document.createElement('option');
              option.value = book.id;
              option.textContent = book.title;
              bookSelect.appendChild(option);
            });
          }

          bookSelect.disabled = false;
        } catch (error) {
          bookSelect.innerHTML = '<option value="">Error loading books</option>';
          console.error('Error:', error);
        } finally {
          loadingIndicator.classList.add('hidden');
        }
      });
    });
  </script>
</body>
</html>
