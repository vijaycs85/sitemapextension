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
      $this->statusCode[$url] = $this->getSession()->getStatusCode();

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

  /**
   * Visit an URL in sitemap.xml
   *
   * @Then /^I should see (?P<type>[^"]*) file$/
   */
  public function iShouldSeeSitemapElement($type) {
    switch (strtolower($type)) {
      case 'xml':
        $content_type = 'application/xml';
      break;
    }
    return $this->getSession()->getResponseHeader('Content-Type') == $content_type;
  }

}
