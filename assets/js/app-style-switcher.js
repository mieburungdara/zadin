$(function () {
    "use strict";
    //****************************
    /* Left header Theme Change function Start */
    //****************************
    function handlelogobg() {
        $('.theme-color .theme-item .data-logobg').on("click", function () {
            var logobgskin = $(this).attr("data-logobg");
            $('.topbar .top-navbar .navbar-header').attr("data-logobg", logobgskin);
            localStorage.LogoBg = logobgskin;
            if (logobgskin == 'skin6') {
                // do this
                // $(".topbar .navbar").addClass('navbar-light');
                // $(".topbar .navbar").removeClass('navbar-dark');
                $('.navbar-brand').css({
                    'color': 'rgba(0, 0, 0, .9)',
                });
            } else {
                $('.navbar-brand').css({
                    'color': '#ffffff',
                });
                // do that
                // $(".topbar .navbar").removeClass('navbar-light');
                // $(".topbar .navbar").addClass('navbar-dark');
            }
        });
    };
    handlelogobg();
    //****************************
    /* Top navbar Theme Change function Start */
    //****************************
    function handlenavbarbg() {
        if ($('#main-wrapper').attr('data-navbarbg') == 'skin6') {
            // do this
            $(".topbar .navbar").addClass('navbar-light');
            $(".topbar .navbar").removeClass('navbar-dark');
        } else {
            // do that
        }
        $('.theme-color .theme-item .data-navbarbg').on("click", function () {
            var navbarbgskin = $(this).attr("data-navbarbg");
            $('#main-wrapper').attr("data-navbarbg", navbarbgskin);
            $('.topbar .navbar-collapse').attr("data-navbarbg", navbarbgskin);
            localStorage.NavbarBg = navbarbgskin;
            if ($('#main-wrapper').attr('data-navbarbg') == 'skin6') {
                // do this
                $(".topbar .navbar").addClass('navbar-light');
                $(".topbar .navbar").removeClass('navbar-dark');
                // $('#main-wrapper > header > nav > div.navbar-header > a.navbar-brand').css({
                //     'color': '#ffffff',
                // });
            } else {
                // do that
                $(".topbar .navbar").removeClass('navbar-light');
                $(".topbar .navbar").addClass('navbar-dark');
            }
            // if ($('#main-wrapper > header > nav > div.navbar-header').attr("data-logobg") == 'skin6') {
            //     // do that
            //     // $(".topbar .navbar").removeClass('navbar-light');
            //     // // $(".topbar .navbar").addClass('navbar-dark');
            //     // $('#main-wrapper > header > nav > div.navbar-header > a.navbar-brand').css({
            //     //     'color': 'rgba(0, 0, 0, .9)',
            //     // });
            // }
        });

    };

    handlenavbarbg();

    //****************************
    // ManageSidebar Type
    //****************************
    // function handlesidebartype() {
    $('#collapssidebar').change(function () {
        if ($(this).is(":checked")) {
            // $('#main-wrapper').attr("data-sidebar-position", 'fixed');
            // $('.topbar .top-navbar .navbar-header').attr("data-navheader", 'fixed');
        } else {
            // $('#main-wrapper').attr("data-sidebar-position", 'absolute');
            // $('.topbar .top-navbar .navbar-header').attr("data-navheader", 'relative');
        }
    });

    // };
    // handlesidebartype();


    //****************************
    /* Manage sidebar bg color */
    //****************************
    function handlesidebarbg() {
        $('.theme-color .theme-item .data-sidebarbg').on("click", function () {
            var sidebarbgskin = $(this).attr("data-sidebarbg");
            $('.left-sidebar').attr("data-sidebarbg", sidebarbgskin);
            localStorage.SidebarColor = sidebarbgskin;
        });
    };
    handlesidebarbg();
    //****************************
    /* sidebar position */
    //****************************
    function handlesidebarposition() {
        $('#sidebar-position').change(function () {
            if ($(this).is(":checked")) {
                $('#main-wrapper').attr("data-sidebar-position", 'fixed');
                $('.topbar .top-navbar .navbar-header').attr("data-navheader", 'fixed');
                localStorage.SidebarPosition = true;
            } else {
                $('#main-wrapper').attr("data-sidebar-position", 'absolute');
                localStorage.SidebarPosition = false;
                $('.topbar .top-navbar .navbar-header').attr("data-navheader", 'relative');
            }
        });

    };
    handlesidebarposition();
    //****************************
    /* Header position */
    //****************************
    function handleheaderposition() {
        $('#header-position').change(function () {
            if ($(this).is(":checked")) {
                $('#main-wrapper').attr("data-header-position", 'fixed');
                localStorage.HeaderPosition = true;
            } else {
                $('#main-wrapper').attr("data-header-position", 'relative');
                localStorage.HeaderPosition = false;
            }
        });
    };
    handleheaderposition();
    //****************************
    /* sidebar position */
    //****************************
    //****************************
    /* Header position */
    //****************************
    function handlethemeview() {
        $('#theme-view').change(function () {
            if ($(this).is(":checked")) {
                $('body').attr("data-theme", 'dark');
                localStorage.Theme = true;
            } else {
                $('body').attr("data-theme", 'light');
                localStorage.Theme = false;
            }
        });
    };
    handlethemeview();
});