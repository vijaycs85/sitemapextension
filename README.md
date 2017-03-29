# Behat Sitemap Extension

## Synopsis
Behat Sitemap Extension provides a way to smoke/sanity test all site pages by getting the URLs from `/sitemap.xml` and visiting them to see if we get 200 response.

## Motivation
- Provide a simple way to start with behat
- With minimal effort, sanity check all pages.


## Installation

### Quick start

Clone this repository and then run:

```bash
export BEHAT_PARAMS='{"extensions":{"Behat\\MinkExtension":{"base_url":"http://localhost"}}}'; bin/behat
```

> Note: Replace `http://localhost` with your site URL.

### Run for multiple sites

Add a CSV file of site URLs and tags to run with (Only available tag with this extension is "@smoke") and run:

```bash
./script/run-test.sh
```

## Contributors

Feel free to open an [issue](https://github.com/vijaycs85/sitemapextension/issues/new) or [pull request](https://github.com/vijaycs85/sitemapextension/pulls) to improve, add new features and bug fixes.


## License

This project is distributed under the terms of the [GNU General Public License version 2](https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html)
