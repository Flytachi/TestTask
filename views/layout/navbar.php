<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/main">Главная</a>
            </li>
        </ul>
        <span class="navbar-text">
            <?php if(isset($_SESSION['id'])): ?>
                <a href="/auth/logout" class="btn btn-sm btn-danger">Выход</a>
            <?php else: ?>
                <button onclick="checkModal('/auth/login')" class="btn btn-sm">Вход</button>
            <?php endif; ?>
        </span>
    </div>
</nav>