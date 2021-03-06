Jetpack Onboarding
=============

Jetpack Onboarding is our attempt at exploring a better New User Experience flow when a user first sets up WordPress.

It is designed to be extensible, so that hosting companies that choose to bundle it can easily modify, add, or remove any of the steps that we've included by default.

Most of the code lives in the client, and uses [ReactJS](https://github.com/facebook/react) and Facebook's [Flux Dispatcher](https://github.com/facebook/flux) to manage the flow of data and UI updates.

This initiative is currently being led by Daniel Walmsley [@gravityrail](http://github.com/gravityrail) and Jesse Friedman [@jessefriedman](http://github.com/jessefriedman), with design by Dan Hauk [@danhauk](https://github.com/danhauk).

Previous contributors who laid the foundation are Luca Sartoni [@lucasartoni](https://github.com/lucasartoni), Dave Martin [@growthdesigner](http://github.com/growthdesigner) and Miguel Lezama [@lezama](http://github.com/lezama).

Pull Requests and Issues are always welcome. :)

## Integrating

This plugin publishes three hooks:
- jpo_started
- jpo_step_skipped
- jpo_step_complete

jpo_started is invoked when the user clicks the "Get Started ->" link on the front page of the wizard. The latter two "step" hooks are invoked with a string (a "slug") which names the step.

Each "jpo_step_completed" step is accompanied by a data hash, which at a minimum includes an entry called "completion", which is the % completion of the wizard. For example, a step completion hash for the "design" step might look like this:

```
$data = array(
	'themeId' => 'edit',
	'completion' => 60
)
```

An integration might look like this:

```php
<?php
/**
 * Plugin Name: My Jetpack Onboarding Tracking Plugin
 * Plugin URI: https://github.com/someone/jetpack-onboarding-tracker
 * Description: Tracking for Jetpack Onboarding
 * Version: 0.1
 */

class JetpackOnboardingTracking {
	static function track_jpo_usage() {
		add_action('jpo_started', array(__CLASS__, 'track_started'), 10, 1);
		add_action('jpo_step_skipped', array(__CLASS__, 'track_step_skipped'));
		add_action('jpo_step_completed', array(__CLASS__, 'track_step_completed'));
	}

	static function track_started( $siteType ) { // 'personal' or 'business'
		self::record_user_event('none', 'started');
	}

	static function track_step_skipped($step_slug) {
		self::record_user_event($step_slug, 'step_skipped', array());
	}

	static function track_step_completed($step_slug, $data) {
		// note: $data is an associative array of metadata related to the step completed
		// e.g. when the "design" step is completed, data looks like: {themeId: 'the-theme-id'}
		self::record_user_event($step_slug, 'step_completed', $data);
	}

	static function record_user_event($step_slug, $event_type, $data) {
		$current_user = wp_get_current_user();
		$event = array(
			'_event_type' => 'jpo_'.$event_type,
			'step' => $step_slug,
			'user_id' => $current_user->ID,
			'user_email' => $current_user->user_email,
			'_ip' => $_SERVER['REMOTE_ADDR'],
			'data' => $data
		);
		error_log("Recorded event: ".print_r($event, true));
	}
}

add_action( 'init',  array('JetpackOnboardingTracking', 'track_jpo_usage') );
}
```

## Building

```bash
cd /path/to/jetpack-onboarding
npm install         # install local dependencies
npm run build       # to build the css and javascript
```

Alternatively, `npm run watch` can be used to watch JS and SCSS files while actively developing, and `npm run build-production` can be used to build for production.

If you get errors running `npm run build`, it could be `node-sass` issues (e.g. missing binaries like scandir). In that case, run:

```bash
npm install node-sass
```

and try again to see if that fixes your issue.

Directory structure:

- client - this is where you come to edit javascript
  - actions - Flux actions. These are called by components, and manage server-side data updates and telling the Dispatcher that an event/update has occurred.
  - components - React components, written as JSX
  - constants - Shared JS constants
  - dispatcher - the Flux App Dispatcher
  - stores - Flux stores, which receive callbacks from the Dispatcher, modify client data state and tell subscribed components to update themselves
  - utils - currently just a wrapper for jQuery.ajax that handles the WP way of rendering JSON errors.
  - jetpack-onboarding.js - entry point for the JS client app
  - welcome-panel.js - entry point that configures and initialises the Welcome Panel on the dashboard.
- css - edit the SCSS files in here. CSS files are generated by grunt-sass (see above)
- font - just genericons
- js - the generated client JS bundles. DO NOT MODIFY. "grunt" handles this for you (see above)

## Debugging

If you load the dashboard with the parameter "jpo_reset=1", then all Jetpack Onboarding *AND* Jetpack data will be reset.

If you enable WP_DEBUG in wp-config.php, then you'll see some additional buttons on the wizard UI for resetting wizard progress data (just the wizard progress in this case, not Jetpack itself) and showing and hiding the spinner overlay.

## Filters

There's a few ways you can customise behaviour of JPO via filters.

### Skipping wizard steps

You can selectively disable any step with a filter, `jpo_wizard_step_enabled_{$STEP_SLUG}`. The step slugs are listed in `jetpack-onboarding-paths.js`.

e.g. to skip the title and layout (blog vs website) step:

```php
add_filter( 'jpo_wizard_step_enabled_title', '__return_false' );
add_filter( 'jpo_wizard_step_enabled_is-blog', '__return_false' );
```

These will also remove the corresponding review items from the final "review" page.

### Final step call-to-action

The final step has a "call to action" on the right which by default encourages the user to enter the customizer. The following filters allow hiding or modifying this behaviour.

#### Hiding the final step call to action

```php
add_filter( 'jpo_review_show_cta', '__return_false' );
```

#### Replacing the image and button text/link on final call to action

```php
add_filter( 'jpo_review_cta_image', 'my_cta_image_url' );
add_filter( 'jpo_review_cta_button_text', 'my_cta_button_text' );
add_filter( 'jpo_review_cta_button_url', 'my_cta_button_url' );

function my_cta_image_url() {
	return '/my-images/cta-promo.png';
}

function my_cta_button_text() {
	return 'Install our Premium Plugin';
}

function my_cta_button_url() {
	return 'http://example.com';
}
```

## Inserting the JPO wizard onto other pages

By default, JPO runs in the welcome panel, but you can run it by inserting a div with the id 'jpo-welcome-panel' into any other page, like this:

```php
// add assets
add_action( 'admin_enqueue_scripts', array( 'Jetpack_Onboarding_WelcomePanel', 'add_wizard_assets' ) );
// add wizard HTML
add_action( 'admin_notices', 'add_jpo_wizard' );
function add_jpo_wizard() {
	if ( get_option( Jetpack_Onboarding_EndPoints::HIDE_FOR_ALL_USERS_OPTION ) ) {
		return;
	}
	?>
	Jetpack_Onboarding_WelcomePanel::render_widget();
	<?php
}
```

Here's a more complete example that shows how to show the wizard on the Profile screen, as opposed to all screens:

```php
add_action( 'current_screen', 'jetpack_onboarding_show_on_profile' );
function jetpack_onboarding_show_on_profile( $screen ) {
	if ( 'profile' == $screen->base ) {
		// add assets
		add_action( 'admin_enqueue_scripts', array( 'Jetpack_Onboarding_WelcomePanel', 'add_wizard_assets' ) );
		// add wizard HTML
		add_action( 'admin_notices', 'add_jpo_wizard' );
	}
}

function add_jpo_wizard() {
	if ( get_option( Jetpack_Onboarding_EndPoints::HIDE_FOR_ALL_USERS_OPTION ) ) {
		return;
	}

	Jetpack_Onboarding_WelcomePanel::render_widget();
}
```

If you decide to show the wizard on another page, you may also want to disable showing the wizard on the dashboard. To do this, you can do the following:

```php
add_filter( 'jetpack_onboarding_show_on_dashboard', '__return_false' );
```

## Styling

### Move the top of the wizard down to expose top elements in dashboard

Inject this CSS:

```css
#jpo-welcome-panel {
	top: 100px !important;
}
```

### Add a logo inside the wizard panel as a background

Given a logo an image, e.g. http://example.com/wp-content/uploads/2017/MyHost_Logo.png, let's scale the logo, move it to the middle at the top, and move the content down:

```css
#jpo-welcome-panel {
    background-image: url( http://local.wordpress.goldsounds.wpvm.io/wp-content/uploads/2017/05/MyHost_Logo.png );
    background-repeat: no-repeat;
    background-position: 50% 30px;
    padding-top: 120px;
    background-size: 400px;
}
```