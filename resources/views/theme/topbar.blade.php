<nav class="navbar navbar-top navbar-expand navbar-dashboard navbar-dark ps-0 pe-2 pb-0">
    <div class="container-fluid px-0">
        <div class="d-flex justify-content-between w-100" id="navbarSupportedContent">
            <div class="d-flex align-items-center">
                <form method="get" action="{{ route('members.index') }}" class="navbar-search form-inline"
                    id="navbar-search-main">
                    <div class="input-group input-group-merge search-bar">
                        <input type="text" class="form-control" name="search" id="topbarInputIconLeft"
                            placeholder="Search" aria-label="Search" aria-describedby="topbar-addon">
                        <span class="input-group-text" id="topbar-addon">
                            <svg class="icon icon-xs" x-description="Heroicon name: solid/search"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </span>
                    </div>
                </form>
            </div>

            <!-- Navbar links -->
            <ul class="navbar-nav align-items-center">
                <li class="nav-item dropdown">
                    <a class="nav-link text-dark notification-bell unread dropdown-toggle"
                        data-unread-notifications="true" href="#" role="button" data-bs-toggle="dropdown"
                        data-bs-display="static" aria-expanded="false">
                        <h5><span class="fas fa-exclamation-circle"></span></h5>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-center mt-2 py-0">
                        <div class="list-group list-group-flush">
                            <a href="#"
                                class="text-center text-primary fw-bold border-bottom border-light py-3">Notifications</a>
                            @foreach ($expiredMembers as $member)
                                <a href="{{ route('members.membership.renew', ['id' => $member->id]) }}"
                                    class="list-group-item list-group-item-action border-bottom">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <img alt="Image placeholder"
                                                src="{{ asset('assets/img/bodybuilder.gym-black-wallpapers.jpg') }}"
                                                class="avatar-md rounded">
                                        </div>
                                        <div class="col ps-0 ms-2">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h4 class="h6 mb-0 text-small"> {{ $member->name }} </h4>
                                                </div>
                                                <div class="text-end">
                                                    <small class="text-danger"> {{ $member->membership_end_date }}
                                                    </small>
                                                </div>
                                            </div>
                                            <strong class="font-small mt-1 mb-0">Membership is expired</strong><br />
                                        </div>
                                    </div>
                                </a>
                            @endforeach

                            <a href="{{ route('alert.expired-members') }}"
                                class="dropdown-item text-center fw-bold rounded-bottom py-3">
                                <svg class="icon icon-xxs text-gray-400 me-1" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                    <path fill-rule="evenodd"
                                        d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                View all
                            </a>
                        </div>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link text-dark notification-bell unread dropdown-toggle"
                        data-unread-notifications="true" href="#" role="button" data-bs-toggle="dropdown"
                        data-bs-display="static" aria-expanded="false">
                        <h5><span class="fas fa-bell"></span></h5>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-center mt-2 py-0">
                        <div class="list-group list-group-flush">
                            <a href="#"
                                class="text-center text-primary fw-bold border-bottom border-light py-3">Notifications</a>
                            @foreach ($expiredMembers as $member)
                                <a href="{{ route('members.membership.payment', ['id' => $member->id]) }}"
                                    class="list-group-item list-group-item-action border-bottom">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <img alt="Image placeholder"
                                                src="{{ asset('assets/img/bodybuilder.gym-black-wallpapers.jpg') }}"
                                                class="avatar-md rounded">
                                        </div>
                                        <div class="col ps-0 ms-2">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h4 class="h6 mb-0 text-small"> </h4>
                                                </div>
                                                <div class="text-end">
                                                    <small class="text-danger"> {{ $member->last_payment_date }}
                                                    </small>
                                                </div>
                                            </div>
                                            <strong>Attention!</strong> {{ $member->name }} has an outstanding amount of
                                            ₹{{ $member->pending_amount }}. Please settle the dues to avoid any
                                            disruption in services.
                                        </div>

                                    </div>
                                </a>
                            @endforeach

                            <a href="{{ route('alert.unpaid-members') }}"
                                class="dropdown-item text-center fw-bold rounded-bottom py-3">
                                <svg class="icon icon-xxs text-gray-400 me-1" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                    <path fill-rule="evenodd"
                                        d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                View all
                            </a>
                        </div>
                    </div>
                </li>
                <li class="nav-item dropdown ms-lg-3">
                    <a class="nav-link dropdown-toggle pt-1 px-0" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="media d-flex align-items-center">
                            <img class="avatar rounded-circle" alt="Image placeholder"
                                src="{{ asset('assets/img/bodybuilder.gym-black-wallpapers.jpg') }}">
                            <div class="media-body ms-2 text-dark align-items-center d-none d-lg-block">
                                <span
                                    class="mb-0 font-small fw-bold text-gray-900">{{ auth()->user()->first_name ? auth()->user()->first_name . ' ' . auth()->user()->last_name : 'User Name' }}</span>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu dashboard-dropdown dropdown-menu-end mt-2 py-1">
                        <a class="dropdown-item d-flex align-items-center" href="/profile">
                            <svg class="dropdown-icon text-gray-400 me-2" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            My Profile
                        </a>
                        <div role="separator" class="dropdown-divider my-1"></div>
                        <a class="dropdown-item d-flex align-items-center">
                            <livewire:logout />
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
