<div class="dropdown mt-2">
    <button class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-1" data-bs-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <svg class="icon icon-sm" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M5 4a1 1 0 00-2 0v7.268a2 2 0 000 3.464V16a1 1 0 102 0v-1.268a2 2 0 000-3.464V4zM11 4a1 1 0 10-2 0v1.268a2 2 0 000 3.464V16a1 1 0 102 0V8.732a2 2 0 000-3.464V4zM16 3a1 1 0 011 1v7.268a2 2 0 010 3.464V16a1 1 0 11-2 0v-1.268a2 2 0 010-3.464V4a1 1 0 011-1z">
            </path>
        </svg>
        <span class="visually-hidden">Toggle Dropdown</span>
    </button>
    <div class="dropdown-menu dropdown-menu-end pb-0">
        <span class="small ps-3 fw-bold text-dark">Show</span>
        <a class="dropdown-item d-flex justify-content-between align-items-center fw-bold" href="{{ route($route,['limit' => 10, 'search' => $search ?? null]) }}">
            @if ($limit == 10)
                <span>10</span>
                <span class="fas fa-check"></span>
            @else
                <span>10</span>
            @endif
        </a>
        <a class="dropdown-item d-flex justify-content-between align-items-center fw-bold" href="{{ route($route,['limit' => 20, 'search' => $search ?? null]) }}">
            @if ($limit == 20)
                <span>20</span>
                <span class="fas fa-check"></span>
            @else
                <span>20</span>
            @endif
        </a>
        <a class="dropdown-item d-flex justify-content-between align-items-center fw-bold" href="{{ route($route,['limit' => 50, 'search' => $search ?? null]) }}">
            @if ($limit == 50)
                <span>50</span>
                <span class="fas fa-check"></span>
            @else
                <span>50</span>
            @endif
        </a>
        <a class="dropdown-item d-flex justify-content-between align-items-center fw-bold" href="{{ route($route,['limit' => 100, 'search' => $search ?? null]) }}">
            @if ($limit == 100)
                <span>100</span>
                <span class="fas fa-check"></span>
            @else
                <span>100</span>
            @endif
        </a>
    </div>
</div>
