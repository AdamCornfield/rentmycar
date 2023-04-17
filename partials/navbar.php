<nav>
    <a class="page-title" href="/">rentmycar.io</a>
    <a class="nav-link" href="#">Cars</a>
    <div class="nav-link ml-auto">
        <?php if (is_logged_in()) { ?>
            <a class="btn btn-dark" href="/logout">Logout</a>
        <?php } else { ?>
            <a class="btn btn-dark" href="/login">Login</a>
        <?php } ?>
    </div>
</nav>