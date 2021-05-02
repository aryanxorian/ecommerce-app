#!/usr/bin/env bash

cd /ecommerce-app/

echo "Running behat tests..."
# run behat tests.
./behat tests/stories/
