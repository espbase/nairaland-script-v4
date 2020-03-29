<style type="text/css">
	.insta {
overflow-y: scroll;
overflow-x: hidden;
display: inline-block;
}
span.b {
display: inline-block;
padding: 10px;
}
</style>
<table>
	<tbody>
		<tr>
			<td class="">
				<h4>&clubs; Members Online:</h4>
				<!--
					//+$user_dump
				-->
				(<b><?php echo number_format(useronline($db)); ?> Members</b> and <b><?php echo number_format(guestonline($db)); ?> Guests</b> online in <b>last 5 minutes</b>!)
			</td>
		</tr>
		<?php
		// call birthday function
		if (postBirthdays($db)) {
		
		?>
		<tr>
			<td class="homeuser" >
				<h3>Birthdays:</h3>
				
				<span style="font-size: 9.5pt !important;">
					<?php
					// call birthday function
					echo postBirthdays($db);
				?></span>
			</td>
		</tr>
		<?php } ?>
		<tr>
			<td class="w">
				<style type="text/css">
					/* phone or baseline views **************************/
				main {
					
					margin: 0 auto;
				}
				main {
					display: grid;
					grid-template-columns: 1fr;
					font-size: 0.8rem;
				}
				/* Tablet Views ******************************/
				@media only screen and (min-width: 37.5em) {
					main {
						grid-template-columns: 1fr 1fr;
						margin: 1%;
					}
					section:nth-child(2) {
						display: block;
					}
					section:nth-child(3) {
						grid-column: span 2;
					}
					main picture {
						display: block;
					}
					main section{
						height: auto;
						margin: 5%;
					
					}
				}
				/* Desktop Views ****************************/
				@media only screen and (min-width: 60em) {
					main {
						grid-template-columns: 1fr 1fr 1fr;
					}
					section:nth-child(3) {
						grid-column: span 1;
					}
				}
				</style>
				<!--
				<main>
						<section>
						<iframe frameborder="0" scrolling="no" width="150%" height="300%" src="//www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2F<?php echo FB; ?>&amp;colorscheme=light&amp;show_faces=true&amp;header=false&amp;stream=false&amp;show_border=false&amp;appId=214922901863083" style="border:none; overflow:hidden;"></iframe>
					</section>
					<section>
					</section>
					<section>
						<span class="insta" style="width: 105%; height: 230px; display: inline-block; ">
							<a class="twitter-timeline" href="https://twitter.com/<?php echo TW; ?>">Tweets by <?php echo APPNAME; ?></a>
							<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
						</span>
					</section>
				</main>
				-->
				
				
			</td>
		</tr>
	</tbody>
</table>