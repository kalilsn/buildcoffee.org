<?php
/**
 * The Header for the homepage.
 *
 * @package _bctheme
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<?php $base_url = get_template_directory_uri(); ?>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo $base_url ?>/assets/images/icons/apple-touch-icon.png">
	<link rel="icon" type="image/png" href="<?php echo $base_url ?>/assets/images/icons/favicon-32x32.png" sizes="32x32">
	<link rel="icon" type="image/png" href="<?php echo $base_url ?>/assets/images/icons/favicon-16x16.png" sizes="16x16">
	<link rel="manifest" href="<?php echo $base_url ?>/assets/images/icons/manifest.json">
	<link rel="mask-icon" href="<?php echo $base_url ?>/assets/images/icons/safari-pinned-tab.svg" color="#000000">
	<link rel="shortcut icon" href="<?php echo $base_url ?>/assets/images/icons/favicon.ico">
	<meta name="msapplication-config" content="<?php echo $base_url ?>/assets/images/icons/browserconfig.xml">
	<meta name="theme-color" content="#ffffff">
	<?php wp_head(); ?>
</head>

<body>
<!--[if lt IE 9]>
	<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<header class="landing page">
	<div class="background-container">
		<img class="background" src="<?php echo $base_url ?>/assets/images/header-background-phone.jpg" srcset="<?php echo $base_url ?>/assets/images/header-background-phone.jpg 768w, <?php echo $base_url ?>/assets/images/header-background-tablet.jpg 1024w, <?php echo $base_url ?>/assets/images/header-background-desktop.jpg 1920w, <?php echo $base_url ?>/assets/images/header-background-large.jpg 2560w">
	</div>
	<div id="header-wrapper" class="header-wrapper before-scroll">
		<div class="logo-wrapper">
			<svg class="logo" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 208.3 210.4" style="enable-background:new 0 0 208.3 210.4;" xml:space="preserve">
				<style type="text/css">
					.st0{fill:#DCDDDE;stroke:#010101;stroke-width:0.5;stroke-linejoin:round;stroke-miterlimit:10;}
					.st1{fill:#B2345E;stroke:#010101;stroke-width:0.5;stroke-linejoin:round;stroke-miterlimit:10;}
					.st2{fill:#EEA0A5;stroke:#010101;stroke-width:0.5;stroke-linejoin:round;stroke-miterlimit:10;}
				</style>
				<polygon id="shadow" class="st0" points="3,68.6 50.9,5.5 137.7,10.5 208,80.8 205.9,155.5 141.8,206 84,198 86.3,109 47.4,107.1
					45.2,193.3 5.8,185.3 "/>
				<g class="beam">
					<polygon class="st1" points="116.8,138 198.1,155.8 200.7,153.8 116.7,135    "/>
					<polygon class="st1" points="116.7,135 120.8,134.1 200.7,150.2 200.7,153.8  "/>
				</g>
				<g class="beam">
					<polyline class="st1" points="116.7,135 9.8,182.7 9.8,179.4 113.2,133.3 116.7,135   "/>
					<polygon class="st1" points="116.8,134.8 116.8,138 16,183.4 9.8,182.7   "/>
				</g>
				<g class="beam">
					<polygon class="st1" points="116.8,39.8 120.8,38.8 120.8,134.1 116.7,135    "/>
					<polygon class="st1" points="113.2,45.3 113.2,133.3 116.7,135 116.8,44.3    "/>
				</g>
				<g class="beam">
					<polygon class="st1" points="116.8,39.8 113.6,36.7 13.3,66.1 10,70.9    "/>
					<polygon class="st1" points="10,70.9 116.8,39.8 116.8,44.3 10,76.5  "/>
				</g>
				<g class="beam">
					<polygon class="st2" points="0.2,188.7 5.8,189.6 5.8,72 0.2,70.9    "/>
					<polygon class="st1" points="5.8,185.3 9.8,182.7 10,70.9 5.8,72     "/>
				</g>
				<g class="beam">
					<polygon class="st2" points="5.8,185.3 42.9,190.2 42.9,195.1 5.8,189.6  "/>
					<polygon class="st2" points="42.9,190.2 42.9,186.6 9.8,182.7 5.8,185.3  "/>
				</g>
				<g class="beam">
					<polygon class="st2" points="42.9,195.1 42.9,195.1 42.9,109.8 47.4,110.2 47.4,195.8     "/>
					<polygon class="st1" points="47.4,110.2 51.5,110.6 51.5,191 47.4,195.8  "/>
				</g>
				<g class="beam">
					<polygon class="st2" points="42.9,109.8 42.9,104.6 84,108.3 84,113.5    "/>
					<polygon class="st2" points="42.9,104.6 49.4,101.8 88.5,105.9 84,108.3  "/>
					<polyline class="st2" points="84,113.5 88.5,110.8 88.5,105.9 84,108.3 84,113.5  "/>
				</g>
				<g class="beam">
					<polygon class="st2" points="79.8,113.1 79.8,200.1 84,200.8 84,113.5    "/>
					<polyline class="st2" points="84,195.2 88.5,193.3 88.5,110.8 84,113.5 84,195.2  "/>
				</g>
				<g class="beam">
					<polygon class="st2" points="84,195.2 136,202.7 136,209 84,200.8    "/>
					<polygon class="st2" points="84,195.2 88.5,193.3 136,200 136,202.7  "/>
				</g>
				<g class="beam">
					<polygon class="st2" points="136,209 136,108.3 141.8,108.2 141.8,210    "/>
					<polygon class="st2" points="141.8,108.2 146.3,105.9 146.2,206 141.8,210    "/>
				</g>
				<g class="beam">
					<polygon class="st2" points="146.2,206 208,157.7 208,152.3 146.3,199.9  "/>
					<polygon class="st2" points="146.3,195.6 200.7,153.8 203.9,155.5 146.3,199.9    "/>
				</g>
				<g class="beam">
					<polygon class="st2" points="208,152.3 208,85.8 203.9,87.6 203.9,155.5  "/>
					<polygon class="st2" points="200.7,153.8 203.9,155.5 203.9,87.6 200.7,88.9  "/>
				</g>
				<g class="beam">
					<polygon class="st1" points="146.3,105.9 144.1,103.3 199.6,80.8 204.8,82.2  "/>
					<polygon class="st2" points="208,85.8 208,80.8 146.3,105.9 146.3,111    "/>
				</g>
				<g class="beam">
					<polyline class="st2" points="141.8,108.2 48.1,0.2 53.5,0.8 146.3,105.9 141.8,108.2     "/>
					<polygon class="st1" points="141.8,108.2 136,108.3 48.6,6.9 48.1,0.2    "/>
				</g>
				<g class="beam">
					<polygon class="st2" points="48.1,0.2 0.2,70.9 5.8,72 48.6,6.9  "/>
					<polygon class="st1" points="10,70.9 5.8,72 48.6,6.9 50.9,9.7   "/>
				</g>
				<g class="beam">
					<polygon class="st2" points="53.5,0.8 137.7,10.5 208,80.8 204.8,82.2 136,13.7 58.1,6.1  "/>
					<polygon class="st1" points="60.8,9.1 134.6,16.2 136,13.7 58.1,6.1  "/>
					<polygon class="st1" points="134.6,16.2 136,13.7 204.8,82.2 199.6,80.8  "/>
				</g>
				<g class="beam">
					<polygon class="st1" points="113.6,36.7 134.6,16.2 136.8,18.3 116.8,39.8    "/>
					<polygon class="st1" points="120.8,38.8 138.9,20.4 136.8,18.3 116.8,39.8    "/>
				</g>
				<g class="beam">
					<polygon class="st1" points="78.3,10.8 80.4,8.3 160.8,100 155.3,98.8    "/>
					<polygon class="st2" points="80.4,8.3 84.8,8.7 164.6,98.5 160.8,100     "/>
				</g>
				<g class="beam">
					<polygon class="st1" points="97.5,12.6 99.6,10.1 173.7,94.8 168.2,93.6  "/>
					<polygon class="st2" points="99.6,10.1 104,10.6 177.5,93.2 173.7,94.8   "/>
				</g>
				<g class="beam">
					<polygon class="st1" points="116.8,14.5 118.8,12 186.6,89.5 181.2,88.3  "/>
					<polygon class="st2" points="118.8,12 123.3,12.5 190.3,88 186.6,89.5    "/>
				</g>
			</svg>
		</div>
		<div class="address-wrapper">
			<svg id="nameplate" class="nameplate" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 754.67 174.45"><defs><style>.cls-1{fill:#fff;stroke:#fff;stroke-miterlimit:10;}</style></defs><polygon class="cls-1" points="0.5 1.95 754.11 0.5 754.17 173.94 0.5 168.94 0.5 1.95"/><path d="M36,138.46V33H58c18.26,0,32.73,4.45,32.73,27.25,0,11.31-5.46,16.93-16.19,20.51,13.93,3.34,19,13.42,19,26.6,0,21.27-10.26,31.11-31.25,31.11Zm21.58-64h3.56c8.18,0,9.9-6.62,9.9-14.77,0-12.54-5-12.48-12.27-12.42H57.54Zm0,48.93h2c11.38,0,13-5.33,13-17.52,0-10.14-2.91-17.4-12.93-17.4H57.54Z"/><path d="M105.51,99.26V33h21.58V98.62c0,17.75,0,25.43,9.55,25.43s9.55-7.68,9.55-25.43V33h21.58V99.26c0,21.74-4,41.25-31.13,41.25S105.51,121,105.51,99.26Z"/><path d="M182.42,138.46V33H204V138.46Z"/><path d="M219.12,138.46V33H240.7v90.82h21.23v14.65Z"/><path d="M272.07,138.46V33h22.29c28.58,0,35.4,10.2,35.4,34.16v34.57c0,24.61-4.92,36.74-35.64,36.74Zm21.58-14.94h.47c11,0,14.05-.64,14.05-10.08V56.67c0-7.38-4.57-8.61-13.7-8.67h-.83Z"/><path d="M361.07,103.25V68.33c0-20.86,7.17-37.38,31-37.38C414.15,30.94,422,45.77,422,66.1v9.08H400.74V65.45c0-7.85-.53-18-8.72-18s-9.37,9.08-9.37,15.59v45.53c0,6.56,1.19,15.53,9.37,15.53,7.89,0,8.89-9.9,8.83-18.11V95.1H422l-.06,8.91c-.3,19-6.7,36.5-29.88,36.5C368.31,140.51,361.07,123.58,361.07,103.25Z"/><path d="M433.12,103.77V68.33c0-20.92,7.41-37.38,31.19-37.38s31.25,16.46,31.25,37.38v34.92c0,20.33-7.59,37.27-31.25,37.27S433.12,124.11,433.12,103.77Zm40.86,4.8V63c0-6.74-1.42-15.59-9.67-15.59s-9.61,9-9.61,15.59v45.59c0,6.68,1.36,15.53,9.61,15.53S474,115.38,474,108.58Z"/><path d="M509.32,138.46V33h44.53V47.64H530.9V76.35h16.25v15H530.9v47.11Z"/><path d="M563.87,138.46V33H608.4V47.64H585.46V76.35H601.7v15H585.46v47.11Z"/><path d="M618.42,138.46V33H663V47.64H640V76.35h16.25v15H640v32.46H663v14.65Z"/><path d="M673.57,138.46V33H718.1V47.64H695.15V76.35H711.4v15H695.15v32.46H718.1v14.65Z"/></svg>

			<div class="address">6100 South Blackstone Ave, Chicago</div>
		</div>
		<nav>
			<?php
			bc_nav_menu();
			?>
		</nav>
		<div class="social">
			<div>
				<a href="https://www.facebook.com/buildcoffee/" target="_blank">
					<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 216 216" style="enable-background:new 0 0 216 216;" xml:space="preserve">
						<path d="M11.9,216C5.3,216,0,210.7,0,204.1V11.9C0,5.3,5.3,0,11.9,0h192.2c6.6,0,11.9,5.3,11.9,11.9v192.2c0,6.6-5.3,11.9-11.9,11.9
						H11.9z M149,216v-83.6h28.1l4.2-32.6H149V78.9c0-9.4,2.6-15.9,16.2-15.9l17.3,0V33.9c-3-0.4-13.2-1.3-25.2-1.3
						c-24.9,0-41.9,15.2-41.9,43.1v24H87.2v32.6h28.1V216H149z"/>
					</svg>
				</a>
			</div>
			<div>
				<a href="https://twitter.com/buildcoffee" target="_blank">
					<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 216 216" style="enable-background:new 0 0 216 216;" xml:space="preserve">
						<path d="M67.9,198C149.4,198,194,130.5,194,71.9c0-1.9,0-3.8-0.1-5.7c8.7-6.3,16.2-14,22.1-22.9c-8.1,3.6-16.7,5.9-25.5,7
							c9.3-5.5,16.2-14.2,19.5-24.5c-8.7,5.2-18.2,8.8-28.1,10.8c-16.8-17.8-44.9-18.7-62.7-1.9c-11.5,10.8-16.4,27-12.8,42.3
							C70.7,75.1,37.5,58.3,15,30.6C3.3,50.8,9.3,76.7,28.8,89.7c-7.1-0.2-14-2.1-20.1-5.5c0,0.2,0,0.4,0,0.6c0,21.1,14.9,39.3,35.6,43.4
							c-6.5,1.8-13.4,2-20,0.8c5.8,18.1,22.4,30.4,41.4,30.8c-15.7,12.3-35.1,19-55,19c-3.5,0-7-0.2-10.5-0.6
							C20.3,191.1,43.8,198,67.9,198"/>
					</svg>
				</a>
			</div>
			<div>
				<a href="https://instagram.com/buildcoffee" target="_blank">
					<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 216 216" style="enable-background:new 0 0 216 216;" xml:space="preserve">
						<g>
							<path d="M0,143.6c0-23.7,0-47.4,0-71.1c0.1-0.6,0.3-1.2,0.3-1.9c0.3-8.5,0.6-17,2.7-25.2C7.7,27,18.4,13.7,36,6.2
								c10.1-4.3,20.7-5.4,31.6-5.7c1.6,0,3.2-0.3,4.8-0.4c23.7,0,47.4,0,71.1,0c0.6,0.1,1.2,0.3,1.9,0.3c7.1,0.6,14.3,0.6,21.3,2
								c23.3,4.4,38.8,17.9,45.7,40.8c3.1,10.2,3.3,20.8,3.5,31.4c0.3,18.8,0.2,37.6,0.1,56.3c0,12,0.2,24.2-2.2,36
								c-4.6,23.1-17.8,38.5-40.5,45.5c-10.1,3.1-20.5,3.5-30.9,3.5c-23.9,0.2-47.8,0-71.8-0.1c-8.5-0.1-17-0.6-25.2-2.7
								c-18.4-4.7-31.7-15.4-39.2-33c-4.3-10.1-5.4-20.7-5.7-31.6C0.4,146.9,0.1,145.2,0,143.6z M196.2,108.1c0.1,0,0.1,0,0.2,0
								c0-9.1,0.2-18.1-0.1-27.2c-0.3-9.2-0.4-18.5-1.8-27.5c-2.5-16.2-12-26.9-28.1-31.1c-8.7-2.3-17.7-2.3-26.6-2.5
								c-19.6-0.2-39.3-0.3-58.9,0c-9.2,0.1-18.5,0.4-27.5,1.8c-16.2,2.5-26.9,12-31.1,28.1c-2.3,8.7-2.3,17.7-2.5,26.6
								c-0.2,19.6-0.3,39.3,0,58.9c0.1,9.2,0.4,18.5,1.8,27.5c2.5,16.2,12,26.9,28.1,31.1c8.7,2.3,17.7,2.3,26.6,2.5
								c19.6,0.2,39.3,0.3,58.9,0c9.2-0.1,18.5-0.4,27.5-1.8c15.7-2.4,26.3-11.3,30.8-26.9c2.4-8,2.5-16.3,2.7-24.6
								C196.3,131.4,196.2,119.8,196.2,108.1z"/>
							<path d="M107.9,52.5c30.7,0,55.7,25,55.7,55.7c0,30.6-25,55.5-55.6,55.5c-30.6,0-55.6-25-55.6-55.6C52.4,77.5,77.4,52.5,107.9,52.5
								z M108.1,72.2c-19.8,0-36,16-36,35.6c0,20,15.9,36.2,35.6,36.2c19.9,0,36.1-16,36.1-35.7C143.9,88.3,127.9,72.2,108.1,72.2z"/>
							<path d="M165.7,63.5c-7.2,0-13.1-5.8-13.1-13c0-7.2,5.8-13.1,13-13.1c7.3,0,13.1,5.8,13.1,13C178.7,57.6,172.9,63.4,165.7,63.5z"/>
						</g>
					</svg>
				</a>
			</div>
		</div>
	</div>
</header>
