===  WordPress YouTube, Vimeo and more elements security Plugin (GDPR) ===
Contributors: 2plus2is4
Donate link: https://money.yandex.ru/to/41001417963743
Tags: iframe, YouTube, GDPR, Vimeo, Flickr, Issuu, Instagram, TED, thumbnails, Consent, Compliance
Requires at least: 5.0.1
Tested up to: 5.2.3
Stable tag: 1.2
Requires PHP: 5.2.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Integrate YouTube elements securely!

== Description ==

> Install, activate, and done!
> No content changes required.

WordPress YouTube security Plugin automatically detects and blocks Iframes from YouTube. Only with a click by the visitor the content is loaded.

Plugin automatically saves YouTube thumbnails locally without the visitor's IP address being transmitted to the video platform.

**Solves your problems**

*   Blocking Google/YouTube cookies
*   100% Plug-n-play functionality
*	No configuration required (it just works)
*	Allows you to keep YouTube videos under GDPR law
*	Scans Embedded content and blocks it
*	Works silently behind the scenes to protect your site visitors
*	Regularly updated and “future proof”

**Privacy**

This plugin does not collect or store any user data. It does not set any cookies. It connects to content holders third-party locations on the server side - no affect on users. Thus, this plugin does not affect user privacy in any way.

> Works perfectly with Gutenberg Block Editor

== Want more? ==
If you enjoy blocking YouTube videos and you want your other content (Vimeo, Flickr, Issuu and more) to be safe, consider purchasing the [premium version](https://checkout.freemius.com/mode/dialog/plugin/4426/plan/7118/).

= Premium features =
* All free features
* Integrate Vimeo videos securely!
* Integrate Issuu content securely!
* Integrate Flickr photos securely!
* Integrate Instagram securely!
* Integrate TED securely!

== Installation ==
1. Go to “plugins” in your Wordpress Dashboard, and click “add new”.
1. Click “upload”, and select the downloaded zip file.

1. Activate.
1. Enjoy!

== Frequently Asked Questions ==

= Does 'Local' mean my server downloads all the images? =

Yes. Usually you can find a folder `/wp-content/uploads/simple-youtube-gdpr-thumbnails` with all the images inside.

= What about no cookie youtube? =

Please replace `youtube.com` with `youtube-nocookie.com` when inserting a youtube link.

= Why there are black line above and below? =

This is an only image plugin can get from YouTube.

= Do I need to have any API? =

No.

= Does plugin make changes to my .htaccess file? =

Absolutely not. Unlike other security/firewall plugins, YouTube security Plugin makes no changes to any .htaccess file.

= Can I change CSS styles? =

Yes. Class:
* `syg__box` - main wrapping `<div>` (`syg__box-%SERVICE%` where `%SERVICE%` can be youtube, vimeo, issuu, ...)
* `syg__box__img` - the thumbnail
* `syg__box__text__btn` - thumbnail play button
* `syg__box__text` - Privacy Policy text

= What are sizes of preview image? =

It is trying to reach 100% of your content. (imitates WP iframe styles)

= How does this plugin work? =

1. Look for an iframe
1. Look for an existing thumbnail. If there are none of them, then download it
1. Replace an iframe with a picture
1. Apply scripts so that if user clicks iframe appears

= Got a question? =

Send any questions or feedback via my [contact site](https://alexeyvolkov.com/).

== Screenshots ==

Integrate YouTube, Vimeo and more elements securely!

1. YouTube video is replaced with a static preview image and a play button.
1. Twitter content is blocked and will be loaded with a button.

== Changelog ==

= 1.2 =
* html5
* aria

= 1.1 =
* Empty title and thumbnail if nothing provided

= 1.0 =
* HTML code passed via <template>
* `embed_oembed_html` filer used

= 0.8 =
* Issuu Blocker Integrated
* Flickr Blocker Integrated
* CSS classes changed

= 0.7 =
* Plans are added (Vimeo)
* CSS classes were changed

= 0.6 =
* Added Simple HTML DOM lib to run through DOM easily
* Removed lot's of code afterwards
* Now the whole figure is replaced with div with image (not just iframe. It caused troubles)

== Upgrade Notice ==

= 1.2 =
* Accessibility provided

= 1.1 =
* Twitter Blocker Integrated [premium]
* Stability enhanced

= 1.0 =
* Instagram Blocker Integrated [premium]
* TED Blocker Integrated [premium]
* Stability enhanced
* Size of plugin reduced

= 0.8 =
* HTML structure changed

= 0.7 =
* No content on the page bug is fixed.
* New design of play button
* Consent Text is added
= 0.6 =
Twenty Nineteen theme bug is fixed. It replaces the whole WordPress <figure> tag with an image.
