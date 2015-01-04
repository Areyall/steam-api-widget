<div class="table">
 <div class="row">
		<div class="column" style="padding: 5px;">
			<a href="<?=$profile->GetProfileUrl()?>" target="_blank" >
				<img class="avatar bg <?=$profile->GetPersonaState()?>" src="<?=$profile->GetAvatarMedium()?>" title="<?=$profile->GetPersonaName()?>" />
			</a>
		</div>
		<div class="column" style="padding: 5px;">
			<p>
				<a class="fg <?=$profile->GetPersonaState()?>" href="<?= $profile->GetProfileUrl() ?>" target="_blank">
					<?= $profile->GetPersonaName() ?> (<?= $profile->GetPersonaState() ?>)
				</a> <br />
				Games owned <?= $games->GetGameCount() ?> <br />
				Games <em>not</em> played <?= $games->GetGamesNotPlayedCount() ?> (<?= $games->GetGamesNotPlayedPercentage() ?>%) <br />
				Since <?= $profile->GetTimeCreated('m/d/Y') ?>
			</p>
		</div>
	</div>
</div>
<?php if ($profile->IsInGame()) : ?>
<div class="message">
	<p>I'm currently playing</p> 
</div>
<div>
	<?php $pgame = $games->GetGameByAppId($profile->GetGameId()) ?>
	<?php if($pgame) : ?>
	<a href="<?= $pgame->GetLink() ?>" target="_blank" title="<?= $pgame->GetName() ?>">
		<img src="<?= $pgame->GetHeader() ?>" alt="<?= $pgame->GetName() ?>"/>
	</a>
	<?php else : ?>
		<div class="message">
		<p><b><?=$profile->GetGameExtraInfo()?></b></p>
		</div>
	<?php endif; ?>
</div>
<?php else : ?>
<div class="message">
	<p>Recently played <?= $games->GetRecentPlayedGamesCount() ?> game<?= ($games->GetRecentPlayedGamesCount() == 1 ? '' : 's') ?></p>
</div>
<div class="table">
	<?php foreach ($games->GetRecentPlayedGames($count) as $game) : ?>
		<div class="row">
			<a href="<?= $game->GetLink() ?>" target="_blank">
				<div class="column">
					<img src="<?= $game->GetImage() ?>" title="<?= $game->GetName() ?>" />
				</div>
				<div class="column" style="padding: 0px 5px 0px 5px">
					<p class="fg <?=$profile->GetPersonaState()?>">&ndash;</p>
				</div>
				<div class="column">
					<p class="fg <?=$profile->GetPersonaState()?>"> <?= $game->GetName() ?></p>
				</div>
			</a>
		</div>
	<?php endforeach; ?>
</div>
<?php endif; ?>

