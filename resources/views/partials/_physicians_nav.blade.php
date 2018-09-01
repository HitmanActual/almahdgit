   <!--navBar-->
   <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Almahd Clinics</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="{{Request::is('/')?"active":""}}">

                @if(Auth::user()->clinic_id == 1)
                <a class="nav-link" href="/physician/pediatric">Current Visits</a>
                @endif     
                
                @if(Auth::user()->clinic_id == 2)
                <a class="nav-link" href="/physician/orthopedic">Current Visits</a>
                @endif 

                @if(Auth::user()->clinic_id == 3)
                <a class="nav-link" href="/physician/derma">Current Visits</a>
                @endif 

            </li>      
        </ul>
        

        <ul class="nav navbar-nav navbar-right mr-5">

        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ Auth::user()->doctorName }} <span class="caret"></span>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Profile</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        </div>
      </li>
        
        </ul>

      
    </div>
    </nav>
    <!--end of nav-->
