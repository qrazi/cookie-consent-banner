<?php
/**
 * Cookie Consent Banner plugin for Craft CMS 3.x
 *
 * Add a configurable cookie consent banner to the website.
 *
 * @link      https://adigital.agency
 * @copyright Copyright (c) 2018 Mark @ A Digital
 */

namespace adigital\cookieconsentbanner\variables;

use adigital\cookieconsentbanner\CookieConsentBanner;
use adigital\cookieconsentbanner\services\CookieConsentBannerService;

use Craft;
/**
 * Cookie Consent Banner Variable
 *
 * Craft allows plugins to provide their own template variables, accessible from
 * the {{ craft }} global variable (e.g. {{ craft.cookieconsentbanner }}).
 *
 * https://craftcms.com/docs/plugins/variables
 *
 * @author    Mark @ A Digital
 * @package   CookieConsentBanner
 * @since     1.1.7
 */
class CookieConsentBannerVariable
{
  // Public Methods
  // =========================================================================
  /**
   * Whatever you want to output to a Twig template can go into a Variable method.
   * You can have as many variable functions as you want.  From any Twig template,
   * call it like this:
   *
   *     {{ craft.cookieconsentbanner.exampleVariable }}
   *
   * Or, if your variable requires parameters from Twig:
   *
   *     {{ craft.cookieconsentbanner.exampleVariable(twigValue) }}
   *
   * @param null $optional
   * @return string
   */
   public function addBanner() {
	   if (Craft::$app->request->getIsCpRequest() || Craft::$app->request->getIsConsoleRequest() || (Craft::$app->request->hasMethod("getIsAjax") && Craft::$app->request->getIsAjax()) || (isset($_COOKIE['cookieconsent_status']) && $_COOKIE['cookieconsent_status'] == "dismiss") || (Craft::$app->request->hasMethod("getIsLivePreview") && (Craft::$app->request->getIsLivePreview() && $this->getSettings()->disable_in_live_preview))) {
		   return false;
	   }
	   return CookieConsentBanner::$plugin->cookieConsentBannerService->renderCookieConsentBanner();
   }
}