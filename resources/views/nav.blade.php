<header class="d-flex space-between flex-center flex-middle">
    <div class="nav-links d-flex flex-center flex-middle">
        <a href="/">
            <h2 class="logo logo-text red-color f-s-28 m-r-25">LETFLIX</h2>
            <h2 class="second-logo-text red-color f-s-28">L</h2>
        </a>
        <a href="/" class="nav-item home">Home</a>

        @foreach ($category as $key => $cate)
            <a href="{{ route('category', $cate->slug) }}" class="nav-item">{{ $cate->title }}</a>
        @endforeach
       
        
        <a href="#" onclick="return alert('Chưa biết làm gì cho nó hihi :))')" class="nav-item latest">Recents</a>
        <a href="{{ route('my_list') }}" class="nav-item">My List</a>
    </div>
    <div class="righticons d-flex flex-end flex-middle">
        <a href="{{ route('tim-kiem') }}"><img src="/images/icons/search.svg" alt="search icon"></a>
        {{-- <div class="dropdown notification">
            <img src="../images/icons/notification.svg" alt="notificatio icon">
            <div class="dropdown-content">
                <a href="#" class="profile-item d-flex flex-middle">
                    <img src="../../images/icons/user2.png" alt="user profile icon" class="user-icon">
                    <span>You have new notification from <span>User 123</span></span>
                </a>
                <a href="#" class="profile-item d-flex flex-middle">
                    <img src="../../images/icons/user1.png" alt="user profile icon" class="user-icon">
                    <span>You have new notification from <span>User 123</span></span>
                </a>
                <a href="#" class="profile-item d-flex flex-middle">
                    <img src="../../images/icons/user4.png" alt="user profile icon" class="user-icon">
                    <span>You have new notification from <span>User 123</span></span>
                </a>
                <a href="#" class="profile-item d-flex flex-middle">
                    <img src="../../images/icons/user3.png" alt="user profile icon" class="user-icon">
                    <span>You have new notification from <span>User 123</span></span>
                </a>
            </div>
        </div> --}}

        {{-- <div class="dropdown">
            <img src="../images/icons/user-image-green.png" alt="user profile icon" class="user-icon">
            <span class="profile-arrow"></span>

            <div class="dropdown-content">
                <div class="profile-links">
                    <a href="#" class="profile-item d-flex flex-middle">
                        <img src="../images/icons/user1.png" alt="user profile icon" class="user-icon">
                        <span>Rajesh</span>
                    </a>
                    <a href="#" class="profile-item d-flex flex-middle">
                        <img src="../images/icons/user2.png" alt="user profile icon" class="user-icon">
                        <span>Karan</span>
                    </a>
                    <a href="#" class="profile-item d-flex flex-middle">
                        <img src="../images/icons/user3.png" alt="user profile icon" class="user-icon">
                        <span>Pappy</span>
                    </a>
                    <a href="#" class="profile-item d-flex flex-middle"
                        style="margin-bottom: 13px;">
                        <img src="../images/icons/user4.png" alt="user profile icon" class="user-icon">
                        <span>Denny</span>
                    </a>
                    <a href="#" class="profile-item last">Manage Profiles</a>
                </div>
                <div class="line"></div>
                <div class="links d-flex direction-column">
                    <a href="user-profile/home.html">Account</a>
                    <a href="#">Help Center</a>
                    <a href="/">Sign Out of Netflix</a>
                </div>

            </div>
        </div> --}}

    </div>
</header>