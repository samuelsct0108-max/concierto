<div class="sidebar">
    <div class="sidebar-inner">
        <div class="sidebar-logo">
            <div class="peers ai-c fxw-nw">
                <div class="peer peer-greed">
                    <a class="sidebar-link td-n" href="{{ url('/', []) }}">
                        <div class="peers ai-c fxw-nw">
                            <div class="peer">
                                <div class="logo">
                                    <img src="https://www.mrpct.org/images/logo.svg">
                                </div>
                            </div>
                            <div class="peer peer-greed">
                                <h5 class="lh-1 mB-0 logo-text"> Maria Reina CT</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="peer">
                    <div class="mobile-toggle sidebar-toggle">
                        <a href="" class="td-n">
                            <i class="ti-arrow-circle-left"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>


        <ul class="sidebar-menu scrollable pos-r">
            @if (session('userRol') == 1)
                <li class="nav-item mT-30 actived">
                    <a class="sidebar-link" href="{{ url('/system', []) }}">
                        <span class="icon-holder">
                            <i class="c-red-500 ti-home"></i>
                        </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="sidebar-link" href="{{ url('/system/sales', []) }}">
                        <span class="icon-holder">
                            <i class="c-green-500 ti-money"></i>
                        </span>
                        <span class="title">Sales</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="sidebar-link" href="{{ url('/system/admin-sales', []) }}">
                        <span class="icon-holder">
                            <i class="c-deep-orange-500 ti-agenda"></i>
                        </span>
                        <span class="title">Admin sales</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="sidebar-link" href="{{ url('/system/collect-money', []) }}">
                        <span class="icon-holder">
                            <i class="c-deep-orange-500 ti-stats-up"></i>
                        </span>
                        <span class="title">Collect money</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="sidebar-link" href="{{ url('/system/users', []) }}">
                        <span class="icon-holder">
                            <i class="c-blue-500 ti-user"></i>
                        </span>
                        <span class="title">Users</span>
                    </a>
                </li>
            @endif
            @if (session('userRol') == 2)
               <li class="nav-item">
                     <a class="sidebar-link" href="{{ url('/system/sales', []) }}">
                        <span class="icon-holder">
                           <i class="c-green-500 ti-money"></i>
                        </span>
                        <span class="title">Sales</span>
                     </a>
               </li>
               <li class="nav-item">
                     <a class="sidebar-link" href="{{ url('/system/admin-sales', []) }}">
                        <span class="icon-holder">
                           <i class="c-deep-orange-500 ti-agenda"></i>
                        </span>
                        <span class="title">Admin sales</span>
                     </a>
               </li>
            @endif    
        </ul>
    </div>
</div>
