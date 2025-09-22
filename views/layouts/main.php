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
        :root {
            --primary-color: #3b49df;
            --background-color: #f9f9f9;
            --white: #ffffff;
            --border-color: #e5e5e5;
            --text-color: #333333;
            --hover-color: #f0f0f0;
        }

        body {
            background: var(--background-color);
            margin: 0;
            padding: 0;
            min-height: 100vh;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            line-height: 1.6;
            color: var(--text-color);
        }

        .container {
            max-width: 1200px;
            padding: 0 15px;
        }

        /* Navbar */
        .navbar {
            background: var(--white);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 0.75rem 0;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            font-size: 1.5rem;
            font-weight: 600;
        }

        .navbar-brand img {
            height: 36px;
            margin-right: 10px;
        }

        .input-group {
            max-width: 450px;
            width: 100%;
        }

        .form-control {
            border-radius: 50px;
            border: 1px solid var(--border-color);
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
        }

        .btn-primary {
            background: var(--primary-color);
            border: none;
            border-radius: 50px;
            padding: 0.5rem 1.25rem;
            transition: background 0.3s ease;
        }

        .btn-primary:hover {
            background: #2a36b1;
        }

        .nav-link {
            color: var(--text-color);
            font-size: 0.9rem;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            transition: background 0.2s ease;
        }

        .nav-link:hover {
            background: var(--hover-color);
        }

        .dropdown-menu {
            border-radius: 8px;
            border: 1px solid var(--border-color);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            padding: 0.5rem;
            min-width: 200px;
        }

        .dropdown-item {
            font-size: 0.9rem;
            padding: 0.5rem 1rem;
            border-radius: 4px;
        }

        .dropdown-item:hover {
            background: var(--hover-color);
        }

        .badge {
            font-size: 0.7rem;
            padding: 0.3rem 0.6rem;
            border-radius: 10px;
        }

        /* App Menu */
        .app-menu {
            position: fixed;
            top: 0;
            left: 0;
            width: 70px;
            height: 100%;
            background: var(--white);
            border-right: 1px solid var(--border-color);
            padding: 1rem 0;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            align-items: center;
            box-shadow: 2px 0 4px rgba(0, 0, 0, 0.05);
        }

        .app-menu .nav-link {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 0.75rem;
            margin: 0.25rem 0;
            border-radius: 8px;
            color: var(--text-color);
            text-decoration: none;
            transition: background 0.2s ease;
        }

        .app-menu .nav-link:hover {
            background: var(--hover-color);
        }

        .app-icon {
            width: 36px;
            height: 36px;
            object-fit: contain;
        }

        /* Sidebars and Feed */
        .left-sidebar, .right-sidebar {
            background: var(--white);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .feed {
            background: var(--white);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .welcome-card {
            background: var(--primary-color);
            color: var(--white);
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .welcome-card a {
            display: block;
            background: rgba(255, 255, 255, 0.15);
            color: var(--white);
            padding: 0.75rem;
            border-radius: 8px;
            text-decoration: none;
            margin-bottom: 0.75rem;
            font-size: 0.9rem;
            transition: background 0.2s ease;
        }

        .welcome-card a:hover {
            background: rgba(255, 255, 255, 0.25);
        }

        .notification-item {
            padding: 0.75rem;
            border-radius: 8px;
            transition: background 0.2s ease;
        }

        .notification-item:hover {
            background: var(--hover-color);
            cursor: pointer;
        }

        /* Responsive Design */
        @media (max-width: 767.98px) {
            .app-menu {
                display: none;
            }

            .navbar {
                padding: 0.5rem;
            }

            .navbar-brand {
                font-size: 1.2rem;
            }

            .input-group {
                max-width: 100%;
            }

            .left-sidebar, .right-sidebar, .feed {
                margin-top: 1rem;
                padding: 1rem;
                border-radius: 8px;
            }

            .left-sidebar ul.nav {
                flex-direction: row;
                flex-wrap: wrap;
                gap: 0.5rem;
            }

            .left-sidebar ul.nav li.nav-item {
                flex: 1 1 auto;
                text-align: center;
            }

            .left-sidebar ul.nav li.nav-item a.nav-link {
                padding: 0.5rem;
                font-size: 0.85rem;
            }

            .left-sidebar h5 {
                font-size: 0.9rem;
            }
        }

        @media (min-width: 768px) {
            .left-sidebar, .right-sidebar {
                min-height: calc(100vh - 80px);
            }
        }

        @media (min-width: 992px) {
            .container {
                max-width: 1140px;
            }
        }

        @media (min-width: 1200px) {
            .container {
                max-width: 1280px;
            }
        }
    </style>
    <!-- Add Font Awesome and Google Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
<?php $this->beginBody() ?>

<div class="container-fluid">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <!-- Brand Logo -->
            <a class="navbar-brand" href="<?= Yii::$app->homeUrl ?>">
                <?= Html::img('@web/images/logoo.webp', [
                    'alt' => 'Community Logo',
                    'class' => 'me-2',
                    'style' => 'height:36px;'
                ]) ?>
            </a>

            <!-- Mobile Toggle Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">
                <!-- Search Bar -->
                <form class="d-flex my-2 my-lg-0 mx-auto" role="search">
                    <div class="input-group">
                        <input class="form-control" type="search" placeholder="Find related Posts... powered by @joel" aria-label="Search">
                        <button class="btn btn-primary" type="submit">
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
                        <ul class="dropdown-menu dropdown-menu-end p-2">
                            <li class="dropdown-header d-flex justify-content-between align-items-center">
                                <span class="fw-medium">Notifications</span>
                                <a href="#" class="text-decoration-none small">Mark all as read</a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li class="notification-item mb-2">
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <img src="https://ui-avatars.com/api/?name=John+Doe&background=3b49df&color=fff" 
                                             width="32" height="32" class="rounded-circle" alt="User">
                                    </div>
                                    <div class="flex-grow-1 ms-2">
                                        <p class="mb-0 small">Joel Mug commented on your post</p>
                                        <small class="text-muted">2 minutes ago</small>
                                    </div>
                                </div>
                            </li>
                            <li class="notification-item mb-2">
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
                            <li class="notification-item mb-2">
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

                    <!-- User Dropdown and Create Post -->
                    <?php if (!Yii::$app->user->isGuest): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= Yii::$app->urlManager->createUrl(['posts/addposts']) ?>" title="Create Post">
                                <i class="fas fa-pen me-1"></i> Create Post
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="https://ui-avatars.com/api/?name=<?= urlencode(Yii::$app->user->identity->username ?? 'User') ?>&background=3b49df&color=fff" 
                                     width="32" height="32" class="rounded-circle me-2" alt="Profile">
                                <span class="d-none d-md-inline fw-medium"><?= Html::encode(Yii::$app->user->identity->username ?? 'User') ?></span>
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

<!-- App Menu -->
<?php
use yii\helpers\Url;
?>

<div class="app-menu">
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link" href="#" title="Firefox">
                <img src="<?= Url::to('@web/images/icons/icon1.webp') ?>" alt="Firefox" class="app-icon">
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#" title="Gmail">
                <img src="<?= Url::to('@web/images/icons/icon2.webp') ?>" alt="Gmail" class="app-icon">
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#" title="YouTube">
                <img src="<?= Url::to('@web/images/icons/icon3.webp') ?>" alt="YouTube" class="app-icon">
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#" title="Google Maps">
                <img src="<?= Url::to('@web/images/icons/icon4.webp') ?>" alt="Google Maps" class="app-icon">
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#" title="DEV">
                <img src="<?= Url::to('@web/images/icons/icon5.webp') ?>" alt="DEV" class="app-icon">
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#" title="Google">
                <img src="<?= Url::to('@web/images/icons/icon6.webp') ?>" alt="Google" class="app-icon">
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#" title="Discord">
                <img src="<?= Url::to('@web/images/icons/icon7.webp') ?>" alt="Discord" class="app-icon">
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#" title="Microsoft">
                <img src="<?= Url::to('@web/images/icons/icon8.webp') ?>" alt="Microsoft" class="app-icon">
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#" title="Amazon">
                <img src="<?= Url::to('@web/images/icons/icon9.webp') ?>" alt="Amazon" class="app-icon">
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#" title="GitHub">
                <img src="<?= Url::to('@web/images/icons/icon10.webp') ?>" alt="GitHub" class="app-icon">
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#" title="GitHub">
                <img src="<?= Url::to('@web/images/icons/icon11.webp') ?>" alt="GitHub" class="app-icon">
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#" title="GitHub">
                <img src="<?= Url::to('@web/images/icons/icon12.webp') ?>" alt="GitHub" class="app-icon">
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#" title="GitHub">
                <img src="<?= Url::to('@web/images/icons/icon13.webp') ?>" alt="GitHub" class="app-icon">
            </a>
        </li>
    </ul>
</div>

<div class="container">
    <div class="row">
        <!-- Left Sidebar -->
        <div class="col-12 col-md-3 col-lg-2 order-2 order-md-1 left-sidebar">
            <?= $this->render('//partials/_sidebar_left') ?>
        </div>

        <!-- Main Feed -->
        <div class="col-12 col-md-6 col-lg-7 order-1 order-md-2 py-3">
            <?= $content ?>
        </div>

        <!-- Right Sidebar -->
        <div class="col-12 col-md-3 col-lg-3 order-3 order-md-3 right-sidebar">
            <?= $this->render('//partials/_sidebar_right') ?>
        </div>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>