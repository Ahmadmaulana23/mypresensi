<!-- App Bottom Menu -->
<div class="appBottomMenu">
        <a href="/dashboard" class="item {{request()->is('dashboard') ? 'active' : '' }}">
            <div class="col">
            <ion-icon name="home-outline"></ion-icon>
                <strong>Home</strong>
            </div>
        </a>
        <a href="/presensi/cuti" class="item {{request()->is('presensi/cuti') ? 'active' : '' }} ">
            <div class="col">
            <ion-icon name="calendar-number-outline"></ion-icon>
                <strong>Cuti</strong>
            </div>
        </a>
        <a href="/presensi/create" class="item">
            <div class="col">
                <div class="action-button large">
                    <ion-icon name="camera" role="img" class="md hydrated" aria-label="add outline"></ion-icon>
                </div>
            </div>
        </a>
        <a href="/presensi/izin" class="item {{request()->is('presensi/izin') ? 'active' : '' }}">
            <div class="col">
            <ion-icon name="receipt-outline"></ion-icon>
                <strong>Izin</strong>
            </div>
        </a>
        <a href="/editprofile" class="item {{request()->is('editprofile') ? 'active' : '' }}">
            <div class="col">
                <ion-icon name="people-outline" role="img" class="md hydrated" aria-label="people outline"></ion-icon>
                <strong>Profile</strong>
            </div>
        </a>
    </div>
    <!-- * App Bottom Menu -->
