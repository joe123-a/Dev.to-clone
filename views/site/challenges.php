<?php
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var array $activeChallenges */
/** @var array $pastChallenges */

$this->title = 'DEV Challenges';
?>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

<style>
/* Scope all styles to this page */
.dev-challenges-page {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    background: #f9f9f9;
    padding: 20px 0;
}

.dev-challenges-page :root {
    --primary-color: #3b49df;
    --secondary-color: #2a38c7;
    --white: #ffffff;
    --text-color: #333333;
    --border-color: #e5e5e5;
    --hover-color: #e9ecef;
    --success-color: #22c55e;
    --warning-color: #facc15;
}

.dev-challenges-page .container {
    max-width: 1200px;
    padding: 2rem 1rem;
    margin: 0 auto;
}

.dev-challenges-page .hero-banner {
    text-align: center;
    margin-bottom: 2rem;
}

.dev-challenges-page .hero-banner img {
    max-width: 600px;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.dev-challenges-page .hero-banner h1 {
    font-size: 2rem;
    font-weight: 700;
    margin-top: 1rem;
}

.dev-challenges-page .intro-card {
    background: var(--white);
    padding: 1.5rem;
    border-radius: 12px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.08);
    margin-bottom: 2rem;
}

.dev-challenges-page .intro-card h5 {
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 1rem;
}

.dev-challenges-page .intro-card p {
    font-size: 0.95rem;
    line-height: 1.6;
}

.dev-challenges-page .section-title {
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 1.5rem;
}

.dev-challenges-page .challenge-card {
    background: var(--white);
    border-radius: 12px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.08);
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.dev-challenges-page .challenge-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.dev-challenges-page .challenge-title {
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
    color: var(--text-color);
}

.dev-challenges-page .challenge-description {
    font-size: 0.9rem;
    margin-bottom: 1rem;
    color: var(--text-color);
}

.dev-challenges-page .badge {
    font-size: 0.8rem;
    padding: 0.3rem 0.8rem;
    border-radius: 6px;
    margin-right: 0.5rem;
}

.dev-challenges-page .status-badge {
    background: var(--success-color);
    color: var(--white);
}

.dev-challenges-page .time-badge {
    background: var(--warning-color);
    color: var(--text-color);
}

.dev-challenges-page .tag-badge {
    background: var(--primary-color);
    color: var(--white);
}

.dev-challenges-page .no-challenges {
    font-size: 0.95rem;
    color: #6c757d;
    text-align: center;
    padding: 1rem;
}

/* Responsive Design */
@media (max-width: 767.98px) {
    .dev-challenges-page .hero-banner h1 {
        font-size: 1.75rem;
    }

    .dev-challenges-page .intro-card {
        padding: 1.25rem;
    }

    .dev-challenges-page .section-title {
        font-size: 1.25rem;
    }

    .dev-challenges-page .challenge-card {
        padding: 1.25rem;
    }

    .dev-challenges-page .challenge-title {
        font-size: 1.1rem;
    }

    .dev-challenges-page .challenge-description {
        font-size: 0.85rem;
    }

    .dev-challenges-page .badge {
        font-size: 0.75rem;
    }
}
</style>

<div class="dev-challenges-page">
    <div class="container">
        <!-- Hero Banner -->
        <div class="hero-banner">
            <img src="<?= Yii::getAlias('@web/images/challenges.webp') ?>" alt="DEV Challenges Banner">
            <h1>Join a DEV Online Hackathon or Writing Challenge</h1>
        </div>

        <!-- Intro Card -->
        <div class="intro-card">
            <h5>What are DEV Challenges? 🧠</h5>
            <p>DEV Challenges are mini hackathons that provide a fun opportunity for you to build up experience using new tools or to publicly show off your best skills to the community, potential employers and more.</p>
        </div>

        <!-- Active Challenges -->
        <h3 class="section-title">Active Challenges</h3>
        <?php if (!empty($activeChallenges)): ?>
            <?php foreach ($activeChallenges as $challenge): ?>
                <a href="<?= Url::to(['site/challenge', 'id' => $challenge->id]) ?>" style="text-decoration: none; color: inherit;">
                    <div class="challenge-card">
                        <div class="challenge-title"><?= Html::encode($challenge->title) ?></div>
                        <p class="challenge-description"><?= Html::encode($challenge->description) ?></p>
                        <div>
                            <span class="badge status-badge"><?= Html::encode($challenge->status) ?></span>
                            <?php if ($challenge->getTimeLeft()): ?>
                                <span class="badge time-badge"><?= Html::encode($challenge->getTimeLeft()) ?></span>
                            <?php endif; ?>
                            <?php foreach ($challenge->getTagsArray() as $tag): ?>
                                <span class="badge tag-badge"><?= Html::encode(trim($tag)) ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="no-challenges">No active challenges available at the moment.</p>
        <?php endif; ?>

        <!-- Past Challenges -->
        <h3 class="section-title mt-5">Past Challenges</h3>
        <?php if (!empty($pastChallenges)): ?>
            <?php foreach ($pastChallenges as $challenge): ?>
                <a href="<?= Url::to(['site/challenge', 'id' => $challenge->id]) ?>" style="text-decoration: none; color: inherit;">
                    <div class="challenge-card">
                        <div class="challenge-title"><?= Html::encode($challenge->title) ?></div>
                        <p class="challenge-description"><?= Html::encode($challenge->description) ?></p>
                        <div>
                            <span class="badge status-badge"><?= Html::encode($challenge->status) ?></span>
                            <?php foreach ($challenge->getTagsArray() as $tag): ?>
                                <span class="badge tag-badge"><?= Html::encode(trim($tag)) ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="no-challenges">No past challenges available.</p>
        <?php endif; ?>
    </div>
</div>
