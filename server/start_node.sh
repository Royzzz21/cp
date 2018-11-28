#!/bin/bash

source ./_config.sh
echo "PHP_BIN=$PHP_BIN"

############## move and run
#cd $WWW_DIR

node ./chart_server.js &
node ./orderbook_server.js &
node ./trade_req.js & 
node ./trade_res.js &
node ./recent_tx.js &
