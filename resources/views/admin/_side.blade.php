        <aside class="left-sidebar" data-sidebarbg="skin5">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav" class="p-t-30">
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('admin.dashboard') }}" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('admin.pegawai') }}" aria-expanded="false"><i class="mdi mdi-account"></i><span class="hide-menu">Pegawai</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-folder"></i><span class="hide-menu">Data Master</span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="{{ route('admin.jabatan') }}" class="sidebar-link"><i class="mdi mdi-briefcase"></i><span class="hide-menu"> Jabatan </span></a></li>
                                <li class="sidebar-item"><a href="{{ route('admin.lokasi') }}" class="sidebar-link"><i class="mdi mdi-map-marker"></i><span class="hide-menu"> Kantor </span></a></li>
                                <li class="sidebar-item"><a href="{{ route('admin.libur') }}" class="sidebar-link"><i class="mdi mdi-calendar"></i><span class="hide-menu"> Libur Nasional </span></a></li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-alert"></i><span class="hide-menu">Report</span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="{{ route('admin.report.harian') }}" class="sidebar-link"><i class="mdi mdi-alert-octagon"></i><span class="hide-menu"> Report harian </span></a></li>
                                <li class="sidebar-item"><a href="{{ route('admin.report.bulanan') }}" class="sidebar-link"><i class="mdi mdi-alert-octagon"></i><span class="hide-menu"> Report bulanan </span></a></li>
                            </ul>
                        </li>   
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>