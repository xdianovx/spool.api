<x-head />

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">

            <x-aside/>

            <!-- Layout container -->
            <div class="layout-page">

                <x-navbar/>

                <!-- Content wrapper -->
                <div class="content-wrapper">

                    @yield('content')

                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>

    <x-footer />

</body>

</html>
