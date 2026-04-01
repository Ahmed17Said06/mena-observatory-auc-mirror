@if (session()->has('success'))
    <div id="flash-message" class="alert alert-success">
        {{ session()->get('success') }}
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var flashMessage = document.getElementById('flash-message');
            setTimeout(function () {
                flashMessage.style.display = 'none';
            }, 4000);
        });
    </script>
@endif
@if (session()->has('errors'))
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li class="text-white mb-0">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
