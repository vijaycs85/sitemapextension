#!/usr/bin/env bash

DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"

while IFS=, read site tags
do
  echo "Processing for site: $site with $tags tags"
  export BEHAT_PARAMS='{"extensions":{"Behat\\MinkExtension":{"base_url":"'"$site"'"}}}'
  $DIR/../bin/behat --tags=$tags

done < $DIR/../data/sites.csv
