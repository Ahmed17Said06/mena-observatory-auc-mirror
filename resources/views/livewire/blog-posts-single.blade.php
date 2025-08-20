<div class="row">
    <div class="col-lg-8">
        <article>
            <header class="mb-4">
                <h1 class="mb-3">{{ $blog->title }}</h1>
                <div class="text-muted mb-3">
                    <small>
                        <i class="fas fa-calendar"></i> {{ $blog->publish_date->format('F j, Y') }}
                        <span class="mx-2">•</span>
                        <i class="fas fa-map-marker-alt"></i> {{ $blog->country->name }}
                        <span class="mx-2">•</span>
                        <i class="fas fa-eye"></i> {{ $blog->views }} views
                    </small>
                </div>
                @if($blog->image)
                    <img src="{{ Storage::url($blog->image) }}" class="img-fluid rounded mb-4" alt="{{ $blog->title }}">
                @endif
            </header>
            
            <div class="mb-4">
                <p class="lead">{{ $blog->description }}</p>
            </div>
            
            <div class="content">
                {!! $blog->content !!}
            </div>
            
            @if($blog->tags && $blog->tags->count() > 0)
                <div class="mt-4">
                    <h6>Tags:</h6>
                    @foreach($blog->tags as $tag)
                        <span class="badge bg-secondary me-1">{{ $tag->name }}</span>
                    @endforeach
                </div>
            @endif
        </article>
    </div>
    
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">About this Blog</h5>
                <p class="card-text">{{ $blog->description }}</p>
                <a href="{{ route('new_work') }}" class="btn btn-primary">Back to New Work</a>
            </div>
        </div>
    </div>
</div>