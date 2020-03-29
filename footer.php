		<?php
		/*
		NOTE: Don't remove this line of code
		this serve as athe developer property
		that exist between the app and the third party
		*/
		//$app = new credit(); echo $app->developer();
		/*
developer credit
Don't temper or try to edit and modify
*/

/////////////////////////////////////////////////
		?>	
<!--<div style="text-align: right;position: fixed;z-index:9999999;bottom: 0;right: 1%; display:block !important;"><a title="NL Official Forum Script" target="_blank" href="https://nl.codexpress.info/?utm_source=nlscript&amp;utm_campaign=000_logo&amp;utm_medium=website&amp;utm_content=footer_img"><img src="<?php echo URL; ?>/images/newlabs.png" alt="Codexpress Nairaland" width="8%"></a></div>
-->

	<table id="down">
		<tbody>
			<tr>
				<td class="small w grad">
				    <form action="/search">
						<input name="q" size="32" type="text"> <input name="search" type="submit" value="Search">
					</form>
				    <p>
				        
		Sections:  
		<?php
		/*
		loop categories
		*/
		$query_cat = $db->query("SELECT * FROM category");
		while($data=$query_cat->fetch_assoc())
		{
		$cat_id=$data['cid'];
		$cat_title=$data['name'];
		$cat_alias=$data['url'];
		// fetch categories according to board id
		$query_sub = $db->query("SELECT * FROM sub_cat WHERE cid_fk='$cat_id' ORDER BY rand() LIMIT 5");
		

		//echo '<div class="category"><a href="./'.$cat_alias.'" title="'.$cat_title.'">'.strtoupper($cat_title).'</a></div>';
		
			while($datas=$query_sub->fetch_assoc())
			{
			$s_title=$datas['sname'];
			$url=$datas['surl'];
			$sid=$datas['sid'];
			echo '<a href="'.URL.'/forum/'.$url.'" title="'.$s_title.'">'.$s_title.'</a>, ';

			}  }// end category loop ?>
			</p>
				<!--<p>Links:  <a href="<?php echo WEBROOT; ?>/links/0">(0)</a> <a href="<?php echo WEBROOT; ?>/links/1">(1)</a> <a href="<?php echo WEBROOT; ?>/links/2">(2)</a> <a href="<?php echo WEBROOT; ?>/links/3">(3)</a> <a href="<?php echo WEBROOT; ?>/links/4">(4)</a> <a href="<?php echo WEBROOT; ?>/links/5">(5)</a> <a href="<?php echo WEBROOT; ?>/links/6">(6)</a> <a href="<?php echo WEBROOT; ?>/links/7">(7)</a> <a href="<?php echo WEBROOT; ?>/links/8">(8)</a> <a href="<?php echo WEBROOT; ?>/links/9">(9)</a>-->
</p>
					
					<b><a href="<?php echo WEBROOT; ?>" title="<?php echo APPNAME; ?>"><?php echo APPNAME; ?></a></b> - Copyright © 2019 - <?php echo date('Y'); ?> <a href="<?php echo AUTHORWEB; ?>" title="<?php echo AUTHOR; ?>" target="_blank"><?php echo AUTHOR; ?></a>. All rights reserved. See How To <a href="<?php echo WEBROOT; ?>/<?php echo $adlinker; ?>" title="Advertise">Advertise</a>. 
		<br><b>Disclaimer</b>: Every <?php echo APPNAME; ?> member is <b>solely responsible</b> for <b>anything</b> that he/she <b>posts</b> or <b>uploads</b> on <?php echo APPNAME; ?>.
		<?php
    echo useronline_spec($db);
    echo guestonline_spec($db)
  
  ?>

				</td>
			</tr>
		</tbody>
	</table>
	

<?php require 'incfiles/theme/footer.html'; ?>