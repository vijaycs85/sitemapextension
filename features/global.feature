@smoke
Feature: Sitemap availability
  In order to demonstrate the sitemap.xml available for SEO
  As a developer for the Behat Extension
  I need to provide test cases to check sitemap presence.

  # Check for sitemap.xml file in given site URL.
  Scenario: Check sitemap is available.
    Given I am on the homepage
    When I visit "sitemap.xml"
    Then I should see xml file
