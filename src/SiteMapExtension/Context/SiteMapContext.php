<?php

namespace Vijaycs85\SiteMapExtension\Context;

use Behat\MinkExtension\Context\RawMinkContext;

/**
 * A context for working with sitemap.xml.
 */
class SiteMapContext extends RawMinkContext {

  private $urls = array();

  private $statusCode = array();

  /**
   * Gets sitemap.xml
   *
   * @Given /^I have URLs from sitemap$/
   */
  public function iHaveUrlsFromSitemap() {
    date_default_timezone_set('Europe/London');
    $this->visitPath('/sitemap.xml');
    $xml = $this->getSession()->getPage()->getContent();
    $sitemap = new \SimpleXMLElement($xml);
    foreach ($sitemap->url as $url) {
      $this->urls[] = (string)$url->loc;
    }
    return !empty($this->urls);
  }

  /**
   * Visit an URL in sitemap.xml
   *
   * @When /^I visit individidual URL in sitemap$/
   */
  public function iVisitIndividualUrlInSitemap() {
    foreach ($this->urls as $url) {
      echo "Visiting URL $url \n";
      try {
        $this->getSession()->visit($url);
      }
      catch (\Exception $e) {
        echo "Error while visiting $url. Error message is:" . $e->getMessage();
        continue;
      }
      if ($this->getSession()->getPage()->has('xpath', '//title')) {
        $this->statusCode[$url] = 200;
      }
      else {
        $this->statusCode[$url] = 500;
      }
    }
  }

  /**
   * Visit an URL in sitemap.xml
   *
   * @Then /^I see the page is available$/
   */
  public function iSeethePageIsAvailableToUser() {
    foreach ($this->statusCode as $url => $code) {
      $status =  "SUCCESS";
      if ($code != 200) {
        $status =  "FAILED";
      }
      echo $status . ': ' . $url . "\n";
    }
  }

}
