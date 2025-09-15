<?php
use yii\helpers\Html;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <style>
        body {
            background: #f9f9f9;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            position: relative;
            
        }
        .left-sidebar, .right-sidebar {
            background: #fff;
            border: 1px solid #e5e5e5;
            border-radius: 8px;
        }
        .feed {
            background: #fff;
            border: 1px solid #e5e5e5;
            padding: 20px;
            border-radius: 8px;
        }
        /* Center the layout content horizontally */
.layout-wrapper {
    display: flex;
    justify-content: center;
    padding: 2rem 0;
}

        .welcome-card {
            background: #3b49df;
            color: #fff;
            border-radius: 8px;
            padding: 20px;
        }
        .welcome-card a {
            display: block;
            background: rgba(255,255,255,0.1);
            color: #fff;
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 6px;
            text-decoration: none;
        }
        .welcome-card a:hover {
            background: rgba(255,255,255,0.2);
        }
        .notification-item:hover {
            background-color: #f8f9fa;
            cursor: pointer;
        }
        .dropdown-menu {
            border: 1px solid rgba(0,0,0,.15);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
        .nav-link {
            padding: 0.5rem 0.75rem;
            border-radius: 0.375rem;
            transition: all 0.2s ease;
        }
        .nav-link:hover {
            background-color: #f8f9fa;
        }
        .badge {
            font-size: 0.6rem;
            padding: 0.25em 0.5em;
        }
        /* Linux-style App Menu (White Theme) */
        .app-menu {
            position: fixed;
            top: 0;
            left: 0;
            width: 60px;
            height: 100%;
            background: #ffffff;
            color: #333333; /* Dark text for readability on white background */
            padding: 10px 0;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            align-items: center;
            border-right: 1px solid #ddd; /* Lighter border for white theme */
        }
        .app-menu .nav-item {
            margin: 5px 0;
            width: 100%;
            text-align: center;
        }
        .app-menu .nav-link {
            color: #333333;
            font-size: 1.5rem;
            padding: 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
        }
        .app-menu .nav-link i {
            margin-bottom: 5px;
        }
        .app-menu .nav-link:hover {
            background: #f0f0f0; /* Light gray hover effect for white theme */
            border-radius: 5px;
        }
        /* Hide app menu on small screens */
        @media (max-width: 767.98px) {
            .app-menu {
                display: none;
            }
            .left-sidebar, .right-sidebar {
                margin-top: 15px;
                padding: 15px;
            }
            .feed {
                padding: 15px;
            }
            .left-sidebar ul.nav {
                flex-direction: row;
                flex-wrap: wrap;
                gap: 10px;
            }
            .left-sidebar ul.nav li.nav-item {
                flex: 1 1 auto;
                text-align: center;
            }
            .left-sidebar ul.nav li.nav-item a.nav-link {
                padding: 8px;
                font-size: 0.9rem;
            }
            .left-sidebar h5 {
                font-size: 1rem;
            }
            .navbar-brand {
                font-size: 1.2rem;
            }
            .navbar form {
                max-width: 100%;
            }
        }
        @media (min-width: 768px) {
            .container {
                max-width: 960px;
            }
            .left-sidebar, .right-sidebar {
                min-height: 100vh;
            }
        }
        @media (min-width: 992px) {
            .container {
                max-width: 1140px;
            }
        }
    </style>
    <!-- Add Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
<?php $this->beginBody() ?>

<div class="container-fluid">
   <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-2">
    <div class="container">
        <!-- Brand Logo -->
      <a class="navbar-brand fw-bold text-primary me-4" href="<?= Yii::$app->homeUrl ?>">
    <?= \yii\helpers\Html::img('@web/images/logoo.webp', [
        'alt' => 'Community Logo',
        'class' => 'me-2',
        'style' => 'height:40px;'  // adjust logo size
    ]) ?>

</a>

        <!-- Mobile Toggle Button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">
            <!-- Search Bar -->
            <form class="d-flex my-2 my-lg-0 mx-auto" role="search" style="max-width: 400px; width: 100%;">
                <div class="input-group">
                    <input class="form-control rounded-pill rounded-end" type="search" placeholder="Find related Posts...            powered by @joel" aria-label="Search">
                    <button class="btn btn-primary rounded-pill rounded-start" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>

            <!-- Navigation Icons -->
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                
                <!-- Notifications Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-bell fa-lg"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            3
                            <span class="visually-hidden">unread notifications</span>
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end p-2" style="width: 320px;">
                        <li class="dropdown-header d-flex justify-content-between align-items-center">
                            <span>Notifications</span>
                            <a href="#" class="text-decoration-none small">Mark all as read</a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li class="notification-item mb-2 p-2 rounded">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <img src="https://ui-avatars.com/api/?name=John+Doe&background=3b49df&color=fff" 
                                         width="32" height="32" class="rounded-circle" alt="User">
                                </div>
                                <div class="flex-grow-1 ms-2">
                                    <p class="mb-0 small">Joel mug commented on your post</p>
                                    <small class="text-muted">2 minutes ago</small>
                                </div>
                            </div>
                        </li>
                        <li class="notification-item mb-2 p-2 rounded">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <span class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center" 
                                          style="width: 32px; height: 32px;">
                                        <i class="fas fa-heart"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1 ms-2">
                                    <p class="mb-0 small">5 people liked your post</p>
                                    <small class="text-muted">1 hour ago</small>
                                </div>
                            </div>
                        </li>
                        <li class="notification-item mb-2 p-2 rounded">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <span class="bg-info text-white rounded-circle d-flex align-items-center justify-content-center" 
                                          style="width: 32px; height: 32px;">
                                        <i class="fas fa-user-plus"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1 ms-2">
                                    <p class="mb-0 small">New follower: Joel Mugambwa</p>
                                    <small class="text-muted">3 hours ago</small>
                                </div>
                            </div>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li class="text-center">
                            <a href="#" class="text-decoration-none small">View all notifications</a>
                        </li>
                    </ul>
                </li>

                <!-- User Dropdown and Create Post (when logged in) -->
                <?php if (!Yii::$app->user->isGuest): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= Yii::$app->urlManager->createUrl(['posts/addposts']) ?>" title="Create Post">
                            <i class="fas fa-pen"></i> Create Post
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://ui-avatars.com/api/?name=<?= urlencode(Yii::$app->user->identity->username ?? 'User') ?>&background=3b49df&color=fff" 
                                 width="32" height="32" class="rounded-circle me-2" alt="Profile">
                            <span class="d-none d-md-inline"><?= Html::encode(Yii::$app->user->identity->username ?? 'User') ?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Profile</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Settings</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-bookmark me-2"></i>Saved Posts</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <?= Html::beginForm(['/site/logout'], 'post', ['class' => 'd-inline']) ?>
                                    <button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt me-2"></i>Logout</button>
                                <?= Html::endForm() ?>
                            </li>
                        </ul>
                    </li>
                <?php else: ?>
                    <li class="nav-item d-flex align-items-center ms-2">
                        <a href="<?= Yii::$app->urlManager->createUrl(['auth/login']) ?>" class="btn btn-outline-primary me-2">Log in</a>
                        <a href="<?= Yii::$app->urlManager->createUrl(['auth/register']) ?>" class="btn btn-primary">Create account</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
</div>

<!-- Linux-style App Menu (White Theme) -->
<div class="app-menu">
    <ul class="nav flex-column">
        <li class="nav-item"><a class="nav-link" href="#" title="Firefox"><i class="fab fa-firefox"></i></a></li>
        <li class="nav-item"><a class="nav-link" href="#" title="Gmail"><i class="fab fa-google"></i></a></li>
        <li class="nav-item"><a class="nav-link" href="#" title="YouTube"><i class="fab fa-youtube"></i></a></li>
        <li class="nav-item"><a class="nav-link" href="#" title="Google Maps"><i class="fas fa-map-marked-alt"></i></a></li>
        <li class="nav-item"><a class="nav-link" href="#" title="DEV"><i class="fas fa-code"></i></a></li>
        <li class="nav-item"><a class="nav-link" href="#" title="Google"><i class="fab fa-google"></i></a></li>
        <li class="nav-item"><a class="nav-link" href="#" title="Discord"><i class="fab fa-discord"></i></a></li>
        <li class="nav-item"><a class="nav-link" href="#" title="Microsoft"><i class="fab fa-microsoft"></i></a></li>
        <li class="nav-item"><a class="nav-link" href="#" title="Amazon"><i class="fab fa-amazon"></i></a></li>
        <li class="nav-item"><a class="nav-link" href="#" title="GitHub"><i class="fab fa-github"></i></a></li>
    </ul>
</div>

<div class="layout-wrapper">
    <div class="container">
        <div class="row justify-content-center">
            <!-- Main Feed -->
            <div class="col-12 col-md-8 py-3">
                <?= $content ?>
            </div>
        </div>
    </div>
</div>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>