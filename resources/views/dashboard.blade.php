<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @foreach ($posts as $post)
                        <div class="post">
                            <div class="post_profile-image">
                                <img src="{{ Vite::asset('resources/images/profile.jpg') }}" alt="profile image">
                            </div>

                            <div class="post_body">
                                <div class="post_header">
                                    <div class="post_header-text">
                                        <h3>{{ $post->user->name }}</h3>
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

                                @if (Auth::id() == $post->user_id)
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">delete</button>
                                </form>
                            @endif
                            </div>
                        </div>  
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>