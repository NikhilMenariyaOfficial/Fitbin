<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<nav id="sidebarMenu" class="sidebar d-lg-block bg-gray-800 text-white collapse" data-simplebar>
    <div class="sidebar-inner px-2 pt-3">
        <div
            class="user-card d-flex d-md-none align-items-center justify-content-between justify-content-md-center pb-4">
            <div class="d-flex align-items-center">
                <div class="avatar-lg me-4">
                    @if (empty($setting))
                        <img src="/assets/img/team/profile-picture-3.jpg" class="card-img-top rounded-circle border-white"
                            alt="Bonnie Green">
                    @else
                        <img src="{{ asset('assets/img/' . $setting->software_logo) }}"
                            class="card-img-top rounded-circle border-white" alt="Bonnie Green">
                    @endif
                </div>
                <div class="d-block">
                    @auth
                        <h2 class="h5 mb-3">Hi {{ auth()->user()->first_name }}</h2>
                    @endauth
                    <a href="/login" class="btn btn-secondary btn-sm d-inline-flex align-items-center">
                        <svg class="icon icon-xxs me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                            </path>
                        </svg>
                        Sign Out
                    </a>
                </div>
            </div>
            <div class="collapse-close d-md-none">
                <a href="#sidebarMenu" data-bs-toggle="collapse" data-bs-target="#sidebarMenu"
                    aria-controls="sidebarMenu" aria-expanded="true" aria-label="Toggle navigation">
                    <svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </a>
            </div>
        </div>
        <ul class="nav flex-column pt-3 pt-md-0">
            {{-- @casual.fitness --------------------------------------------------------------------------------------------------- --}}

            <li class="nav-item bg-transparent p-1">
                @if (empty($setting))
                    <img class="rounded" src="{{ asset('assets/img/gym-black-wallpapers.jpg') }}" alt=""
                        srcset="">
                @else
                    <img class="rounded" src="{{ asset('assets/img/' . $setting->software_logo) }}" alt=""
                        srcset="">
                @endif
            </li>

            <li class="nav-item {{ Request::segment(1) == 'dashboard' ? 'active' : '' }}">
                <a href="/dashboard" class="nav-link">
                    <span class="sidebar-icon">
                        <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                            <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                        </svg>
                    </span>
                    <span class="sidebar-text">Dashboard</span>
                </a>
            </li>

            <li role="separator" class="dropdown-divider"></li><!-- section one start -->
            <li class="nav-item">
                <span
                    class="nav-link {{ Request::segment(1) !== 'members' ? 'collapsed' : '' }} d-flex justify-content-between align-items-center"
                    data-bs-toggle="collapse" data-bs-target="#submenu-members">
                    <span>
                        <span class="sidebar-icon"><i class="fas fa-users me-2" style="color: #ffffff;"></i></span>
                        <span class="sidebar-text" style="color: #ffffff;">Members</span>
                    </span>
                    <span class="link-arrow">
                        <svg class="icon icon-sm" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </span>
                </span>
                <div class="multi-level collapse {{ Request::segment(1) == 'members' ? 'show' : '' }}" role="list"
                    id="submenu-members" aria-expanded="false">
                    <ul class="flex-column nav">
                        <li
                            class="nav-item {{ Request::segment(1) === 'members' && Request::segment(2) === 'create' ? 'active' : '' }}">
                            <a href="{{ route('members.create') }}" class="nav-link">
                                <span class="sidebar-text">Create Member</span>
                            </a>
                        </li>
                        <li
                            class="nav-item {{ Request::segment(1) === 'members' && Request::segment(2) === null ? 'active' : '' }}">
                            <a href="{{ route('members.index') }}" class="nav-link">
                                <span class="sidebar-text">List Members</span>
                            </a>
                        </li>
                        <!-- Add more links as needed for managing members -->
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <span
                    class="nav-link {{ Request::segment(1) !== 'membership-plans' ? 'collapsed' : '' }} d-flex justify-content-between align-items-center"
                    data-bs-toggle="collapse" data-bs-target="#submenu-membership-plans">
                    <span>
                        <span class="sidebar-icon"><i class="fas fa-user-friends me-2"
                                style="color: #ffffff;"></i></span>
                        <span class="sidebar-text">Membership Plans</span>
                    </span>
                    <span class="link-arrow">
                        <svg class="icon icon-sm" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </span>
                </span>
                <div class="multi-level collapse {{ Request::segment(1) == 'membership-plans' ? 'show' : '' }}"
                    role="list" id="submenu-membership-plans" aria-expanded="false">
                    <ul class="flex-column nav">
                        <li
                            class="nav-item {{ Request::segment(1) == 'membership-plans' && Request::segment(2) == 'create' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('membership-plans.create') }}">
                                <i class="fa fa-plus me-2"></i>
                                <span class="sidebar-text">Create Plan</span>
                            </a>
                        </li>
                        <li
                            class="nav-item {{ Request::segment(1) == 'membership-plans' && !Request::segment(2) ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('membership-plans.index') }}">
                                <i class="fa fa-list-ul me-2" aria-hidden="true"></i>
                                <span class="sidebar-text">View Plans</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item {{ Request::segment(1) == 'membership-histories' ? 'active' : '' }}">
                <a href="{{ route('membership-histories.index') }}" class="nav-link">
                    <span class="sidebar-icon">
                        <i class="fas fa-user-friends me-2" style="color: #ffffff;"></i>
                    </span>
                    <span class="sidebar-text">Membership Histories</span>
                </a>
            </li>

            <li class="nav-item">
                <span
                    class="nav-link {{ Request::segment(1) !== 'personal-training' ? 'collapsed' : '' }} d-flex justify-content-between align-items-center"
                    data-bs-toggle="collapse" data-bs-target="#submenu-personal-training">
                    <span>
                        <span class="sidebar-icon">
                            <i class="fas fa-dumbbell me-2" style="color: #ffffff;"></i>
                        </span>
                        <span class="sidebar-text">Personal Training</span>
                    </span>
                    <span class="link-arrow">
                        <svg class="icon icon-sm" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </span>
                </span>
                <div class="multi-level collapse {{ Request::segment(1) == 'personal-training' ? 'show' : '' }}"
                    role="list" id="submenu-personal-training" aria-expanded="false">
                    <ul class="flex-column nav">
                        <li
                            class="nav-item {{ Request::segment(1) == 'personal-training' && Request::segment(2) == 'create' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('personal-training.create') }}">
                                <i class="fa fa-plus me-2"></i>
                                <span class="sidebar-text">Create Training</span>
                            </a>
                        </li>
                        <li
                            class="nav-item {{ Request::segment(1) == 'personal-training' && !Request::segment(2) ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('personal-training.index') }}">
                                <i class="fa fa-list-ul me-2" aria-hidden="true"></i>
                                <span class="sidebar-text">View Training</span>
                            </a>
                        </li>
                        <li
                            class="nav-item {{ Request::segment(1) == 'personal-training' && Request::segment(2) == 'members' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('personal-training.members') }}">
                                <i class="fa fa-list-ul me-2" aria-hidden="true"></i>
                                <span class="sidebar-text">View Members</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li role="separator" class="dropdown-divider"></li><!-- section one end -->


            <li role="separator" class="dropdown-divider"></li><!-- section two start -->
            <li class="nav-item mt-2">
                <span
                    class="nav-link {{ Request::segment(1) !== 'enquiry' ? 'collapsed' : '' }} d-flex justify-content-between align-items-center"
                    data-bs-toggle="collapse" data-bs-target="#submenu-enquiry">
                    <span>
                        <span class="sidebar-icon"><i class="fa fa-question-circle me-2"
                                style="color: #ffffff;"></i></span>
                        <span class="sidebar-text">Enquiry</span>
                    </span>
                    <span class="link-arrow">
                        <svg class="icon icon-sm" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </span>
                </span>
                <div class="multi-level collapse {{ Request::segment(1) == 'enquiry' ? 'show' : '' }}" role="list"
                    id="submenu-enquiry" aria-expanded="false">
                    <ul class="flex-column nav">
                        <li
                            class="nav-item {{ Request::segment(1) === 'enquiry' && Request::segment(2) === 'create' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('enquiry.create') }}">
                                <i class="fa fa-list-ul me-2" aria-hidden="true"></i>
                                <span class="sidebar-text">Create Enquiry</span>
                            </a>
                        </li>
                        <li
                            class="nav-item {{ Request::segment(1) === 'enquiry' && Request::segment(2) === null ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('enquiry.index') }}">
                                <i class="fa fa-list-ul me-2"></i>
                                <span class="sidebar-text">Enquiries List</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <span
                    class="nav-link {{ Request::segment(1) !== 'overview' ? 'collapsed' : '' }} d-flex justify-content-between align-items-center"
                    data-bs-toggle="collapse" data-bs-target="#submenu-overview">
                    <span>
                        <span class="sidebar-icon"><i class="fa fa-search me-2" style="color: #ffffff;"></i></span>
                        <span class="sidebar-text">Overview</span>
                    </span>
                    <span class="link-arrow">
                        <svg class="icon icon-sm" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </span>
                </span>
                <div class="multi-level collapse {{ Request::segment(1) == 'overview' ? 'show' : '' }}"
                    role="list" id="submenu-overview" aria-expanded="false">
                    <ul class="flex-column nav">
                        <li
                            class="nav-item {{ Request::segment(1) == 'overview' && Request::segment(2) == 'members' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('overview.members') }}">
                                <i class="fa fa-list-ul me-2"></i>
                                <span class="sidebar-text">Member Overview</span>
                            </a>
                        </li>
                        <li
                            class="nav-item {{ Request::segment(1) == 'overview' && Request::segment(2) === 'income' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('overview.income') }}">
                                <i class="fa fa-list-ul me-2" aria-hidden="true"></i>
                                <span class="sidebar-text">Income Overview</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <span
                    class="nav-link {{ Request::segment(1) !== 'alert' ? 'collapsed' : '' }} d-flex justify-content-between align-items-center"
                    data-bs-toggle="collapse" data-bs-target="#submenu-alert">
                    <span>
                        <span class="sidebar-icon"><i class="fa fa-exclamation-triangle me-2"
                                style="color: #ffffff;"></i></span>
                        <span class="sidebar-text">Alert</span>
                    </span>
                    <span class="link-arrow">
                        <svg class="icon icon-sm" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </span>
                </span>
                <div class="multi-level collapse {{ Request::segment(1) == 'alert' ? 'show' : '' }}" role="list"
                    id="submenu-alert" aria-expanded="false">
                    <ul class="flex-column nav">
                        <li
                            class="nav-item {{ Request::segment(1) === 'alert' && Request::segment(2) === 'unpaid-members' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('alert.unpaid-members') }}">
                                <i class="fa fa-list-ul me-2"></i>
                                <span class="sidebar-text">Unpaid Member</span>
                            </a>
                        </li>
                        <li
                            class="nav-item {{ Request::segment(1) === 'alert' && Request::segment(2) === 'expired-members' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('alert.expired-members') }}">
                                <i class="fa fa-list-ul me-2" aria-hidden="true"></i>
                                <span class="sidebar-text">Expired Membership</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item mb-3">
                <span
                    class="nav-link {{ Request::segment(1) !== 'reports' ? 'collapsed' : '' }} d-flex justify-content-between align-items-center"
                    data-bs-toggle="collapse" data-bs-target="#submenu-reports">
                    <span>
                        <span class="sidebar-icon"><i class="fa fa-file-text me-2 text-white fw-bold"></i></span>
                        <span class="sidebar-text">Reports</span>
                    </span>
                    <span class="link-arrow">
                        <svg class="icon icon-sm" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </span>
                </span>
                <div class="multi-level collapse {{ Request::segment(1) == 'reports' ? 'show' : '' }}" role="list"
                    id="submenu-reports" aria-expanded="false">
                    <ul class="flex-column nav">
                        <li
                            class="nav-item {{ Request::segment(1) == 'reports' && Request::segment(2) == 'attendance' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('reports.attendance-reports') }}">
                                <i class="fa fa-list-ul me-2"></i>
                                <span class="sidebar-text">Attendance Report</span>
                            </a>
                        </li>
                        <li
                            class="nav-item {{ Request::segment(1) == 'reports' && Request::segment(2) ? 'generate' : '' }}">
                            <a class="nav-link" href="{{ route('reports.generate-reports') }}">
                                <i class="fa fa-list-ul me-2" aria-hidden="true"></i>
                                <span class="sidebar-text">Generate Report</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li role="separator" class="dropdown-divider"></li><!-- section two end -->


            <li role="separator" class="dropdown-divider"></li><!-- section three end -->
            <li class="nav-item mt-2 {{ Request::segment(1) == 'payments' ? 'active' : '' }}">
                <a href={{ route('payments.index') }} class="nav-link">
                    <span class="sidebar-icon">
                        <i class="fa fa-credit-card-alt text-white" style="color:white"></i>
                    </span>
                    <span class="sidebar-text">Payments</span>
                </a>
            </li>
            <li class="nav-item mb-2 {{ Request::segment(1) == 'attendance' ? 'active' : '' }}">
                <a href="{{ route('attendance.index') }}" class="nav-link">
                    <span class="sidebar-icon">
                        <i class="fa fa-check-square text-white"></i>
                    </span>
                    <span class="sidebar-text">Attendance</span>
                </a>
            </li>
            <li role="separator" class="dropdown-divider"></li><!-- section three end -->

            <li role="separator" class="dropdown-divider"></li><!-- section fourth start -->
            <li class="nav-item {{ Request::segment(1) == 'membership-request' ? 'active' : '' }}">
                <a href="{{ route('membership-request.pending.registrations') }}" class="nav-link">
                    <span class="sidebar-icon text-white text-lg">
                        <i class="fas fa-user-plus text-lg font-size-lg"></i>
                    </span>
                    <span class="sidebar-text text-white text-lg">Membership Requests</span>
                </a>
            </li>
            <li class="nav-item {{ Request::segment(1) == 'terms' ? 'active' : '' }}">
                <a href="{{ route('terms.index') }}" class="nav-link">
                    <span class="sidebar-icon text-white text-lg">
                        <i class="fa fa-cog text-lg font-size-lg"></i>
                    </span>
                    <span class="sidebar-text text-white text-lg">Terms and Conditions</span>
                </a>
            </li>

            <li role="separator" class="dropdown-divider"></li><!-- section fourth start -->
            <li class="nav-item {{ Request::segment(1) == 'settings' ? 'active' : '' }}">
                <a href="{{ route('settings') }}" class="nav-link">
                    <span class="sidebar-icon text-white text-lg"><i
                            class="fa fa-cog text-lg font-size-lg"></i></span>
                    <span class="sidebar-text text-white text-lg">Settings</span>
                </a>
            </li>
            <li role="separator" class="dropdown-divider"></li><!-- section fourth end -->

            {{-- ------------------------------------------------------------------------------------------------------------------ --}}
        </ul>
    </div>
</nav>
