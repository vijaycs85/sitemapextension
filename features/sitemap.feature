@smoke
Feature: Sitemap support
  In order to demonstrate the sitemap.xml available for SEO
  As a developer for the Behat Extension
  I need to provide test cases for the sitemap support

  # These test scenarios assume to have drupal installation with /sitemap.xml available.

  Scenario: Check pages in sitemap are available.
    Given I have URLs from sitemap
    When I visit individidual URL in sitemap
    Then I see the page is available
