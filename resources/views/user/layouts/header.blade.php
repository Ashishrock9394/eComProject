<!-- header section strats -->
  <style>
  .highlight {
    background-color: yellow;
  }
  .search-wrapper {
    position: relative;
    display: inline-block;
  }

  .search-wrapper input {
    padding-left: 35px; /* space for icon */
    border-radius: 20px;
    padding: 5px 5px;
  }

  .search-wrapper .fa-search {
    position: absolute;
    top: 50%;
    right: 10px;
    transform: translateY(-50%);
    color: red;
    pointer-events: none;
  }
</style>
<header id="header" class="header_section">
            <div class="container">
               <nav class="navbar navbar-expand-lg custom_nav-container ">
                  <a class="navbar-brand" href="{{url('/redirect')}}"><img width="250" src="{{asset('images/logo.png')}}" alt="#" /></a>
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class=""> </span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                     <ul class="navbar-nav">
                        <li class="nav-item active">
                           <a class="nav-link" href="{{url('/redirect')}}">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="#new">Latest</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="#products">Products</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="#blog">Blog</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="#contact">Contact</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="{{ route('cart.show') }}">
                              <i class="fa fa-shopping-cart"></i> 
                              @auth
                                    @php
                                       $cartCount = \App\Models\Cart::where('user_id', Auth::id())->count();
                                    @endphp
                                    <span class="badge badge-danger">{{ $cartCount }}</span>
                              @else
                                    <span class="badge badge-danger">0</span>
                              @endauth
                           </a>
                        </li>
                        @if (Route::has('login'))
                        @auth
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <img src="{{ Auth::user()->profile_photo_url ?? asset('images/user.png') }}" alt="User"
                                        class="rounded-circle" width="30">
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu" aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="{{ route('profile.show') }}">Profile</a>
                                    <a class="dropdown-item" href="{{ route('user.orders')}}">My Orders</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @else
                        <li class="nav-item">
                           <a class="btn btn-primary mr-2" href="{{route ('login')}}">Login</a>
                        </li>                        
                        <li class="nav-item">
                           <a class="btn btn-success m2-2" href="{{route ('register')}}">Register</a>
                        </li>
                        @endauth

                        @endif
                        <li class="nav-item">
                           <div class="search-wrapper m-2">
                              <i class="fas fa-search"></i>
                              <input type="text" id="searchBox" oninput="highlightText()" class="form-control" style="width: 100px;">
                           </div>
                        </li>

                     </ul>
                  </div>
               </nav>
            </div>
         </header>
         @if (session('success'))
               <div id="success-message" class="alert alert-success">
               {{ session('success') }}
               </div>
         @endif
         @if (session('error'))
               <div id="error-message" class="alert alert-danger">
               {{ session('error') }}
               </div>
         @endif

      <script>
         setTimeout(function() {
               $(".alert").fadeOut("slow");
         }, 3000);
      </script>
      <script>
  function highlightText() {
    const searchText = document.getElementById("searchBox").value.trim().toLowerCase();
    const container = document.getElementById("products");

    // Remove all existing highlights
    const highlights = container.querySelectorAll(".highlight");
    highlights.forEach(el => {
      const parent = el.parentNode;
      parent.replaceChild(document.createTextNode(el.textContent), el);
      parent.normalize(); // Merge adjacent text nodes
    });

    if (searchText === "") return;

    const walker = document.createTreeWalker(container, NodeFilter.SHOW_TEXT, null, false);

    const nodesToHighlight = [];
    while (walker.nextNode()) {
      const node = walker.currentNode;
      if (node.nodeValue.toLowerCase().includes(searchText)) {
        nodesToHighlight.push(node);
      }
    }

    nodesToHighlight.forEach(textNode => {
      const parent = textNode.parentNode;
      const value = textNode.nodeValue;

      const regex = new RegExp(`(${searchText})`, 'gi');
      const parts = value.split(regex);

      const fragment = document.createDocumentFragment();

      parts.forEach(part => {
        if (part.toLowerCase() === searchText) {
          const span = document.createElement("span");
          span.className = "highlight";
          span.textContent = part;
          fragment.appendChild(span);
        } else {
          fragment.appendChild(document.createTextNode(part));
        }
      });

      parent.replaceChild(fragment, textNode);
    });
  }
</script>



<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>  <!-- Add this line -->
<script src="{{ asset('js/bootstrap.js') }}"></script>

