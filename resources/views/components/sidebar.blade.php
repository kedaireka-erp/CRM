<div class="left-side-bar sidebar-light">
    <div class="brand-logo">
        <a href="/">
            <img src="https://allureindustries.com/files/uploads/2016/03/600.png" alt="" class="dark-logo" />
            <img src="https://allureindustries.com/files/uploads/2016/03/600.png" alt="" class="light-logo" />
        </a>
        <div class="close-sidebar" data-toggle="left-sidebar-close">
            <i class="ion-close-round"></i>
        </div>
    </div>
    <div class="menu-block customscroll">
        <div class="sidebar-menu">
            <ul id="accordion-menu">
                <li>
                    <a href="/" class="dropdown-toggle no-arrow {{ $slot == 'Home' ? 'active' : '' }}">
                        <i class="micon bi bi-house"></i> Home
                    </a>
                </li>
                @hasanyrole('Admin|Sales|QC')
                    <li>
                        <a href="/kontak" class="dropdown-toggle no-arrow {{ $slot == 'Kontak' ? 'active' : '' }}">
                            <i class="micon bi bi-people"></i> Kontak
                        </a>
                    </li>
                    <li>
                        <a href="/ncr" class="dropdown-toggle no-arrow {{ $slot == 'NCR' ? 'active' : '' }}">
                            <i class="micon bi bi-archive"></i> NCR
                        </a>
                    </li>
                    <li>
                        <a href="/memo" class="dropdown-toggle no-arrow {{ $slot == 'Memo' ? 'active' : '' }}">
                            <i class="micon bi bi-card-heading"></i> Memo
                        </a>
                    </li>
                    @endhasanyrole
                </ul>
            </div>
        </div>
    </div>
