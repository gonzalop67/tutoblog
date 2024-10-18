{{-- {{ dd($menuPrincipal) }} --}}
<aside class="left-sidebar" data-sidebarbg="skin5">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="pt-4">
                {{-- <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('dashboard')}}" aria-expanded="false"><i
                            class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a>
                </li> --}}
                @foreach ($menuPrincipal as $key => $item)
                    @if ($item["menu_id"] != null)
                        @break
                    @endif
                    @include("theme.back.aside-menu-item", ["item" => $item])
                @endforeach
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
