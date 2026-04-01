<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
    id="">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="{{ route('home') }}"
            target="_blank">
            <!--<img src="./img/logo-ct-dark.png" class="navbar-brand-img h-100" alt="main_logo">-->
            <span class="ms-1 font-weight-bold">Mena Observatory</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="" id="">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'home' ? 'active' : '' }}" href="{{ route('home') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Home</span>
                </a>
            </li>
            <li class="nav-item mt-3 d-flex align-items-center">
                <div class="ps-4">
                    <i class="fab fa-laravel" style="color: #f4645f;"></i>
                </div>
                <h6 class="ms-2 text-uppercase text-xs font-weight-bolder opacity-6 mb-0">Administration</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'backend.statics.index' ? 'active' : '' }}" href="{{ route('backend.statics.index') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
			<i class="fas fa-calendar text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Static Content</span>
                </a>
	    </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'backend.blogs.index' ? 'active' : '' }}" href="{{ route('backend.blogs.index') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
			<i class="fas fa-calendar text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Blogs</span>
                </a>
	    </li>

	    <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'backend.event.index' ? 'active' : '' }}" href="{{ route('backend.event.index') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
			<i class="fas fa-calendar text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Events</span>
                </a>
	    </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'backend.news.index' ? 'active' : '' }}" href="{{ route('backend.news.index') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">News</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'backend.partners.index' ? 'active' : '' }}" href="{{ route('backend.partners.index') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-handshake text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Partners</span>
                </a>
            </li>
	    <li>
<div class="card">
                <a class="nav-link" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  Repo
            	</a>

            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
		 <ul>
		     <li class="nav-item">
                	<a class="nav-link " href="{{ route('backend.repos.index') }}">
                 	    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
        	                <i class="ni ni-single-copy-04 text-warning text-sm opacity-10"></i>
        	            </div>
        	            <span class="nav-link-text ms-1">Repos</span>
			</a>
			</li>
			<li>
                	<a class="nav-link " href="{{ route('backend.repo_types.index') }}"  >
                 	    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
        	                <i class="ni ni-single-copy-04 text-warning text-sm opacity-10"></i>
        	            </div>
        	            <span class="nav-link-text ms-1">Types</span>
			</a>
			</li>
			<li>
                	<a class="nav-link " href="{{ route('backend.repo_themes.index') }}">
                 	    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
        	                <i class="ni ni-single-copy-04 text-warning text-sm opacity-10"></i>
        	            </div>
        	            <span class="nav-link-text ms-1">Themes</span>
			</a>
			</li>
			<li>
                	<a class="nav-link " href="{{ route('backend.repo_tags.index') }}">
                 	    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
        	                <i class="ni ni-single-copy-04 text-warning text-sm opacity-10"></i>
        	            </div>
        	            <span class="nav-link-text ms-1">Tags</span>
        	        </a>
			</li>
		    </li>
		</ul>
            </div>
          </div>
	    </li>

            <li class="nav-item">
                <a class="nav-link " href="{{ route('sign-in-static') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-single-copy-04 text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Sign In</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{ route('sign-up-static') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-collection text-info text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Sign Up</span>
                </a>
	    </li>
        </ul>
    </div>
</aside>
