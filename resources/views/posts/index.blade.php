@include('components.header')

<main style="max-width: 800px; margin: 30px auto; font-family: sans-serif;">
    <h1 style="color: #333; margin-bottom: 25px;">Բոլոր գրառումները</h1>

    @foreach($posts as $post)
        <div style="background: white; padding: 25px; border-radius: 12px; margin-bottom: 25px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); border: 1px solid #f0f0f0;">

            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                <div style="display: flex; align-items: center; gap: 12px;">
                    <img src="{{ $post->user->avatar_url }}"
                         style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; border: 1px solid #ddd;">

                    <a href="{{ route('user.profile', $post->user->id) }}" style="text-decoration: none; color: #007bff; font-weight: 600; font-size: 16px;">
                        {{ $post->user->name }}
                    </a>
                </div>
                <small style="color: #999;">{{ $post->created_at->diffForHumans() }}</small>
            </div>

            <h2 style="margin: 0 0 12px 0; color: #222; font-size: 22px;">{{ $post->title }}</h2>

            @if($post->images->count() > 0)
                <div id="carousel-{{ $post->id }}" style="position: relative; margin-top: 15px; border-radius: 8px; overflow: hidden; border: 1px solid #eee; background: #000;">

                    <div class="carousel-container" style="display: flex; overflow-x: auto; scroll-snap-type: x mandatory; scroll-behavior: smooth;">
                        @foreach($post->images as $img)
                            <div style="min-width: 100%; scroll-snap-align: start; display: flex; justify-content: center; align-items: center; background: #f8f8f8;">
                                <img src="{{ asset($img->image) }}"
                                     style="width: 100%; max-height: 500px; object-fit: cover; display: block;">
                            </div>
                        @endforeach
                    </div>

                    @if($post->images->count() > 1)
                        <button onclick="moveCarousel('{{ $post->id }}', -1)"
                                style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); background: rgba(0,0,0,0.5); color: white; border: none; border-radius: 50%; width: 35px; height: 35px; cursor: pointer; font-size: 18px; display: flex; align-items: center; justify-content: center; z-index: 10; transition: background 0.3s;"
                                onmouseover="this.style.background='rgba(0,0,0,0.8)'"
                                onmouseout="this.style.background='rgba(0,0,0,0.5)'">
                            &#10094;
                        </button>

                        <button onclick="moveCarousel('{{ $post->id }}', 1)"
                                style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: rgba(0,0,0,0.5); color: white; border: none; border-radius: 50%; width: 35px; height: 35px; cursor: pointer; font-size: 18px; display: flex; align-items: center; justify-content: center; z-index: 10; transition: background 0.3s;"
                                onmouseover="this.style.background='rgba(0,0,0,0.8)'"
                                onmouseout="this.style.background='rgba(0,0,0,0.5)'">
                            &#10095;
                        </button>

                        <div style="position: absolute; bottom: 15px; left: 50%; translate: -50% 0; display: flex; gap: 6px; background: rgba(0,0,0,0.3); padding: 5px 10px; border-radius: 20px;">
                            @foreach($post->images as $index => $img)
                                <div style="width: 6px; height: 6px; background: white; border-radius: 50%; opacity: 0.6;"></div>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endif

            <p style="color: #555; line-height: 1.6; font-size: 16px; margin-top: 15px; margin-bottom: 15px;">
                {{ $post->body }}
            </p>

        </div>
    @endforeach
</main>

<style>
    .carousel-container::-webkit-scrollbar {
        display: none;
    }
    .carousel-container {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>

<script>
    function moveCarousel(postId, direction) {
        const container = document.querySelector(`#carousel-${postId} .carousel-container`);
        const slideWidth = container.offsetWidth;

        container.scrollBy({
            left: direction * slideWidth,
            behavior: 'smooth'
        });
    }
</script>
