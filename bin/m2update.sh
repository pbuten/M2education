#!/bin/bash

php bin/magento setup:upgrade
php bin/magento setup:di:compile
#php bin/magento setup:static-content:deploy -f en_US
php bin/magento indexer:reindex
php bin/magento cache:clean
php bin/magento cache:flush
