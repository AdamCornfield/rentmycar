<!-- A centralised component for the nav bar so that all pages will reference one point and it will remain conwsistant -->
<nav>
    <a class="page-title" href="/">rentmycar.io</a>
    <?php if (is_logged_in()) { ?>
        <a class="nav-link" href="/rentals">Edit Car Data</a>
    <?php } ?>
    <div class="nav-link ml-auto">
        <?php if (is_logged_in()) { ?>
            <div class="dropdown">
                <button class="btn btn-dark dropbtn" href="/logout" onclick="navbarDropdown()"><?php echo $userdata['username'] ?> ˅</button>
                <div id="myDropdown" class="dropdown-content">
                    <a href="/rentals">Manage Vehicles</a>
                    <div class="line-divider-full-nm"></div>
                    <a href="/logout" class="text-danger">Logout</a>
                </div>
            </div>
        <?php } else { ?>
            <a class="btn btn-dark" href="/login">Login</a>
        <?php } ?>
    </div>
</nav>