<ul class="nav">
          @if(!auth()->user()->isAdmin())
          <li class="nav-item "> 
            <a class="nav-link" href="{{route('bukus.index')}}">
              <i class="menu-icon mdi mdi-account"></i>
              <span class="menu-title">Lihat Buku</span>
            </a>
          </li>
          @else
          <li class="nav-item "> 
          <a class="nav-link" href="{{route('bukus.index')}}">
              <i class="menu-icon mdi mdi-account"></i>
              <span class="menu-title">Tambah Buku</span>
            </a>
          </li>  
      
        
 
          <li class="nav-item "> 
          <a class="nav-link" href="{{route('users.index')}}">
              <i class="menu-icon mdi mdi-account"></i>
              <span class="menu-title">Tambah User</span>
            </a>
          </li> 
          @endif  
         
        </ul>