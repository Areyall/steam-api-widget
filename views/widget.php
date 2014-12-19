<div class="container-fluid">
    <div class="row" style="padding-bottom:0px; margin-bottom: 5px;">
        <div class="col-xs-4">
            <a href="<?= $profile->GetProfileUrl() ?>" target="_blank" >
                <img src="<?= $profile->GetAvatarMedium() ?>" class="img-rounded center-block" style="padding:3px; background-color: <?= $profile->GetPersonaStateColor() ?>;" title="<?= $profile->GetPersonaName() ?>" />
            </a>
        </div>
        <div class="col-xs-8">
            <p>
                <a href="<?= $profile->GetProfileUrl() ?>" style="color:<?= $profile->GetPersonaStateColor() ?>;" target="_blank"><?= $profile->GetPersonaName() ?> (<?= $profile->GetPersonaState() ?>)</a> <br />
                Games owned <?= $games->GetGameCount() ?> <br />
                Games <em>not</em> played <?= $games->GetGamesNotPlayedCount() ?> (<?= $games->GetGamesNotPlayedPercentage() ?>%) <br />
                Since <?= $profile->GetTimeCreated('m/d/Y') ?>
            </p>
        </div>

    </div>
    <?php if ($profile->IsInGame()) : ?>
        <div class="row">
            <div class="col-xs-12">
                <p style="padding-bottom:0px; margin-bottom: 5px;">I'm currently playing</p>
                <?php $pgame = $games->GetGameByAppId($profile->GetGameId()) ?>
                <?php if($pgame) : ?>
                <a href="<?= $pgame->GetLink() ?>" target="_blank" title="<?= $pgame->GetName() ?>">
                    <img src="<?= $pgame->GetHeader() ?>" alt="<?= $pgame->GetName() ?>"/>
                </a>
                <?php else : ?>
					<b><?=$profile->GetGameExtraInfo()?></b>
                <?php endif; ?>
            </div>
        </div>
    <?php else : ?>
        <div class="row" style="padding-bottom:0px; margin-bottom: 5px;">
            <div class="col-xs-12" >
                <p>Recently played <?= $games->GetRecentPlayedGamesCount() ?> game<?= ($games->GetRecentPlayedGamesCount() == 1 ? '' : 's') ?></p>
            </div>
        </div>

        <?php foreach ($games->GetRecentPlayedGames($count) as $game) : ?>
            <div class="row" style="padding-bottom:0px; margin-bottom: 0px;">
                <a href="<?= $game->GetLink() ?>" target="_blank">
                    <div class="col-xs-12">
                        <p style="margin-bottom: 0px; padding-bottom:0px; color:<?= $profile->GetPersonaStateColor() ?>;">
                            <img style="margin:0px;" src="<?= $game->GetImage() ?>" title="<?= $game->GetName() ?>" /> &ndash; <?= $game->GetName() ?>
                        </p>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
