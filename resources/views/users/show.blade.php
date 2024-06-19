<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">

    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home / Twitter</title>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    @vite('resources/css/app.css')

    

</head>
<!-- nav bar starts -->
<nav>
    <a href="{{ route('home') }}">
        <div class="nav_logo-wrapper">
            <svg class="nav_logo" viewBox="0 0 24 24" aria-hidden="true"
                class="r-1cvl2hr r-4qtqp9 r-yyyyoo r-16y2uox r-8kz0gk r-dnmrzs r-bnwqim r-1plcrui r-lrvibr r-lrsllp">
                <g>
                    <path
                        d="M23.643 4.937c-.835.37-1.732.62-2.675.733.962-.576 1.7-1.49 2.048-2.578-.9.534-1.897.922-2.958 1.13-.85-.904-2.06-1.47-3.4-1.47-2.572 0-4.658 2.086-4.658 4.66 0 .364.042.718.12 1.06-3.873-.195-7.304-2.05-9.602-4.868-.4.69-.63 1.49-.63 2.342 0 1.616.823 3.043 2.072 3.878-.764-.025-1.482-.234-2.11-.583v.06c0 2.257 1.605 4.14 3.737 4.568-.392.106-.803.162-1.227.162-.3 0-.593-.028-.877-.082.593 1.85 2.313 3.198 4.352 3.234-1.595 1.25-3.604 1.995-5.786 1.995-.376 0-.747-.022-1.112-.065 2.062 1.323 4.51 2.093 7.14 2.093 8.57 0 13.255-7.098 13.255-13.254 0-.2-.005-.402-.014-.602.91-.658 1.7-1.477 2.323-2.41z">
                    </path>
                </g>
            </svg>
        </div>
    </a>

    <div class="Menu_options active">
        @auth

            <span class="material-icons">home</span>

            <a href="{{ route('dashboard') }}">
                <h2>Dashboard</h2>
            </a>
        @else

            <span class="material-icons">home</span>
            <a href="{{ route('register') }}">
                <h2>Home</h2>
            </a>
        @endauth
    </div>

    <div class="Menu_options">
        <span class="material-icons">group</span>
        <h2>Community</h2>
    </div>

    <div class="Menu_options">
        <span class="material-icons">notifications</span>
        <h2>Notification</h2>
    </div>

    <div class="Menu_options">
        @auth

            <span class="material-icons">person</span>

            <a href="{{ route('profile.edit') }}">
                <h2>Profile</h2>
            </a>
        @else

            <span class="material-icons">person</span>
            <a href="{{ route('register') }}">
                <h2>Profile</h2>
            </a>
        @endauth
    </div>


</nav>
<!-- nav bar end -->

<body class="main">
    <!-- main section start -->

    <main>
        <div class="header">
            <h2>{{ $user->name }}'s Posts</h2>
        </div>

        <div class="tweet_box">
            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="tweet_box-input">
                    <img src="{{ Vite::asset('resources/images/profile.jpg') }}" alt="profile image">
                    <textarea name="content" placeholder="What's happening?" class="tweet_input"></textarea>
                </div>
                <div class="tweet_box-actions">
                    <label for="file-input" class="file-label">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m18.375 12.739-7.693 7.693a4.5 4.5 0 0 1-6.364-6.364l10.94-10.94A3 3 0 1 1 19.5 7.372L8.552 18.32m.009-.01-.01.01m5.699-9.941-7.81 7.81a1.5 1.5 0 0 0 2.112 2.13" />
                        </svg>
                        <input id="file-input" type="file" name="image" class="hidden">
                    </label>
                    <button type="submit" class="tweet_button">Post</button>
                </div>
            </form>
        </div>

        @foreach ($posts as $post)
    <div class="post">
        <div class="post_profile-image">
            <img src="{{ Vite::asset('resources/images/profile.jpg') }}" alt="profile image">
        </div>

        <div class="post_body">
            <div class="post_header">
                <div class="post_header-text">
                    <h3>
                        <a href="{{ route('users.show', $post->user->id) }}">
                            {{ $post->user->name }}
                        </a>
                    </h3>
                    <span class="header-icon-section">
                        @if ($post->user->verified)
                            <span class="material-icons post_badge">verified</span>
                        @endif
                    </span>
                </div>
            </div>

            <div class="post_header-description">
                <p>{{ $post->content }}</p>
            </div>

            @if ($post->image_path)
                <img src="{{ Storage::disk('s3')->url($post->image_path) }}" alt="Post Image">
            @endif

            <div class="post_footer">
                <span class="material-icons">chat</span>
                <span class="material-icons">repeat</span>
                <span class="material-icons">favorite_border</span>
                <span class="material-icons">file_upload</span>
            </div>
        </div>
    </div>
@endforeach



    </main>
    <!-- main section end -->

    <!-- aside element start -->
    <aside>
        <div class="aside_input">
            <span class="material-icons aside_search-icon">search</span>
            <input type="text" placeholder="Search Twitter">

        </div>

        <div class="aside_container">
            <h2>Subscribe to Premium</h2>
            <blockquote class="twitter-tweet">
                <p>Subscribe to unlock new features and if eligible, receive a share of ads revenue.</p>
                <button style="width:120px; margin-top: 10px" class="tweet_button">Subscribe</button>
            </blockquote>

        </div>
        <div class="aside_container">
            <h2>Who to follow</h2>
            @foreach ($users as $user)
                <blockquote class="twitter-tweet inRow">
                    <div class="inRow">
                        <div class='profile_img'>
                            <img src="{{ Vite::asset('resources/images/profile.jpg') }}" alt="profile image">
                        </div>
                        <div>
                            <a href="{{ route('users.show', $user->id) }}">{{ $user->name }}</a>
                            <p>@ {{ $user->id }}</p>
                        </div>
                    </div>
                    <button style="background-color: black;" class="tweet_button">Follow</button>
                </blockquote>
            @endforeach
        </div>
    </aside>
    <!-- aside element ends -->


</body>


</html>

