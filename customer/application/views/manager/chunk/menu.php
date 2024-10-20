	<div id="footer-bar" class="footer-bar-1 footer-bar-detached">
        
        <?php
		if( (user_balance('buy_coin')>0))
		{
			$active = "";
			if($class=="rewards")
			{
				$active = "circle-nav-2 scale-box";
			}
			?>
			<a href="<?=site_url("rewards")?>" class="<?=$active?>"><i class="bi bi-percent"></i><span><?=custom_language('Reward')?></span></a>
		<?php
		}
		?>
        <?php
		 
			$active = "";
			if($class=="tasks")
			{
				$active = "circle-nav-2 scale-box";
			}
			?>
			<a href="<?=site_url("tasks")?>" class="<?=$active?>"><i class="bi bi-book"></i><span><?=custom_language('Tasks')?></span></a>
         <?php
		$active = "";
		if($class=="vote")
		{
			$active = "circle-nav-2 scale-box";
		}
		?>
        <a href="<?=site_url("vote")?>" class="<?=$active?>"><i class="bi bi-vector-pen"></i><span><?=custom_language('Vote')?> <small class="num_label">(<?=user_balance('votes')?>)</small></span></a>
		 
		<?php
		 
		$active = "";
		if($class=="home")
		{
			$active = "circle-nav-2 scale-box";
		}
		?>
        <a href="<?=site_url("home")?>" class="<?=$active?>"><i class="bi bi-house"></i><span><?=custom_language('Home')?></span></a>
		
		
        <?php
         
		$active = "";
		if($class=="activity")
		{
			$active = "circle-nav-2 scale-box";
		}
		?>
        <a href="<?=site_url("activity")?>?active=wd" class="<?=$active?>"><i class="bi bi-graph-up"></i><span><?=custom_language('Activity')?></span></a>
         <?php
		/*$active = "";
		if($class=="payment")
		{
			$active = "circle-nav-2 scale-box";
		}
		?>
        <a href="<?=site_url("payment")?>" class="<?=$active?>"><i class="bi bi-receipt"></i><span><?=custom_language('Payments')?></span></a>
         <?php
		*/
		/*$active = "";
		if($class=="profile")
		{
			$active = "circle-nav-2 scale-box";
		}
		?>
        <a href="<?=site_url("profile")?>" class="<?=$active?>"><i class="bi bi-person"></i><span><?=custom_language('Profiles')?></span></a>
		*/
		?>
		 <?php
		 
			$active = "";
			if($class=="leaderboard")
			{
				$active = "circle-nav-2 scale-box";
			}
			?>
			<a href="<?=site_url("leaderboard")?>" class="<?=$active?>"><i class="bi bi-people"></i><span><?=custom_language('Leaderboard')?></span></a>
    </div>