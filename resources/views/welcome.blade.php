<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootsrap CSS CDN -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <title>Dashboard</title>
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-success navbar-dark">
        <div class="container-fluid">
        <!-- Links -->
        <ul class="navbar-nav">
            @if (Route::has('login'))
                @auth
                <div class="dropdown">
                    <button type="button" class="btn btn-light dropdown-toggle px-4 py-1" data-bs-toggle="dropdown">{{ Auth::user()->name}}</button>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                      <li>
                        {{-- <a class="dropdown-item " href="{{ route('logout') }}">Logout</a> --}}
                        <form method="POST" action="{{ route('logout') }}" class="dropdown-item">
                            @csrf
        
                            <x-responsive-nav-link :href="route('logout')"
                                   class="text-decoration-none text-dark" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-responsive-nav-link>
                        </form>
                    </li>
                    </ul>
                  </div>
                {{-- <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>
    
                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
    
                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div> --}}
                @else
                    <li class="nav-item">
                        <a class="nav-link btn btn-light px-4 py-1" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-light px-4 py-1" href="{{ route('register') }}">Register</a>
                    </li>
                @endauth
            @endif
        </ul>
        </div>
    </nav>

    <div class="container my-4 text-center">
        <a href="" class="btn btn-dark px-4">Home</a>
    </div>

    <div class="container">
        <div class="card bg-light mt-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <form action="{{ route('import') }}"
                            method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="file"
                                class="form-control">
                            <br>
                            <button type="submit" class="btn btn-success">
                                Import User Data
                            </button>
                        </form>
                    </div>

                    <div class="col-md-6 col-sm-6 text-center py-4 border-4 border-start">
                        <form action="{{ route('export') }}"
                            method="POST">
                            @csrf
                            <button type="submit" class="btn btn-info">
                                Export as Excel
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <table class="table table-striped">
        <thead class="table-success">
        <tr>
                <th>Id</th>
                <th>Name</th>
                <th>email</th>
        </tr>
        </thead>
            <tbody>
            @if (count($user_list) > 0)
                @foreach ($user_list as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                    </tr>     
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
</body>
</html>