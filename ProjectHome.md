## Features ##

Adds the standard Facebook Comments dialog box to your Wordpress blog by replacing the comments template in your theme.  It does this without modifying your theme.  Your readers will then have the option of posting the comments they leave on your blog to their Facebook Walls, instantly catapulting you to blogosphere super-stardom.

## Requirements ##

  * A Facebook API key
  * An installation of Wordpress into which you can install plugins. (Users of Wordpress.com: this does not include you.)

I've tested the plugin in Wordpress 2.8, but it should work in all versions of Wordpress going back to 2.6.  If you do try the plugin in another version, please let me know if you succeed.

## Installation ##

  1. Download the plugin.
  1. Uncompress the plugin into your Wordpress path in `/wp-content/plugins/`. This should create a folder named "wpfb" in which all of the plugin's files will be stored.
  1. If you haven't already, add the Facebook Developer's application to your Facebook account.
  1. Unless you have one already, create a Facebook application.  You'll need the API key issued to you to finish setting up this plugin.
  1. Also, when you setup your Facebook application, you'll want to set the **Connect URL** to the URL of your Wordpress installation, e.g., http://aaroncollegeman.com
  1. After installing the plugin into Wordpress, you'll find a new administrative menu in the back-end: Connect.  On this options page you'll find a number of settings that you can configure to customize your Facebook Comments experience

## About The Project ##

This first release of the WPFB plugin sets the stage for a number of other features, the most important of which will be the archival into your local Wordpress database of the comments entered through the Facebook Comment box.  In other words, you'll get all the benefits of spreading links to your work on Facebook, without any of the loss associated with having your comments living only in the cloud.

For now, the plugin does one thing really well: it replaces the comments template in your theme (provided your theme uses the Wordpress function `get_comments()` to load the template, and most do).  All you have to do is download and install the plugin the way you would for any Wordpress plugin.

## The Story ##

Despite there being a number of other viable options for integrating Facebook Comments with Wordpress (probably), I thought there needed to be another one.  Something a bit easier to use (because I'm yet to encounter an easy to use Wordpress plugin).  And something to set the deal.

I met Blake Schwendiman through my work on the Squidoo project, and got to know him better through his personal blog.  Then there came a day when I needed to add Facebook Comments to another project I was working on.  Since Blake was already using Facebook Comments on his site, I thought he might be able to help me get a leg up in my own work.

Lucky for me, he agreed. While his code didn't give me the leg up I was looking for, it did help me to understand that integrating Facebook Comments into a Web site is a pretty simple task (especially if you have it all laid out for you). The deal was in exchange for his code, I would open source his approach to integrating Facebook Comments with Wordpress.

And now, you can benefit from our collaboration by incorporating this plugin into your own project.

## Disclaimer ##

Catapult to blogosphere super-stardom not included.