# Scaffold Child for Healthwatch Bucks

A child theme for the Scaffold Theme (https://github.com/dtw/hw-bucks-scaffold), tailored to Healthwatch Bucks (in theory)

## Description

The Scaffold Theme was originally created to be an overarching theme for Local Healthwatch WordPress sites, with specific local customisations in a child Theme. This is the child Theme for Healthwatch Bucks.

## Features

* Custom stand-alone Page templates with sidebar widget areas
* Custom "Your Story" webform to submit longer/more complicated feedback
* Custom workflow to send user off-site after commenting on `local_service`s, to collect demographic data (see note below), and then return to the site
* Comment threading support for Healthwatch Feedback (`hw-feedback`) plugin
* OpenGraph <meta> support built-in

### Demographic Data

To meet our GDPR obligations we avoid storing contact information and sensitive personal data together. We certainly don't want this information cached in a WordPress database. This theme supports redirection to a third-party survey to collect this data. For this to function effectively, ensure pages based on the following are not cached:
* page-about-you.php
* template-thanks.php

## License
Unless otherwise specified, all the plugin files, scripts and images are licensed under GNU General Public License version 2, see http://www.gnu.org/licenses/gpl-2.0.html.

## Dependencies

* Scaffold Theme - https://github.com/dtw/hw-bucks-scaffold
* AJAX Search Pro - https://ajaxsearchpro.com/ (was free, now requires a license)

### Recommended plugins

* YARRP - https://wordpress.org/plugins/yet-another-related-posts-plugin/

## Contributors
Original code (circa 1.0.0) by jasoncharlesstuartking - former WordPress developer, now Google Ad Grant guru https://kingjason.co.uk/