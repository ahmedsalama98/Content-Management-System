<div class="wn__sidebar">

    <aside class="widget search_widget">
        <ul class="list-group">
            <li class="list-group-item">
                <img id="profile-avatar" style="display: block; margin:auto; max-width:100%" src="{{ asset(Auth::user()->image_path) }}" alt="{{ Auth::user()->username }}" >
            </li>
            <li class="list-group-item">
                <a href="{{ route('user.dashboard') }}"> My Posts</a>
            </li>

            <li class="list-group-item">
                <a href="{{ route('post.create') }}"> Add Post</a>
            </li>


            <li class="list-group-item">
                <a href="{{ route('user.update-info.show') }}"> Update Information</a>
            </li>
            <li class="list-group-item">
                <a href="{{ route('user.update-password.show') }}"> Update Password</a>
            </li>
            <li class="list-group-item">
                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form-dash').submit();"> Logout</a>

                <form id="logout-form-dash" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>





          </ul>

    </aside>
</div>
