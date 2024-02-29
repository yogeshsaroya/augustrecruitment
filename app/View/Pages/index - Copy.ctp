<style>

		.revo-slider-emphasis-text {
			font-size: 64px;
			font-weight: 700;
			letter-spacing: -1px;
			font-family: 'Gabarito', sans-serif;
			padding: 15px 20px;
			border-top: 2px solid #FFF;
			border-bottom: 2px solid #FFF;
		}

		.revo-slider-desc-text {
			font-size: 20px;
			font-family: 'Lato', sans-serif;
			width: 650px;
			text-align: center;
			line-height: 1.5;
		}

		.revo-slider-caps-text {
			font-size: 16px;
			font-weight: 400;
			letter-spacing: 3px;
			font-family: 'Gabarito', sans-serif;
		}

	</style>
		<section id="slider" class="slider-parallax revoslider-wrap clearfix">

			<!--
			#################################
				- THEMEPUNCH BANNER -
			#################################
			-->
			<div class="tp-banner-container">
				<div class="tp-banner" >
						<ul>    <!-- SLIDE  -->
					<li class="dark" data-transition="fade" data-slotamount="1" data-masterspeed="1000" data-thumb="images/slider/rev/main/s1-thumb.jpg"  data-saveperformance="off"  data-title="Welcome to Canvas">
						<!-- MAIN IMAGE -->
						<img src="images/videos/explore-poster.jpg"  alt="video_typing_cover"  data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat">
						<!-- LAYERS -->

						<!-- LAYER NR. 1 -->
						<div class="tp-caption tp-fade fadeout fullscreenvideo"
							data-x="0"
							data-y="0"
							data-speed="1000"
							data-start="1100"
							data-easing="Power4.easeOut"
							data-elementdelay="0.01"
							data-endelementdelay="0.1"
							data-endspeed="1500"
							data-endeasing="Power4.easeIn"
							data-autoplay="true"
							data-autoplayonlyfirsttime="false"
							data-nextslideatend="true"
				 data-volume="mute" data-forceCover="1" data-aspectratio="16:9" data-forcerewind="on" style="z-index: 2;"><video class="" preload="none" width="100%" height="100%"
				poster='images/videos/explore-poster.jpg'>
				<source src='images/videos/explore.mp4' type='video/mp4' />
				<source src='images/videos/explore.webm' type='video/webm' />

				</video>

						</div>

						<!-- LAYER NR. 2 -->
						<div class="tp-caption customin ltl tp-resizeme revo-slider-caps-text uppercase"
						data-x="350"
						data-y="235"
						data-customin="x:0;y:150;z:0;rotationZ:0;scaleX:1;scaleY:1;skewX:0;skewY:0;opacity:0;transformPerspective:200;transformOrigin:50% 0%;"
						data-speed="800"
						data-start="1000"
						data-easing="easeOutQuad"
						data-splitin="none"
						data-splitout="none"
						data-elementdelay="0.01"
						data-endelementdelay="0.1"
						data-endspeed="1000"
						data-endeasing="Power4.easeIn" style="z-index: 3;">The Best Multipurpose HTML5 Template</div>

						<div class="tp-caption customin ltl tp-resizeme revo-slider-emphasis-text nopadding noborder"
						data-x="116"
						data-y="260"
						data-customin="x:0;y:150;z:0;rotationZ:0;scaleX:1;scaleY:1;skewX:0;skewY:0;opacity:0;transformPerspective:200;transformOrigin:50% 0%;"
						data-speed="800"
						data-start="1200"
						data-easing="easeOutQuad"
						data-splitin="none"
						data-splitout="none"
						data-elementdelay="0.01"
						data-endelementdelay="0.1"
						data-endspeed="1000"
						data-endeasing="Power4.easeIn" style="z-index: 3;">Welcome to the World of Canvas</div>

						<div class="tp-caption customin ltl tp-resizeme revo-slider-desc-text"
						data-x="195"
						data-y="370"
						data-customin="x:0;y:150;z:0;rotationZ:0;scaleX:1;scaleY:1;skewX:0;skewY:0;opacity:0;transformPerspective:200;transformOrigin:50% 0%;"
						data-speed="800"
						data-start="1400"
						data-easing="easeOutQuad"
						data-splitin="none"
						data-splitout="none"
						data-elementdelay="0.01"
						data-endelementdelay="0.1"
						data-endspeed="1000"
						data-endeasing="Power4.easeIn" style="z-index: 3; width: 750px; max-width: 750px; white-space: normal;">Create a website that you are gonna be proud of. Be it Business, Portfolio, Agency, Photography, e-Commerce &amp; much more..</div>

						<div class="tp-caption customin ltl tp-resizeme"
						data-x="496"
						data-y="478"
						data-customin="x:0;y:150;z:0;rotationZ:0;scaleX:1;scaleY:1;skewX:0;skewY:0;opacity:0;transformPerspective:200;transformOrigin:50% 0%;"
						data-speed="800"
						data-start="1550"
						data-easing="easeOutQuad"
						data-splitin="none"
						data-splitout="none"
						data-elementdelay="0.01"
						data-endelementdelay="0.1"
						data-endspeed="1000"
						data-endeasing="Power4.easeIn" style="z-index: 3;"><a href="#" class="button button-border button-white button-light button-large button-rounded tright nomargin"><span>Start Tour</span> <i class="icon-angle-right"></i></a></div>

					</li>
					
				</ul>

				</div>
			</div>

			<script type="text/javascript">

				var tpj=jQuery;
				tpj.noConflict();

				tpj(document).ready(function() {

					var apiRevoSlider = tpj('.tp-banner').show().revolution(
					{
						dottedOverlay:"none",
						delay:9000,
						startwidth:1140,
						startheight:700,
						hideThumbs:200,

						thumbWidth:100,
						thumbHeight:50,
						thumbAmount:3,

						navigationType:"none",
						navigationArrows:"solo",
						navigationStyle:"preview4",

						touchenabled:"on",
						onHoverStop:"on",

						swipe_velocity: 0.7,
						swipe_min_touches: 1,
						swipe_max_touches: 1,
						drag_block_vertical: false,


						parallax:"mouse",
						parallaxBgFreeze:"on",
						parallaxLevels:[8,7,6,5,4,3,2,1],
						parallaxDisableOnMobile:"on",


						keyboardNavigation:"on",

						navigationHAlign:"center",
						navigationVAlign:"bottom",
						navigationHOffset:0,
						navigationVOffset:20,

						soloArrowLeftHalign:"left",
						soloArrowLeftValign:"center",
						soloArrowLeftHOffset:20,
						soloArrowLeftVOffset:0,

						soloArrowRightHalign:"right",
						soloArrowRightValign:"center",
						soloArrowRightHOffset:20,
						soloArrowRightVOffset:0,

						shadow:0,
						fullWidth:"off",
						fullScreen:"on",

						spinner:"spinner0",

						stopLoop:"off",
						stopAfterLoops:-1,
						stopAtSlide:-1,

						shuffle:"off",


						forceFullWidth:"off",
						fullScreenAlignForce:"off",
						minFullScreenHeight:"400",

						hideThumbsOnMobile:"off",
						hideNavDelayOnMobile:1500,
						hideBulletsOnMobile:"off",
						hideArrowsOnMobile:"off",
						hideThumbsUnderResolution:0,

						hideSliderAtLimit:0,
						hideCaptionAtLimit:0,
						hideAllCaptionAtLilmit:0,
						startWithSlide:0,
						fullScreenOffsetContainer: ".header"
					});

					apiRevoSlider.bind("revolution.slide.onchange",function (e,data) {
						if( $(window).width() > 992 ) {
							if( $('#slider ul > li').eq(data.slideIndex-1).hasClass('dark') ){
								$('#header.transparent-header:not(.sticky-header,.semi-transparent)').addClass('dark');
								$('#header.transparent-header.sticky-header,#header.transparent-header.semi-transparent.sticky-header').removeClass('dark');
								$('#header-wrap').removeClass('not-dark');
							} else {
								if( $('body').hasClass('dark') ) {
									$('#header.transparent-header:not(.semi-transparent)').removeClass('dark');
									$('#header.transparent-header:not(.sticky-header,.semi-transparent)').find('#header-wrap').addClass('not-dark');
								} else {
									$('#header.transparent-header:not(.semi-transparent)').removeClass('dark');
									$('#header-wrap').removeClass('not-dark');
								}
							}
							SEMICOLON.header.darkLogo();
						}
					});

				}); //ready

			</script>

			<!-- END REVOLUTION SLIDER -->

		</section>


		
<div class="section nobottommargin">
<div class="container clearfix">
<div class="heading-block center nobottommargin nobottomborder">

<div id="section-home" class="heading-block title-center nobottomborder page-section">
<h1>Energeti Career</h1>
<p>As hospitality consultants we understand that success is only achievable through the dedication and understanding of the individuals that are employed within an organization.  At August we help individuals and organizations achieve their respective goals by working as a bridge between them.  We help organizations find suitable and qualified individuals and we help individuals find employment opportunities that best suit their capabilities and experience.</p>
<p>If you are looking for more in-depth human resource services above and beyond recruitment, please follow the August Human Resources link below.</p>					
</div>
<div class="center bottommargin">
<a href="#" class="button button-3d button-teal button-xlarge nobottommargin">Employees Click Here</a> 
- OR - 
<a href="#" data-scrollto="#section-pricing" class="button button-3d button-red button-xlarge nobottommargin">Employers Click Here</a>

</div>
</div>
</div>
</div>

		
